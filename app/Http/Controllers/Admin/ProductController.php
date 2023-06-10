<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    // private $url = '192.168.1.106:8080';
    private $url = '127.0.0.1:8080';
    private $token;

    public function __construct()
    {
        $this->token = Session::get('token');
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
            $response = Http::withToken($this->token)->get($this->url . '/admin/product');
            if ($response->status() != 200)
                abort($response->status());

            $data = $response->json();
            // return $response->json();
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
            ['link' => "/Admin/dashboard", 'name' => "Home"], ['name' => "admins"]
        ];

        $response=Http::withToken($this->token)->get($this->url.'/admin/category/get-active-category');
        if($response->status() != 200)
            return redirect()->route('product.index')->with(['error'=>'some things went wronsg']);
        $categories =$response->json();
        return view('admin.products.create', compact('breadcrumbs','categories'));
    }

    public function store(Request $request)
    {
        // return $request ;
        $data = $request->only('name_en', 'description_en','price','is_special','category_id','details_en');
         $response = Http::withToken($this->token)->attach(
            'image',
            file_get_contents($request->image),
            $request->image->getClientOriginalName()
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
        $response = Http::withToken($this->token)->get($this->url . '/admin/product/' . $id);
        if ($response->status() != 200)
            return response()->json(['message' => 'some things went wrongs'], $response->status());

        return $response->json();
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->only('name_en', 'description_en','_method');

        if ($request->has('image')){
            // return 'image';
            $response = Http::withToken($this->token)->attach(
                'image',
                file_get_contents($request->image),
                $request->image->getClientOriginalName()
            )->post($this->url . '/admin/category/' . $id, $data);
            }
        else
            $response = Http::withToken($this->token)
                ->post($this->url . '/admin/category/' . $id, $data);

        if ($response->status() != 200)
            return failure($response->json(), $response->status());

        return success('updated successfully');
    }

    public function changeStatus($id)
    {
        $response = Http::withToken($this->token)->get($this->url . '/admin/product/change-status/' . $id);
        if ($response->status() == 404)
            return failure('not found', 404);

        elseif ($response->status() == 403)
            return failure('forbidden', 403);

        return success('status changed successfully');
    }

    public function destroy($id)
    {
        $response = Http::withToken($this->token)->delete($this->url . '/admin/product/' . $id);
        if ($response->status() == 404)
            return response()->json('not found', 404);

        elseif ($response->status() == 403)
            return response()->json('forbidden', 403);

        return success('deleted successfully');
    }
}
