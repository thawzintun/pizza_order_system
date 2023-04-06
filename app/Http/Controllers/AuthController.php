<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Redirect after Login
    public function dashboard(){
        if ( Auth::user()->role == 'admin') {
            return redirect()->route('admin#categoryList');
        } else {
            return redirect()->route('user#home');
        }
    }
}
