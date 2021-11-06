<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Product;
use App\Models\ProductEnter;
use App\Models\ProductEnterDetail;
use Carbon\Carbon;
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
        $partners = Partner::all();
        return view('admin.product-enter.create', compact('products', 'partners'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'plat_number' => ['required'],
            'date' => ['required'],
            'driver_name' => ['required'],
            'partner_id' => ['required'],
            'product_id' => ['required'],
            'quantity' => ['required']
        ]);

        $newProductEnter = new ProductEnter();
        $newProductEnter->partner_id = $request->partner_id;
        $newProductEnter->date = Carbon::parse($request->date);
        $newProductEnter->plat_number = $request->plat_number;
        $newProductEnter->driver_name = $request->driver_name;
        $newProductEnter->driver_phone = $request->driver_phone;
        $newProductEnter->description = $request->description;
        $newProductEnter->save();

        $productEnterDetail = [];
        $lenght = sizeof($request->product_id);
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        for ($i = 0; $i < $lenght; $i++) {
            $product = Product::findOrFail($product_id[$i]);
            if ($product) {
                $data = [
                    'product_id' => $product_id[$i],
                    'product_enter_id' => $newProductEnter->id,
                    'quantity' => $quantity[$i]
                ];
                array_push($productEnterDetail, $data);
                $product->stock += $quantity[$i];
                $product->update();
            }
        }
        ProductEnterDetail::insert($productEnterDetail);
        return back()->with('success', 'Success Menambah Data!');
    }
}
