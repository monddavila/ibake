<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderApproved extends Notification implements ShouldQueue
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
            ->subject('Hi ' . $this->cusname .'! your customize cake  request is now approved and ready to pay!')
            ->line('Pay for your custom cake today and enjoy it soon!')
            ->line('Order Details:')
            ->line('Order ID: ' . $this->orderId)
            ->line('Custom Cake Price: Php. ' . $this->cusOrder->cakePrice)
            ->line('Date Requested: ' . $this->cusOrder->created_at)
            ->line('Date Request Approved: ' . $this->cusOrder->updated_at);


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
