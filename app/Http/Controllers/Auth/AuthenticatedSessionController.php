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
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user = User::where(function ($query) use ($request) {
            $query->where('email', $request->login)
                ->orWhere('username', $request->login)
                ->orWhere('phone', $request->login);
        })->first();

        if (!$user || !Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            return back()->withErrors(['login' => 'Invalid username, email, or phone number'])->withInput();
        }

        // User authentication successful
        $request->session()->regenerate();

        $user = Auth::user();
        $user->update(['status' => 'active']);

        $notification = [
            'message' => 'User ' . $user->name . ' Login Successfully',
            'alert-type' => 'info',
        ];

        return redirect()->intended($user->role === 'admin' ? 'admin/dashboard' : 'dashboard')->with($notification);
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
