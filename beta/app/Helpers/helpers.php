<?php

use Illuminate\Support\Facades\DB;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\Notification;
use App\Events\NotificationCreated;

function updateProfileComplete(int $profileScore): bool
{
    $userId = auth()->id();

    if (!$userId) {
        return false;
    }

    $profileComplete = $profileScore >= 25 ? 1 : 0;

    DB::table('users')
        ->where('id', $userId)
        ->update([
            'profile_complete' => $profileComplete,
        ]);
        
    return (bool) $profileComplete;
}
    
function getLinkedInJobs($offset = 0, $limit = 10, $timeFrame = '24h')
{
    $curl = curl_init();

    $url = "https://linkedin-job-search-api.p.rapidapi.com/active-jb"
         . "?time_frame={$timeFrame}"
         . "&limit={$limit}"
         . "&offset={$offset}"
         . "&description_format=html"
         . "&location=%22India%22";

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "x-rapidapi-host: linkedin-job-search-api.p.rapidapi.com",
            "x-rapidapi-key: fdf5746a43msh86327123b213bf3p1e83b7jsnf95f76534bc2"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    return $err ? null : $response;
}

function getUserNotifications($limit = 10)
{
    if (!Auth::check()) {
        return collect();
    }

    return Notification::where('user_id', Auth::id())
        ->latest()
        ->take($limit)
        ->get();
}

function sendNotification(
    $userId,
    $title,
    $message,
    $type = 'general',
    $url = null,
    $icon = 'fa-bell'
) {

    $notification = Notification::create([
        'user_id'    => $userId,
        'title'      => $title,
        'message'    => $message,
        'type'       => $type,
        'icon'       => $icon,
        'url'        => $url,
        'is_read'    => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    try {
        broadcast(new NotificationCreated($notification))->toOthers();
    } catch (\Throwable $e) {

        Log::error('Notification Broadcast Failed', [
            'error' => $e->getMessage(),
            'notification_id' => $notification->id,
            'user_id' => $userId,
        ]);
    }

    return $notification;
}

function unreadChatCount()
{
    $userId = Auth::id();

    if (!$userId) {
        return 0;
    }

    return DB::table('conversations')
        ->where(function ($q) use ($userId) {
            $q->where('employer_id', $userId)
                ->orWhere('freelancer_id', $userId);
        })
        ->selectRaw("
                SUM(
                    (
                        SELECT COUNT(*)
                        FROM messages m
                        WHERE
                            m.conversation_id = conversations.id
                            AND m.sender_id <> ?
                            AND NOT EXISTS (
                                SELECT 1
                                FROM message_reads mr
                                WHERE mr.message_id = m.id
                                AND mr.user_id = ?
                            )
                    )
                ) as total_unread
            ", [$userId, $userId])
        ->value('total_unread') ?? 0;
}


function getUserDetails($users_id, $fields)
{
    return DB::table('users')
        ->select($fields)
        ->where('id', $users_id)
        ->first();
}

function getCategories($fields)
{
    return DB::table('categories')
        ->select($fields)
        ->where('status', 1)
        ->get();
}

function send_mail($to, $type, $message, $cc = NULL)
{
    $from = config('mail.from.address', 'noreply@lanxers.com');
    $sender_name = config('mail.from.name', 'LANXERS');

    $hostname = config('mail.mailers.smtp.host', 'smtp.zeptomail.in');
    $retries = 3;

    for ($i = 0; $i < $retries; $i++) {
        try {
            config(['mail.mailers.smtp.host' => $hostname]);

            Mail::html($message, function ($mail) use ($to, $type, $from, $sender_name, $cc) {
                $mail->from($from, $sender_name)
                    ->to(trim($to))
                    ->subject($type);
            });
            return true;
        } catch (\Exception $e) {
            sleep(3);
        }
    }
    return false;
}


function imageCompress($sourcePath, $fileName, $height, $width)
{
    $imagePath = $sourcePath . $fileName;

    // Just check if file exists
    if (!file_exists($imagePath)) {
        return false;
    }

    // Skip compression and directly upload to S3
    $s3Image = moveToAws($imagePath);

    // Remove local file
    unlink($imagePath);

    return $s3Image;
}

function moveToAws($imagePath)
{
    $s3 = new S3Client([
        'region' => 'ap-south-1',
        'version' => 'latest',
        'credentials' => [
            'key'    => '',
            'secret' => '',
        ],
    ]);

    try {
        $result = $s3->putObject([
            'Bucket' => 'idpdefault',
            'Key'    => uniqid() . ".jpg",
            'SourceFile' => $imagePath,
        ]);
        return $result['ObjectURL'];
    } catch (AwsException $e) {
        "Error uploading file: " . $e->getMessage();
        die;
    }
}

function moveDocumentToAws($file)
{
    $s3 = new S3Client([
        'region' => 'ap-south-1',
        'version' => 'latest',
        'credentials' => [
            'key'    => '',
            'secret' => '',
        ],
    ]);

    try {

        $extension = strtolower($file->getClientOriginalExtension());

        $fileName = 'employer_documents/' . uniqid() . '.' . $extension;

        $result = $s3->putObject([
            'Bucket'      => 'idpdefault',
            'Key'         => $fileName,
            'SourceFile'  => $file->getRealPath(),
            'ContentType' => $file->getMimeType(),
        ]);

        return $result['ObjectURL'];
    } catch (AwsException $e) {

        \Log::error($e->getMessage());

        return null;
    }
}

function get_wallet($userId)
{
    $wallet = DB::table('wallets')->where('user_id', $userId)->first();

    if (!$wallet) {
        DB::table('wallets')->insert([
            'user_id'    => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $wallet = DB::table('wallets')->where('user_id', $userId)->first();
    }

    return $wallet;
}


function wallet_log($userId, $type, $amount, $contractId = null, $note = null, $reference = null)
{
    $wallet = get_wallet($userId);

    DB::table('wallet_transactions')->insert([
        'user_id'       => $userId,
        'type'          => $type,
        'amount'        => $amount,
        'balance_after' => $wallet->available_balance,
        'contract_id'   => $contractId,
        'reference'     => $reference,
        'note'          => $note,
        'created_at'    => now(),
    ]);
}
