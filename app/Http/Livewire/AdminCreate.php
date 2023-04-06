<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;

class AdminCreate extends Component
{
    use WithFileUploads;
    use PasswordValidationRules;

    public $photo;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $password;
    public $password_confirmation;

    public function render()
    {
        return view('livewire.admin-create');
    }

    public function save(){

        $this->validate([
            'photo' => 'max:10240',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'starts_with:09', 'min_digits:9' , 'unique:users'],
            'address' => ['required'],
            'password' => $this->passwordRules(),
        ],
        [
            'name.required' => "Name cannot be empty!",
            'email.required' => "Email cannot be empty!",
            'phone.required' => "Phone Number cannot be empty!",
            'phone.numeric' => "Phone Number must be numbers!",
            'phone.min_digits' => "Phone Number must be at least 9 numbes!",
            'phone.starts_with' => "Phone Number must be start with 09!",
            'password.required' => "Password cannot be empty!",
            'address.required' => "Address cannot be empty!"
        ]);

        if ($this->photo) {

            $imageName = uniqid()."_".$this->photo->getClientOriginalName();
            $this->photo->storeAs("public",$imageName);

            User::create([
                "profile_photo_path" => $imageName,
                "name" => $this->name,
                "email" => $this->email,
                "phone" => $this->phone,
                "address" => $this->address,
                "role" => 'admin',
                "password" => Hash::make($this->password),
            ]);
        } else {
            User::create([
                "name" => $this->name,
                "phone" => $this->phone,
                "email" => $this->email,
                "address" => $this->address,
                "role" => 'admin',
                "password" => Hash::make($this->password),
            ]);
        }
        return redirect()->route("admin#list")->with(['adminCreate' => 'New Admin created successfully']);
    }
}
