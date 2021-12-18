<?php

/**
 * Location controller for the admin interface.
 *
 * PHP version 8
 *
 * @category  PHP
 * @package   Desk_Reservation
 * @author    Vamsi Krishna
 * @copyright 2006-2021 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   standard license
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Location controller for the admin interface.
 *
 * PHP version 8
 *
 * @category  PHP
 * @package   Desk_Reservation
 * @author    Vamsi Krishna
 * @copyright 2006-2021 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   standard license
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class LocationController extends Controller
{
    //

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
                'address'  => ['required', 'string', 'max:255'],
                'state'    => ['required', 'string', 'max:100'],
                'city'     => ['required', 'string', 'max:100'],
                'country'  => ['required', 'string', 'max:100'],
                'zipcode'  => ['required', 'string', 'max:100'],
                'timezone' => ['required', 'string', 'max:100'],
            ]
        );

        try {
            $user     = Auth::user();
            $location = $user->location()->create(
                [
                    'address'  => $request->address,
                    'country'  => $request->country,
                    'timezone' => $request->timezone,
                    'state'    => $request->state,
                    'city'     => $request->city,
                    'zipcode'  => $request->zipcode,
                ]
            );

            $zones = $request->all()['zones'];
            foreach ($zones as $zone) {
                $location->zone()->create(
                    [
                        'building_name' => $zone['building_name'],
                        'level'         => $zone['level_name'],
                        'zone'          => $zone['zone_name'],
                    ]
                );
            }
        } catch (\Exception $e) {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect('location')->with('success', 'New Location Added Successfully');
    }

    /**
     * todo
     *
     * @return void
     */
    public function locationOverview()
    {
        $location = User::find(Auth::user()->id)->location->orderBy('id')->get();
        // print_r($location);
        // die;
        return view('location', compact('location'));
    }
    /**
     * editLocation
     *
     * @return void
     */
    public function editLocation($id)
    {
        $location = Location::findOrFail($id);
        return view(
            'editlocation',
            compact('location')
        );
    }

    /**
     * updateLocation
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updateLocation(Request $request, $id)
    {
        $request->validate(
            [
                'address' => ['required', 'string', 'max:255'],
                'state'   => ['required', 'string', 'max:100'],
                'city'    => ['required', 'string', 'max:100'],
                'country' => ['required', 'string', 'max:100'],
                'zipcode' => ['required', 'string', 'max:100'],
            ]
        );
        // dd($request->all());
        $locationId = Location::find($id);

        $locationId->update(
            [
                'address'  => $request->get('address'),
                'country'  => $request->get('country'),
                'timezone' => $request->get('timezone'),
                'state'    => $request->get('state'),
                'city'     => $request->get('city'),
                'zipcode'  => $request->get('zipcode'),
            ]
        );

        $zones = $request->all()['zones'];
        foreach ($zones as $zone) {
            $locationId->zone()->update(
                [
                    'building_name' => $zone['building_name'],
                    'level'         => $zone['level_name'],
                    'zone'          => $zone['zone_name'],
                ]
            );
        }
       
        return redirect('location')->with('success', 'Location updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed Deleting the location.
     *
     * @var $data
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id, 'delete');die;
        try {
            DB::beginTransaction();
            $location = Location::findOrFail($id);
            $location->delete();
        } catch (\Exception $e) {
            // dd($e);
        }
        DB::commit();
        Session::flash('message', 'Location Delete Successfully');
        Session::flash('alert-class', 'alert-danger');
        return redirect('location')->with('success','Location Delete Successfully');
    }
}
