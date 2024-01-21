<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\UserMail;
use App\Events\UserInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationUserListener
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
    public function handle(UserInformation $event): void
    {
        $users = User::all();
    foreach($users as $user) {
        Mail::to($user->email)->send(new UserMail($event->userInfo));
    }
    }
}
