<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Excel;
use Response;

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
        'username'    => ['required', 'alpha_num', 'string', 'max:255'],
        'firstName'   => ['required', 'string', 'max:100','alpha', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
        'employeeId'  => ['required', 'string'],
        'lastName'    => ['required', 'string', 'max:100','alpha', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
        'department'  => ['required', 'string', 'max:100', 'alpha','regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
        'password'    => ['required', 'string', 'max:30', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
        'designation' => ['required', 'string', 'max:100','alpha', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
      ]
    );

    try {
      $user = Auth::user();
      $user->employee()->create([
        'username'    => $request->username,
        'first_name'  => $request->firstName,
        'last_name'   => $request->lastName,
        'employeeId'  => $request->employeeId,
        'email'       => $request->email,
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
    // dd('exit');
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

    $designations = [
      'Developer' => 'Developer',
      'Designer'  => 'Designer',
    ];

    $departments = [
      'IT'  => 'IT',
      'CSE' => 'CSE',
    ];

    $employee = Employee::findOrFail($id);
    return view('employee.edit', compact('employee'))
      ->with('designations', $designations)
      ->with('departments', $departments);
  }

  /**
   * UpdateEmployee in the database.
   *
   * @param  mixed $request
   * @param  mixed $id
   * @return void
   */
  public function updateEmployee(Request $request, $id)
  {
    // dd($request->input());
    // exit('Not updated');
    $request->validate(
      [
        'username'    => ['required', 'alpha_num', 'string', 'max:255'],
        'firstName'   => ['required', 'string', 'max:100', 'alpha', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
        'employeeId'  => ['required', 'string'],
        'lastName'    => ['required', 'string', 'max:100', 'alpha', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
        'department'  => ['required', 'string', 'max:100', 'alpha', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
        'designation' => ['required', 'string', 'max:100', 'alpha', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
      ]
    );

    $employeeId = Employee::find($id);

    $employeeId->update([
      'username'    => $request->get('username'),
      'employeeId'  => $request->get('employeeId'),
      'first_name'  => $request->get('firstName'),
      'last_name'   => $request->get('lastName'),
      'email'       => $request->get('email'),
      'department'  => $request->get('department'),
      'designation' => $request->get('designation'),
    ]);

    return redirect('employee.details')->with('success', 'Employee updated Successfully');
  }

  /**
   * exportEmployeeCsv
   *
   * @return void
   */
  public function exportEmployeeCsv(Request $request)
  {
    // exit('export');
    $fileName = 'employee.csv';
    $tasks    = Employee::all();

    $headers =
      array(
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0",
      );

    $columns  = array('employeeId', 'username', 'first_name', 'last_name', 'designation', 'department', 'password', 'email');
    $callback = function () use ($tasks, $columns) {
      $file = fopen('php://output', 'w');

      fputcsv($file, $columns);

      foreach ($tasks as $task) {
        $row['employeeId']  = $task->employeeId;
        $row['username']    = $task->username;
        $row['firstName']   = $task->first_name;
        $row['lastName']    = $task->last_name;
        $row['designation'] = $task->designation;
        $row['department']  = $task->department;
        $row['password']    = $task->password;
        $row['email']       = $task->email;

        fputcsv($file, array(
          $row['employeeId'],
          $row['username'],
          $row['firstName'],
          $row['lastName'],
          $row['designation'],
          $row['department'],
          $row['email'],
          $row['email'],
        ));
      }
      fclose($file);
    };
    return response()->stream($callback, 200, $headers);
  }
  
  /**
   * exportCsv
   *
   * @return void
   */
  public function exportCsv()
  {
    exit('csv');
    // $data = array('employeeId', 'username', 'first name', 'last name', 'designation', 'department', 'password', 'email');

    // Excel::create(
    //   'employee',
    //   function ($e) use ($data) {
    //     $e->sheet(
    //       'Employee',
    //       function ($sheet) use ($data) {
    //         $sheet->fromArray($data);
    //       }
    //     );
    //   }
    // )->download('csv', ['access-control-allow-origin' => '*']);
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
