<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\CsvToArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeImportController extends Controller
{
    use CsvToArray;

    /**
     * ImportEmployee data with uploaded files.
     *
     * @return view
     */
    public function importEmployeeCsv()
    {
        return view('drop-zone-employees');
    }

    /**
     * ImportCsv
     *
     * @return view to import CSV Blade file.
     */
    public function importEmployee(Request $request)
    {
        $request->validate(
            [
                'file' => ['required', 'mimes:csv,txt'],
            ]
        );
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('uploads'), $fileName);
        $csvFile   = public_path('uploads/' . $fileName);
        $employees = $this->csvToArray($csvFile);
        // dd($employeeArr);
        $user = User::find(Auth::user()->id);

        foreach ($employees as $employee) {
            $user->employee()->create([
                'username'    =>  ' ' ? $employee['email']: $employee['username'],
                'employeeId'  => $employee['employeeId'],
                'first_name'  => $employee['first_name'],
                'last_name'   => $employee['last_name'],
                'email'       => $employee['email'],
                'department'  => $employee['department'],
                'designation' => $employee['designation'],
                'password'    =>  ' ' ? Hash::make($employee['email']):Hash::make($employee['password']),
            ]);
        }
        return redirect('employee.details')
            ->with('success', 'Employee updated Successfully');
    }
}
