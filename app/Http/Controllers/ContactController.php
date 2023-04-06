<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function messageList(){
        $messages = Contact::orderBy('created_at','desc')->paginate(5);
        return view('admin.messages.list',compact('messages'));
    }

    public function contactUsPage(){
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.contact.create',compact('cart'));
    }

    public function sendMessage(Request $request){

        $this->ContactValidation($request);

        $data = $this->ContactData($request);

        Contact::create($data);

        return back()->with(['messageSuccess' => "Thanks for contacting us. We'll reply you in shortly."]);
    }

    public function messageDetail($id){
        $data = Contact::where('contact_id',$id)->first();
        return view('admin.messages.detail',compact('data'));
    }

    public function ContactValidation($request){
        $validationRules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|starts_with:09|min_digits:9',
            'subject' => 'required',
            'description' => 'required',
        ];

        $validationMsg = [
            'name.required' => 'Name cannot be blank.',
            'email.required' => 'Email Address cannot be blank.',
            'email.email' => 'This field should be an email format.',
            'phone.required' => 'Phone Number cannot be blank.',
            'phone.numeric' => "Phone Number must be numbers.",
            'phone.min_digits' => "Phone Number must be at least 9 numbers.",
            'phone.starts_with' => "Phone Number must be start with 09..",
            'subject.required' => 'This field is required.',
            'description.required' => 'Please describe in details.',
        ];

        Validator::make($request->all(),$validationRules,$validationMsg)->validate();
    }

    public function ContactData($request){
        return[
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->description,
        ];
    }
}
