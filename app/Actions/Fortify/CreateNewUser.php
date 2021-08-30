<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Http\Request;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        //Validation Rules for Register Form
        Validator::make($input, [
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            "role" => ['required','max:255'],
            'firstname' => ['required_if:company_name,null', 'min:3', 'max:255'],
            'lastname' => ['required_if:company_name,null', 'min:3', 'max:255'],
            'company_name' => ['required_if:firstname,null', 'required_if:lastname,null', 'min:3', 'max:255'],
            'address' => ['required', 'min:5', 'max:255'],
            'telephone' => ['required', 'min:5', 'max:255'],
        ])->validate();

        //In case a malicious user change the default values the value of the select dropdown
        if(!$input['role'] == 'Customer' || !$input['role'] == 'Company')
        {
            $input['role'] = 'Customer';
        }

        //Creating the User
        return User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            "firstname" => $input['firstname'] ?? NULL,
            "lastname" => $input['lastname'] ?? NULL,
            "company_name" => $input['company_name'] ?? NULL,
            "address" => $input['address'],
            "telephone" => $input['telephone'],
            "role" => $input['role']
        ]);
    }
}
