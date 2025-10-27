<?php

namespace App\Services;

use App\Models\MailerSetting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Exception;

class DynamicMailerService
{
    protected $settings;

    public function __construct()
    {
        $this->settings = MailerSetting::latest()->first();
        if (!$this->settings) {
            throw new Exception('Mailer settings not configured.');
        }

        // Dynamically override mail config
        Config::set('mail.mailers.smtp.transport', $this->settings->mail_mailer ?? 'smtp');
        Config::set('mail.mailers.smtp.host', $this->settings->mail_host);
        Config::set('mail.mailers.smtp.port', $this->settings->mail_port);
        Config::set('mail.mailers.smtp.username', $this->settings->mail_username);
        Config::set('mail.mailers.smtp.password', $this->settings->mail_password);
        Config::set('mail.mailers.smtp.encryption', $this->settings->mail_encryption);

        Config::set('mail.from.address', $this->settings->mail_from_address);
        Config::set('mail.from.name', $this->settings->mail_from_name);
    }

    public function sendMail($to, $subject, $body, $view = null, $data = [])
    {
        try {
            Mail::send([], [], function ($message) use ($to, $subject, $body) {
                $message->to($to)
                    ->subject($subject)
                    ->html($body);
            });

            return true;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }
}
