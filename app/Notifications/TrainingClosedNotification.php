<?php

namespace App\Notifications;

use App\Http\Controllers\TrainingController;
use App\Mail\TrainingMail;
use App\Training;
use App\Country;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrainingClosedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $training, $closedBy, $reason;

    /**
     * Create a new notification instance.
     *
     * @param Training $training
     * @param string $key
     */
    public function __construct(Training $training, int $closedBy, string $reason = null)
    {
        $this->training = $training;
        $this->closedBy = strtolower(TrainingController::$statuses[$closedBy]['text']);
        $this->reason = $reason;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return TrainingClosedMail
     */
    public function toMail($notifiable)
    {

        $textLines[] = 'We would like to inform you that your training request for '.$this->training->getInlineRatings().' in '.Country::find($this->training->country_id)->name.' has been *'.$this->closedBy.'*.';
        if(isset($this->reason)){
            $textLines[] = '**Reason for closure:** '.$this->reason;
        }

        $contactMail = Country::find($this->training->country_id)->contact;

        // Find staff who wants notification of new training request
        $bcc = User::where('setting_notify_closedreq', true)->where('group', '<=', '2')->get()->pluck('email');

        return (new TrainingMail('Training Request Closed', $this->training, $textLines, $contactMail))
            ->to($this->training->user->email)
            ->bcc($bcc);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'training_id' => $this->training->id
        ];
    }
}