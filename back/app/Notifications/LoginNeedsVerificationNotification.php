<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\Twilio;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class LoginNeedsVerificationNotification extends Notification
{
    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return [TwilioChannel::class];
    }

    public function toTwilio($notifiable)
    {
        $loginCode = rand(111111, 999999);

        $notifiable->update([
            'login_code' => $loginCode
        ]);

        return (new TwilioSmsMessage())
            ->content("Your ride share login code is ${loginCode} don't share it!");
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
