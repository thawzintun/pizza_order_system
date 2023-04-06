<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductUpdate extends Component
{

    use WithFileUploads;

    public $photo; // show temp and add new
    public $image; // old image
    public $p_id; // id from passing parameters
    public $name;
    public $description;
    public $price;
    public $time;
    public $p_category_id; // old category data and add new


    public function render()
    {
        $editData = Category::get();
        return view('livewire.product-update',compact('editData'));
    }

    public function mount($id){
        $data = Product::where('product_id',$id)->first();
        $this->p_id = $data->product_id;
        $this->name = $data->name;
        $this->description = $data->description;
        $this->image = $data->image;
        $this->price = $data->price;
        $this->p_category_id = $data->category_id;
        $this->time = $data->waiting_time;

    }

    public function save(){
        $this->validate([
            "photo" => 'max:10240',
            "name" => 'required|string|unique:products,name,'.$this->p_id.',product_id',
            "description" => 'required|string',
            "price" => 'required|numeric',
            "p_category_id" => 'required',
            'time' => 'required|numeric',
        ],[
            'name.required' => "Product Name cannot be empty!",
            'p_category_id.required' => "Category must be selected!",
            'description.required' => "Description cannot be empty!",
            'price.required' => "Price cannot be empty!",
            'price.numeric' => "Price must be numbers!",
            'time.required' => "Waiting Time cannot be empty!",
            'time.numeric' => "Waiting Time must be numbers!",
        ]);

        if ($this->photo) {

            $oldImage = Product::where("product_id",$this->p_id)->value("image");
            Storage::delete("public/".$oldImage);

            $imageName = uniqid()."_".$this->photo->getClientOriginalName();
            $this->photo->storeAs("public",$imageName);

            Product::where("product_id",$this->p_id)->update([
                "name" => $this->name,
                "description" => $this->description,
                "image" => $imageName,
                "price" => $this->price,
                "waiting_time" => $this->time,
                "category_id" => $this->p_category_id,
            ]);
        } else {

            Product::where("product_id",$this->p_id)->update([
                "name" => $this->name,
                "description" => $this->description,
                "price" => $this->price,
                "waiting_time" => $this->time,
                "category_id" => $this->p_category_id,
            ]);
        }

        return redirect()->route('admin#productList')->with(['productUpdateSuccess' => 'Updated Successfully']);

    }
}
