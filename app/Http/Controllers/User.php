<?php

namespace App\Http\Controllers;

use App\Models\User_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\View;
use Vinkla\Hashids\Facades\Hashids;

class User extends Controller
{
    public function talentFormList()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(6, explode(',', $userData->parent_modules))))) {
            return view('adminend/talent_form_list');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function gettalentFormList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $lookingFor = $request->input('lookingFor');
        
        $start = $request->input('start', 0);
        $length = $request->input('length', 50);

        $query = DB::table('talent_profiles')
            ->join('users', 'users.id', '=', 'talent_profiles.user_id')
            ->select(
                'talent_profiles.id',
                'talent_profiles.user_id',
                'talent_profiles.looking_for',
                'talent_profiles.city',
                'talent_profiles.current_profile',
                'talent_profiles.preferred_roles',
                'talent_profiles.portfolio_link',
                'talent_profiles.cv',
                'talent_profiles.created_at',
                'talent_profiles.updated_at',

                'users.name',
                'users.email',
                'users.phone'
            );
            
        // Looking For filter
        if (!empty($lookingFor)) {
            $query->where('talent_profiles.looking_for', $lookingFor);
        }

        // Apply search
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {

                $q->where('users.name', 'like', "%{$searchValue}%")
                    ->orWhere('users.email', 'like', "%{$searchValue}%")
                    ->orWhere('users.phone', 'like', "%{$searchValue}%")
                    ->orWhere('talent_profiles.city', 'like', "%{$searchValue}%")
                    ->orWhere('talent_profiles.looking_for', 'like', "%{$searchValue}%")
                    ->orWhere('talent_profiles.preferred_roles', 'like', "%{$searchValue}%");
            });
        }

        // Filtered count
        $filteredCount = $query->count();

        // Pagination
        $users = $query
            ->orderBy('talent_profiles.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Total count
        $totalCount = DB::table('talent_profiles')->count();

        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    // Lanxers Code
    public function freelancerModule()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(1, explode(',', $userData->parent_modules))))) {
            if (!session()->has('user_id')) {
                // If the user is already logged in, redirect them to the dashboard
                return redirect()->route('admin.login');
            }

            return view('adminend/freelancer_module');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function freelancerModuleSearch(Request $request)
    {
        $request->validate([
            'searchQuery' => 'required|min:5', // Ensure search query is at least 10 characters
        ]);

        $query = $request->input('searchQuery');
        $fields = 'users.id,
                users.name,
                users.email,
                users.phone,
                users.email_verified_at,
                users.profile_complete,
                users.profile_photo,
                users.role,
                freelancer_profiles.account_status as account';

        $users =  User_model::get_user($query, $fields);

        $usersArray = $users->toArray();

        // Har row me encoded id add karo
        foreach ($usersArray as $user) {
            $user->users_id_hash = \Vinkla\Hashids\Facades\Hashids::encode($user->id);
        }

        return response()->json([
            'draw'            => intval($request->input('draw', 1)),
            'recordsTotal'    => 0,
            'recordsFiltered' => 0,
            'data'            => $usersArray
        ]);
    }

    public function freelancerDetails($id = NULL)
    {
        if ($id === null) {
            abort(404);
        }

        $decoded = Hashids::decode($id);

        if (empty($decoded)) {
            abort(404);   // tampered/invalid hash
        }
        $id = $decoded[0];

        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(2, explode(',', $userData->sub_modules))))) {
            $fields = 'users.id as user_id,
                    users.name as user_name,
                    users.email,
                    users.phone,
                    users.profile_photo,
                    users.role,
                    users.profile_complete,
                    users.created_at,
                    users.email_verified_at,

                    freelancer_profiles.job_title,
                    freelancer_profiles.bio,
                    freelancer_profiles.hourly_rate,
                    freelancer_profiles.experience,
                    freelancer_profiles.city,
                    freelancer_profiles.languages,
                    freelancer_profiles.portfolio,
                    freelancer_profiles.website,
                    freelancer_profiles.linkedin,
                    freelancer_profiles.github,
                    freelancer_profiles.profile_level,
                    freelancer_profiles.account_status as account,
                    freelancer_profiles.available_for_work,
                    freelancer_profiles.ai_rating,
                    freelancer_profiles.ai_level,

                    wallets.available_balance,
                    wallets.on_hold_balance,
                    wallets.total_deposited,
                    wallets.total_spent,
                    wallets.total_earned,
                    wallets.total_withdrawn,

                    states.name as state_name,
                    countries.name as country_name';

            // Fetch user details
            $user = User_model::get_user_details($id, $fields);

            if (empty($user)) {
                abort(404); // Show 404 if user not found
            }

            $fields = 'skills.name as skill_name, skills.id as skill_id';
            $skills = User_model::get_user_skills($id, $fields);

            $fields = 'user_experiences.*';
            $experiences = User_model::get_user_experiences($id, $fields);

            return view('adminend.freelancer_details_view', compact('user', 'skills', 'experiences'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function updateProfileLevel(Request $request)
    {
        $userId = $request->input('user_id');
        $level  = $request->input('level');

        if (!in_array($level, ['beginner', 'intermediate', 'expert'])) {
            return response()->json(['status' => 'error', 'message' => 'Invalid level']);
        }

        $updated = DB::table('freelancer_profiles')
            ->where('user_id', $userId)
            ->update(['profile_level' => $level]);

        return response()->json(['status' => 'success', 'updated' => $updated]);
    }

    public function updateAccountStatus(Request $request)
    {
        $userId = $request->input('user_id');
        $status = $request->input('status');

        if (!in_array($status, ['approve', 'disapprove', 'suspend'])) {
            return response()->json(['status' => 'error', 'message' => 'Invalid status']);
        }

        $updated = DB::table('freelancer_profiles')
            ->where('user_id', $userId)
            ->update(['account_status' => $status]);

        return response()->json(['status' => 'success', 'updated' => $updated]);
    }





    // Old Code
    public function videokycModule()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(134, explode(',', $userData->parent_modules))))) {
            return view('adminend/videokyc');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getUserVideokycList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('tbl_video_kyc')
            ->select('tbl_video_kyc.*', 'users.users_id', 'users.email', 'users.name', 'users.phone',)
            ->leftJoin('users', 'users.users_id', '=', 'tbl_video_kyc.user_id')
            ->where('tbl_video_kyc.status', 0);

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('users.email', 'like', "%$searchValue%")
                    ->orWhere('users.phone', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $users = $query->orderBy('tbl_video_kyc.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('tbl_video_kyc')
            ->where('status', 0)
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    public function setvideoKycstatus(Request $request)
    {
        $id = $request->users_id;
        $status = (int) $request->status;

        if (!in_array($status, [0, 1, 2])) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid status.'
            ]);
        }

        // Fetch original data
        $originalVideo = DB::table('tbl_video_kyc')
            ->where('user_id', $id)
            ->first();

        $originalCheckId = DB::table('users_checkid')
            ->where('users_id', $id)
            ->first();

        // Update data
        $videoUpdateData = [
            'status' => $status,
            'updated_on' => now(),
        ];

        $affiliateStatus = ($status == 1) ? 1 : 0;

        // Update tbl_video_kyc
        DB::table('tbl_video_kyc')
            ->where('user_id', $id)
            ->update($videoUpdateData);

        // Update users_checkid
        DB::table('users_checkid')
            ->where('users_id', $id)
            ->update([
                'becomeaffiliate' => $affiliateStatus
            ]);

        // Get changed fields
        $changes = [];

        // Changes from tbl_video_kyc
        $videoChanges = getChanges($originalVideo, $videoUpdateData);
        if (!empty($videoChanges)) {
            $changes = array_merge($changes, $videoChanges);
        }

        // Changes from users_checkid
        if ($originalCheckId && (int)$originalCheckId->becomeaffiliate !== $affiliateStatus) {
            $changes[] = 'becomeaffiliate';
        }

        // Remove duplicates
        $changes = array_unique($changes);

        // Save audit log
        if (!empty($changes)) {
            $message = 'Updated fields: ' . implode(', ', $changes);
            User_model::recordsUpdatedBy($id, $message);
        }

        return response()->json([
            'status' => true,
            'message' => 'Video KYC status updated successfully.'
        ]);
    }

    public function generateCSVNew(Request $request)
    {
        $userData = session('user_data');
        if (isset($userData)) {
            $from = $request->from;
            $to   = $request->to;

            if (empty($from) || empty($to)) {
                return back()->with('error', 'From and To dates are required.');
            }

            $users = DB::table('tbl_user_referral_amount_list')
                ->select('receive_user_id')
                ->whereDate('created_on', '>=', $from)
                ->whereDate('created_on', '<=', $to)
                ->groupBy('receive_user_id')
                ->pluck('receive_user_id');

            $jjj = [];
            $totEarn = 0;

            foreach ($users as $userId) {

                $earn = DB::table('tbl_user_referral_amount_list')
                    ->where('receive_user_id', $userId)
                    ->whereDate('created_on', '>=', $from)
                    ->whereDate('created_on', '<=', $to)
                    ->sum('amount');

                if ($earn > 0) {

                    $fields = ['kyc_status', 'name', 'email', 'phone'];
                    $ud = getUserDetails($userId, $fields); // your helper function

                    $kycUser = ($ud && $ud->kyc_status == '2') ? 'OK' : '-';

                    $jjj[] = [
                        $kycUser,
                        $ud->name ?? '',
                        $ud->email ?? '',
                        $ud->phone ?? '',
                        $earn
                    ];

                    $totEarn += $earn;
                }
            }

            usort($jjj, function ($a, $b) {
                return $a[4] <=> $b[4];
            });

            echo "Total price earn : " . $totEarn . "<br><br>";
            echo "<pre>";
            print_r($jjj);
            die;
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function liveWebinarDetails()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(128, explode(',', $userData->parent_modules))))) {
            return view('adminend/live_webinar_details');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function LiveWebinarAdd()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(128, explode(',', $userData->parent_modules))))) {
            return view('adminend/live_webinar_add');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function submitLiveWebinarAddForm(Request $request)
    {
        $validated = $request->validate([
            'webinar_title' => 'required',
            'webinar_start_time' => 'required|date',
            'webinar_end_time' => 'required|date',
            'zoom_link' => 'required',
            'youtube_link' => 'required',
        ]);

        $data = [
            'title' => $request->input('webinar_title'),
            'start_time' => date('Y-m-d H:i:s', strtotime($request->webinar_start_time)),
            'end_time' => date('Y-m-d H:i:s', strtotime($request->webinar_end_time)),
            'zoom_link' => $request->input('zoom_link'),
            'youtube_link' => $request->input('youtube_link'),
            'created_on' => Carbon::now('Asia/Kolkata'),
        ];

        $result = User_model::liveWebinarAdd($data);

        if ($result) {
            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to save data.');
        }
    }

    public function getLiveWebinarList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('tbl_webinar_detail')
            ->select('*');

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('title', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $users = $query->orderBy('tbl_webinar_detail.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('tbl_webinar_detail')
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    public function setLiveWebinarStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $liveWebinar = User_model::setLiveWebinarStatus($id, $status);
        if ($liveWebinar) {
            echo $status;
            die;
        }
    }

    public function editLiveWebinar($id)
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(128, explode(',', $userData->parent_modules))))) {
            $webinar = User_model::getLiveWebinar($id);
            return view('adminend/live_webinar_edit', compact('webinar'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function submitEditLiveWebinarForm(Request $request, $id)
    {
        $validated = $request->validate([
            'product' => 'required',
            'offer_title' => 'required',
            'offer_start_date' => 'required',
            'offer_close_date' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'user_type' => 'required',
            'quantity' => 'required',
        ]);

        $data = [
            'package' => implode(',', $request->input('product')),
            'title' => $request->input('offer_title'),
            'offer_start_date' => $request->input('offer_start_date') . ' 00:00:00',
            'offer_close_date' => $request->input('offer_close_date') . ' 23:59:59',
            'discount_type' => $request->input('discount_type'),
            'discount' => $request->input('discount'),
            'user_type' => $request->input('user_type'),
            'quantity' => $request->input('quantity'),
            'updated_on' => Carbon::now('Asia/Kolkata'),
        ];

        $result = User_model::updateEditLiveWebinar($data, $id);

        if ($result) {
            return redirect()->back()->with('success', 'Data updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }


    public function userRedeemAmount()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(126, explode(',', $userData->parent_modules))))) {
            return view('adminend/userredeemamount');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getUserRedeemAmountList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('tbl_redeem')
            ->select('tbl_redeem.*', 'users.users_id', 'users.email', 'users.phone', 'users.name')
            ->leftJoin('users', 'users.users_id', '=', 'tbl_redeem.users_id');

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('users.email', 'like', "%$searchValue%")
                    ->orWhere('users.phone', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $users = $query->orderBy('tbl_redeem.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('tbl_redeem')
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    public function userRedeemAmountDetails($id)
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(126, explode(',', $userData->parent_modules))))) {
            $user = DB::table('tbl_redeem')
                ->select(
                    'tbl_redeem.*',
                    'users.users_id',
                    'users.email',
                    'users.name',
                    'tbl_redeem_items.redeem_id',
                    'tbl_redeem_items.referral_id',
                    'tbl_redeem_items.users_id as riuid',
                    'tbl_redeem_items.amount as riamount',
                    'tbl_redeem_items.status as ristatus',
                    'tbl_redeem_items.created_on as ricreated_on',
                    'tbl_redeem_items.updated_on as riupdated_on',
                    'tbl_user_referral_amount_list.invoice_no as referral_invoice_no',
                    'tbl_user_referral_amount_list.purchasing_user_id as referral_purchasing_user_id',
                    'tbl_user_referral_amount_list.amount as referral_amount',
                    'tbl_user_referral_amount_list.pay_amount as referral_pay_amount',
                    'tbl_user_referral_amount_list.created_on as referral_date',

                    'purchasing_user.name as purchasing_user_name',
                    'purchasing_user.email as purchasing_user_email',
                    'purchasing_user.phone as purchasing_user_phone'
                )
                ->leftJoin('users', 'users.users_id', '=', 'tbl_redeem.users_id')
                ->leftJoin('tbl_redeem_items', 'tbl_redeem_items.redeem_id', '=', 'tbl_redeem.id')
                ->leftJoin('tbl_user_referral_amount_list', 'tbl_user_referral_amount_list.id', '=', 'tbl_redeem_items.referral_id')
                ->leftJoin('users as purchasing_user', 'purchasing_user.users_id', '=', 'tbl_user_referral_amount_list.purchasing_user_id')
                ->where('tbl_redeem.id', $id)
                ->get();

            // dd($user);

            return view('adminend/redeemamount_user_details', compact('user'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function internationalkycModule()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(117, explode(',', $userData->parent_modules))))) {
            return view('adminend/internationalkyc');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getinternationalUserkycList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('users_international_kyc')
            ->select('users_international_kyc.*', 'users.users_id', 'users.email', 'users.name')
            ->leftJoin('users', 'users.users_id', '=', 'users_international_kyc.users_id');

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('users.email', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $users = $query->orderBy('users_international_kyc.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('users_international_kyc')
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    public function internationalkycUserDetails($id)
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(117, explode(',', $userData->parent_modules))))) {
            $user = DB::table('users_international_kyc')
                ->select('users_international_kyc.*', 'users.users_id', 'users.email', 'users.name')
                ->leftJoin('users', 'users.users_id', '=', 'users_international_kyc.users_id')
                ->where('users_international_kyc.users_id', $id)
                ->first();

            return view('adminend/internationalkyc_user_details', compact('user'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function setInternationalKycstatus()
    {
        $id = (isset($_GET['users_id']) ? $_GET['users_id'] : 'X');
        $status =  (isset($_GET['status']) ? $_GET['status'] : 'X');

        $data = array(
            "kyc_status" => $status,
            "updated_on" => date('Y-m-d H:i:s')
        );

        if ($status == 2) {
            $data1 = array(
                "status" => 2,
                "updated_on" => date('Y-m-d H:i:s')
            );
        } else {
            $data1 = array(
                "status" => 3,
                "updated_on" => date('Y-m-d H:i:s')
            );
        }

        $original_data = DB::table('users_international_kyc')->where('users_id', $id)->first();
        $changes = getChanges($original_data, $data1);

        DB::table('users_international_kyc')->where('users_id', $id)->update($data1);

        if (!empty($changes)) {
            $message = 'Updated fields: ' . implode(', ', $changes);
            User_model::recordsUpdatedBy($id, $message);
        }

        $original_data = DB::table('users')->where('users_id', $id)->first();
        $changes = getChanges($original_data, $data);

        DB::table('users')->where('users_id', $id)->update($data);

        if (!empty($changes)) {
            $message = 'Updated fields: ' . implode(', ', $changes);
            User_model::recordsUpdatedBy($id, $message);
        }
    }

    public function setUaeKycstatus()
    {
        $id = (isset($_GET['users_id']) ? $_GET['users_id'] : 'X');
        $status =  (isset($_GET['status']) ? $_GET['status'] : 'X');

        $data = array(
            "kyc_status" => $status,
            "updated_on" => date('Y-m-d H:i:s')
        );

        if ($status == 2) {
            $data1 = array(
                "status" => 2,
                "updated_on" => date('Y-m-d H:i:s')
            );
        } else {
            $data1 = array(
                "status" => 3,
                "updated_on" => date('Y-m-d H:i:s')
            );
        }

        $original_data = DB::table('tbl_user_kyc_data_uae')->where('users_id', $id)->first();
        $changes = getChanges($original_data, $data1);

        DB::table('tbl_user_kyc_data_uae')->where('users_id', $id)->update($data1);

        if (!empty($changes)) {
            $message = 'Updated fields: ' . implode(', ', $changes);
            User_model::recordsUpdatedBy($id, $message);
        }

        $original_data = DB::table('users')->where('users_id', $id)->first();
        $changes = getChanges($original_data, $data);

        DB::table('users')->where('users_id', $id)->update($data);

        if (!empty($changes)) {
            $message = 'Updated fields: ' . implode(', ', $changes);
            User_model::recordsUpdatedBy($id, $message);
        }
    }

    public function uaekycModule()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(116, explode(',', $userData->parent_modules))))) {
            return view('adminend/uaekyc');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getUaeUserkycList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('tbl_user_kyc_data_uae')
            ->select('tbl_user_kyc_data_uae.*', 'users.users_id', 'users.email', 'users.name')
            ->leftJoin('users', 'users.users_id', '=', 'tbl_user_kyc_data_uae.users_id');

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('users.email', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $users = $query->orderBy('tbl_user_kyc_data_uae.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('tbl_user_kyc_data_uae')
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    public function uaekycUserDetails($id)
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(116, explode(',', $userData->parent_modules))))) {
            $user = DB::table('tbl_user_kyc_data_uae')
                ->select('tbl_user_kyc_data_uae.*', 'users.users_id', 'users.email', 'users.name')
                ->leftJoin('users', 'users.users_id', '=', 'tbl_user_kyc_data_uae.users_id')
                ->where('tbl_user_kyc_data_uae.users_id', $id)
                ->first();

            return view('adminend/uaekyc_user_details', compact('user'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function IndividualCourseUserFind()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(115, explode(',', $userData->parent_modules))))) {
            return view('adminend/individual_course_user_check');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function findUserIndividualCourseReferral(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $referrals = DB::table('tbl_individual_course_purchase_order as icpo')
            ->join('users as u', 'icpo.users_id', '=', 'u.users_id')
            ->join('tbl_courses_list as c', 'icpo.course_id', '=', 'c.id')
            ->where('icpo.referred_by', $user->users_id)
            ->where('icpo.status', 1)
            ->select(
                'icpo.created_on',
                'icpo.commission',
                'u.users_id as purchaser_id',
                'u.name as purchaser_name',
                'u.email as purchaser_email',
                'c.course_title'
            )
            ->get();

        return view('adminend.individual_course_user_referrals', compact('user', 'referrals'))->render();
    }

    public function refundSheet()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(111, explode(',', $userData->parent_modules))))) {
            return view('adminend/refund_sheet');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getRefundSheetList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('tbl_refunds')
            ->select('tbl_refunds.*', 'tbl_refunds_order.account_no', 'tbl_refunds_order.ifsc', 'tbl_refunds_order.tds', 'tbl_refunds_order.status', 'tbl_refunds_order.id as refund_order_id')
            ->leftJoin('tbl_refunds_order', 'tbl_refunds_order.refund_id', '=', 'tbl_refunds.id')
            ->where('tbl_refunds_order.status', '!=', 0)
            ->whereDate('tbl_refunds.created_on', '>=', now()->subWeeks(2)->toDateString())
            ->orderBy('tbl_refunds.id', 'DESC');

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('tbl_refunds.email', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $withdrawals = $query->orderBy('tbl_refunds.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('tbl_refunds')
            ->whereDate('created_on', '>=', now()->subWeeks(2)->toDateString())
            ->count();

        foreach ($withdrawals as $withdrawal) {
            $withdrawal->actions = $this->generateRefundStatusButtons($withdrawal);
        }

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $withdrawals
        ]);
    }

    private function generateRefundStatusButtons($row)
    {
        $html = '';

        // Pre-encrypt values (assuming you have helper function like encryptedValueNew)
        $encId = encryptedValueNew($row->id);
        $encUserId = encryptedValueNew($row->users_id ?? 0);
        $encStatus1 = encryptedValueNew(1);
        $encStatus0 = encryptedValueNew(0);

        // CASE: Waiting for pay/cancel
        if ($row->status == 2) {
            if (!empty($row->razorpayx_contact_id) && str_starts_with($row->razorpayx_contact_id, 'cont')) {
                if (!empty($row->account_no) && !empty($row->ifsc)) {

                    // Example: check group or module access from session
                    $html .= '<a href="' . url("admin/setrefundstatus?status={$encStatus1}&id={$encId}&user_id={$encUserId}") . '"
                                class="btn btn-sm btn-info pay-btn" onclick="return handleClick(this)">
                                <span class="btn-text">Pay</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                              </a>';
                    $html .= ' | <a href="' . url("admin/setrefundstatus?status={$encStatus0}&id={$encId}&user_id={$encUserId}") . '"
                                class="btn btn-sm btn-danger" onclick="return ConfirmDialogCancel()">Cancel</a>';
                } else {
                    $html .= '<a href="' . url("admin/setrefundstatus?status={$encStatus0}&id={$encId}&user_id={$encUserId}") . '"
                            class="btn btn-sm btn-danger" onclick="return ConfirmDialogCancel()">Cancel (A/N not added)</a>';
                }
            } else {
                $html .= '<p class="btn btn-sm btn-success">Contact Id not created</p>';
                $html .= ' | <a href="' . url("admin/generateRefundCid/{$encId}") . '" class="btn btn-sm btn-warning">Generate</a>';
            }
        }
        // CASE: Paid
        elseif ($row->status == 1) {
            $html .= '<p class="btn btn-default">Paid</p>';
        }
        // CASE: OTP Generation
        elseif ($row->status == 5) {
            $adminEmail = "management@idigitalpreneur.com";
            $html .= '<p class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vd_popup"
                     onclick="setUserToRequestForm(' . $row->id . ', 2, \'' . $adminEmail . '\')">Generate Otp</p>';
            $html .= ' | <a href="' . url("admin/setrefundstatus?status={$encStatus0}&id={$encId}&user_id={$encUserId}") . '"
                    class="btn btn-sm btn-danger" onclick="return ConfirmDialogCancel()">Cancel</a>';
        }
        // CASE: Pending from bank
        elseif ($row->status == 3) {
            $html .= '<p class="btn btn-default">Pending from bank side</p>';
        }
        // CASE: Cancel
        elseif ($row->status == 0) {
            $html .= '<p class="btn btn-default">Cancel</p>';
        }
        // CASE: Reversed
        elseif ($row->status == 7) {
            $html .= '<p class="btn btn-default">Reversed</p>';
        }

        return $html;
    }

    public function refundpaysetstatus(Request $request)
    {
        $id     = $request->input('id');
        $status = $request->input('status');
        $email  = $request->input('email');
        $otp    = $request->input('otp');

        $query = DB::table('tbl_refunds_order')->where('refund_id', $id);

        // If OTP is given, validate it
        if (!empty($otp)) {
            $query->where('otp', $otp)
                ->where('otp_generate', '>', now());
        }

        $updated = $query->update([
            'status'     => (int) $status,
            'otp_status' => 1
        ]);

        if ($updated) {
            return redirect()
                ->route('refund.sheet') // define this route in web.php
                ->with('success', 'Updated successfully');
        } else {
            return redirect()
                ->route('refund.sheet')
                ->with('error', 'Something went wrong, please try again');
        }
    }

    public function refundPayOtp($number, $id)
    {
        $email = urldecode($number);

        // Fetch refund record
        $userR = DB::table('tbl_refunds')->where('id', $id)->first();

        if ($userR) {
            $otp = rand(9999, 1000000);

            DB::table('tbl_refunds_order')
                ->where('refund_id', $id)
                ->update([
                    'otp'         => $otp,
                    'otp_generate' => now()->addMinutes(5)
                ]);

            $message = "Hi, your Refund Payout Approval OTP is {$otp}. OTP will expire in 5 minutes.";
            $header  = "IDP Refund Payout Approval OTP";

            // Replace with Laravel's Mail facade if possible
            @send_mail($email, $header, $message);

            return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Refund record not found'], 404);
        }
    }

    public function setrefundstatus()
    {
        $id = (isset($_GET['id']) ? decryptedValueNew($_GET['id']) : 'X');
        $status = isset($_GET['status']) ? (int) decryptedValueNew($_GET['status']) : 0;
        $user_id =  (isset($_GET['user_id']) ? decryptedValueNew($_GET['user_id']) : '');

        if (!is_numeric($id) || !is_numeric($user_id) || !is_numeric($status)) {
            abort(404);
        }

        $fields = ['razorpayx_contact_id', 'name', 'is_tax', 'email', 'phone'];
        $user_D = getUserDetails($user_id, $fields);

        $refund_details = getUserRefundDetails($id);

        $fund_response = "";
        $payout_response = "";
        $tds_amount = 0;

        if ($status == 1 && !empty($user_id) && $refund_details->status == 2) {

            $fund_response = $this->createIdpUserFundTransaferIdInBankByRazorpay($refund_details->razorpayx_contact_id, $refund_details->name, $refund_details->ifsc, $refund_details->account_no);
            if (empty($fund_response['error'])) {
                $ac_amount = $refund_details->amount;
                $tds_amount = $refund_details->tds;
                $payout_response = $this->payoutIdpUserByRazorpay($fund_response['id'], $ac_amount - $tds_amount, $user_id, "REFUND_" . $id);

                $hiddenDigits = "*******"; // Define the hidden part
                $visibleDigits = substr($refund_details->account_no, -4); // Get the last four digits of the account number
                $maskedAccountNumber = $hiddenDigits . $visibleDigits;
                $tds1 = floor($ac_amount - $tds_amount);

                $mail = array(
                    'name' => $refund_details->name,
                    'full_amount' => $ac_amount,
                    'amount' => floor($ac_amount - $tds_amount),
                    'bank' => $refund_details->account_no,
                    'tds' => $tds_amount,
                );
                $header = 'Your Refund Has Been Processed';
                $message = View::make('mails.refundMail', $mail)->render();

                @send_mail($refund_details->email, $header, $message);
            }
        }

        User_model::update_refund_status($id, $status, $user_id, json_encode($fund_response), json_encode($payout_response), $tds_amount);

        if ($status == 0 && !empty($user_id)) {
            DB::table('tbl_refunds_order')
                ->where('refund_id', $id)
                ->where('users_id', $user_id)
                ->update(['status' => $status]);
        }

        return redirect()->route('refund.sheet');
    }


    public function refund()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(110, explode(',', $userData->parent_modules))))) {
            return view('adminend/refund');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function refundUserSearch(Request $request)
    {
        $email = $request->input('email');
        $user = DB::table('users')->where('email', $email)->first();

        $html = '';

        if (empty($user)) {
            $html .= "User not found.";
        } else {
            // get purchase data
            $user_purchase = DB::table('tbl_user_referral_amount_list')
                ->where('purchasing_user_id', $user->users_id)
                ->first();

            // get sponsor details
            $sponsor = DB::table('users')
                ->where('users_id', $user->reffral_by_user_id)
                ->first();

            $html .= '<input type="hidden" name="users_id" value="' . $user->users_id . '">
            <div class="col-md-4 details_re"><span class="label label-info">Account created: ' . $user->created_on . '</span></div>
            <div class="col-md-4 details_re"><span class="label label-info">Name: ' . $user->name . ' (' . $user->phone . ')</span></div>
            <div class="col-md-4 details_re"><span class="label label-info">Sponser: ' . ($sponsor->name ?? 'N/A') . '</span></div>
            <div class="col-md-4 details_re"><span class="label label-info">Invoice: ' . ($user_purchase->invoice_no ?? '-') . '</span></div>
            <div class="col-md-4 details_re"><span class="label label-info">Plan purchased: ' . ($user_purchase->created_on ?? '-') . '</span></div>
            <div class="col-md-4 details_re"><span class="label label-info">Amount received: ' . ($user_purchase->pay_amount ?? '-') . '</span></div>
            <div class="col-md-4 details_re"><span class="label label-info">Amount to Sponser: ' . ($user_purchase->amount ?? '-') . '</span></div>';
        }

        return response($html);
    }

    public function refundRequestCreate(Request $request)
    {
        $ud = DB::table('users')->where('users_id', $request->input('users_id'))->first();

        $response = $this->createIdpUserRazorpayContactId(
            $request->input('name'),
            $request->input('email'),
            $request->input('phone'),
            strval($ud->users_id)
        );

        $p_u_d   = DB::table('tbl_user_referral_amount_list')
            ->where('purchasing_user_id', $ud->users_id)
            ->first();  // purchasing user details

        $manage_d = DB::table('tbl_user_allocation')
            ->where('users_id', $ud->users_id)
            ->first();

        // Insert into tbl_refunds
        $in_id = DB::table('tbl_refunds')->insertGetId([
            'users_id'            => $ud->users_id,
            'amount'              => $request->input('amount'),
            'pay_amount'          => (int) ($p_u_d->pay_amount ?? 0),
            'razorpayx_contact_id' => $response,
            'name'                => $request->input('name'),
            'phone'               => $request->input('phone'),
            'email'               => $request->input('email'),
            'plan'                => $ud->current_plan,
            'purchased_on'        => $p_u_d->created_on ?? null,
            'purchase_invoice_no' => $p_u_d->invoice_no ?? null,
            'refund_invoice_no'   => getNewRefundInvoiceNumber(),
            'sponsor_id'          => $ud->reffral_by_user_id,
            'manager_id'          => $manage_d->manager_id ?? null,
            'user_raw_data'       => json_encode([
                "user_table" => [
                    "users_id"      => $ud->users_id,
                    "balance_money" => $ud->balance_money,
                    "receive_money" => $ud->receive_money,
                    "aadhar_no"     => $ud->aadhar_no,
                    "name"          => $ud->name,
                    "email"         => $ud->email,
                    "phone"         => $ud->phone,
                ],
                "referal_table" => [
                    "pay_amount" => $p_u_d->pay_amount ?? 0,
                    "payment_id" => $p_u_d->payment_id ?? null,
                ]
            ]),
            'created_on' => now(),
        ]);

        if (!empty($in_id)) {
            // Insert into tbl_refunds_order
            DB::table('tbl_refunds_order')->insert([
                'users_id'   => $ud->users_id,
                'account_no' => $request->input('account_number'),
                'ifsc'       => $request->input('ifsc'),
                'amount'     => $request->input('amount'),
                'tds'        => $request->input('amount') * 7 / 100,
                'refund_id'  => $in_id,
                'created_on' => now(),
                'updated_on' => now(),
            ]);

            return redirect()
                ->route('refund.create.module')
                ->with('message', 'Refund Request is Created & sent for approval');
        } else {
            return redirect()
                ->route('refund.create.module')
                ->with('error', 'Create Refund Request Failed.');
        }

        return redirect()->route('refund.create.module');
    }

    public function getRefundList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('tbl_refunds')
            ->select('tbl_refunds.*', 'tbl_refunds_order.account_no', 'tbl_refunds_order.ifsc', 'tbl_refunds_order.tds', 'tbl_refunds_order.status', 'tbl_refunds_order.id as refund_order_id')
            ->leftJoin('tbl_refunds_order', 'tbl_refunds_order.refund_id', '=', 'tbl_refunds.id')
            ->where('tbl_refunds_order.status', '!=', 0)
            ->whereDate('tbl_refunds.created_on', '>=', now()->subWeeks(2)->toDateString())
            ->orderBy('tbl_refunds.id', 'DESC');

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('tbl_refunds.email', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $withdrawals = $query->orderBy('tbl_refunds.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('tbl_refunds')
            ->whereDate('created_on', '>=', now()->subWeeks(2)->toDateString())
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $withdrawals
        ]);
    }

    public function getUserReferralList(Request $request)
    {
        $id = $request->input('receive_user_id');
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('tbl_user_referral_amount_list as r')
            ->join('users as u', 'u.users_id', '=', 'r.purchasing_user_id')
            ->select(
                'u.name',
                'u.email',
                'r.amount',
                'r.created_on'
            )
            ->where('r.receive_user_id', $id); // Filter by receive_user_id

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('u.email', 'like', "%$searchValue%");
            });
        }

        $filteredCount = $query->count();

        $users = $query->orderBy('r.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        $totalCount = DB::table('tbl_user_referral_amount_list')
            ->where('receive_user_id', $id)
            ->count();

        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    public function userPaymentModule()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(108, explode(',', $userData->parent_modules))))) {
            return view('adminend/user_payment_module');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function userEmailVerifyChange(Request $request)
    {
        DB::table('users')
            ->where('users_id', $request->users_id)
            ->update(['email_verify' => 1]);

        return response()->json([
            'status' => 'success',
            'message' => 'Email verification status updated successfully.'
        ], 200);
    }

    public function findUser()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(108, explode(',', $userData->parent_modules))))) {
            return view('adminend/find_user');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function weeklyEarners()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(58, explode(',', $userData->parent_modules))))) {
            return view('adminend/weekly_earner');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function submitFindUserForm(Request $request)
    {
        $phone = $request->input('phone');
        $email = $request->input('email');

        if (!empty($phone)) {
            $user = User_model::Search_by_phone($phone);
            if ($user) {
                $sponser_detail = User_model::getSponserDetails($user->reffral_by_user_id);
                $indi_course_name = User_model::getIndiCourseName($user->extra_open_course_ids);
            } else {
                return redirect()->back()->with('error', 'User not found.');
            }
        }

        if (!empty($email)) {
            $user = User_model::Search_by_email($email);
            if ($user) {
                $sponser_detail = User_model::getSponserDetails($user->reffral_by_user_id);
                $indi_course_name = User_model::getIndiCourseName($user->extra_open_course_ids);
            } else {
                return redirect()->back()->with('error', 'User not found.');
            }
        }

        return view('adminend/find_user_list', compact('user', 'sponser_detail', 'indi_course_name'));
    }

    public function findUserDelete($users_id)
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(108, explode(',', $userData->parent_modules))))) {
            $users = User_model::user_remove($users_id);
            if ($users) {
                return redirect()->route('find.user');
            } else {
                return redirect()->route('find.user');
            }
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function findUserView($users_id)
    {
        $fields = ['reffral_by_user_id', 'users_id', 'name', 'email', 'phone', 'status', 'account', 'phone_verify', 'email_verify', 'created_on'];
        $user = User_model::get_users($users_id, $fields);

        // $fields = ['reffral_by_user_id','users_id','name','email','phone'];
        // $users_other = User_model::get_user_other($users_id,$fields);

        $sponser_detail = User_model::getSponserDetails($user->reffral_by_user_id);

        return view('adminend/find_user_view', compact('user', 'sponser_detail'));
    }

    public function findUserUpdateDetails(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'sponser' => 'required',
        ]);

        $user_id = $request->input('user_id');
        $sponser_id =  User_model::getSponserDetail($request->input('sponser'));

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'reffral_by_user_id' => $sponser_id->users_id,
            'updated_on' => Carbon::now('Asia/Kolkata'),
        ];

        $result = User_model::updateEditFindUserDetails($data, $user_id);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function findUserPasswordUpdate(Request $request)
    {
        $user_id = $request->input('users_id');
        $data = [
            'password' => 'e10adc3949ba59abbe56e057f20f883e',
            'updated_on' => Carbon::now('Asia/Kolkata'),
        ];

        $result = User_model::updatePassword($data, $user_id);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function viewNumber(Request $request) {}

    public function weeklyEarnersDownload(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $select_type = $request->input('select_type');

        // Append time to the dates
        $from = Carbon::createFromFormat('Y-m-d', $from)->setTime(0, 0, 0)->toDateTimeString();
        $to = Carbon::createFromFormat('Y-m-d', $to)->setTime(23, 59, 59)->toDateTimeString();

        // Start building the query
        $query = DB::table('tbl_user_referral_amount_list')
            ->whereRaw("tbl_user_referral_amount_list.created_on >= ?", [$from])
            ->whereRaw("tbl_user_referral_amount_list.created_on <= ?", [$to]);

        // Apply conditions based on select_type
        if ($select_type == 1) {
            $query->select('users.name', 'users.email', 'users.kyc_status', DB::raw('SUM(tbl_user_referral_amount_list.amount) AS earning'))
                ->join('users', 'users.users_id', '=', 'tbl_user_referral_amount_list.receive_user_id')
                ->where('users.kyc_status', 2)
                ->where('users.is_tax', 1)
                ->groupBy('tbl_user_referral_amount_list.receive_user_id', 'users.name', 'users.email', 'users.kyc_status');
        } elseif ($select_type == 2) {
            $query->select('users.name', 'users.email', 'users.current_plan', 'tbl_user_referral_amount_list.amount', 'tbl_user_referral_amount_list.pay_amount', 'referral.name AS referral_name', 'referral.email AS referral_email', 'referral.current_plan AS referral_current_plan')
                ->join('users', 'users.users_id', '=', 'tbl_user_referral_amount_list.purchasing_user_id')
                ->join('users AS referral', 'referral.users_id', '=', 'tbl_user_referral_amount_list.receive_user_id');
        }


        // Execute the query and fetch the results
        $data = $query->get();

        $planNames = [
            1 => 'Elite',
            2 => 'Pro',
            3 => 'Supreme',
            4 => 'Premium',
            5 => 'Standard',
            6 => 'Premium Plus'
        ];

        // echo $query->toSql();
        // echo "<br>";
        // echo json_encode($query->getBindings());
        // die();

        // Check if no data was returned
        // if ($data->isEmpty()) {
        //     $data = collect([['No data available for the selected dates', '', '', '', '', '']]);
        // }

        // Prepare CSV Response
        return new StreamedResponse(function () use ($data, $select_type, $planNames) {
            $handle = fopen('php://output', 'w');

            // Set CSV Headers
            if ($select_type == 1) {
                fputcsv($handle, ['Name', 'Email', 'KYC Status', 'Earning']);
            } elseif ($select_type == 2) {
                fputcsv($handle, ['Name', 'Email', 'Current Plan', 'Amount', 'Pay Amount', 'Sponsor Name', 'Sponsor Email', 'Sponsor Plan']);
            }

            // Output the data
            foreach ($data as $row) {

                if ($select_type == 1) {
                    fputcsv($handle, [
                        $row->name,
                        $row->email,
                        $row->kyc_status,
                        number_format($row->earning, 2),
                    ]);
                } else {
                    fputcsv($handle, [
                        $row->name,
                        $row->email,
                        $planNames[$row->current_plan] ?? '',
                        number_format($row->amount, 2),
                        $row->pay_amount,
                        $row->referral_name,
                        $row->referral_email,
                        $planNames[$row->referral_current_plan] ?? '',
                    ]);
                }
            }

            fclose($handle);
        }, 200, [
            "Content-Description" => "File Transfer",
            "Content-Disposition" => "attachment; filename=weekly_earners_" . now()->format('YmdHis') . ".csv",
            "Content-Type" => "application/csv; charset=UTF-8"
        ]);

        return $response->send()->sendHeaders()->end() . redirect()->route('weekly.earners');
    }

    public function autokycModule()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(43, explode(',', $userData->parent_modules))))) {
            return view('adminend/autokyc');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getUserAutokycList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('tbl_user_kyc_data')
            ->select('tbl_user_kyc_data.*', 'users.users_id', 'users.email', 'users.name')
            ->leftJoin('users', 'users.users_id', '=', 'tbl_user_kyc_data.user_id');

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('users.email', 'like', "%$searchValue%")
                    ->orWhere('tbl_user_kyc_data.pan', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $users = $query->orderBy('tbl_user_kyc_data.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('tbl_user_kyc_data')
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    public function autokycUserDetails($id)
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(43, explode(',', $userData->parent_modules))))) {
            $user = DB::table('tbl_user_kyc_data')
                ->select('tbl_user_kyc_data.*', 'users.users_id', 'users.email', 'users.name')
                ->leftJoin('users', 'users.users_id', '=', 'tbl_user_kyc_data.user_id')
                ->where('tbl_user_kyc_data.user_id', $id)
                ->first();

            return view('adminend/autokyc_user_details', compact('user'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function userAutokycReset()
    {
        $id = (isset($_GET['users_id']) ? $_GET['users_id'] : 'X');
        User_model::userAutokycReset($id);
    }

    public function setKycstatus()
    {
        $id = (isset($_GET['users_id']) ? $_GET['users_id'] : 'X');
        $status =  (isset($_GET['status']) ? $_GET['status'] : 'X');
        $type =  (isset($_GET['type']) ? $_GET['type'] : 'X');

        $fields = ['pan', 'aadhar_responce', 'pan_response', 'bank_response'];
        $current_u_d = getKycUserDetailsAutomate($id, $fields);
        $update_data = [$type => 1];

        if ($type == "aadhar_kyc_status") {
            $a_data = json_decode($current_u_d->aadhar_responce, true);
            $update_data["aadhar"] = $a_data["masked_aadhaar"] ?? $a_data["aadhaar_number"];
            $update_data["dob"] = $a_data["dob"];
        }

        if ($type == "pan_kyc_status") {
            $p_data = json_decode($current_u_d->pan_response, true);
            $update_data["pan"] = $p_data["pan_number"];
        }

        if ($type == "fulll_kyc_done") {
            $cc_data = json_decode($current_u_d->aadhar_responce, true);
            $b_data = json_decode($current_u_d->bank_response, true);
            $data = array(
                "city" => $cc_data["address"]['po'],
                "state_name" => $cc_data["address"]['state'],
                "aadhar_no" => $cc_data["masked_aadhaar"] ?? $cc_data["aadhaar_number"],
                "kyc_status" => 2,
                "updated_on" => date('Y-m-d H:i:s'),
                'razorpayx_fund_id' => ''
            );

            $data1 = array(
                "name" => $b_data['full_name'],
                "ac_type" => "Saving",
                "ifsc" => $b_data["ifsc_details"]['ifsc'],
                "bank_name" => $b_data["ifsc_details"]['bank'],
                "tax_cre" => $current_u_d->pan,
                "zip" => $cc_data['zip'],
                "city" => $cc_data["address"]['po'],
                "updated_on" => date('Y-m-d H:i:s')
            );

            if (array_key_exists('account_number', $b_data)) {
                $data1["account_number"] = $b_data['account_number'];
            }

            $original_data = DB::table('tbl_user_bank')->where('users_id', $id)->first();
            $changes = getChanges($original_data, $data1);

            DB::table('tbl_user_bank')->where('users_id', $id)->update($data1);

            if (!empty($changes)) {
                $message = 'Updated fields: ' . implode(', ', $changes);
                User_model::recordsUpdatedBy($id, $message);
            }

            $original_data = DB::table('users')->where('users_id', $id)->first();
            $changes = getChanges($original_data, $data);

            DB::table('users')->where('users_id', $id)->update($data);

            if (!empty($changes)) {
                $message = 'Updated fields: ' . implode(', ', $changes);
                User_model::recordsUpdatedBy($id, $message);
            }
        }

        $original_data = DB::table('tbl_user_kyc_data')->where('user_id', $id)->first();
        $changes = getChanges($original_data, $update_data);

        DB::table('tbl_user_kyc_data')->where('user_id', $id)->update($update_data);

        if (!empty($changes)) {
            $message = 'Updated fields: ' . implode(', ', $changes);
            User_model::recordsUpdatedBy($id, $message);
        }

        return redirect()->route('autokyc.user.details', ['id' => $id]);
    }

    public function subuserWithdrawalRequest()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(20, explode(',', $userData->parent_modules))))) {
            return view('adminend/sub_user_withdrawal_request');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getsubUserWithdrawalList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('tbl_withdrawal_amount')
            ->select('tbl_withdrawal_amount.*', DB::raw('users.balance_money - users.receive_money as pending_amount'), 'users.users_id', 'users.email', 'users.name', 'users.kyc_status', 'users.is_tax', 'tbl_user_bank.name as usernamebank', 'tbl_user_bank.tax_cre', 'tbl_user_bank.account_number', 'tbl_user_bank.ifsc', 'users.razorpayx_contact_id')
            ->leftJoin('users', 'users.users_id', '=', 'tbl_withdrawal_amount.users_id')
            ->leftJoin('tbl_user_bank', 'users.users_id', '=', 'tbl_user_bank.users_id')
            ->where('tbl_withdrawal_amount.status', 2)
            ->where('tbl_withdrawal_amount.is_astitva', 0)
            ->whereDate('tbl_withdrawal_amount.created_on', '>=', now()->subMonths(6))
            ->whereNotIn('tbl_withdrawal_amount.users_id', $this->excludedUsers);

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('users.email', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $withdrawals = $query->orderBy('tbl_withdrawal_amount.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('tbl_withdrawal_amount')
            ->where('status', 2)
            ->where('is_astitva', 0)
            ->whereDate('created_on', '>=', now()->subMonths(6))
            ->whereNotIn('users_id', $this->excludedUsers)
            ->count();

        // Generate status buttons dynamically
        foreach ($withdrawals as $withdrawal) {
            $withdrawal->actions = $this->generateStatusButtons($withdrawal);
        }

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $withdrawals
        ]);
    }

    public function generateWithdrawalRequestCsv()
    {
        $query = DB::table('tbl_withdrawal_amount')
            ->select('tbl_withdrawal_amount.*', DB::raw('users.balance_money - users.receive_money as pending_amount'), 'users.users_id', 'users.email', 'users.phone', 'users.name', 'users.kyc_status', 'users.is_tax', 'tbl_user_bank.name as usernamebank', 'tbl_user_bank.tax_cre', 'tbl_user_bank.account_number', 'tbl_user_bank.ifsc', 'users.razorpayx_contact_id')
            ->leftJoin('users', 'users.users_id', '=', 'tbl_withdrawal_amount.users_id')
            ->leftJoin('tbl_user_bank', 'users.users_id', '=', 'tbl_user_bank.users_id')
            ->where('tbl_withdrawal_amount.status', 2)
            ->where('tbl_withdrawal_amount.is_astitva', 0)
            ->whereDate('tbl_withdrawal_amount.created_on', '>=', now()->subMonths(6))
            ->whereNotIn('tbl_withdrawal_amount.users_id', $this->excludedUsers);

        $data = $query->get();

        return new StreamedResponse(function () use ($data) {
            $handle = fopen('php://output', 'w');


            // Set CSV Headers
            fputcsv($handle, ["Sr", 'KYC', 'Link Kyc', "Username", "Phone", "Amount", "Account Number", "IFSC", "Request create date"]);

            $i = 1;
            // Output the data
            foreach ($data as $row) {
                fputcsv($handle, [
                    $i++,
                    $row->kyc_status,
                    $row->is_tax,
                    $row->name . '(' . $row->email . ')',
                    $row->phone,
                    $row->amount,
                    $row->account_number,
                    $row->ifsc,
                    $row->created_on,
                ]);
            }

            fclose($handle);
        }, 200, [
            "Content-Description" => "File Transfer",
            "Content-Disposition" => "attachment; filename=withdrawal_request_" . now()->format('YmdHis') . ".csv",
            "Content-Type" => "application/csv; charset=UTF-8"
        ]);

        return $response->send()->sendHeaders()->end() . redirect()->route('sub.users.withdrawal.request');
    }

    public function userWithdrawalRequest()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(20, explode(',', $userData->parent_modules))))) {
            $total_amount = User_model::get_tbl_current_sheet_total_pending(NULL)->current_amount;

            return view('adminend/user_withdrawal_request', compact('total_amount'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getUserWithdrawalList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('tbl_withdrawal_amount')
            ->select('tbl_withdrawal_amount.*', DB::raw('users.balance_money - users.receive_money as pending_amount'), 'users.users_id', 'users.email', 'users.name', 'users.kyc_status', 'users.is_tax', 'tbl_user_bank.name as usernamebank', 'tbl_user_bank.tax_cre', 'tbl_user_bank.account_number', 'tbl_user_bank.ifsc', 'users.razorpayx_contact_id')
            ->leftJoin('users', 'users.users_id', '=', 'tbl_withdrawal_amount.users_id')
            ->leftJoin('tbl_user_bank', 'users.users_id', '=', 'tbl_user_bank.users_id')
            ->where('tbl_withdrawal_amount.status', 2)
            ->where('tbl_withdrawal_amount.is_astitva', 0)
            ->whereDate('tbl_withdrawal_amount.created_on', '>=', now()->subMonths(6))
            ->whereNotIn('tbl_withdrawal_amount.users_id', $this->excludedUsers);

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('users.email', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $withdrawals = $query->orderBy('tbl_withdrawal_amount.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('tbl_withdrawal_amount')
            ->where('status', 2)
            ->where('is_astitva', 0)
            ->whereDate('created_on', '>=', now()->subMonths(6))
            ->whereNotIn('users_id', $this->excludedUsers)
            ->count();

        // Generate status buttons dynamically
        foreach ($withdrawals as $withdrawal) {
            $withdrawal->actions = $this->generateStatusButtons($withdrawal);
        }

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $withdrawals
        ]);
    }

    private function generateStatusButtons($user)
    {
        $status_buttons = '';
        $contact_id = explode("_", $user->razorpayx_contact_id);
        $userData = session('user_data');

        if (isset($contact_id[0]) && $contact_id[0] == "cont") {
            if (!empty($user->account_number) && !empty($user->ifsc)) {
                if (isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(32, explode(',', $userData->sub_modules))))) {
                    $status_buttons .= '<a href="' . route('user.withdrawal.setstatus', [
                        'status' => encryptedValueNew(1),
                        'id' => encryptedValueNew($user->id),
                        'user_id' => encryptedValueNew($user->users_id)
                    ]) . '" class="btn btn-sm btn-info" onclick="return ConfirmDialog()">Pay</a>';
                }

                if (isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(33, explode(',', $userData->sub_modules))))) {

                    $status_buttons .= ' | <a href="' . route('user.withdrawal.setstatus', [
                        'status' => encryptedValueNew(0),
                        'id' => encryptedValueNew($user->id),
                        'user_id' => encryptedValueNew($user->users_id)
                    ]) . '" class="btn btn-sm btn-danger" onclick="return ConfirmDialogCancel()">Cancel</a>';
                }
            } else {
                if (isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(33, explode(',', $userData->sub_modules))))) {
                    $status_buttons .= '<a href="' . route('user.withdrawal.setstatus', [
                        'status' => encryptedValueNew(0),
                        'id' => encryptedValueNew($user->id),
                        'user_id' => encryptedValueNew($user->users_id)
                    ]) . '" class="btn btn-sm btn-danger" onclick="return ConfirmDialogCancel()">Cancel (A/N not added)</a>';
                }
            }
        } else {
            if (isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(35, explode(',', $userData->sub_modules))))) {
                $status_buttons .= '<a href="' . route('user.withdrawal.setstatus', [
                    'status' => encryptedValueNew(0),
                    'id' => encryptedValueNew($user->id),
                    'user_id' => encryptedValueNew($user->users_id)
                ]) . '" class="btn btn-sm btn-danger" onclick="return ConfirmDialogCancel()">Cancel (Wrong Contact ID)</a>';
            }
            if (isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(36, explode(',', $userData->sub_modules))))) {
                $status_buttons .= ' | <a href="' . route('user.withdrawal.generateCid', [
                    'user_id' => encryptedValueNew($user->users_id)
                ]) . '" class="btn btn-sm btn-success">Generate</a>';
            }
        }

        return $status_buttons;
    }

    public function UserWithdrawalGenerateCid($user_id)
    {
        $user_id = decryptedValueNew($user_id);

        $fields = ['name', 'email', 'phone'];
        $user_D = getUserDetails($user_id, $fields);

        $response = $this->createIdpUserRazorpayContactId($user_D->name, $user_D->email, $user_D->phone, strval($user_id));

        $this->db->where('users_id', $user_id);
        $this->db->update('users', array('razorpayx_contact_id' => $response));
        redirect(base_url('withdrawal/admin'));
    }

    public function createIdpUserRazorpayContactId($name, $email, $phone, $reference_id)
    {
        $fields = array(
            "name" =>  $name,
            "email" =>  $email,
            "contact" =>  $phone,
            "type" =>  "customer",
            "reference_id" =>  $reference_id
        );
        $response = createIdpUserContactIdInRazorpay($fields, 1);

        // echo "<pre>";print_r($response);die;

        if (empty($response['error'])) {
            return $response['id'];
        } else {
            return $response['error']->description;
        }
    }

    public function createIdpUserFundTransaferIdInBankByRazorpay($contact_id, $name, $ifsc, $account_number)
    {
        $fields = array(
            "contact_id" =>  $contact_id,
            "account_type" =>  "bank_account",
            "bank_account" =>  array(
                "name" =>  $name,
                "ifsc" =>  $ifsc,
                "account_number" =>  $account_number
            )
        );
        return $response = createIdpUserContactIdInRazorpay($fields, 2);
        // echo "<pre>";print_r($response);die;
    }

    public function payoutIdpUserByRazorpay($fund_account_id, $amount, $payout_id, $request_id)
    {
        $amount = floor($amount);
        $fields = array(
            "account_number" =>  "409315918513", // our rx account id
            "fund_account_id" =>  $fund_account_id,
            "amount" =>  $amount * 100,
            "currency" =>  "INR",
            "mode" =>  "NEFT", //IMPS NEFT RTGS
            "purpose" =>  "payout",
            "queue_if_low_balance" =>  true,
            "reference_id" =>  $payout_id,
            "notes" =>
            array("request_id" => $request_id)
        );
        if ($amount > 499999) {
            $fields["mode"] = "NEFT";
        }
        $response = createIdpUserContactIdInRazorpay($fields, 3);

        // echo "<pre>";print_r($response);die;

        return $response;
    }

    public function UserWithdrawalSetstatus(Request $request)
    {
        $id = decryptedValueNew($request->query('id', 'X'));
        $status = (int) decryptedValueNew($request->query('status', 0));
        $user_id = decryptedValueNew($request->query('user_id', ''));

        if (!is_numeric($id) || !is_numeric($user_id) || !is_numeric($status)) {
            abort(404);
        }

        $fields = ['razorpayx_contact_id', 'name', 'is_tax', 'email', 'phone', 'razorpayx_fund_id'];
        $user_D = getUserDetails($user_id, $fields);

        $fields = ['account_number', 'ifsc'];
        $user_D_bank = userBankAccountExist($user_id, $fields);

        $fields = ['status', 'is_cashback'];
        $withdrawal_details = getUserWithdrawalDetails($id, $fields);

        $fund_response = "";
        $payout_response = "";
        $tds_amount = 0;

        if ($status == 1 && !empty($user_id) && $withdrawal_details->status == 2) {

            $locked = User_model::lock_withdrawal($id, $user_id);
            if (!$locked) {
                return redirect()->route('users.withdrawal.request')
                    ->with('error', 'This withdrawal is already being processed.');
            }

            try {
                if (!empty($user_D->razorpayx_fund_id)) {
                    $fund_response = [];
                    $fund_response['id'] = $user_D->razorpayx_fund_id;
                } else {
                    $fund_response = $this->createIdpUserFundTransaferIdInBankByRazorpay($user_D->razorpayx_contact_id, $user_D->name, $user_D_bank->ifsc, $user_D_bank->account_number);

                    if (!empty($fund_response) && empty($fund_response['error']) && !empty($fund_response['id'])) {
                        DB::table('users')
                            ->where('users_id', $user_D->users_id)
                            ->update(['razorpayx_fund_id' => $fund_response['id']]);
                    }
                }

                if (empty($fund_response) || !empty($fund_response['error'])) {
                    throw new \Exception("Fund account creation failed");
                }

                $fields = ['amount'];
                $ac_amount = getUserWithdrawalAmount($id, $fields);
                // $tds_amount = $ac_amount * 5/100;
                $tds_amount = ($user_D->is_tax == 0) ? $ac_amount * 20 / 100 : $ac_amount * 2 / 100;
                $payout_response = $this->payoutIdpUserByRazorpay($fund_response['id'], $ac_amount - $tds_amount, $user_id, $id);

                $maskedAccountNumber = "*******" . substr($user_D_bank->account_number, -4);
                $tds1 = floor($ac_amount - $tds_amount);

                $mail = array(
                    'name' => $user_D->name,
                    'full_amount' => $ac_amount,
                    'amount' => floor($ac_amount - $tds_amount),
                    'bank' => $user_D_bank->account_number,
                    'tds' => $tds_amount,
                );
                $header = 'Idigitalpreneur weekly payment';

                $message = View::make('mails.payoutMail', $mail)->render();
                $message1 = View::make('mails.payoutMail', $mail)->render();

                if ($withdrawal_details->is_cashback == 1) {
                    @send_mail($user_D->email, $header, $message);
                } else {
                    @send_mail($user_D->email, $header, $message1);
                }

                if ($withdrawal_details->is_cashback == 1) // yha pr ek wati template bna dena jisme payout ki jgh cashback likha ho
                    @whatsMessage($user_D->phone, '{"template_name": "payout_wati_msg","broadcast_name": "payout_wati_msg","parameters": [{"name":"name","value":"*' . $user_D->name . '*"},{"name":"amount","value":"*' . $ac_amount . '*"},{"name":"amuont_1","value":"*' . $tds1 . '*"},{"name":"account_number","value":"*' . $maskedAccountNumber . '*"}]}');
                else {
                    if (($user_D->is_tax == 0)) {
                        @whatsMessage($user_D->phone, '{"template_name": "20_tds_payout1","broadcast_name": "payout_wati_msg","parameters": [{"name":"name","value":"*' . $user_D->name . '*"},{"name":"amount","value":"*' . $ac_amount . '*"},{"name":"amuont_1","value":"*' . $tds1 . '*"},{"name":"account_number","value":"*' . $maskedAccountNumber . '*"}]}');
                    } else {
                        @whatsMessage($user_D->phone, '{"template_name": "payout_wati_msg","broadcast_name": "payout_wati_msg","parameters": [{"name":"name","value":"*' . $user_D->name . '*"},{"name":"amount","value":"*' . $ac_amount . '*"},{"name":"amuont_1","value":"*' . $tds1 . '*"},{"name":"account_number","value":"*' . $maskedAccountNumber . '*"}]}');
                    }
                }

                if (isset($payout_response['status']) && $payout_response['status'] == "processing") {
                    $status = 3; // processing
                    User_model::update_withdrawalstatus($id, $status, $user_id, json_encode($fund_response), json_encode($payout_response), $tds_amount);
                    return redirect()->route('users.withdrawal.request')
                        ->with('message', 'Payment is processing, please wait for few minutes.');
                } elseif (isset($payout_response['status']) && $payout_response['status'] != "processing") {
                    $status = 4; // failed/hold
                    User_model::update_withdrawalstatus($id, $status, $user_id, json_encode($fund_response), json_encode($payout_response), $tds_amount);
                    return redirect()->route('users.withdrawal.request')
                        ->with('error', 'Payment is not processed. Status is hold state.');
                } else {
                    $status = 2; // reset to pending
                    User_model::update_withdrawalstatus($id, $status, $user_id, json_encode($fund_response), json_encode($payout_response), $tds_amount);
                    return redirect()->route('users.withdrawal.request')
                        ->with('error', 'Payment is not processed, record re-updated for payment.');
                }
            } catch (\Exception $e) {
                User_model::update_withdrawalstatus(
                    $id,
                    2,
                    $user_id,
                    json_encode($fund_response),
                    json_encode($payout_response),
                    $tds_amount
                );
                return redirect()->route('users.withdrawal.request')
                    ->with('error', 'Something went wrong: ' . $e->getMessage());
            }
        }


        return redirect()->route('users.withdrawal.request');
    }

    public function selfPayOtp($number, $id)
    {
        $email = urldecode($number);

        // Find user by email and id
        $userR = DB::table('tbl_self_withdrawl_request')
            ->where('email', $email)
            ->where('id', $id)
            ->first();

        if ($userR) {
            $otp = rand(9999, 1000000);

            // Update OTP and expiry time
            DB::table('tbl_self_withdrawl_request')
                ->where('email', $email)
                ->where('id', $id)
                ->update([
                    'otp' => $otp,
                    'otp_generate' => Carbon::now('Asia/Kolkata')->addMinutes(5)
                ]);

            Mail::send([], [], function ($message) use ($email, $otp) {
                $message->to($email)
                    ->subject('IDP Self Payout Approval OTP')
                    ->html("Hi your Self Payout Approval OTP is <strong>$otp</strong>.OTP will be Expire in 5 min.");
            });
            echo 1;
        } else {
            echo 0;
        }
    }

    public function disapproveSelfPayStatus()
    {
        $id = (isset($_GET['id']) ? $_GET['id'] : 'X');
        $status =  (isset($_GET['status']) ? $_GET['status'] : 'X');
        $update = User_model::update_self_pay_status($id, $status);
        if ($update == 1) {
            echo $status;
            die;
        }
    }

    public function approveSelfPayStatus(Request $request)
    {
        $id = $request->input('id');
        $status =  $request->input('status');
        $email =  $request->input('email');
        $otp =  $request->input('otp');
        // echo "<pre>"; print_r($id); die;

        $update = User_model::update_self_pay_status($id, $status, $email, $otp);
        if ($update == 1) {
            $aa = getSelfPayoutRecordForCashback($id);
            if ($aa &&  $aa->is_cashback == 1) {
                $fields = ['name', 'email', 'phone'];
                $c_u_d = getUserDetails($aa->users_id, $fields);

                $data['name'] = $c_u_d->name;
                $data['cashback'] = $aa->amount;

                Mail::send('cashback-mail', $data, function ($message) use ($email) {
                    $message->to($email)
                        ->subject('Congratulations on Your Cashback Reward!');
                });

                whatsMessage($c_u_d->phone, '{"template_name": "cashback_","broadcast_name": "cashback_","parameters": [{"name":"name","value":"*' . $data['name'] . '*"},{"name":"cashback","value":"*' . $data['cashback'] . '*"}]}');
            }
            return redirect()->route('self.payuser')->with('success', 'Updated successfully!');
        } else {
            return redirect()->route('self.payuser')->with('error', 'Something went wrong, please try again.');
        }
    }

    public function selfpayuser()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(37, explode(',', $userData->parent_modules))))) {
            if (!session()->has('user_id')) {
                // If the user is already logged in, redirect them to the dashboard
                return redirect()->route('admin.login');
            }

            $tbl_self_withdrawl_request = User_model::get_self_payuser_list(NULL);
            return view('adminend/selfpayuser', compact('tbl_self_withdrawl_request'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function userModule()
    {
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(1, explode(',', $userData->parent_modules))))) {
            if (!session()->has('user_id')) {
                // If the user is already logged in, redirect them to the dashboard
                return redirect()->route('admin.login');
            }

            return view('adminend/user_module');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function userModuleSearch(Request $request)
    {
        $request->validate([
            'searchQuery' => 'required|min:5', // Ensure search query is at least 10 characters
        ]);

        $query = $request->input('searchQuery');
        $fields = 'users.users_id,users.is_tax,users.name,users.email,users.phone,users.current_plan,users.balance_money,users.receive_money,users.email_verify,users.kyc_status,users.account,users.status,tbl_user_bank.affiliate,checkid.redeem_status';

        $users =  User_model::get_user($query, $fields);

        $usersArray = $users->toArray();

        // $totalRecords = DB::table('users')->count();

        // If a single user is returned, wrap it in an array with the "data" key
        // $recordsFiltered = count($usersArray);

        // Server-side JSON response
        return response()->json([
            'draw' => intval($request->input('draw', 1)), // DataTables draw counter
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => $usersArray
        ]);
    }

    public function userReferralList($id = NULL)
    {
        if ($id === null) {
            abort(404); // Proper way to show a 404 error in Laravel
        }
        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(16, explode(',', $userData->sub_modules))))) {

            // Fetch user details
            // $user = User_model::get_user_details($id, $fields);
            // echo "<pre>"; print_r($user); die;
            // if (empty($user)) {
            //     abort(404);
            // }

            // $fields = 'users.name,users.email';
            // $sponsor_details = User_model::get_user_details($user->reffral_by_user_id, $fields);

            // $fields = 'tbl_franchise_member.username';
            // $manager_details = User_model::get_manager_details($id, $fields);

            // return view('adminend.user_referral_list', compact('user', 'sponsor_details', 'manager_details'));
            return view('adminend.user_referral_list', ['receive_user_id' => $id]);
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function userStatusChange(Request $request)
    {
        $data['users_id'] = $request->input('users_id');
        $status = $request->input('status');
        $email = $request->input('email');

        $data['admin_id'] = session()->has('user_id');
        $data['otp'] = rand(9999, 1000000);
        $data['otp_expire'] = Carbon::now('Asia/Kolkata')->addMinutes(10);
        $data['created_on'] = Carbon::now('Asia/Kolkata');

        if ($status == '1') {
            $data['message'] = 'Account Deactivated';
        } else {
            $data['message'] = 'Account Activated';
        }

        $result = User_model::updateAdminLog($data);

        if ($result) {
            $otp = $data['otp'];
            Mail::send([], [], function ($message) use ($email, $otp) {
                $message->to($email)
                    ->subject('OTP for Account Activation/Deactivation')
                    ->html("As requested, please find the One-Time Password (OTP) below for [activation/deactivation] of the user account:<br><br><strong>OTP: $otp</strong>");
            });

            echo json_encode([
                "status" => "success",
                "insert_id" => $result,

            ]);
        } else {
            echo json_encode([
                "status" => "error",
            ]);
        }
    }

    public function userStatusChangeVerifyotp(Request $request)
    {
        header('Content-Type: application/json');

        $insertId = $request->input('insert_id');
        $otp = $request->input('otp');
        $status = $request->input('status');
        $currentTime = Carbon::now('Asia/Kolkata');

        $otpVerify = User_model::getData($insertId);

        if ($otpVerify && $otpVerify->otp == $otp && $otpVerify->otp_expire > $currentTime) {
            $id = $otpVerify->users_id;
            $result = User_model::update_status($id, $status);

            if ($result) {
                echo json_encode([
                    "status" => "success",
                    "message" => "OTP verified and status updated successfully."
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Failed to update status."
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid OTP or OTP expired."
            ]);
        }
    }

    public function userAccountChange(Request $request)
    {
        $data['users_id'] = $request->input('users_id');
        $status = $request->input('status');
        $email = $request->input('email');

        $data['admin_id'] = session()->has('user_id');
        $data['otp'] = rand(9999, 1000000);
        $data['otp_expire'] = Carbon::now('Asia/Kolkata')->addMinutes(10);
        $data['created_on'] = Carbon::now('Asia/Kolkata');

        if ($status == '1') {
            $data['message'] = 'Account Resume';
        } else {
            $data['message'] = 'Account Suspend';
        }

        $result = User_model::updateAdminLog($data);

        if ($result) {
            $otp = $data['otp'];

            Mail::send([], [], function ($message) use ($email, $otp) {
                $message->to($email)
                    ->subject('OTP for Account Suspend/Resume')
                    ->html("As requested, please find the One-Time Password (OTP) below for [Suspend/Resume] of the user account:<br><br><strong>OTP: $otp</strong>");
            });
            echo json_encode([
                "status" => "success",
                "insert_id" => $result,

            ]);
        } else {
            echo json_encode([
                "status" => "error",
            ]);
        }
    }

    public function userAccountChangeVerifyotp(Request $request)
    {
        header('Content-Type: application/json');

        $insertId = $request->input('insert_id');
        $otp = $request->input('otp');
        $status = $request->input('status');
        $currentTime = Carbon::now('Asia/Kolkata');

        $otpVerify = User_model::getData($insertId);

        if ($otpVerify && $otpVerify->otp == $otp && $otpVerify->otp_expire > $currentTime) {
            $id = $otpVerify->users_id;
            $result = User_model::update_suspend($id, $status);

            if ($result) {
                echo json_encode([
                    "status" => "success",
                    "message" => "OTP verified and status updated successfully."
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Failed to update status."
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid OTP or OTP expired."
            ]);
        }
    }

    public function userRedeemStatusChange(Request $request)
    {
        $data['users_id'] = $request->input('users_id');
        $status = $request->input('status');
        $email = $request->input('email');

        $data['admin_id'] = session()->has('user_id');
        $data['otp'] = rand(9999, 1000000);
        $data['otp_expire'] = Carbon::now('Asia/Kolkata')->addMinutes(10);
        $data['created_on'] = Carbon::now('Asia/Kolkata');

        if ($status == '1') {
            $data['message'] = 'Redeem Disabled';
        } else {
            $data['message'] = 'Redeem Activated';
        }

        $result = User_model::updateAdminLog($data);

        if ($result) {
            $otp = $data['otp'];
            Mail::send([], [], function ($message) use ($email, $otp) {
                $message->to($email)
                    ->subject('OTP for Redeem Disabled/Activated')
                    ->html("As requested, please find the One-Time Password (OTP) below for [Disabled/Activated] of the user Redeem:<br><br><strong>OTP: $otp</strong>");
            });

            echo json_encode([
                "status" => "success",
                "insert_id" => $result,

            ]);
        } else {
            echo json_encode([
                "status" => "error",
            ]);
        }
    }

    public function userRedeemStatusChangeVerifyotp(Request $request)
    {
        header('Content-Type: application/json');

        $insertId = $request->input('insert_id');
        $otp = $request->input('otp');
        $status = $request->input('status');
        $currentTime = Carbon::now('Asia/Kolkata');

        $otpVerify = User_model::getData($insertId);

        if ($otpVerify && $otpVerify->otp == $otp && $otpVerify->otp_expire > $currentTime) {
            $id = $otpVerify->users_id;
            $result = User_model::update_redeemstatus($id, $status);

            if ($result) {
                echo json_encode([
                    "status" => "success",
                    "message" => "OTP verified and status updated successfully."
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Failed to update status."
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid OTP or OTP expired."
            ]);
        }
    }



    public function userEdit($id = NULL)
    {
        if ($id === null) {
            abort(404); // Proper way to show a 404 error in Laravel
        }

        $userData = session('user_data');
        if (isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(17, explode(',', $userData->sub_modules))))) {

            $fields = 'users.country_id,users.users_id,users.state_name,users.name,users.email,users.phone,users.last_login,
                    users.created_on,users.reffral_by_user_id,users.reffral_code,tbl_user_bank.affiliate,
                    tbl_user_bank.account_number,tbl_user_bank.ifsc,tbl_user_bank.ac_type,tbl_user_bank.tax_cre,tbl_user_bank.name as usernamebank';

            // Fetch user details
            $user = User_model::get_user_details($id, $fields);
            // echo "<pre>"; print_r($user); die;
            if (empty($user)) {
                abort(404); // Show 404 if user not found
            }

            $fields = 'users.name,users.email';
            $sponsor_details = User_model::get_user_details($user->reffral_by_user_id, $fields);

            $fields = 'tbl_franchise_member.username';
            $manager_details = User_model::get_manager_details($id, $fields);

            return view('adminend.user_details_edit', compact('user', 'sponsor_details', 'manager_details'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function userPersonalDetailsUpdate(Request $request, $id = NULL)
    {
        if ($id === null) {
            abort(404);
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'state'   => $request->input('state_id'),
            'state_name' => $request->input('state_name'),
        ];

        $result = User_model::userPersonalDetailsUpdate($id, $data);
        // Check if the update was successful and return a response
        if ($result) {
            return redirect()->route('user.edit', $id)
                ->with('success', 'User details updated successfully.');
        } else {
            return back()->with('error', 'Failed to update user details.');
        }
    }

    public function userBankDetailsUpdate(Request $request, $id = NULL)
    {
        if ($id === null) {
            abort(404);
        }

        $data = [
            'name' => $request->input('name'),
            'account_number' => $request->input('account_number'),
            'ac_type' => $request->input('ac_type'),
            'ifsc' => $request->input('ifsc'),
            'tax_cre' => $request->input('tax_cre'),
        ];

        $result = User_model::userBankDetailsUpdate($id, $data);
        // Check if the update was successful and return a response
        if ($result) {
            return redirect()->route('user.edit', $id)
                ->with('success', 'User Bank details updated successfully.');
        } else {
            return back()->with('error', 'Failed to update user bank details.');
        }
    }

    public function userWithdrawalRequestCreate(Request $request)
    {
        $users_id = $request->input('users_id');
        $amount = $request->input('amount');
        $is_cashback = $request->input('is_cashback');

        $fields = ['balance_money', 'receive_money'];
        $ud = getUserDetails($users_id, $fields);

        if (($ud->balance_money - $ud->receive_money) >= $amount) {
            try {
                $insertId = DB::table('tbl_self_withdrawl_request')->insertGetId([
                    'users_id'   => $users_id,
                    'amount'     => $amount,
                    'is_cashback' => $is_cashback,
                    'status'     => 1,
                    'created_on' => Carbon::now('Asia/Kolkata'),
                    'email'      => 'management@idigitalpreneur.com'
                ]);
                if ($insertId) {
                    return redirect()->route('users.module')->with('message', 'Request is Created & sent for approval');
                } else {
                    return redirect()->route('users.module')->with('error', 'Create Request Failed.');
                }
            } catch (\Exception $e) {
                return redirect()->route('users.module')->with('error', 'Something went wrong! ' . $e->getMessage());
            }
        } else {
            return redirect()->route('users.module')->with('error', 'Create Request is Failed. Balance money not sufficient.');
        }
    }

    public function userMessageSendWhatsapp(Request $request)
    {
        $phone = $request->input('mobile');
        $message = $request->input('message');

        @whatsMessage($phone, '{"template_name": "single_user_personnel_message","broadcast_name": "single_user_personnel_message","parameters": [{"name":"attribute_1","value":"' . $message . '"}]}');

        return redirect()->route('users.module')->with('message', 'Message sent successfully.');
    }
}
