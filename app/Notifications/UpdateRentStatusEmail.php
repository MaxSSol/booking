<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateRentStatusEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public $rentHistory;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rentHistory)
    {
        $this->rentHistory = $rentHistory;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Добрий день!')
                    ->subject('Оновлення статусу бронювання')
                    ->line('Оновлено статус бронювання '.$this->rentHistory->accommodationUnit->title)
                    ->action('Переглянути статус', url('/profile'))
                    ->line('Дякуємо, що скористались нашим сервісом');
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
            //
        ];
    }
}
