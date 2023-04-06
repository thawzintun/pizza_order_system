<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AdminEdit extends Component
{

    use WithFileUploads;

    public $photo;
    public $a_id;
    public $name;
    public $phone;
    public $email;
    public $address;
    public $gender;
    public $adminData;

    public function render()
    {

        return view('livewire.admin-edit');
    }

    public function mount($id){
        $data = User::where('id',$id)->first();
        $this->adminData = $data;
        $this->name = $data->name;
        $this->phone = $data->phone;
        $this->email = $data->email;
        $this->address = $data->address;
        $this->gender = $data->gender;
        $this->a_id = $data->id;
    }

    public function save(){
        $this->validate([
            'photo' => 'max:10240',
            'name' => 'required|string|max:255',
            'phone' => ['required','min_digits:9','numeric','starts_with:09',
            Rule::unique('users','phone')->ignore($this->a_id),
            ],
            'email' => ['required','string','email','max:255',
            Rule::unique('users','email')->ignore($this->a_id),
            ],
            'address' => 'required',
        ],
        [
            'name.required' => "Name is required!",
            'email.required' => "Email is required!",
            'phone.required' => "Phone Number is required!",
            'phone.numeric' => "Phone Number must be numbers!",
            'phone.min_digits' => "Phone Number must be at least 9 numbes!",
            'phone.starts_with' => "Phone Number must be start with 09!",
            'address.required' => "Address cannbot be empty!"
        ]);

        if ($this->photo) {
            $oldImage = User::where("id",$this->a_id)->value("profile_photo_path");
            Storage::delete("public/".$oldImage);

            $imageName = uniqid()."_".$this->photo->getClientOriginalName();
            $this->photo->storeAs("public",$imageName);

            User::where("id",$this->a_id)->update([
                "profile_photo_path" => $imageName,
                "name" => $this->name,
                "phone" => $this->phone,
                "email" => $this->email,
                "address" => $this->address,
                "gender" => $this->gender,
            ]);
        } else {
            User::where("id",$this->a_id)->update([
                "name" => $this->name,
                "phone" => $this->phone,
                "email" => $this->email,
                "address" => $this->address,
                "gender" => $this->gender,
            ]);
        }


        return redirect()->route("admin#list")->with(['adminUpdate' => 'Account has been updated successfully']);
    }
}
