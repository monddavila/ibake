<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderRejected extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $cusname;
    protected $cusOrder;
    protected $orderId;

    public function __construct($cusname, $cusOrder, $orderId)
    {
        $this->cusname = $cusname;
        $this->cusOrder = $cusOrder;
        $this->orderId = $orderId;

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
        $mailMessage = (new MailMessage)
            ->from('teammed.amauonline@gmail.com', 'iBake Tiers of Joy')
            ->subject('Hi ' . $this->cusname .', this regards to your custom cake order request')
            ->line('Dear ' . $this->cusname .',')
            ->line('Thank you for your interest in ordering a custom cake from iBake')
            ->line('We are sorry to inform you that your request has been declined.')
            ->line('Order Details:')
            ->line('Order ID: ' . $this->orderId)
            ->line('Date Requested: ' . $this->cusOrder->created_at);


        $mailMessage->action('View Request', route('customer'))
            ->line('If you have any questions, please contact our support team.')
            ->line('Thank you for trusting us!')
            ->line('Sincerely,')
            ->line('iBake Tiers of Joy')
            ->salutation(' ');

        
        return $mailMessage;
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
