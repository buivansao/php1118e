<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password;
use Auth;
use Illuminate\Http\Request;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Bạn nhận được email này vì bạn đã gửi yêu cầu lấy lại. Lưu ý, link này chỉ có giá trị trong 60 phút')
                    ->action('Lấy lại mật khẩu', route('customer.password.reset', $this->token))
                    ->line('Nếu bạn không yêu cầu, vui lòng bỏ qua email này');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

}
