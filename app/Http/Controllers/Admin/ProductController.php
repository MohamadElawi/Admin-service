<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    // private $url = '192.168.1.106:8080';
    private $url;
    private $token;

    public function __construct()
    {
        $this->url = env('PRODUCT_SERVICE_PORT');
        $this->token = Session::get('token');
        $this->middleware('permission:view product')->only('index', 'getData');
        $this->middleware('permission:create product')->only('create', 'store');
        $this->middleware('permission:edit product')->only('update');
        $this->middleware('permission:change status product')->only('changeStatus');
        $this->middleware('permission:delete product')->only('destroy');
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "products"]
        ];
        return view('admin.products.index', compact('breadcrumbs'));
    }

    public function getData()
    {
        try {
            $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/product');
            if ($response->status() != 200)
                abort($response->status());

            $data = $response->json();

            return DataTables::of($data)
                ->addColumn('action', 'admin.products.action')
                ->addIndexColumn()
                ->make(true);
        } catch (HttpException $ex) {
        }
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "products", 'link' => 'Admin/products']
        ];

        $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/category/get-active-category');
        if ($response->status() != 200)
            return redirect()->route('product.index')->with(['error' => 'some things went wronsg']);
        $categories = $response->json();
        return view('admin.products.create', compact('breadcrumbs', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->only('name_en', 'description_en', 'price', 'is_special', 'quantity', 'category_id', 'details_en');
        $response = Http::withToken(Session::get('token'))->attach(
            'main_image',
            file_get_contents($request->main_image),
            $request->main_image->getClientOriginalName()
        )->post($this->url . '/admin/product', $data);

        if ($response->status() == 400)
            return 'not authorize';

        elseif ($response->status() == 403)
            return 'forbidden';

        elseif ($response->status() == 200)
            return redirect()->route('product.index')->with(['success' => 'created successfully']);
    }

    public function show($id)
    {
        $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/product/' . $id);
        if ($response->status() != 200)
            return response()->json(['message' => 'some things went wrongs'], $response->status());

        return $response->json();
    }

    public function edit($id)
    {
        $breadcrumbs = [
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "products", 'link' => 'Admin/products']
        ];

        $response = Http::withToken(Session::get('token'))->get($this->url . "/admin/product/$id");
        if ($response->status() != 200)
            return redirect()->route('product.index')->with(['error' => 'some things went wronsg']);

        $product = $response->json();

        $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/category/get-active-category');
        if ($response->status() != 200)
            return redirect()->route('product.index')->with(['error' => 'some things went wronsg']);

        $categories = $response->json();
        return view('admin.products.edit', compact('breadcrumbs', 'categories', 'product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();
        $data['_method'] = 'put';
        if ($request->has('main_image')) {
            $response = Http::withToken(Session::get('token'))->attach(
                'main_image',
                file_get_contents($request->main_image),
                $request->main_image->getClientOriginalName()
            )->post($this->url . '/admin/product/' . $id, $data);
        } else
            $response = Http::withToken(Session::get('token'))
                ->post($this->url . '/admin/product/' . $id, $data);

        if ($response->status() != 200)
            return failure($response->json(), $response->status());

        return redirect()->route('product.index')->with(['success' => 'created successfully']);
    }

    public function changeStatus($id)
    {
        $response = Http::withToken(Session::get('token'))->get($this->url . '/admin/product/change-status/' . $id);
        if ($response->status() == 404)
            return failure('not found', 404);

        elseif ($response->status() == 403)
            return failure('forbidden', 403);

        return success('status changed successfully');
    }

    public function destroy($id)
    {
        $response = Http::withToken(Session::get('token'))->delete($this->url . '/admin/product/' . $id);
        if ($response->status() == 404)
            return response()->json('not found', 404);

        elseif ($response->status() == 403)
            return response()->json('forbidden', 403);

        return success('deleted successfully');
    }

    public function export(){
        $time = Carbon::now()->format('m_d_H:i');
        return Excel::download(new ProductExport() , "product_$time.xlsx");
    }
}
