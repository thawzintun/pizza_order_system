<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // Get Product List
    public function getProduct(){
        $data = Product::orderBy('product_id','asc')->get();
        return response()->json($data, 200);
    }

    // Get Category List
    public function getCategory(){
        $data = Category::orderBy('category_id','asc')->get();
        return response()->json($data, 200);
    }

    // Get User List
    public function getUsers(){
        $data = User::where('role','user')->orderBy('id','asc')->get();
        return response()->json($data, 200);
    }

    // Create Category
    public function createCategory(Request $request){
        $data = [
            'name' => $request->name,
        ];
        $response = Category::create($data);
        return response()->json($response, 200);
    }

    // Update Category
    public function updateCategory(Request $request){
        $data = [
            'name' => $request->name,
        ];
        $response = Category::where('category_id',$request->id)->update($data);
        return response()->json('Success', 200);
    }

    // Send Message
    public function sendMessage(Request $request){
        $data = $this->getMessageData($request);
        $response = Contact::create($data);
        return response()->json($response, 200);
    }

    // Delete Category
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();

        return response()->json('Success Delete', 200);
    }

    // Category Delete
    public function categoryDelete(Request $request){
        $data = Category::where('category_id',$request->id)->first();

        if (isset($data)) {
            Category::where('category_id',$request->id)->delete();
            return response()->json('Success Delete', 200);
        }
        return response()->json('No Data', 200);
    }

    private function getMessageData($request){
        return [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];
    }
}
