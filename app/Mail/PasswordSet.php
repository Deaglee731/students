<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordSet extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Student $student , $password)
    {
        $this->student = $student;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->student->email, $this->student->fullName)
                ->view('mail.setPassword', [
                    'student' => $this->student,
                    'password' => $this->password,
                ]);
    }
}
