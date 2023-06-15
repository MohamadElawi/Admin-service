<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    private $url;
    public $token;

    public function __construct()
    {
        $this->url = env('PRODUCT_SERVICE_PORT');
        $this->token = Session::get('token');
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "orders"]
        ];
        return view('admin.orders.index', compact('breadcrumbs'));
    }

    public function getData()
    {
        try {
            $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/order');
            if ($response->status() != 200)
                abort($response->status());

            $data = $response->json();
            // return $response->json();
            return DataTables::of($data)
                ->addColumn('action', 'admin.orders.action')
                ->addIndexColumn()
                ->make(true);
        } catch (HttpException $ex) {
        }
    }


}
