<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths
{
    private $i = 0 ;
    public function map($order): array
    {
        return [
            $this->i += 1 ,
            $order['user_name'],
            $order['user_email'],
            $order['user_phone'],
            $order['total_amount'] .' SY',
            $order['created_at'],
        ];
    }

    public function headings(): array
    {
        return [
            '#' ,
            'user Name',
            'user Email',
            'user phone',
            'total price',
            'Created_at',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 10,
            'c' => 15,
            'd' => 10,
            'e' => 25,
            'f' => 7,
            'g' => 7,
            'h' => 20,
        ];
    }


    public function collection()
    {
        $response = Http::withToken(Session::get('token'))->get(env('PRODUCT_SERVICE_PORT') . '/admin/order');
        if ($response->status() != 200)
            abort($response->status());

        return $order = collect($response->json());
    }
}
