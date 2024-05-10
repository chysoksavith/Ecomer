<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRoles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function users(Request $request)
    {
        Session::put('page', 'users');
        $users = User::paginate(4);

        // set admin/subadmin Permission for users
        $usersModuleCount = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'users'])->count();
        $usersModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $usersModule['view_access'] = 1;
            $usersModule['edit_access'] = 1;
            $usersModule['full_access'] = 1;
        } else if ($usersModuleCount == 0) {
            $message = "This feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $usersModule = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'users'])->first()->toArray();
        }
        return view('admin.users.users')->with(compact('users', 'usersModule'));
    }

    //  update status
    public function updateUserStatus(Request $request)
    {
        $data = $request->all();
        if ($data['status'] == 'Active') {
            $status = 0;
        } else {
            $status = 1;
        }

        User::where('id', $data['user_id'])->update(['status' => $status]);
        return response()->json(['status' => $status, 'user_id' => $data['user_id']]);
    }
    public function UserChart()
    {
        Session::put('page', 'users_report');

        $currentMonthUsersCount = User::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $beforeOneMonthUsersCount = User::whereYear('created_at', Carbon::now()->subMonth()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();
        $beforeTwoMonthsUsersCount = User::whereYear('created_at', Carbon::now()->subMonths()->year)
            ->whereMonth('created_at', Carbon::now()->subMonths(2)->month)
            ->count();
        $beforeThreeMonthsUsersCount = User::whereYear('created_at', Carbon::now()->subMonths()->year)
            ->whereMonth('created_at', Carbon::now()->subMonths(3)->month)
            ->count();
        $userCount = array($currentMonthUsersCount, $beforeOneMonthUsersCount, $beforeTwoMonthsUsersCount, $beforeThreeMonthsUsersCount);
        return view('admin.users.view_users_chart')->with(compact('userCount'));
    }
}
