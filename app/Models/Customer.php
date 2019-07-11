<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as Authenticable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class Customer extends Model implements CanResetPasswordContract, AuthenticatableContract
{
    use Authenticable, CanResetPassword, Notifiable;

    protected $table = 'customers';
    protected $guarded = ['customer'];
    public $timestamps = false;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'status'
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
