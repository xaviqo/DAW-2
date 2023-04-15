<?php

namespace App\Http\Controllers;

use App\Models\Disc;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{

    public function create(Request $request){

        $order_total = 0;
        $lines = [];

        foreach ($request->all() as $line){
            $disc = Disc::find($line['id']);
            $sub_total = floatval(round($disc->price*$line['units'], 2));
            $order_total+=$sub_total;
            $lines[] = [
                'quantity' => $line['units'],
                'disc_id' => $disc->id,
                'disc_price' => $disc->price,
                'subtotal' => $sub_total,
            ];
        }

        $order_total = floatval(round($order_total, 2));

        if ($order_total <= 0){
            return new JsonResponse([
                "message" => 'Invalid order'
            ], 400);
        }

        $order = Order::create([
            'user_id' => $request->attributes->get('decoded_token')->sub,
            'total' => $order_total,
            'paid' => false
        ]);

        foreach ($lines as $line){
            $order_line = new OrderLine([
                'order_id' => $order->id,
                'disc_id' => $line['disc_id'],
                'quantity' => $line['quantity'],
                'disc_price' => $line['disc_price'],
                'subtotal' => $line['subtotal']
            ]);

            $order->orderLines()->save($order_line);
        }
        return new JsonResponse([
            "orderId" => $order->id,
            "message" => 'Order created successfully. Time to pay!'
        ], 201);
    }

    public function checkOrder($id, Request $request){
        $user = User::find($request->attributes->get('decoded_token')->sub);
        $order = Order::find($id);

        if ($order == null || $order->user_id != $user->id || $order->paid){
            return new JsonResponse([
                "message" => 'This order is not available'
            ], 400);
        }

        return new JsonResponse([
            "order" => $order,
            "lines" => DB::table('order_lines')
                ->join('discs', 'order_lines.disc_id', '=', 'discs.id')
                ->select('order_lines.*', 'discs.name')
                ->where('order_lines.order_id', '=', $id)
                ->get()
        ], 200);

    }


}
