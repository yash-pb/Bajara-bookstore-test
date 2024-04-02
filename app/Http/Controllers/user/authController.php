<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\forgotPasswordMail;
use Illuminate\Support\Str;


class authController extends Controller
{
    public function register(Request $request)
    {
        if($request->isMethod('get')) {
            return view('store.register');
        }
        
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $register = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'user_type' => 2,
            'status' => 1,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with([
            'msg' => 'User registered',
            'color' => 'green'
        ]);
    }

    public function login (Request $request) {
        if($request->isMethod('get')) {
            return view('store.login');
        }
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required|min:6',
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('store.index');
        }
    
        return redirect()->route('user.login')->with([
            'msg' => 'Credential not matched',
            'color' => 'red'
        ]);
    }

    public function forgotPassword(Request $request)
    {
        if($request->isMethod('get')) {
            return view('store.forgotPassword');
        }
        
        if(User::where(['email' => $request->email])->exists()) {
            $token = Str::random(32);
            User::where(['email' => $request->email])->update([
                'remember_token' => $token
            ]);
            Mail::to($request->email)->send(new forgotPasswordMail($token));

            return redirect()->route('user.login')->with([
                'msg' => 'Email send successfully',
                'color' => 'green'
            ]);
        }
    
        return back()->with([
            'msg' => 'Email not found',
            'color' => 'red'
        ]);
    }

    public function changePassword(Request $request, $token)
    {
        if($request->isMethod('get')) {
            if(User::where(['remember_token' => $token])->exists()) {
                return view('store.changePassword');
            }
        }
        
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $update = User::where(['remember_token' => $token])->update([
            'remember_token' => null,
            'password' => Hash::make($request->password)
        ]);
    
        return redirect()->route('user.login')->with([
            'msg' => 'Password Updated',
            'color' => 'freen'
        ]);
    }

    public function editProfile(Request $request)
    {
        if($request->isMethod('get')) {
            return view('store.editPprofile');
        }
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required|email',
            'mobile_no' => 'required|numeric',
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $register = User::where('id', Auth::user()->id)->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
        ]);

        return back()->with([
            'msg' => 'Profile Updated',
            'color' => 'green'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('store.index');
    }
}
