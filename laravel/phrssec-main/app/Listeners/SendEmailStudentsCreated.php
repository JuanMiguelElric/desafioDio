<?php

namespace App\Listeners;

use App\Events\RegisteredStudent as RegisteredStudentEvent;
use App\Mail\EstudanteCriado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailStudentsCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegisteredStudentEvent $event): void
    {
        $email = new EstudanteCriado(
            $event->email,
            $event->password,
            route('estudante.login'),
            $event->name
        );
        $when = now()->addSeconds(10);
        Mail::to($event->email)->later($when, $email);
    }
}
