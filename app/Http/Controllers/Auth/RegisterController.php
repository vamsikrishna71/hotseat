<?php

/**
 * Users Registration interface implementation.
 *
 * PHP version 8
 *
 * @category  PHP
 * @package   Desk_Reservation
 * @author    Vamsi Krishna <vamsi@softsoutions4u.com>
 * @copyright 2006-2021 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   standard license
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Users registration interface implementation.
 *
 * PHP version 8
 *
 * @category  PHP
 * @package   Desk_Reservation
 * @author    Vamsi Krishna <vamsi@softsoutions4u.com>
 * @copyright 2006-2021 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   standard license
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

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
            'firstName'   => ['required', 'string', 'max:255','alpha'],
            'lastName'    => ['required', 'string', 'max:255', 'alpha'],
            'username'    => ['required', 'string', 'unique:users', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
            'designation' => ['required', 'string', 'max:50', 'alpha'],
            'department'  => ['required', 'string', 'max:50', 'alpha'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'    => ['required', 'string', 'min:6', 'confirmed'],
            // 'dob' => ['required', 'date', 'before:today'],
            'logo'      => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
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
        // return $request->input();
        if (request()->has('logo')) {
            $logo     = request()->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logoPath = public_path('/images/');
            $logo->move($logoPath, $logoName);
        }

        return User::create([
            'first_name'  => $data['firstName'],
            'last_name'   => $data['lastName'],
            'username'    => $data['username'],
            'designation' => $data['designation'],
            'department'  => $data['department'],
            'email'       => $data['email'],
            'password'    => Hash::make($data['password']),
            // 'dob'      => date('Y-m-d', strtotime($data['dob'])),
            'logo'      => "/images/" . $logoName,
        ]);
    }
}
