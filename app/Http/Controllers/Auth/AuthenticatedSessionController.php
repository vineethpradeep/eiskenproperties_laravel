<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        // dd($request->all());

        $id = Auth::user()->id;
        $admindata = User::find($id);
        $username = $admindata->name;

        $user = Auth::user();
        $user->status = 'active';
        $user->save();

        $request->session()->regenerate();
        $url = "";

        $notification = [
            'message' => ' User ' . $username . ' Login Successfully',
            'alert-type' => 'info',
        ];

        if ($request->user()->role == "admin") {
            $url = 'admin/dashboard';
        } else if ($request->user()->role == "agent") {
            $url = 'admin/dashboard';
        } else {
            $url = 'dashboard';
        }

        // return redirect()->intended(route('dashboard', absolute: false));
        return redirect()->intended($url)->with($notification);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $user = Auth::user();
        if ($user) {
            $user->status = 'inactive';
            $user->save();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
