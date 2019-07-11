<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('backend.login');
    }

    public function postLogin(Request $request)
    {
        $arr = [
            'user_email' => $request->email,
            'password' => $request->password,
            'status' => '1',
        ];
        if ($request->remember == 'Remember Me') {
            $remember = true;
        } else {
            $remember = false;
        }
        if (Auth::attempt($arr, $remember)) {
            return redirect()->intended('admin/home');
        }
        else {
            return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu không chính xác hoặc tài khoản chưa được kích hoạt');
        }
    }
}
