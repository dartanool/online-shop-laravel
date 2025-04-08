<?php

namespace App\Http\Services;

use App\DTO\CreateOrderDTO;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\UserProduct;

class OrderService
{
    private CartService $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();
    }

    public function create(CreateOrderDTO $data) : void
    {

        $sum = $this->cartService->getSum();

        if ($sum < 100){
            throw new \Exception('Для формирования заказа сумма заказа должна быть больше 100 рублей');
        }

        $user = auth()->user();
        $userProducts = $user->userProducts()->get();

        $order = Order::query()->create([
                'user_id' => $user->id,
                'contact_name' => $data->getName(),
                'contact_phone' => $data->getPhone(),
                'comment' => $data->getComment(),
                'address'  => $data->getAddress()]
        );

        $orderId = $order->id;

        foreach ($userProducts as $userProduct) {
            OrderProduct::query()->create([
                'order_id' => $orderId,
                'product_id' => $userProduct->product_id,
                'amount' => $userProduct->amount,
            ]);

        }
        UserProduct::query()->where('user_id', $user->id)->delete();
    }

}
