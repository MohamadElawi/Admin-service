<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    // private $url = '192.168.1.106:8080';
    private $url;
    public $token;

    public function __construct()
    {
        $this->url = env('PRODUCT_SERVICE_PORT');
        $this->token = Session::get('token');
        $this->middleware('permission:view category')->only('index', 'getData');
        $this->middleware('permission:create category')->only('create', 'store');
        $this->middleware('permission:edit category')->only('update');
        $this->middleware('permission:change status category')->only('changeStatus');
        $this->middleware('permission:delete category')->only('destroy');
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "admins"]
        ];
        return view('admin.categories.index', compact('breadcrumbs'));
    }

    public function getData()
    {
        try {

            $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/category');
            if ($response->status() != 200)
                abort($response->status());

            $data = $response->json();
            // return $response->json();
            return DataTables::of($data)
                ->addColumn('action', 'admin.categories.action')
                ->addIndexColumn()
                ->make(true);
        } catch (HttpException $ex) {
        }
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "category"]
        ];
        return view('admin.categories.create', compact('breadcrumbs'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->only('name_en', 'description_en');
        $response = Http::withToken(Session::get('token'))->attach(
            'image',
            file_get_contents($request->image),
            $request->image->getClientOriginalName()
        )->post($this->url . '/admin/category', $data);

        if ($response->status() == 400)
            return 'not authorize';

        elseif ($response->status() == 403)
            return 'forbidden';

        elseif ($response->status() == 200)
            return redirect()->route('category.index')->with(['success' => 'created successfully']);
    }

    public function show($id)
    {
        $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/category/' . $id);
        if ($response->status() != 200)
            return response()->json(['message' => 'some things went wrongs'], $response->status());

        return $response->json();
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->only('name_en', 'description_en', '_method');

        if ($request->has('image')) {
            // return 'image';
            $response = Http::withToken(Session::get('token'))->attach(
                'image',
                file_get_contents($request->image),
                $request->image->getClientOriginalName()
            )->post($this->url . '/admin/category/' . $id, $data);
        } else
            $response = Http::withToken($this->token)
                ->post($this->url . '/admin/category/' . $id, $data);

        if ($response->status() != 200)
            return failure($response->json(), $response->status());

        return success('updated successfully');
    }

    public function changeStatus($id)
    {
        $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/category/change-status/' . $id);
        if ($response->status() == 404)
            return failure('not found', 404);

        elseif ($response->status() == 403)
            return failure('forbidden', 403);

        return success('status changed successfully');
    }

    public function destroy($id)
    {
        $response = Http::withToken(Session::get('token'))->delete($this->url . '/admin/category/' . $id);
        if ($response->status() == 404)
            return response()->json('not found', 404);

        elseif ($response->status() == 403)
            return response()->json('forbidden', 403);

        return success('deleted successfully');
    }

    public function export(){
        $time = Carbon::now()->format('m_d_H:i');
        return Excel::download(new CategoryExport() , "category_$time.xlsx");
    }
}
