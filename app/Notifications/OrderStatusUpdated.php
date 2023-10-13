<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $order;
    protected $customOrder;
    protected $orderId;

    public function __construct($order, $customOrder, $orderId)
    {
        $this->order = $order;
        $this->customOrder = $customOrder;
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
            ->from('teammed.amauonline@gmail.com', 'iBake Tiers of Joy');

        if ($this->order !== null) {
            
            if ($this->order->shipping_method === 'Pickup') {
                $mailMessage->subject('Your sweet treats are waiting for you at the shop!');
                $mailMessage->line('Your order is ready, time to pick up your delicious treats!');
            }else{
                $mailMessage->subject('Get ready to indulge! Your order is ready for delivery!');
                $mailMessage->line('Your order is on its way to your doorstep!');
            }
            $mailMessage->line('Order Details:');
            $mailMessage->line('Order ID: ' . $this->order->order_id);
            $mailMessage->line('Order Date: ' . $this->order->created_at);
            $mailMessage->line('Recipient: ' . $this->order->recipient_name);

        } else {
            if ($this->customOrder->shipping_method === 'Pickup') {
                $mailMessage->subject('Your sweet treats are waiting for you at the shop!');
                $mailMessage->line('Your order is ready, time to pick up your delicious treats!');
            }else{
                $mailMessage->subject('Get ready to indulge! Your order is ready for delivery!');
                $mailMessage->line('Your order is on its way to your doorstep!');
            }
            $mailMessage->line('Order Details:');
            $mailMessage->line('Order ID: ' . $this->orderId);
            $mailMessage->line('Order Date: ' . $this->customOrder->created_at);
            $mailMessage->line('Recipient: ' . $this->customOrder->recipient_name);
        }

        $mailMessage->action('View Order', route('customerActiveOrder'))
            ->line('If you have any questions, please contact our support team.')
            ->line('Thank you for shopping with us!')
            ->line('Sincerely,')
            ->line('iBake Tiers of Joy')
            ->salutation(' ');

            //dd($mailMessage);

         
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
