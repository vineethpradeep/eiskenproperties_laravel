<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = [
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'success',
        ];

        return redirect('/login')->with($notification);
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        //Get Authencate user
        $id = Auth::user()->id;
        //Get user data
        $profiledata = User::find($id);

        //Return user data
        //compact means to pass data
        return view('admin.admin_profile', compact('profiledata'));
    }

    public function AdminProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            @unlink(public_path('upload/admin_images/' . $data->avatar));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['avatar'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        //return redirect()->route('admin.profile')->with($notification);
        return redirect()->back()->with($notification);
    }

    // public function AdminChangePassword()
    // {
    //     $profiledata = User::find(Auth::user()->id);
    //     return view('admin.admin_change_password', compact('profiledata'));
    // }

    // public function AdminUpdatePassword(Request $request)
    // {
    //     // Validate inputs
    //     $request->validate([
    //         'old_password' => 'required',
    //         'new_password' => 'required|confirmed',
    //     ]);

    //     // Check if the old password matches the current one
    //     if (!Hash::check($request->old_password, auth::user()->password)) {
    //         // If the old password doesn't match, return an error notification
    //         $notification = array(
    //             'message' => 'Old Password does not match',
    //             'alert-type' => 'error'
    //         );
    //         return back()->with($notification);  // Pass notification using 'with()' method
    //     }

    //     // Update password if old password is correct
    //     User::whereId(Auth::user()->id)->update([
    //         'password' => Hash::make($request->new_password)
    //     ]);

    //     // If successful, return a success notification
    //     $notification = array(
    //         'message' => 'Password Updated Successfully',
    //         'alert-type' => 'success'
    //     );
    //     dd($request->old_password, $request->new_password);
    //     return back()->with($notification);  // Return with success notification
    // }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = user::find($id);

        return view('admin.admin_change_password', compact('profileData'));
    } // End Method

    public function AdminUpdatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = [
                'message' => 'Old password Does not match!',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }
        // Update The New Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = [
            'message' => 'Password Change Successfully',
            'alert-type' => 'success',
        ];

        return back()->with($notification);
    } // End Method
}
