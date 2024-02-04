<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\Admin\NewUserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Keygen\Keygen;

class UserController extends Controller
{
    public function users()
    {

        //* retrieve all admins in the system
        $admins = Admin::where('id', '!=', Auth::guard('admin')->user()->id)->orderBy('created_at','DESC')->get();

        return view('admin.users', ['users' => $admins]);
    }

    public function new_user()
    {
        return view('admin.add_user');
    }

    public function store_user(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'role' => 'required|string',
        ]);

        //* generate a password for the user
        $password = Keygen::numeric(8)->prefix('ADM-')->generate();
        $uuid = Str::uuid();
        $email_verified_at = Carbon::now()->format('Y-m-d H:i:s');

        $new_admin = Admin::query()->create([
            'uuid'          => $uuid,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone_number'  => $request->phone_number,
            'role'          => $request->role,
            'email_verified_at' => $email_verified_at,
            'password'      => Hash::make($password),
            'status'        => 'active',
        ]);

        if ($new_admin) {
            //* dispatch an email with the users credentials
            $mail_data = [
                "name"              => $new_admin->first_name,
                "email"             => $new_admin->email,
                "password"          => $password,
                "portal_endpoint"   => config('services.urls.app_url'),
            ];

            // $new_admin->notify(new NewUserNotification($mail_data));

            return redirect()->back()->with('success', 'New User has been added successfully');
        }
        return redirect()->back()->with('error','Process encountered a problem. Please try again!');

    }

    public function edit_user($uuid){
        $user =  Admin::where('uuid',$uuid)->first();
        return view('admin.edit_user',['admin'=>$user]);
    }

    public function update_user(Request $request, $uuid){
        $user =  Admin::where('uuid',$uuid)->first();
        if(!$user){
            return redirect()->back()->with('error', 'User not found');
        }

        $request_data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'role' => 'required|string',
            'status'=>'required|string'
        ]);

        $user_update = $user->update($request_data);
        if($user_update){
            return redirect()->back()->with('success','Successfully updated the user details');
        }
        return redirect()->back('error','User update encountered a problem. Please try again!');
    }

    public function remove_user($uuid){
        $user = Admin::query()->where('uuid',$uuid)->first();
        if(!$user){
            return redirect()->back()->with('error', 'User not found');
        }
        $user->delete();

        return redirect()->back()->with('success','Successfully removed the user details from the system');
    }
}
