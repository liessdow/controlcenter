<?php

namespace App\Notifications;

use App\Mail\EndorsementMail;
use App\Models\Endorsement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EndorsementExpiredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $endorsement;

    /**
     * Create a new notification instance.
     *
     * @param Endorsement $endorsement
     */
    public function __construct(Endorsement $endorsement)
    {
        $this->endorsement = $endorsement;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return EndorsementMail
     */
    public function toMail($notifiable)
    {

        $textLines = [
            'Your **'.ucwords(strtolower((string)$this->endorsement->type)).' Endorsement has expired** for following positions: *'.$this->endorsement->positions->pluck('callsign')->implode(', ').'*',
            '**Expired:** '.$this->endorsement->valid_to->toEuropeanDateTime(),
            'If you need a renewal, please contact the staff member who initially issued you the endorsement.',
        ];

        return (new EndorsementMail('Training Endorsement Expired', $this->endorsement, $textLines))
            ->to($this->endorsement->user->email, $this->endorsement->user->name);
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
            'endorsement_id' => $this->endorsement->id
        ];
    }
}
