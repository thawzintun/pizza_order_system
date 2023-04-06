<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'starts_with:09', 'min_digits:9' , 'unique:users'],
            'address' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],[
            'name.required' => "Name is required!",
            'email.required' => "Email is required!",
            'phone.required' => "Phone Number is required!",
            'phone.numeric' => "Phone Number must be numbers!",
            'phone.min_digits' => "Phone Number must be at least 9 numbes!",
            'phone.starts_with' => "Phone Number must be start with 09!",
            'password.required' => "Password is required!",
            'address.required' => "Address is required!"
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone' => $input['phone'],
            'address' => $input['address'],
        ]);
    }
}
