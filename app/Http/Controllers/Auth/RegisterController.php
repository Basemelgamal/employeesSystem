<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'  =>
                [
                    'required',
                    'string',
                    'max:255'
                ],
            'last_name'  =>
                [
                    'required',
                    'string',
                    'max:255'
                ],
            'email' =>
                [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users'
                ],
            'phone' =>
                [
                    'required',
                    'regex:/^(?:\+20|0)?(1[0-2]|2\d|1[5-9])[0-9]{8}$/',
                    'unique:users',
                ],
            'password' =>
                [
                    'required',
                    'confirmed',
                    'min:8',
                    'regex:/[A-Z]/',
                    'regex:/[a-z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/'
                ],
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name'=> $data['first_name'],
            'last_name' => $data['last_name'],
            'email'     => $data['email'],
            'phone'     => $data['phone'],
            'password'  => Hash::make($data['password']),
        ]);

        // Find or create the role
        $role = Role::findOrCreate('employee');

        // Assign the role to the user
        $user->assignRole($role);

        return $user;
    }
}
