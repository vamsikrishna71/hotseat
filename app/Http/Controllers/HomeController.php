<?php

/**
 * Admin interface implementation.
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

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * Main controller for the admin interface.
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
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return view
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param mixed Request $request it validates the fields
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $location = Location::all();

        if (view()->exists($request->path())) {
            return view($request->path(), compact('location'));
        }
        return abort(404);
    }

    /**
     * Loads by default the application.
     *
     * @return void
     */
    public function root()
    {
        return view('index');
    }

    /**
     * Language translation for the application.
     *
     * @param mixed Local language in the current locale $locale.
     *
     * @return void
     */
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update profile data in database.
     *
     * @param mixed Request         $request it validates the fields.
     * @param mixed Identifying the $id.
     *
     * @var $user
     * @var $logo
     * @var $logoPath
     * @var $logoName
     *
     * @return view
     */
    public function updateProfile(Request $request, $id)
    {
        $request->validate(
            [
                'firstName'   => ['required', 'string', 'max:255'],
                'lastName'    => ['required', 'string', 'max:255'],
                'username'    => ['required', 'string'],
                'designation' => ['required', 'string', 'max:255'],
                'department'  => ['required', 'string', 'max:255'],
                // 'name' => ['required', 'string', 'max:255'],
                'email'       => ['required', 'string', 'email'],
                // 'dob' => ['required', 'date', 'before:today'],
                'logo'        => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            ]
        );

        $user = User::find($id);

        $user->first_name  = $request->get('firstName');
        $user->last_name   = $request->get('lastName');
        $user->username    = $request->get('username');
        $user->designation = $request->get('designation');
        $user->department  = $request->get('department');
        $user->email       = $request->get('email');
        // $user->dob = date('Y-m-d', strtotime($request->get('dob')));

        if ($request->file('logo')) {
            $logo     = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logoPath = public_path('/images/');
            $logo->move($logoPath, $logoName);
            $user->logo = '/images/' . $logoName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json(
                [
                    'isSuccess' => true,
                    'Message'   => "User Details Updated successfully!",
                ],
                200
            ); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json(
                [
                    'isSuccess' => true,
                    'Message'   => "Something went wrong!",
                ],
                200
            ); // Status code here
        }
    }

    /**
     * Update password data into database.
     *
     * @param mixed Request $request it validates the fields.
     * @param mixed Identifying the password $id.
     *
     * @var $user
     *
     * @return view
     */
    public function updatePassword(Request $request, $id)
    {
        $request->validate(
            [
                'current_password' => ['required', 'string'],
                'password'         => ['required', 'string', 'min:6', 'confirmed'],
            ]
        );

        if (!(Hash::check(
            $request->get('current_password'),
            Auth::user()->password
        ))) {
            return response()->json(
                [
                    'isSuccess' => false,
                    'Message'   => "Your Current password does not matches with the
                password you provided. Please try again.",
                ],
                200
            ); // Status code
        } else {
            $user           = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash(
                    'message',
                    'Password updated successfully!'
                );
                Session::flash('alert-class', 'alert-success');
                return response()->json(
                    [
                        'isSuccess' => true,
                        'Message'   => "Password updated successfully!",
                    ],
                    200
                ); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json(
                    [
                        'isSuccess' => true,
                        'Message'   => "Something went wrong!",
                    ],
                    200
                ); // Status code here
            }
        }
    }

    /**
     * Insert location data into database
     *
     * @param mixed Request $request it validates the fields.
     *
     * @var $data
     * @var $save
     *
     * @return view
     */
    public function location(Request $request)
    {

        $request->validate(
            [
                'address'      => ['required', 'string', 'max:255'],
                'state'        => ['required', 'string', 'max:100'],
                'city'         => ['required', 'string', 'max:100'],
                'country'      => ['required', 'string', 'max:100'],
                'zipcode'      => ['required', 'string', 'max:100'],   
            ]
        );

        $location          = new Location;
        $location->address  = $request->address;
        $location->country  = $request->country;
        $location->timezone = $request->timezone;
        $location->state    = $request->state;
        $location->city     = $request->city;
        $location->zipcode  = $request->zipcode;
        $location->save();
        
       $location->zone()->create(
            [
                'building_name' => '$request->buildingName',
                'level'         => '$request->level',
                'zone'          => '$request->zone'
            ]
        );
        
    
        
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param mixed Deleting the location $id.
     *
     * @var $data
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Location::findOrFail($id);
        $data->delete();
        session()->flash('success', 'Location was successfully deleted');
        return redirect()->route('location');
    }
}
