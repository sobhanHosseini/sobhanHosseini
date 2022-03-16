<?php

namespace App\Imports;

use App\Models\Info;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class UsersImport implements ToModel, WithStartRow
{

    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //dd($row);
        /*  return new Info([
            'name'     => $row[0],
            'email'    => $row[1],
        ]); */
        $b = [];
       /*  foreach ($row as $rows=>$a ) {
            array_push($b, $rows);
             Info::create([
                'name' => $row[$rows],
                //'email' => $a,

            ]); 
         } */
       /*  array_push($b, $row);
        dd($row); */
    }

    public function startRow(): int
    {
        return 2;
    }
}
