<?php

namespace App\Exports;

use App\Approach;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ApproachExport implements FromQuery
{
    use Exportable;
    public $ids;

    function forIds($ids)
    {
        $this->ids = $ids;
//        print_r($this->ids);
//        exit();
        return $this;
    }

    public function query()
    {

        return Approach::whereIn('id', $this->ids);
    }
}
