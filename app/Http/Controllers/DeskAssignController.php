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
    public function deskAssign(Request $request){
        
        $request->validate([
            'deskName' => 'required',
            'employeeName'  => 'required',
        ]);
        $desk = Desk::find($request->deskId);
        $desk->deskAssign()->create([
            'desk_name' => $request->deskName,
            'employee_name'  => $request->employeeName,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        
        return back()->with('success', 'Desk Added Successfully');
    }
    
    /**
     * mapAssign
     *
     * @param  mixed $request
     * @return void
     */
    public function mapAssign(Request $request){
        $maps = DeskAssign::where('desk_id', $request->deskId)->select('desk_id', 'latitude', 'longitude','employee_name','desk_name')->get();
        return $maps->toArray();
    }

    /**
     * editDeskAssign
     *
     * @param  mixed $request
     * @return void
     */
    public function editDeskAssign(Request $request){
        $request->input();
    }
    
    /**
     * updateDeskAssign
     *
     * @param  mixed $request
     * @return void
     */
    public function updateDeskAssign(Request $request){
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
    public function destroy($id)
    {
        
        try {
            DB::beginTransaction();
            $floor = DeskAssign::findOrFail($id);
            $floor->delete();
        } catch (\Exception $e) {
            dd($e);
        }
        DB::commit();
        Session::flash('message', 'Desk Delete Successfully');
        Session::flash('alert-class', 'alert-danger');
        return redirect('maps-overview')->with(
            'success',
            'Desk Delete Successfully'
        );
    }
}
