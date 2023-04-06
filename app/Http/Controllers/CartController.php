<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartPage(){
        $cart = Cart::select('carts.*','products.*')
                ->leftJoin('products','products.product_id','carts.product_id')
                ->where('user_id',Auth::user()->id)
                ->get();

        $priceTotal = 0 ;
        foreach ($cart as $c) {
            $priceTotal += $c->qty * $c->price;
        }

        return view('user.cart.cart' ,compact('cart','priceTotal'));
    }

        // Add Single Cart
        public function singleCart(Request $request){
            $productID = $request->productID;
            $data = $this->cartData($productID);
            $existingCart = Cart::where('user_id',Auth::user()->id)->where('product_id',$productID)->first();
            if ($existingCart == null) {
                Cart::create($data);
            }else{
                if ( 1 + $existingCart->qty > 20) {
                    Cart::where('user_id',Auth::user()->id)->where('product_id',$productID)
                    ->update([
                        'qty' => 20,
                    ]);
                }else {
                    Cart::where('user_id',Auth::user()->id)->where('product_id',$productID)
                    ->update([
                        'qty' => 1 + $existingCart->qty,
                    ]);
                }
            }
            $count = count(Cart::where('user_id',Auth::user()->id)->get());
            return $count;
        }

    public function deleteCart($id){
        Cart::where('cart_id',$id)->delete();
        return back();
    }

    public function cartData($productID){
        return [
            'qty' => 1,
            'product_id' => $productID,
            'user_id' => Auth::user()->id,
        ];
    }
}
