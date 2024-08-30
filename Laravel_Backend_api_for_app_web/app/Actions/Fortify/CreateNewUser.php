<?php


namespace App\Actions\Fortify;


use App\Models\Doctor;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;


//this is to register new user/doctor


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
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'type' => $input['type'], //to store type of user .
            'password' => Hash::make($input['password']),
        ]);


        // This part for alternative of the below part
        if($input['type']=='doctor'){
            $doctorInfo = Doctor::create([
                'doc_id' => $user->id,
                'status' => 'active'
            ]);
        }else if($input['type']=='user'){
            $userInfo = UserDetails::create([
                'user_id' => $user->id,
                'status' => 'active'
            ]);


        }
        //This part is alternative of below part


        //This is below part
        // $doctorInfo = Doctor::create([
        //     'doc_id' => $user->id,
        //     'status' => 'active'
        // ]);
        //This is below part
        return $user;
    }
}
