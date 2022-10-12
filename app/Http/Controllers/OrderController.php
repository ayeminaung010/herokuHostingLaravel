<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //list
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                    ->leftjoin('users','users.id','orders.user_id')->paginate('5');
        // dd($order->toArray());
        return view('admin.order.list',compact('order'));
    }

    //ajax status order sort
    public function changeStatus(Request $request){
        $order = Order::select('orders.*','users.name as user_name')
                    ->leftjoin('users','users.id','orders.user_id')
                    ->orderBy('created_at','desc');

        if($request->orderStatus == null){
            $order = $order->paginate('5');
        }else{
            $order = $order->where('orders.status',$request->orderStatus)->paginate('5');
        }

        return view('admin.order.list',compact('order'));
    }

    //ajax change status
    public function ajaxChangeStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status' => $request->status
        ]);

    }

    //listInfo order
    public function listInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = OrderList::select('order_lists.*','products.name as pizza_name','products.image as pizzaImage','users.name as user_name')
                    ->leftjoin('products','products.id','order_lists.product_id')
                    ->leftjoin('users','users.id','order_lists.user_id')
                    ->where('order_code',$orderCode)->get();
                    // dd($orderList->toArray());
        return view('admin.order.orderList',compact('orderList','order'));
    }
}
