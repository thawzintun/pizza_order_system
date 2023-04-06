<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
        // Change Password Page
        public function password(){
            return view('admin.account.changepassword');
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

            return redirect()->route('admin#password')->with(['changeSuccess' => 'Your password has been changed successfully.']);
        }

        // Account Detail Page
        public function details(){
            return view('admin.account.details');
        }

        // Account Edit Page
        public function profile(){
            return view('admin.account.edit');
        }

        // Admin List Page
        public function list(){
            $data = User::where('role','admin')->when(request("key"),function($p){
                $key = request("key");
                $p->where('name', 'like', '%'.$key.'%');})
                ->orderBy("created_at","asc")->paginate(3);
                if (count($data) == 0 && $data->total() > 0) {
                    $lastPage = $data->lastPage(); // Get last page with results.
                    $url = route('admin#productList').'?page='.$lastPage; // Manually build URL.
                    return redirect($url);
                }
            return view('admin.account.list', compact('data'));
        }

        // Admin Create Page
        public function create(){
            return view('admin.account.create');
        }

        // Admin Detail Page
        public function listDetail($id){
            $data = User::where('id',$id)->first();
            return view('admin.account.admindetails',compact('data'));
        }

        // Admin Edit Page
        public function listEdit($id){
            $a_id = $id;
            return view('admin.account.adminedit',compact('a_id'));
        }

}
