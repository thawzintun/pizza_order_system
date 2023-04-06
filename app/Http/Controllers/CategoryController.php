<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Show Category List
    public function showList(){
        $categoryList = Category::when(request("key"),function($p){
            $key = request("key");
            $p->where('name', 'like', '%'.$key.'%');
            })->orderBy("name","asc")->paginate(5);
        if (count($categoryList) == 0 && $categoryList->total() > 0) {
            $lastPage = $categoryList->lastPage(); // Get last page with results.
            $url = route('admin#categoryList').'?page='.$lastPage; // Manually build URL.
            return redirect($url);
        }
        return view('admin.category.list', compact('categoryList'));
    }

    // Create Category Page
    public function createPage(){
        return view('admin.category.create');
    }

    // Create Category
    public function create(Request $request){
        $this->categoryValidation($request);
        $data = $this->newCategoryData($request);
        Category::create($data);
        return redirect()->route('admin#categoryList')->with(['successMessage' => 'Category has been created Successfully']);
    }

    // Delete Category
    public function delete($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteMessage' => 'Category has been deleted Successfully']);
    }

    // Edit Category Page
    public function editPage($id){
        $editData = Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('editData'));
    }

    // Edit Category
    public function edit(Request $request, $id){

        $this->categoryValidation($request);
        $data = $this->newCategoryData($request);
        Category::where("category_id",$id)->update($data);
        return redirect()->route('admin#categoryList')->with(['updateMessage' => 'Category has been updated Successfully']);
    }


    // Category Data
    private function newCategoryData($request){
        return [
            "name" => $request->categoryName,
        ];
    }

    // Validation Rules
    private function categoryValidation($request){
        $validationRules = [
            'categoryName' => [
                'required',
                Rule::unique('categories','name')->ignore($request->categoryID, 'category_id'),
            ],
        ];
        $validationMessage = [
            "categoryName.required" => "Category Name should not be blank.",
            "categoryName.unique" => "Category Name has been already taken.",
        ];

        Validator::make($request->all(),$validationRules,$validationMessage)->validate();
    }
}
