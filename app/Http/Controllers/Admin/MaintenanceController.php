<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class MaintenanceController extends Controller
{
    private $url;
    public $token;

    public function __construct()
    {
        $this->url = env('PRODUCT_SERVICE_PORT');
        $this->token = Session::get('token');
    }

    public function index(){
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "Maintenance"]
        ];
        return view('admin.maintenances.index', compact('breadcrumbs'));
    }

    public function getData(){
        try {

            $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/maintenance');
            if ($response->status() != 200)
                abort($response->status());

            $data = $response->json();
            // return $response->json();
            return DataTables::of($data)
                ->addColumn('action', 'admin.maintenances.action')
                ->addIndexColumn()
                ->make(true);
        } catch (HttpException $ex) {
        }
    }
}
