<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the signin form.
     */
    public function showSignin()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.signin');
    }

    /**
     * Show the signup form.
     */
    public function showSignup()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.signup');
    }

    /**
     * Handle signin request.
     */
    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/signin')->with('error', 'Please fill in all fields');
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return redirect('/signin')->with('error', 'Invalid email or password');
    }

    /**
     * Handle signup request.
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string',
            'division' => 'required|string',
            'district' => 'required|string',
            'upazila' => 'required|string',
            'zipcode' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect('/signup')->with('error', $validator->errors()->first());
        }

        // Check if this is the first user (should be admin)
        $userCount = User::count();
        $role = $userCount === 0 ? 'admin' : 'user';

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'division' => $request->division,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'zipcode' => $request->zipcode,
            'role' => $role,
        ]);

        return redirect('/signin')->with('success', 'Account created successfully. Please sign in.');
    }

    /**
     * Show user profile.
     */
    public function profile()
    {
        if (!Auth::check()) {
            return redirect('/signin');
        }

        return view('auth.profile');
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
