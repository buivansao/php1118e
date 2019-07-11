<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Password;
use Illuminate\Support\Facades\Auth;
use Session;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'customer/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customers');
    }

    protected function guard()
    {
        return Auth::guard('customers');
    }

    public function broker()
    {
        return Password::broker('customers');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('website.customer.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
        Session::flash('success', 'Đặt lại mật khẩu thành công');
        $this->guard('customers')->login($user);
    }
}
