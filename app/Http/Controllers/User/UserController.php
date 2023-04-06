<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Fortify\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // User Home
    public function home(){
        $pizza = Product::orderBy('name','asc')->get();
        $categories = Category::orderBy('name','asc')->get();
        $cart = $this->userCart();
        return view('user.main.home',compact('pizza','categories','cart'));
    }

    public function filter($id){
        $pizza = Product::where('category_id',$id)->orderBy('name','asc')->get();
        $categories = Category::orderBy('name','asc')->get();
        $cart = $this->userCart();
        return view('user.main.home',compact('pizza','categories','cart'));
    }

    // User Home Details
    public function pizzaDetails($id){
        $details = Product::where('product_id',$id)->first();
        $otherProducts = Product::where('product_id','!=', $id)->orderBy('name','asc')->get();
        $cart = $this->userCart();
        return view('user.main.details',compact('details','otherProducts','cart'));
    }

    // Change Password Page
    public function password(){
        $cart = $this->userCart();
        return view('user.account.changepassword',compact('cart'));
    }

    // Change Password
    public function passwordChange(Request $request){
        $request = $request->toArray();
        Validator::make($request, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ])->validate();
        Auth::user()->forceFill([
            'password' => Hash::make($request['password']),
        ])->save();

        return redirect()->route('user#password')->with(['changeSuccess' => 'Your password has been changed successfully.']);
    }

    // User Account Edit Page
    public function profile(){
        $cart = $this->userCart();
        return view('user.account.edit',compact('cart'));
    }

    // User Cart Data
    public function userCart(){
        return Cart::where('user_id',Auth::user()->id)->get();
    }

    // Users List
    public function usersList(){
        $user = User::when(request("key"),function($p){
            $key = request("key");
            $p->where('name', 'like', '%'.$key.'%');})
            ->where('role','user')
            ->orderBy('name','asc')->paginate(4);
        if (count($user) == 0 && $user->total() > 0) {
            $lastPage = $user->lastPage(); // Get last page with results.
            $url = route('admin#userList').'?page='.$lastPage; // Manually build URL.
            return redirect($url);
        }
        return view('admin.users.list', compact('user'));
    }

    // User Details
    public function usersDetail($id){
        $user = User::where('id',$id)->first();
        return view('admin.users.details',compact('user'));
    }
}
