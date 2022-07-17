<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public $accommodationUnits;
    public $totalPrice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($accommodationUnits, $totalPrice)
    {
        $this->accommodationUnits = $accommodationUnits;
        $this->totalPrice = $totalPrice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Запит на бронювання успішно створено')
            ->greeting('Добрий день!')
            ->line('Ваш запит на бронювання надіслано власнику, очікуйте підтвердження бронювання.')
            ->line('Статус бронювання можете перевірити в особистому кабінеті')
            ->line('Дякуємо що скористались нашим сервісом для бронювання житла!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
