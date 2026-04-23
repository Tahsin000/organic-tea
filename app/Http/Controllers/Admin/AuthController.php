<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signIn() { return view('admin.auth.login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_admin) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard.ecommerce'));
            }
            Auth::logout();
            return back()->withErrors(['email' => 'Access denied. Admin only.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.auth.sign-in');
    }

    // Placeholder views - non-login auth disabled
    public function signUp()    { abort(404); }
    public function lockScreen()    { abort(404); }
    public function resetPass()     { abort(404); }
    public function newPass()       { abort(404); }
    public function loginPin()      { abort(404); }
    public function twoFactor()     { abort(404); }
    public function successMail()   { abort(404); }
    public function deleteAccount() { abort(404); }

    // Card style
    public function cardSignIn()        { abort(404); }
    public function cardSignUp()        { abort(404); }
    public function cardLockScreen()    { abort(404); }
    public function cardResetPass()     { abort(404); }
    public function cardNewPass()       { abort(404); }
    public function cardLoginPin()      { abort(404); }
    public function cardTwoFactor()     { abort(404); }
    public function cardSuccessMail()   { abort(404); }
    public function cardDeleteAccount() { abort(404); }

    // Split style
    public function splitSignIn()        { abort(404); }
    public function splitSignUp()        { abort(404); }
    public function splitLockScreen()    { abort(404); }
    public function splitResetPass()     { abort(404); }
    public function splitNewPass()       { abort(404); }
    public function splitLoginPin()      { abort(404); }
    public function splitTwoFactor()     { abort(404); }
    public function splitSuccessMail()   { abort(404); }
    public function splitDeleteAccount() { abort(404); }
}
