<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
class ExportUser implements FromCollection, WithHeadings,ShouldQueue
{
    protected $filter;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($limit){
        $this->filter = $limit;
    }

    public function collection()
    {
        return User::limit($this->filter)->get();

    }
    public function headings(): array
    {
        return [
            'id',
            'User Name',
            'User Mobile',
            'User Age',
            'User Salary',
            'Created At',
            'Deleted At',
        ];
    }
}
