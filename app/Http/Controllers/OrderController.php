<?php

namespace App\Http\Controllers;

use App\DTO\CreateOrderDTO;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\Order;
use App\Models\User;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{

    public function getOrderForm()
    {
        $user = auth()->user();

        $userProducts = UserProduct::query()->where('user_id', $user->id)->get();

        $total = 0;
        foreach ($userProducts as $userProduct) {
            $total += $userProduct->product->price*$userProduct->amount;
        }

        return view('orderForm', ['userProducts' => $userProducts, 'total' => $total]);
    }

    public function create(CreateOrderRequest $request)
    {
        try {
            $dto = $request->getDto();
            $this->orderService->create($dto);

            return response()->redirectTo('catalog');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ошибка при создании заказа: ' . $e->getMessage());
        }
    }

    public function getAll()
    {
        $userOrders = Order::query()->where('user_id', Auth::id())->get();

        return view('userOrdersPage', compact('userOrders'));
    }

}
