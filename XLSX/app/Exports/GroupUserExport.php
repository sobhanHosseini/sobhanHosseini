<?php

namespace App\Exports;

use App\Imports\FirstSheetImport;
use App\Imports\FirstSheetImport2;
use App\Imports\FirstSheetImport3;
use App\Imports\FirstSheetImport4;
use App\Imports\FirstSheetImport5;
use App\Imports\FirstSheetImport6;
use App\Imports\FirstSheetImport7;
use App\Imports\FirstSheetImport8;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GroupUserExport implements FromArray, WithMultipleSheets
{
    protected $sheets;

    public function __construct(array $sheets)
    {
        $this->sheets = $sheets;
    }

    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
        return [
            new FirstSheetImport($this->sheets[0]),
            new FirstSheetImport($this->sheets[1]),
            new FirstSheetImport($this->sheets[2]),
            new FirstSheetImport($this->sheets[3]),
            new FirstSheetImport($this->sheets[4]),
            new FirstSheetImport($this->sheets[5]),
            new FirstSheetImport($this->sheets[6]),
            new FirstSheetImport($this->sheets[7]),
            new FirstSheetImport($this->sheets[8]),
            new FirstSheetImport($this->sheets[9]),
            new FirstSheetImport($this->sheets[10]),
            new FirstSheetImport($this->sheets[11]),
            new FirstSheetImport($this->sheets[12]),
            new FirstSheetImport($this->sheets[13]),
            new FirstSheetImport($this->sheets[14]),
            new FirstSheetImport($this->sheets[15]),
            new FirstSheetImport($this->sheets[16]),
            new FirstSheetImport($this->sheets[17]),
            new FirstSheetImport($this->sheets[18]),
            new FirstSheetImport($this->sheets[19]),
            new FirstSheetImport($this->sheets[20]),
            new FirstSheetImport($this->sheets[21]),
            new FirstSheetImport($this->sheets[22]),
            new FirstSheetImport($this->sheets[23]),
            new FirstSheetImport($this->sheets[24]),
            new FirstSheetImport($this->sheets[25]),
            new FirstSheetImport($this->sheets[26]),
            new FirstSheetImport($this->sheets[27]),
            new FirstSheetImport($this->sheets[28]),
            new FirstSheetImport($this->sheets[29]),
            new FirstSheetImport($this->sheets[30]),
        ];
    }
}
