<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class OrderDelivered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public $user;
    public $runner;
    public $services;
    public $balance;

    public function __construct($order,$user)
    {
        $this->order = $order;
        $this->user = $user;
        $this->runner = DB::table('users')
            ->join('runner', 'users.id', '=', 'runner.user_id')
            ->where('runner.runner_id', '=', $order->runner_id)
            ->first();
        $this->services = DB::table('order')
            ->join('order_service', 'order.order_id', '=', 'order_service.order_id')
            ->where('order_service.order_id', '=', $order->order_id)
            ->select('order_service.*')
            ->get();

        $this->balance = 4;

        foreach ($this->services as $item){
            if($item->service_id == 2)
                $this->balance += 4;
                if($item->service_id == 3)
                    $this->balance += 4;
                    if($item->service_id == 4)
                        $this->balance += 4;

        }
        $this->balance = $order->order_fee - $this->balance;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('akmalsab14@gmail.com')
            ->view('emails.reciept');
    }
}
