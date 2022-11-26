<?php
namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportUser implements FromQuery
{
    use Exportable;
    protected $filter;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($limit){
        $this->filter = $limit;
    }

    public function query()
    {
        return Post::query();
    }
}
