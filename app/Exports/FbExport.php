<?php

namespace App\Exports;

use App\Fb;
use Maatwebsite\Excel\Concerns\FromCollection;

class FbExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Fb::all();
    }
}
