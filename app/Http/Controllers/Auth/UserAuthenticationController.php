<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Auth\EmailVerificationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Keygen\Keygen;


class UserAuthenticationController extends Controller
{
    public function login()
    {
        return view("auth.user.login");
    }

    public function register()
    {
        return view("auth.user.register");
    }

    public function signup(Request $request)
    {
        try {

            // dd($request);
            //* validate request
            $request->validate([
                "first_name" => "required|string|max:255",
                "last_name" => "required|string|max:255",
                "email" => "required|email",
                "phone_number" => "required|string|max:13",
                "password" => "string|required|min:8|max:255|confirmed",
            ]);

            //* create an entry in the User table
            $verification_code = Keygen::numeric(5)->generate();
            $user = User::query()->create([
                "uuid" => Str::uuid(),
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "email" => $request->email,
                "phone_number" => $request->phone_number,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "remember_token" => Str::random(10),
                "email_verification_code" => $verification_code,
            ]);

            //* verification data
            $verification_data = [
                "name" => request()->first_name,
                "code" => $verification_code,
            ];
            //* dispatch the email
            $user->notify(new EmailVerificationNotification($verification_data));

            //* authenticate the user
            $credentials = $request->only(['email', 'password']);

            if (Auth::guard('user')->attempt($credentials)) {

                request()->session()->regenerate();

                return redirect()->intended('/home');
            }

        } catch (\Exception $e) {
            return redirect()->route('guest.register')->with('error', $e->getMessage());
        }
    }

    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8|max:255',
            ]);

            if (Auth::guard('user')->attempt($credentials)) {

                request()->session()->regenerate();

                return redirect()->intended('/home');
            }
            return redirect()->back()->withErrors('error', 'Wrong Credentials');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }

    public function email_verification()
    {
        return view('auth.user.verify_email');
    }

    public function verify_email($uuid)
    {

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $verification = User::where("uuid", $uuid)->update(['email_verified_at' => $now()]);

        if ($verification) {
            return redirect()->intended('/home');
        }
        return redirect()->route('email.verification')->with('error', 'Verification failed');
    }

    public function resend_verification_code()
    {
        $user = Auth::guard('user')->user();
        if (!$user) {
            return redirect()->route('email.verification')->with('error', 'Please you must be logged in to access this feature');
        }

        $verification_code = Keygen::numeric(5)->generate();

        //* verification_data
        $verification_data = [
            'name' => $user->first_name,
            "code" => $verification_code,
        ];

        //* dispatch the email
        $user->notify(new EmailVerificationNotification($verification_data));

        //* update the db after the email dispatch is effected
        User::query()->where('uuid', $user->uuid)->update(['email_verification_code' => $verification_code]);

        return redirect()->route('email.verification')->with('success', 'Verification code has been resent');
    }

    public function logout()
    {

        Auth::guard('user')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('login')->withSuccess("You have successfully logged out");
    }
}
