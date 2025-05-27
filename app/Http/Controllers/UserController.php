<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Wishlist;
use App\Models\Property;
use App\Models\PropertyViewing;

class UserController extends Controller
{
    public function Index()
    {
        return view('frontend.index');
    }

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $userdata = User::find($id);
        return view('frontend.dashboard.edit_profile', compact('userdata'));
    }

    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('backend.users.all_users', compact('users'));
    }


    public function UserProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            @unlink(public_path('upload/user_images/' . $data->avatar));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['avatar'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        //return redirect()->route('admin.profile')->with($notification);
        return redirect()->back()->with($notification);
    }

    //User Logout
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = [
            'message' => 'User Logout Successfully',
            'alert-type' => 'success',
        ];

        return redirect('/login')->with($notification);
    }

    public function UserChangePassword()
    {
        return view('frontend.dashboard.change_password');
    }

    public function UserUpdatePassword(Request $request)
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


    private function getUserPropertyStats()
    {
        $userId = Auth::id();

        $wishlist = Wishlist::with('property')
            ->where('user_id', $userId)
            ->get();

        $propertyViewing = PropertyViewing::with('property')
            ->where('user_id', $userId)
            ->get();

        return [
            'wishlistProperties' => $wishlist->pluck('property')->filter(),
            'userWishlist' => $wishlist->pluck('property_id')->toArray(),
            'enquiry' => $propertyViewing,
            'viewingProperties' => $propertyViewing->pluck('property')->filter(),
        ];
    }


    public function UserPropertyInfo()
    {
        $data = $this->getUserPropertyStats();

        return view('frontend.dashboard.properties_info', [
            'userWishlist' => $data['userWishlist'],
            'enquiry' => $data['enquiry'],
        ]);
    }

    public function UserWishlist()
    {
        $data = $this->getUserPropertyStats();
        $userName = Auth::user()->name;

        return view('frontend.dashboard.user_property_log', [
            'properties' => $data['wishlistProperties'],
            'userWishlist' => $data['userWishlist'],
            'type' => 'wishlist',
            'userName' => $userName,
        ]);
    }

    public function UserPropertyEnquiry()
    {
        $data = $this->getUserPropertyStats();
        $userName = Auth::user()->name;

        return view('frontend.dashboard.user_property_log', [
            'properties' => $data['viewingProperties'],
            'enquiry' => $data['enquiry'],
            'type' => 'enquiry',
            'userName' => $userName,
        ]);
    }
}
