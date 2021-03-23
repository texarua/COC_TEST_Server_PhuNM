<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Events\RegisCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\SendRegistMail;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendMailRegistration implements ShouldQueue
{
    use DispatchesJobs;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(RegisCourse $event)
    {
        \Log::info($event->data);
        dispatch(new SendRegistMail($event->data));
    }
}
