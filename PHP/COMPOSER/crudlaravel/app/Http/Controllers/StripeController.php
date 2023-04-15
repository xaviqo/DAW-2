<?php

namespace App\Http\Controllers;

use App\Models\Disc;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stripe\Customer;

class StripeController extends Controller
{

    public function pay(Request $request)
    {
/*        $user = User::find($request->attributes->get('decoded_token')->sub);
        //$order = Order::find($id);

        if ($order == null || $order->user_id != $user->id){
            return new JsonResponse([
                "message" => 'This order is not available'
            ], 400);
        }

        //$order->paid

        $customer = Customer::create([
            'email' => $user->email,
            'source' => $request->input('stripeToken')
        ]);*/
    }



}
