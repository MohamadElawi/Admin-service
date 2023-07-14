<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdminExport implements FromCollection ,WithMapping , WithHeadings, WithColumnWidths

{
    private $i = 0 ;
    public function map($admins): array
    {
        return [
            $this->i += 1 ,
            $admins->name,
            $admins->email,
            $admins->phone,
            $admins->status,
            $admins->all_roles[0],
            $admins->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#' ,
            'Name',
            'Email',
            'phone',
            'Status',
            'type',
            'Created_at',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'c' => 15,
            'd' => 15,
            'e' => 10,
            'f' => 20,
            'g' => 20
        ];
    }


    public function collection()
    {
         return  $admins = Admin::different(auth('admin')->id())->get();
    }
}
