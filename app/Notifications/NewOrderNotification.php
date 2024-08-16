<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $orderUrl = url('/admin/orders/' . $this->orderId); // Adjust the URL based on your route structure

        return (new MailMessage)
            ->line('A new order has been placed.')
            ->line('Order ID: ' . $this->orderId)
            ->action('View Order', $orderUrl)
            ->line('Thank you for using our application!');
    }
}
