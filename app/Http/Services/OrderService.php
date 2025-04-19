<?php

namespace App\Http\Services;

use App\DTO\CreateOrderDTO;
use App\Jobs\CreateTasktYougile;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\UserProduct;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();
        try {

            $order = Order::query()->create([
                    'user_id' => $user->id,
                    'contact_name' => $data->getName(),
                    'contact_phone' => $data->getPhone(),
                    'comment' => $data->getComment(),
                    'address'  => $data->getAddress()]
            );

            $orderId = $order->id;

            $description = [];
            $count = 0;
            foreach ($userProducts as $userProduct) {
                OrderProduct::query()->create([
                    'order_id' => $orderId,
                    'product_id' => $userProduct->product_id,
                    'amount' => $userProduct->amount,
                ]);
                $count += 1;

                $description["$count"] = "productId: ".$userProduct->product_id  . " amount: ".$userProduct->amount;
            }

            CreateTasktYougile::dispatch($orderId, $description);

//            UserProduct::query()->where('user_id', $user->id)->delete();

            DB::commit();
        } catch (\Throwable $exception) {

            DB::rollBack();
            throw $exception;
        }
    }

}
