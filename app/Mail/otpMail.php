<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class otpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $otp;
    public $userId;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param int $otp
     * @param int $userId
     */
    public function __construct($email, $otp, $userId)
    {
        $this->email = $email;
        $this->otp = $otp;
        $this->userId = $userId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your OTP Code'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.otp', // Blade view for the email
            with: [
                'email' => $this->email,
                'otp' => $this->otp,
                'userId' => $this->userId,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
