<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeskController extends Controller
{
    //
    public function createFloor(Request $request)
    {
        // return $request->input();
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
        return redirect('floor', )
            ->with('success', 'Floor Added Successfully');
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
        return view('maps', compact('floor'));
    }

    public function createDesk(Request $request)
    {
        return $request->input();
    }
}
