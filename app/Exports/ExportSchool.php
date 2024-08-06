<?php

namespace App\Exports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportSchool implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return School::select('UserCode','Name','Address','Email','Username','Mobile','Registration','Start_Date','Expiry_Date')->get();
    }

    public function headings(): array
    {
        return ["UserCode", "School Name","Address","Email","Administrator Name","Mobile No.","Registration No.","Account Start Date","Account Expiry Date"];
    }
}
