<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadPhotoWithPreview extends Component
{
    public function render()
    {
        return view('livewire.upload-photo-with-preview');
    }

    use WithFileUploads;

    public $photo;
    public $name;
    public $phone;
    public $email;
    public $address;
    public $gender;

    public function mount()
    {
        $record = User::find(Auth::user()->id);
        $this->name = $record->name;
        $this->phone = $record->phone;
        $this->email = $record->email;
        $this->address = $record->address;
        $this->gender = $record->gender;
    }

    public function save()
    {
        $this->validate([
            'photo' => 'max:10240',
            'name' => 'required|string|max:255',
            'phone' => ['required','min_digits:9','numeric','starts_with:09',
            Rule::unique('users','phone')->ignore(Auth::user()->id),
            ],
            'email' => ['required','string','email','max:255',
            Rule::unique('users','email')->ignore(Auth::user()->id),
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
            $oldImage = User::where("id",Auth::user()->id)->value("profile_photo_path");
            Storage::delete("public/".$oldImage);

            $imageName = uniqid()."_".$this->photo->getClientOriginalName();
            $this->photo->storeAs("public",$imageName);

            User::where("id",Auth::user()->id)->update([
                "profile_photo_path" => $imageName,
                "name" => $this->name,
                "phone" => $this->phone,
                "email" => $this->email,
                "address" => $this->address,
                "gender" => $this->gender,
            ]);
        } else {
            User::where("id",Auth::user()->id)->update([
                "name" => $this->name,
                "phone" => $this->phone,
                "email" => $this->email,
                "address" => $this->address,
                "gender" => $this->gender,
            ]);
        }


        return redirect()->route("admin#account")->with(['profileUpdate' => 'Profile has been updated successfully']);
    }

}
