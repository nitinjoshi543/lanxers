<?php

namespace App\Http\Controllers;

use App\Models\Subadmin_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Subadmin extends Controller
{
    public function subadminModule()
    {
        $userData = session('user_data');
        if ($userData->group_id == 1) {
            if (!session()->has('user_id')) {
                return redirect()->route('admin.login');
            }
            $users = Subadmin_model::get_admin_user_list();
            return view('adminend/subadmin_module', compact('users'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function subadminEdit($id)
    {
        $userData = session('user_data');
        if ($userData->group_id == 1) {
            if (!session()->has('user_id')) {
                return redirect()->route('admin.login');
            }
            $users = Subadmin_model::get_admin_user_list($id);
            $parent_modules = Subadmin_model::get_parent_module_list();
            return view('adminend/subadmin_module_edit', compact('users','parent_modules'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function subadminAdd()
    {
        $userData = session('user_data');
        if ($userData->group_id == 1) {
            if (!session()->has('user_id')) {
                return redirect()->route('admin.login');
            }
            $parent_modules = Subadmin_model::get_parent_module_list();
            return view('adminend/subadmin_module_add', compact('parent_modules'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function submitEditAdminModuleForm(Request $request,$id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'parent_modules' => 'array', // Parent modules
            'sub_modules' => 'array', // Submodules
        ]);

        $parentModules = implode(',', $request->input('parent_modules', []));
        $subModules = implode(',', $request->input('sub_modules', []));

        $data = [
            'user_name' => $request->input('name'),
            'user_email' => $request->input('email'),
            'user_number' => $request->input('phone'),
            'user_department' => $request->input('user_department'),
            'group_id' => 2,
            'parent_modules' => $parentModules,
            'sub_modules' => $subModules,
            'updated_on' => Carbon::now('Asia/Kolkata'),
        ];

        $result = Subadmin_model::updateEditAdminLog($data,$id);

        if ($result) {
            return redirect()->back()->with('success', 'Data updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }

    public function submitAdminModuleForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'modules' => 'array', // Parent modules
            'submodules' => 'array', // Submodules
        ]);

        $parentModules = implode(',', $request->input('parent_modules', []));
        $subModules = implode(',', $request->input('sub_modules', []));

        $data = [
            'user_name' => $request->input('name'),
            'user_email' => $request->input('email'),
            'user_number' => $request->input('phone'),
            'user_department' => $request->input('user_department'),
            'group_id' => 2,
            'parent_modules' => $parentModules,
            'sub_modules' => $subModules,
            'created_on' => Carbon::now('Asia/Kolkata'),
            'updated_on' => Carbon::now('Asia/Kolkata'),
        ];

        $result = Subadmin_model::updateAdminLog($data);

        if ($result) {
            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to save data.');
        }
    }
}
