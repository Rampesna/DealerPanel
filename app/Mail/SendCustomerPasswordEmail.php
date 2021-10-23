<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCustomerPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $tax_number;
    private $password;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $tax_number
     * @param string $password
     *
     * @return void
     */
    public function __construct(
        $name,
        $tax_number,
        $password
    )
    {
        $this->name = $name;
        $this->tax_number = $tax_number;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bayi Paneli Giriş Bilgileriniz Hk.')->markdown('customer.mails.password', [
            'name' => $this->name,
            'tax_number' => $this->tax_number,
            'password' => $this->password
        ]);
    }
}
