<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;


class EmployeeImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model(array $row)
    {
        $user = User::get();
        return new Employee([
            'username'    => $row[0],
            'first_name'  => $row[1],
            'last_name'   => $row[2],
            'department'  => $row[3],
            'designation' => $row[4],
            'user_id'     => $row[$user->id],
            'password'    => Hash::make($row[6]),
        ]);
    }
}
