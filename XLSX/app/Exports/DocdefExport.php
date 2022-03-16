<?php

namespace App\Exports;

use App\Imports\Docdef;
use App\Imports\DocdefImport;
use App\Imports\testImport;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DocdefExport implements FromArray, WithMultipleSheets
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
        $sheets = [
            new testImport($this->sheets),
        ];

        return $sheets;
    }
}
