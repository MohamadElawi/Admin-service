<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Spatie\Permission\Models\Role;

class RoleExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths
{
    private $i = 0 ;
    public function map($roles): array
    {
        return [
            $this->i += 1 ,
            $roles->name,
            $roles->status,
            $roles->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#' ,
            'Name',
            'Status',
            'Created_at',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 30,
            'c' => 30,
            'd' => 30,
        ];
    }


    public function collection()
    {
        return  $roles = Role::get();
    }
}
