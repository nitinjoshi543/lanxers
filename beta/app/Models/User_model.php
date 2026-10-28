<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class User_model extends Model
{
    public static function get_user($query, $fields)
    {
        $result = DB::table('users')
            ->select(DB::raw($fields))
            ->leftJoin('freelancer_profiles', 'users.id', '=', 'freelancer_profiles.user_id')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('users.email', 'like', "%{$query}%")
                    ->orWhere('users.phone', 'like', "%{$query}%")
                    ->orWhere('users.name', 'like', "%{$query}%");
            })
            ->where('users.role', 'freelancer')
            ->get();

        return $result;
    }

    public static function get_user_details($id, $fields)
    {
        return DB::table('users')
            ->select(DB::raw($fields))
            ->leftJoin('freelancer_profiles', 'users.id', '=', 'freelancer_profiles.user_id')
            ->leftJoin('wallets', 'users.id', '=', 'wallets.user_id')
            ->leftJoin('states', 'states.id', '=', 'freelancer_profiles.state')
            ->leftJoin('countries', 'countries.id', '=', 'freelancer_profiles.country')
            ->where('users.id', $id)
            ->first();
    }

    public static function get_user_skills($id, $fields)
    {
        return DB::table('user_skills')
            ->select(DB::raw($fields))
            ->leftJoin('skills', 'user_skills.skill_id', '=', 'skills.id')
            ->where('user_skills.user_id', $id)
            ->get();
    }

    public static function get_user_experiences($id, $fields)
    {
        return DB::table('user_experiences')
            ->select(DB::raw($fields))
            ->where('user_id', $id)
            ->orderByDesc('id')
            ->get();
    }







// Old Code
    public static function setLiveWebinarStatus($id, $status)
    {
        return DB::table('tbl_webinar_detail')
            ->where('id', $id)
            ->update([
                'status' => $status,
                'updated_on' => Carbon::now('Asia/Kolkata'),
            ]);
    }

    public static function getLiveWebinar($id)
    {
        return DB::table('tbl_webinar_detail')
            ->select('*')
            ->where('id', $id)
            ->first();
    }

    public static function updateEditLiveWebinar($data, $id)
    {
        return DB::table('tbl_webinar_detail')
            ->where('id', $id)
            ->update([
                'package' => $data['package'],
                'title' => $data['title'],
                'offer_start_date' => $data['offer_start_date'],
                'offer_close_date' => $data['offer_close_date'],
                'discount_type' => $data['discount_type'],
                'discount' => $data['discount'],
                'user_type' => $data['user_type'],
                'quantity' => $data['quantity'],
                'updated_on' => $data['updated_on'],
            ]);
    }

    public static function liveWebinarAdd($data)
    {
        return DB::table('tbl_webinar_detail')->insert($data);
    }

    public static function lock_withdrawal($id, $user_id)
    {
        return DB::table('tbl_withdrawal_amount')
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->where('status', 2) // only pending
            ->update(['status' => 9]); // 9 = processing
    }

    public static function update_refund_status($id, $status, $user_id, $fund_response, $payout_response)
    {
        $payout_array = json_decode($payout_response);

        // status adjustments
        if ($status == 1 && !empty($user_id) && isset($payout_array) && $payout_array->status == "processing") {
            $status = 3;
        } elseif ($status == 1 && !empty($user_id) && isset($payout_array) && $payout_array->status != "processing") {
            $status = 4;
        } elseif ($status == 1 && !empty($user_id) && empty($payout_array)) {
            $status = 4;
        }

        $data = [
            'status' => $status,
            'razorpayx_fundid_response' => $fund_response,
            'razorpayx_payout_response' => $payout_response,
        ];

        return DB::table('tbl_refunds_order')
            ->where('refund_id', $id)
            ->update($data);
    }

    public static function Search_by_phone($phone)
    {
        $result = DB::table('tbl_users')
            ->select(DB::raw('users_id,name,email,phone,current_plan,created_on,reffral_by_user_id,extra_open_course_ids'))
            ->where('phone', $phone)
            ->where('current_plan', NULL)
            ->first();

        return $result;
    }

    public static function Search_by_email($email)
    {
        $result = DB::table('tbl_users')
            ->select(DB::raw('users_id,name,email,phone,current_plan,created_on,reffral_by_user_id,extra_open_course_ids'))
            ->where('email', $email)
            ->where('current_plan', NULL)
            ->first();

        return $result;
    }

    public static function getIndiCourseName($id)
    {
        $result = DB::table('tbl_courses_list')
            ->select(DB::raw('course_title'))
            ->where('id', $id)
            ->first();

        return $result;
    }

    public static function getSponserDetails($users_id)
    {
        $result = DB::table('tbl_users')
            ->select(DB::raw('tbl_users.name,tbl_users.email,tbl_user_bank.affiliate'))
            ->leftJoin('tbl_user_bank', 'tbl_users.users_id', '=', 'tbl_user_bank.users_id')
            ->where(function ($queryBuilder) use ($users_id) {
                $queryBuilder->where('tbl_users.users_id', $users_id);
            })
            ->first();

        return $result;
    }

    public static function getSponserDetail($affiliate)
    {
        $result = DB::table('tbl_users')
            ->select(DB::raw('tbl_users.users_id, tbl_users.name, tbl_users.email'))
            ->leftJoin('tbl_user_bank', 'tbl_users.users_id', '=', 'tbl_user_bank.users_id')
            ->where(function ($queryBuilder) use ($affiliate) {
                $queryBuilder->where('tbl_user_bank.affiliate', $affiliate);
            })
            ->first();

        return $result;
    }

    public static function get_user_other($id, $fields)
    {
        $fieldsString = implode(',', $fields);
        $result = DB::table('tbl_user_bank')
            ->select(DB::raw($fieldsString))
            ->where('users_id', $id)
            ->first();
        return $result;
    }

    public static function get_users($id, $fields)
    {
        $fieldsString = implode(',', $fields);
        $result = DB::table('tbl_users')
            ->select(DB::raw($fieldsString))
            ->where('users_id', $id)
            ->first();

        return $result;
    }

    public static function user_remove($users_id)
    {
        $deleted = DB::table('tbl_users')
            ->where('users_id', $users_id)
            ->delete();

        if ($deleted) {
            $message = 'Record Deleted';
            self::recordsUpdatedBy($users_id, $message);
        }

        return $deleted;
    }

    public static function updateEditFindUserDetails($data, $users_id)
    {
        $original_user_data = DB::table('tbl_users')
            ->where('users_id', $users_id)
            ->first();

        $user_changes = [];
        foreach ($data as $key => $value) {
            if (isset($original_user_data->$key) && $original_user_data->$key != $value) {
                $user_changes[] = $key;
            }
        }

        if (!empty($user_changes)) {
            $message = 'Updated fields: ' . implode(', ', $user_changes);
            self::recordsUpdatedBy($users_id, $message);
        }

        return DB::table('tbl_users')
            ->where('users_id', $users_id)
            ->update($data);
    }

    public static function updatePassword($data, $users_id)
    {
        $original_user_data = DB::table('tbl_users')
            ->where('users_id', $users_id)
            ->first();

        $user_changes = [];
        foreach ($data as $key => $value) {
            if (isset($original_user_data->$key) && $original_user_data->$key != $value) {
                $user_changes[] = $key;
            }
        }

        if (!empty($user_changes)) {
            $message = 'Updated fields: ' . implode(', ', $user_changes);
            self::recordsUpdatedBy($users_id, $message);
        }

        return DB::table('tbl_users')
            ->where('users_id', $users_id)
            ->update($data);
    }

    public static function userAutokycReset($id)
    {
        $original_user_data = DB::table('tbl_users')
            ->where('users_id', $id)
            ->first();

        $original_kyc_data = DB::table('tbl_user_kyc_data')
            ->where('user_id', $id)
            ->first();

        $data2 = array(
            'fulll_kyc_done' => 0,
            'bank_kyc_status' => 0,
        );
        $data = array(
            'kyc_status' => 0,
            'razorpayx_fund_id' => ''
        );

        // Track changes for `tbl_users`
        $user_changes = [];
        foreach ($data as $key => $value) {
            if (isset($original_user_data->$key) && $original_user_data->$key != $value) {
                $user_changes[] = $key;
            }
        }

        // Track changes for `tbl_user_kyc_data`
        $kyc_changes = [];
        foreach ($data2 as $key => $value) {
            if (isset($original_kyc_data->$key) && $original_kyc_data->$key != $value) {
                $kyc_changes[] = $key;
            }
        }

        // Combine all changed fields
        $changes = array_merge($user_changes, $kyc_changes);

        // If there are changes, log them
        if (!empty($changes)) {
            $message = 'Updated fields: ' . implode(', ', $changes);
            self::recordsUpdatedBy($id, $message);
        }

        DB::table('tbl_users')
            ->where('users_id', $id)
            ->update($data);

        DB::table('tbl_user_kyc_data')
            ->where('user_id', $id)
            ->update($data2);
    }

    // Function to log changes
    public static function recordsUpdatedBy($id, $message)
    {
        $data = [
            'users_id'   => $id,
            'admin_id'   => session('user_id'), // Assuming Laravel session
            'created_on' => now(), // Laravel helper function for timestamp
            'message'    => $message
        ];

        return DB::table('tbl_admin_user_data_update')->insert($data);
    }

    public static function get_self_payuser_list($id = NULL)
    {

        if ($id === null) {
            return DB::table('tbl_self_withdrawl_request')
                ->join('tbl_users', 'tbl_users.users_id', '=', 'tbl_self_withdrawl_request.users_id')
                ->select('tbl_self_withdrawl_request.id', 'tbl_self_withdrawl_request.users_id', 'tbl_self_withdrawl_request.amount', 'tbl_self_withdrawl_request.created_on', 'tbl_self_withdrawl_request.status', 'tbl_users.name', 'tbl_users.email', 'tbl_self_withdrawl_request.email as admin_email')
                ->where('tbl_self_withdrawl_request.status', 1)
                ->orderBy('tbl_self_withdrawl_request.id', 'ASC')
                ->get();
        }

        return DB::table('tbl_self_withdrawl_request')
            ->where('id', $id)
            ->first();
    }

    public static function update_self_pay_status($id, $status, $email = NULL, $otp = NULL)
    {
        $data = ['status' => $status];

        // Begin by updating the status in the table
        $update = DB::table('tbl_self_withdrawl_request')
            ->where('id', $id);

        if ($email !== null && $otp !== null) {
            $update->where('email', $email)
                ->where('otp', $otp)
                ->where('otp_generate', '>', now());
        }

        $update = $update->update($data);

        if ($status == 0 && $update) {
            $record = DB::table('tbl_self_withdrawl_request')
                ->where('id', $id)
                ->first();

            if ($record->is_cashback == 1) {
                DB::table('tbl_users')
                    ->where('users_id', $record->users_id)
                    ->increment('balance_money', $record->amount);
            } else {
                if ($record->status == 0) {
                    DB::table('tbl_withdrawal_amount')
                        ->insert([
                            'users_id' => $record->users_id,
                            'amount' => $record->amount,
                            'is_cashback' => $record->is_cashback,
                            'self_create' => 1,
                            'status' => 2,
                            'created_on' => now(),
                        ]);
                }
            }
        }

        return $update;
    }

    public static function update_withdrawalstatus($id, $status, $user_id, $fund_response, $payout_response, $tds)
    {
        $payout_array = json_decode($payout_response);

        // echo "<pre>"; print_r($payout_array); die;

        if ($status == 1 && !empty($user_id) && isset($payout_array->status) && $payout_array->status == "processing") {
            $status = 3;
        } elseif ($status == 1 && !empty($user_id) && isset($payout_array->status) && $payout_array->status != "processing") {
            $status = 4;
        } elseif ($status == 1 && !empty($user_id) && empty($payout_array)) {
            $status = 4;
        }

        return DB::table('tbl_withdrawal_amount')
            ->where('id', $id)
            ->where('is_astitva', '0')
            ->update([
                'status' => $status,
                'tds' => $tds,
                'razorpayx_fundid_response' => $fund_response,
                'razorpayx_payout_response' => $payout_response,
            ]);
    }

    public static function get_tbl_current_sheet_total_pending($id = NULL)
    {
        $result = DB::table('tbl_withdrawal_amount')
            ->select(DB::raw('SUM(amount) as current_amount'))
            ->where('status', 2)
            ->where('is_astitva', 0)
            ->whereDate('created_on', '>=', now()->subMonths(6))
            ->first();

        return $result;
    }

    private function _getDatatablesQuery($searchValue = null)
    {
        $query = DB::table('tbl_withdrawal_amount')
            ->select('tbl_withdrawal_amount.*', 'tbl_users.email')
            ->leftJoin('tbl_users', 'tbl_users.users_id', '=', 'tbl_withdrawal_amount.users_id')
            ->where('tbl_withdrawal_amount.status', 2)
            ->where('tbl_withdrawal_amount.is_astitva', 0)
            ->whereDate('tbl_withdrawal_amount.created_on', '>=', now()->subMonths(6));

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                foreach ($this->column_search as $column) {
                    $q->orWhere($column, 'like', "%$searchValue%");
                }
                $q->orWhere('tbl_users.email', 'like', "%$searchValue%");
            });
        }

        return $query;
    }

    public function getDatatables()
    {
        $searchValue = request()->input('search.value');
        $length = request()->input('length', -1);
        $start = request()->input('start', 0);

        $query = $this->_getDatatablesQuery($searchValue);

        if ($length != -1) {
            $query->limit($length)->offset($start);
        }

        return response()->json($query->get());
    }

    public function countFiltered()
    {
        $searchValue = request()->input('search.value');
        return $this->_getDatatablesQuery($searchValue)
            ->whereNotIn('tbl_withdrawal_amount.users_id', [103, 7256, 105922, 130287, 15025, 92339, 48101, 53833, 219185, 54444, 16400])
            ->count();
    }

    public function countAll()
    {
        return DB::table('tbl_withdrawal_amount')
            ->where('status', 2)
            ->where('is_astitva', 0)
            ->whereDate('created_on', '>=', now()->subMonths(6))
            ->whereNotIn('users_id', [103, 7256, 105922, 130287, 15025, 92339, 48101, 53833, 219185, 54444, 16400])
            ->count();
    }

    

    public static function get_manager_details($id, $fields)
    {
        $result = DB::table('tbl_franchise_member')
            ->select(DB::raw($fields))
            ->leftJoin('tbl_user_allocation', 'tbl_franchise_member.id', '=', 'tbl_user_allocation.manager_id')
            ->where('tbl_user_allocation.users_id', $id)
            ->first();

        return $result;
    }

    public static function userPersonalDetailsUpdate($id, $data)
    {
        $original_user_data = DB::table('tbl_users')
            ->where('users_id', $id)
            ->first();

        $user_changes = [];
        foreach ($data as $key => $value) {
            if (isset($original_user_data->$key) && $original_user_data->$key != $value) {
                $user_changes[] = $key;
            }
        }

        if (!empty($user_changes)) {
            $message = 'Updated fields: ' . implode(', ', $user_changes);
            self::recordsUpdatedBy($id, $message);
        }

        return DB::table('tbl_users')
            ->where('users_id', $id)
            ->update($data);
    }

    public static function userBankDetailsUpdate($id, $data)
    {
        $original_user_data = DB::table('tbl_user_bank')
            ->where('users_id', $id)
            ->first();

        $user_changes = [];
        foreach ($data as $key => $value) {
            if (isset($original_user_data->$key) && $original_user_data->$key != $value) {
                $user_changes[] = $key;
            }
        }

        if (!empty($user_changes)) {
            $message = 'Updated fields: ' . implode(', ', $user_changes);
            self::recordsUpdatedBy($id, $message);

            // ✅ Reset Razorpay Fund ID when bank details change
            DB::table('tbl_users')
                ->where('users_id', $id)
                ->update(['razorpayx_fund_id' => '']);
        }

        return DB::table('tbl_user_bank')
            ->where('users_id', $id)
            ->update($data);
    }

    public static function updateAdminLog($data)
    {
        $insertedId = DB::table('tbl_admin_user_data_update')->insertGetId($data);
        return $insertedId ?: false;
    }

    public static function getData($id)
    {
        return DB::table('tbl_admin_user_data_update')->where('id', $id)->first();
    }

    public static function update_status($id, $status)
    {
        $newStatus = $status == 0 ? 1 : 0;
        return DB::table('tbl_users')
            ->where('users_id', $id)
            ->update(['status' => $newStatus]);
    }

    public static function update_suspend($id, $suspend)
    {
        return DB::table('tbl_users')
            ->where('users_id', $id)
            ->update(['account' => $suspend]);
    }

    public static function update_redeemstatus($id, $status)
    {
        return DB::table('tbl_users_checkid')
            ->where('users_id', $id)
            ->update(['redeem_status' => $status]);
    }
}
