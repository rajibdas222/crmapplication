<?php

namespace App\Exports;

use App\Approach;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApproachselectedExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Approach::whereIn('id', [1, 2])
            ->get();
    }
}
