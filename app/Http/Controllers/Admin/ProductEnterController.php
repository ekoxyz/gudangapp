<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductEnterController extends Controller
{
    public function index()
    {
        return view('admin.product-enter.index');
    }
    public function create()
    {
        $products = Product::all();
        return view('admin.product-enter.create', compact('products'));
    }
    public function store(Request $request)
    {
        return $request;
    }
}
