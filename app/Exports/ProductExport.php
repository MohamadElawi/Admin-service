<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths

{
    private $i = 0 ;
    public function map($product): array
    {
        return [
            $this->i += 1 ,
            $product['name'],
            $product['category_name'],
            $product['price'] .'sy',
            $product['is_special'] == 1 ? 'special' :'normal',
            $product['status'],
            $product['created_at']
        ];
    }

    public function headings(): array
    {
        return [
            '#' ,
            'Name',
            'category',
            'price',
            'type',
            'Status',
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
            'e' => 15,
            'f' => 15,
            'g' => 20
        ];
    }


    public function collection()
    {
         $response = Http::withToken(Session::get('token'))->get(env('PRODUCT_SERVICE_PORT') . '/admin/product');
        if ($response->status() != 200)
            abort($response->status());

        return $product =collect($response->json());
    }
}
