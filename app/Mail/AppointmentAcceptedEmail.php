<?php

namespace App\Mail;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentAcceptedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $patient;

    public function __construct(Patient $patient)
    {  
        $this->$patient = $patient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->view('patient.email.accept')->with([
            'name' => $this->patient->name
        ]);
    }
}
