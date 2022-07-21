<?php

namespace App\Events;

use App\Models\Order;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifyTheCompanySalesTheRequstUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $order;
    public function __construct(Order $order)
    {   
        $userName = User::where('id', $order->user_id)->value('name');
        $message = "";
        $userLogged = auth()->user()->name;
        switch($order->status){
            case 1:
                $message = "Você tem um novo pedido de {$userName}";
            break;
            case 2:
                $message = "Usuário {$userLogged} marcaou o pedido de {$userName}, como recebido";
            break;
            case 3:
                $message = "O Pedido de {$userName}, está sendo preparado";
            break;
            case 4:
                $message = " Pedido de {$userName}, saiu para entrega";
            break;
            case 5:
                $message = "O Pedido de {$userName}, foi entregue.";
            break;
            case 0:
                $message = "O Pedido de {$userName}, foi cancelado.";
            break;
        }
    
        $this->order = [
            'message' => $message
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['orders'];
    }
    public function broadcastAs()
    {
      return 'sendOrderCompany';
    }
}
