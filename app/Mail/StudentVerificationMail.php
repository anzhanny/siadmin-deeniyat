<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Verifikasi Akun Anda')
                    ->view('student_verification')
                    ->with([
                        'name' => $this->user->name,
                        'email' => $this->user->email,
                        'plain_password' => $this->user->plain_password,
                    ]);
    }
}
