<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        'password'    => Hash::make($request->password),
        'designation' => $request->designation,
        'department'  => $request->department,
      ]);
    } catch (\Exception $e) {
      dd($e);
    }
    // return $request->input();
    return redirect('employee.details')->with('success', 'Employee Added Successfully');
    // dd($request->input());
  }


  /**
   * employeeLogin
   *
   * @param  mixed $request
   * @return void
   */
  public function employeeLogin(Request $request)
  {
    $request->validate( [
      'username' => 'required',
      'password' => 'required|min:6',
    ]);
    $credentials = $request->only('username', 'password');
    if (Auth::guard('employee')->attempt($credentials)) {
      return redirect()->route('employee.create');
    } else {
      exit('Not login');
    }
    // return redirect()->route('employee.create');
  }

  public function editEmployee(Request $request)
  {
  }
}
