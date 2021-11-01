<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendDealerUserPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $email;
    private $password;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @return void
     */
    public function __construct(
        $name,
        $email,
        $password
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bayi Paneli Giriş Bilgileriniz Hk.')->markdown('dealerUser.mails.password', [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);
    }
}
