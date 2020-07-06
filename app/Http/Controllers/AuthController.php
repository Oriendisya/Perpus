<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credential)) {
            return redirect()
                    ->route('admin.dashboard.index')
                    ->with(['success' => 'Login Sukses']);
        }

        return redirect()
                ->back()
                ->with(['error' => 'Login gagal']);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.index');
    }
}