<?php

namespace App\Notifications;

use App\Models\Buffet;
use App\Models\BuffetSubscription;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BuffetCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Buffet $buffet,
        public Subscription $subscription,
        public BuffetSubscription $buffet_subscription,
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = config('app.commercial_url').'/'.$this->buffet->slug.'/dashboard';
        return (new MailMessage)
                    ->greeting('Boa tarde, '.$notifiable->name.'!')
                    ->line('Seu buffet foi cadastrado com sucesso!')
                    ->line('Seu buffet foi cadastrado com o plano '.$this->subscription->name.' com duração até '.$this->buffet_subscription->expires_in.'!')
                    ->line('Clique no botão abaixo para acessa-lo com o mesmo usuário e senha cadastrado anteriormente.')
                    ->action('Ver buffet', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
