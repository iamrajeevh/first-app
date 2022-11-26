<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'user_name'=>$row[0],
            'user_mobile'=>$row[1],
            'user_age'=>$row[2],
            'user_salary'=>$row[3],
        ]);
    }
}
