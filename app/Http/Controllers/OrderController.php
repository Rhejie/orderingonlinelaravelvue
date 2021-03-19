<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function index()
    {
        $data = Order::orderBy('created_at', 'desc')->get();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'order' => 'required|min:4',
            'price' => 'required|min:1'
        ]);

        $order = $request->order;
        $someArray = json_decode($order, true);
        // return response()->json($order, 200);

        if ($request->coupon == '' | $request->coupon == 'GO2018') {
            $totalPrice = $request->price;
        } else {
            return response()->json([
                'message' => 'Invalid coupon!',
                'status_code' => 500
            ], 500);
        }

        Order::create([
            'order' => $order,
            'tax' => $request->tax,
            'coupon' => $request->coupon,
            'price' => $totalPrice
        ]);

        return response()->json([
            'message' => 'successfully created!'
        ], 200);
    }
}
