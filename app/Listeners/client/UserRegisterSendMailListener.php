<?php

namespace App\Listeners\client;

use App\Events\client\auth\UserRegisterEvent;
use App\Notifications\client\auth\UserRegisterNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class UserRegisterSendMailListener
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
    public function handle(UserRegisterEvent $event): void
    {
        Notification::send($event->user, new UserRegisterNotification($event->user));
    }
}
