<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

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
                'address' => ['required', 'string', 'max:255'],
                'state'   => ['required', 'string', 'max:100'],
                'city'    => ['required', 'string', 'max:100'],
                'country' => ['required', 'string', 'max:100'],
                'zipcode' => ['required', 'string', 'max:100'],
                'timezone' => ['required', 'string', 'max:100'],
            ]
        );
        
        try {
            $user = Auth::user();
            $location = $user->location()->create(
                [
                    'address'  => $request->address,
                    'country' => $request->country,
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
        return back()->with('success', 'New Location Added Successfully');
    }

    /**
     * todo
     *
     * @return void
     */
    public function locationOverview()
    {
       $location = User::find(Auth::user()->id)->location->orderBy('id')->get();
       print_r($location);die;
       
       return view('location',compact('location'));
       
    }
    /**
     * editLocation
     *
     * @return void
     */
    public function editLocation($id)
    {
        return view(
            'editlocation',
            ['location' => Location::findOrFail($id)]
        );
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
        dd($id);
        // try {
        //     DB::beginTransaction();
        // $data = Location::findOrFail($id);
        // $data->delete();
        // Session::flash('message', 'Location Delete Successfully');
        // Session::flash('alert-class', 'alert-danger');
        // } catch (\Exception $e) {
        //     dd($e);
        // }
        // DB::commit();
        // return redirect()->route('location');
    }
}
