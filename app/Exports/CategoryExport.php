<?php

namespace App\Exports;

use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CategoryExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths

{
    private $i = 0;
    public function map($category): array
    {
        return [
            $this->i += 1,
            $category['name'],
            $category['description'],
            $category['status'],
            $category['created_at'],
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'description',
            'Status',
            'Created_at',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 10,
            'c' => 55,
            'd' => 10,
            'e' => 20
        ];
    }


    public function collection()
    {
        $response = Http::withToken(Session::get('token'))->get(env('PRODUCT_SERVICE_PORT') . '/admin/category');
        if ($response->status() != 200)
            abort($response->status());

         return $category =collect($response->json());

    }
}
