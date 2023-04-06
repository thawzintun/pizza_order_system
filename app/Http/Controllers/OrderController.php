<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orderPage(){
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(8);
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.order.history',compact('orders','cart'));
    }

    public function orderDetails($code){
        $orders = OrderList::select('order_lists.*','products.product_id','products.name','products.price','products.image')
                ->leftJoin('products','products.product_id','order_lists.product_id')
                ->where('user_id',Auth::user()->id)
                ->where('orderCode',$code)
                ->orderBy('name','asc')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $subTotal = 0;
        foreach ($orders as $item) {
            $subTotal += $item->total;
        }
        return view('user.order.details',compact('orders','cart','subTotal'));
    }

    // Admin Order List
    public function adminOrderPage(){
        $orders = Order::select('orders.*','users.name')
            ->when(request("key"),function($p){
                $key = request("key");
                $p->where('orders.orderCode',$key);})
            ->leftJoin('users','orders.user_id','users.id')
            ->orderBy('created_at','desc')->get();
        if (count($orders) == 0 && $orders->total() > 0) {
            $lastPage = $orders->lastPage(); // Get last page with results.
            $url = route('admin#orderList').'?page='.$lastPage; // Manually build URL.
            return redirect($url);
        }
        return view('admin.order.list', compact('orders'));
    }

    // Admin Order Detail
    public function adminOrderDetails($id){
        $orders = OrderList::select('order_lists.*','products.product_id','products.name','products.price','products.image')
        ->leftJoin('products','products.product_id','order_lists.product_id')
        ->where('order_lists.orderCode',$id)
        ->orderBy('name','asc')->get();
        $subTotal = 0;
        foreach ($orders as $item) {
            $subTotal += $item->total;
        };

       $orderTotal = Order::select('orders.*','users.name')
            ->leftJoin('users','orders.user_id','users.id')
            ->where('orderCode',$id)->first();

        return view('admin.order.details',compact('orders','subTotal','orderTotal'));
    }

    // Admin Order Delivered
    public function orderDelivered($id){
        $orders = Order::where('order_id',$id)->update([
            'status' => 'Delivered',
        ]);

        return redirect()->route('admin#orderList');
    }

    // Admin Order Cancelled
    public function orderCancelled($id){
        $orders = Order::where('order_id',$id)->update([
            'status' => 'Cancelled',
        ]);

        return redirect()->route('admin#orderList');
    }
}
