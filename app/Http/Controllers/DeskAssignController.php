<?php

namespace App\Http\Controllers;

use App\Models\DeskAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $user = Auth::user();
        $user->deskAssignEmployee()->create([
            'desk_name' => $request->deskName,
            'employee_name'  => $request->employeeName,
            // 'positions' => $request->positions
        ]);
        return redirect('floor')
        ->with('success', 'Desk Added Successfully');
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
        // dd($id, 'delete');die;
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
