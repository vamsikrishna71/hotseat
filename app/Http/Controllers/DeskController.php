<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\DeskAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DeskController extends Controller
{
    //
    public function createFloor(Request $request)
    {
        $request->validate([
            'floorName' => 'required',
            'floorMap'  => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if (request()->has('floorMap')) {
            $floorMap     = request()->file('floorMap');
            $floorMapName = time() . '.' . $floorMap->getClientOriginalExtension();
            $floorMapPath = public_path('/images/');
            $floorMap->move($floorMapPath, $floorMapName);
        }

        $request->floorMap = "/images/" . $floorMapName;
        $user = Auth::user();
        $user->desk()->create([
            'floor_name' => $request->floorName,
            'floor_map'  => $request->floorMap,
        ]);
        return redirect('floor')
        ->with('success', 'Desk Added Successfully');
    }
        
    
        
    /**
     * Edit Floor Details.
     *
     * @param  mixed $id
     * @return void
     */
    public function editFloor($id)
    {
        $floor = Desk::findOrFail($id);
        $map = DeskAssign::all();
        return view('maps', compact('floor','map'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     * @param mixed Deleting the location.
     *
     * @var $data
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $floor = Desk::findOrFail($id);
            $floor->delete();
        } catch (\Exception $e) {
            dd($e);
        }
        DB::commit();
        Session::flash('message', 'Floor Delete Successfully');
        Session::flash('alert-class', 'alert-danger');
        return redirect('floor')->with('success', 
        'Floor Delete Successfully');
    }
}
