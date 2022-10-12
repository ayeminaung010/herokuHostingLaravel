<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name' ,'products.price as pizza_price','products.image as pizzaImage')
                    ->leftjoin('products','products.id','carts.product_id')
                    ->where('user_id',Auth::user()->id)->get();
        // dd($cartList->toArray());
        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->qty;
        }


        return view('user.cart.cartList',compact('cartList','totalPrice'));
    }
}
