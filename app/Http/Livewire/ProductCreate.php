<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ProductCreate extends Component
{
    public function render()
    {
        $datas = Category::select('category_id','name')->get();
        return view('livewire.product-create',compact('datas'));
    }

    use WithFileUploads;

    public $photo;
    public $name;
    public $category;
    public $description;
    public $price;
    public $time;

    public function save()
    {
        $p_id = Category::select('category_id')->get();
        $this->validate([
            'photo' => 'required|max:10240',
            'name' => ['required','string','max:255',
            Rule::unique('products','name')->ignore($p_id,'product_id'),
        ],
            'category' => 'required',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'time' => 'required|numeric',
        ],
        [
            'photo.required' => "Photo must be uploaded!",
            'name.required' => "Name cannot be empty!",
            'category.required' => "Category must be selected!",
            'description.required' => "Description cannot be empty!",
            'price.required' => "Price cannot be empty!",
            'price.numeric' => "Price must be numbers!",
            'time.required' => "Waiting Time cannot be empty!",
            'time.numeric' => "Waiting Time must be numbers!",
        ]);

        $imageName = uniqid()."_".$this->photo->getClientOriginalName();
        $this->photo->storeAs("public",$imageName);

        Product::create([
            "name" => $this->name,
            "description" => $this->description,
            "image" => $imageName,
            "price" => $this->price,
            "waiting_time" => $this->time,
            "category_id" => $this->category,
        ]);

        return redirect()->route('admin#productList')->with(['productAddSuccess' => 'New Product has been created Successfully']);
    }
}
