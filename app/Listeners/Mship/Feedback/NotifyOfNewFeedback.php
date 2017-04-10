<?php

namespace App\Listeners\Mship\Feedback;

use App\Models\Mship\Account;
use App\Jobs\Messages\SendNotificationEmail;
use App\Events\Mship\Feedback\NewFeedbackEvent;

class NotifyOfNewFeedback
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
     * @param  NewFeedbackEvent  $event
     * @return void
     */
    public function handle(NewFeedbackEvent $event)
    {
        $feedback    = $event->feedback;
        $displayFrom = 'VATSIM UK - Community Department';
        $subject     = 'New member feedback received';
        $body        = \View::make('emails.mship.feedback.new_feedback')
                   ->with('feedback', $feedback)
                   ->render();

        $sender = Account::find(VATUK_ACCOUNT_SYSTEM);

        $recipientName = strtoupper($feedback->formSlug()).' Training Team';

        if ($feedback->isATC()) {
            $recipient = 'atc-team@vatsim.uk';
        } elseif ($feedback->isPilot()) {
            $recipient = 'pilot-team@vatsim.uk';
        } else {
            // Not an ATC or Pilot form!
        return;
        }

        $createNewMessage = new SendNotificationEmail($subject, $body, Account::find(VATUK_ACCOUNT_SYSTEM), $sender, [
        'sender_display_as' => $displayFrom,
        'sender_email'      => 'community@vatsim-uk.co.uk',
        'recipient_email'   => $recipient,
        'recipient_name'    => $recipientName,
      ]);
        dispatch($createNewMessage->onQueue('emails'));
    }
}
