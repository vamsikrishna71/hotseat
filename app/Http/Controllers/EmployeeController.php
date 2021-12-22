<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        'password'    => ['required', 'string', 'max:30'],
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
    $request->validate([
      'username' => 'required',
      'password' => 'required|min:6',
    ]);
    $credentials = $request->only('username', 'password');
    if (Auth::guard('employee')->attempt($credentials)) {
      return redirect()->route('employee.show');
    } else {
      exit('Not login');
    }
    // return redirect()->route('employee.create');
  }

  /**
   * editEmployee
   *
   * @param  mixed $id
   * @return void
   */
  public function editEmployee($id)
  {
    $employee = Employee::findOrFail($id);
    return view('employee.edit', compact('employee'));
  }

  public function updateEmployee(Request $request, $id)
  {
    // dd($request->input());
    // exit('Not updated');
    $request->validate(
      [
        'username'    => ['required', 'string', 'max:255'],
        'firstName'   => ['required', 'string', 'max:100'],
        'lastName'    => ['required', 'string', 'max:100'],
        'department'  => ['required', 'string', 'max:100'],
        'designation' => ['required', 'string', 'max:100'],
      ]
    );

    $employeeId = Employee::find($id);
    
    $employeeId->update([
      'username'    => $request->get('username'),
      'first_name'  => $request->get('firstName'),
      'last_name'   => $request->get('lastName'),
      // 'password'    => Hash::make($request->get('password')),
      'department'  => $request->get('department'),
      'designation' => $request->get('designation'),
    ]);

    return redirect('employee.details')->with('success', 'Employee updated Successfully');
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
      $employee = Employee::findOrFail($id);
      $employee->delete();
    } catch (\Exception $e) {
      dd($e);
    }
    DB::commit();
    Session::flash('message', 'Employee Delete Successfully');
    Session::flash('alert-class', 'alert-danger');
    return redirect('employee.details')->with('success', 'Employee Delete Successfully');
  }
}
