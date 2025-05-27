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

        $id = Auth::user()->id;
        $admindata = User::find($id);
        $username = $admindata->name;

        $request->session()->regenerate();
        $url = "";

        $notification = [
            'message' => ' User ' . $username . ' Logout Successfully',
            'alert-type' => 'info',
        ];

        if ($request->user()->role == "admin") {
            $url = 'admin/dashboard';
        } else if ($request->user()->role == "agent") {
            $url = 'agent/dashboard';
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

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
