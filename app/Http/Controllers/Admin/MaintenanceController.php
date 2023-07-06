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
        $this->middleware('permission:view maintenance')->only('index', 'getData');
        $this->middleware('permission:action maintenance')->only('show', 'update', 'addPrice', 'destroy');
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "Maintenance"]
        ];
        return view('admin.maintenances.index', compact('breadcrumbs'));
    }

    public function getData()
    {
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

    public function show($id)
    {
        $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/maintenance/' . $id);
        if ($response->status() != 200)
            return response()->json(['message' => 'some things went wrongs'], $response->status());

        return $response->json();
    }

    public function update($id, Request $request)
    {
        $data = $request->only('datetime1', 'datetime2', 'datetime3');

        $response = Http::withToken(Session::get('token'))->put($this->url . '/admin/maintenance/' . $id, $data);
        if ($response->status() != 200)
            return response()->json(['message' => 'some things went wrongs'], $response->status());
        return success('added dates successfully');
    }

    public function addPrice(Request $request, $id)
    {
        $request->validate(['price' => 'required|numeric']);
        $response = Http::withToken(Session::get('token'))->post($this->url . '/admin/maintenance/add-price' . $id);
        if ($response->status() != 200)
            return response()->json(['message' => 'some things went wrongs'], $response->status());
        return response()->json('updated successfully');
    }

    public function destroy($id)
    {
        return  $response = Http::withToken(Session::get('token'))->delete($this->url . '/admin/maintenance/' . $id);
        if ($response->status() != 200)
            return response()->json(['message' => 'some things went wrongs'], $response->status());
        return response()->json('rejected successfully');
    }
}
