<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizzaList(Request $request){

        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at','desc')->get();
        }elseif ($request->status == 'asc') {
            $data = Product::orderBy('created_at','asc')->get();
        }

        return $data;
    }

    // Add Cart
    public function addCart(Request $request){
        $data = $this->cartData($request);
        $existingCart = Cart::where('user_id',$request->user_id)->where('product_id',$request->product_id)->first();
        if ($existingCart == null) {
            Cart::create($data);
        }else{
            if ($request->quantity + $existingCart->qty > 20) {
                Cart::where('user_id',$request->user_id)->where('product_id',$request->product_id)
                ->update([
                    'qty' => 20,
                ]);
            }else {
                Cart::where('user_id',$request->user_id)->where('product_id',$request->product_id)
                ->update([
                    'qty' => $request->quantity + $existingCart->qty,
                ]);
            }
        }
        return $data;
    }

    // Update Cart
    public function updateCart(Request $request){
        // logger($request->all());
        Cart::where('user_id',$request->user_id)->where('product_id',$request->product_id)
                ->update([
                    'qty' => $request->updateQty,
                ]);
        return $request;
    }

    public function orderListCreate(Request $request){

        $total_price = 3000;
        $orderCode = '';

        foreach ($request->all() as $orderList) {
            OrderList::create($orderList);
            logger($orderList['total']);
            $orderCode = $orderList['orderCode'];
            $total_price += $orderList['total'];
        };

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $total_price,
            'orderCode' => $orderCode,
        ]);

        return $request;
    }

    public function orderAjax(Request $request){
        if ($request->filterStatus == null) {
            $orders = Order::select('orders.*','users.name')
                    ->leftJoin('users','orders.user_id','users.id')
                    ->orderBy('created_at','desc')->get();
        } else {
            $orders = Order::select('orders.*','users.name')
                    ->leftJoin('users','orders.user_id','users.id')
                    ->where('orders.status',$request->filterStatus)
                    ->orderBy('created_at','desc')->get();
        }
        return $orders;
    }

    public function cartData($request){
        return [
            'qty' => $request->quantity,
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
        ];
    }

    public function increaseViewCount(Request $request){
        $product = Product::where('product_id',$request->product_id)->first();
        $view_count = $product->view_count;
        Product::where('product_id',$request->product_id)->update([
            'view_count' => $view_count + 1,
        ]);
    }
}
