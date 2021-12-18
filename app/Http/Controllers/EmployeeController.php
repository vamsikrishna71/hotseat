<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{

  /**
   * Adding Employee by respective admin.
   *
   * @param  mixed $request
   * @return void
   */
  public function addEmployee(Request $request)
  {
    $request->validate(
      [
        'username'    => ['required', 'string', 'max:255'],
        'firstName'   => ['required', 'string', 'max:100'],
        'lastName'    => ['required', 'string', 'max:100'],
        'department'  => ['required', 'string', 'max:100'],
        'designation' => ['required', 'string', 'max:100'],
      ]
    );

    try {
      $user = Auth::user();
      $user->employee()->create([
        'username'    => $request->username,
        'first_name'  => $request->firstName,
        'last_name'   => $request->lastName,
        'password'    => Str::random(10),
        'designation' => $request->designation,
        'department'  => $request->department,
      ]);
    } catch (\Exception $e) {
      dd($e);
    }
    // return $request->input();
    return redirect('location')->with('success', 'Employee Added Successfully');
    // dd($request->input());
  }

  public function editEmployee(Request $request)
  {
  }
}
