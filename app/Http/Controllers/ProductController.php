<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Show Product List
    public function showList(){
        $productList = Product::select('products.*','categories.name as c_name')->when(request("key"),function($p){
            $key = request("key");
            $p->where('products.name', 'like', '%'.$key.'%');})
            ->leftJoin('categories','products.category_id','categories.category_id')
            ->orderBy("products.name","asc")->paginate(4);
        if (count($productList) == 0 && $productList->total() > 0) {
            $lastPage = $productList->lastPage(); // Get last page with results.
            $url = route('admin#productList').'?page='.$lastPage; // Manually build URL.
            return redirect($url);
        }
        return view('admin.product.list', compact('productList'));
    }

    // Create Product Page
    public function createPage(){
        return view('admin.product.create');
    }

    // Delete Product Page
    public function delete($id){

        $oldImage = Product::where("product_id",$id)->value("image");
        Storage::delete("public/".$oldImage);

        Product::where('product_id',$id)->delete();
        return back()->with(['productDeleteSuccess' => 'Product has been deleted Successfully']);
    }

    // Edit Product Page
    public function editPage($id){
        $p_id = $id;
        return view('admin.product.edit',compact('p_id'));
    }

    // Product detail Page
    public function detail($id){
        $data = Product::select('products.*','categories.name as c_name')
        ->leftJoin('categories','products.category_id','categories.category_id')
        ->where("product_id",$id)->first();
        return view('admin.product.detail',compact('data'));
    }
}
