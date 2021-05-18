<?php

namespace App\Listeners;

use App\Events\SendVendorWelcomeMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVendorWelcomeMailEventListener
{
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
     * @param  SendVendorWelcomeMailEvent  $event
     * @return void
     */
    public function handle(SendVendorWelcomeMailEvent $event)
    {
        // Access the user using $event->user...
        $user = array(
            'name' => $event->user->name,
            'email' => $event->user->email,
        );

        // send email with the template
        Mail::send(
            'components.email.vendor-created',
            $user,
            function ($message) use ($user) {
                $message->to($user['email'], $user['name'])
                    ->subject('Welcome to Global Garner')
                    ->from('info@globalgarner.com', 'Ashish Patel');
            }
        );
    }
}
