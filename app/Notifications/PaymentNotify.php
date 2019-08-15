<?php

namespace App\Notifications;

use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentNotify extends Notification implements ShouldQueue
{
    use Queueable;

    public $payment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
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
                    ->subject(__('Pay bill'))
                    ->line('لقد تم دفع '. $this->payment->pay. ' جنية بواسطة ' . $this->payment->order->client->name)
                    ->line('اسم الطلب: '. $this->payment->order->name_file)
                    ->line('الخامة: '. $this->payment->order->material->name)
                    ->line('المصمم: '. $this->payment->order->user->name)
                    ->line('اجمالي التكلفة: '. $this->payment->order->total)
                    ->line(__('Thank you!'));
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
