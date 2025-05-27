<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\Property;

class WishlistController extends Controller
{
    public function toggle($id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Login required'], 401);
        }

        $userId = Auth::id();

        $wishlist = Wishlist::where('user_id', $userId)->where('property_id', $id)->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'property_id' => $id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
