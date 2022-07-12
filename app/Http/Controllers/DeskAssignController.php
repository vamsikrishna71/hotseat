<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\User;
use App\Models\DeskAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DeskAssignController extends Controller
{

    /**
     * DeskAssign in the FloorMap
     *
     * @param  mixed $request
     * @return void
     */

    public function deskAssign(Request $request,$id)
    {
        // dd($request);
        $floor = Desk::find($request->floorId);
        $hotdesk = Desk::find($id);
        try {
            foreach ($request->desks as $desk) {
                $floor->deskAssign()->create([
                    'desk_name' => $desk['desk'],
                    'employee_name' => $desk['employee'],
                    'latitude' => $desk['latitude'],
                    'longitude' => $desk['longitude'],
                ]);
            }
        } catch (\Exception $e) {
            dd($e);
        }
        if ($floor) {
            Session::flash('message', 'Desk saved successfully!');
            Session::flash('alert-class', 'alert-success');
            $data = [
                'success' => true,
                'message' => 'Desk saved successfully'
            ];
            return response()->json(
                $data,
                200
            );
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            $data = [
                'success' => false,
                'message' => 'Something went wrong!'
            ];
            return response()->json(
                $data,
                200
            );
        }
        return view('hotdesk',compact('hotdesk'));
    }

    /**
     * mapAssign
     *
     * @param  mixed $request
     * @return void
     */
    public function mapAssign(Request $request)
    {
        $maps = DeskAssign::where('desk_id', $request->deskId)->select('desk_id', 'latitude', 'longitude', 'employee_name', 'desk_name')->get();
        return $maps->toArray();
    }

    /**
     * editDeskAssign
     *
     * @param  mixed $request
     * @return void
     */
    public function editDeskAssign(Request $request)
    {
        $request->input();
    }

    /**
     * updateDeskAssign
     *
     * @param  mixed $request
     * @return void
     */
    public function updateDeskAssign(Request $request)
    {
        $request->input();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param mixed Deleting the Desk Allocation.
     *
     * @var $data
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
   
    DeskAssign::find($id)->delete($id);
    return response()->json([
        'success' => 'Desk deleted successfully!'
    ]);
}
}
