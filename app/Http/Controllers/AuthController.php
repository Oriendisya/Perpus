<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            if (Auth::user()->role == 'admin') {
                return redirect()
                    ->route('admin.dashboard.index')
                    ->with(['success' => 'Login Sukses']);
            } else {
                return redirect()
                    ->route('front.index')
                    ->with(['success' => 'Login Sukses']);
            }
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
        $request->validateWithBag('message', [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|numeric',
            'password' => 'required',
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        $request->request->add([
            'role' => 'peminjam'
        ]);

        User::create($request->all());

        Auth::attempt($credential);

        return redirect()->route('front.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.index');
    }
}
