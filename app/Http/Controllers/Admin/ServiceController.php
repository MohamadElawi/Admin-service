<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    private $url;
    private $token;

    public function __construct()
    {
        $this->url = env('SERVICE_PORT');
        $this->token = Session::get('token');
        $this->middleware('permission:view service')->only('index', 'getData');
        $this->middleware('permission:create service')->only('create', 'store');
        $this->middleware('permission:edit service')->only('update');
        $this->middleware('permission:delete service')->only('destroy');
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "Services"]
        ];
        return view('admin.services.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function getData()
    {
        try {
            $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/form');
            if ($response->status() != 200)
                abort($response->status());

            $data = $response->json();
            $arr = [];

            foreach ($data as $raw) {
                $raw['id'] = $raw['_id'];
                unset($raw['_id']);
                array_push($arr, $raw);
            }

            return DataTables::of($arr)
                ->addColumn('action', 'admin.services.action')
                ->addColumn('truncated_description', function ($row) {
                    return Str::limit($row['description'], 50);
                })
                ->editColumn('createdAt', function ($arr) {
                    return Carbon::parse($arr['createdAt'])->format('Y-m-d H:00');
                })
                ->addIndexColumn()
                ->make(true);
        } catch (HttpException $ex) {
        }
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "Services"]
        ];
        return view('admin.services.create', compact('breadcrumbs'));
    }


    public function store(Request $request)
    {
        $data = $request->only('name', 'description');
        $response = Http::post($this->url . "/form", $data);
        if ($response->status() != 201)
            return redirect()->route('service.index')->with(['error' => 'sorry , some things went wrongs']);

        return redirect()->route('service.index')->with(['success' => 'created successfully']);
    }


    public function show($service)
    {
        $response = Http::withToken($this->token)->get($this->url . "/form/$service");
        if ($response->status() != 200)
            return failure('sorry , some things went wrongs', 450);

        $data = $response->json();
        return response()->json($data);
    }

    public function update($service, Request $request)
    {
        $data = $request->only('name', 'description', 'active');
        $response = Http::withToken($this->token)->put($this->url . "/form/$service", $data);
        if ($response->status() != 200)
            return failure('sorry , some things went wrongs', 450);

        return success('updated successfully');
    }


    public function destroy($service)
    {
        $response = Http::withToken($this->token)->delete($this->url . "/form/$service");
        if ($response->status() != 200)
            return failure('sorry , some things went wrongs', 450);

        return success('deleted successfully');
    }
}
