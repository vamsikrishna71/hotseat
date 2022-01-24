<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeskAssignController extends Controller
{

    /**
     * DeskAssign in the FloorMap
     *
     * @param  mixed $request
     * @return void
     */
    public function deskAssign(Request $request){
        
        // return $request->input();
        $request->validate([
            'deskName' => 'required',
            'employeeName'  => 'required',
        ]);

        $user = Auth::user();
        $user->deskAssignEmployee()->create([
            'desk_name' => $request->deskName,
            'employee_name'  => $request->employeeName,
        ]);
        return redirect('floor')
        ->with('success', 'Desk Added Successfully');
    }
}
