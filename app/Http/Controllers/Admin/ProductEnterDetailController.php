<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductEnterDetail;
use Illuminate\Http\Request;

class ProductEnterDetailController extends Controller
{
    public function destroy($id)
    {
        $detail = ProductEnterDetail::findorFail($id);
        $product = Product::findOrFail($detail->product_id);
        $product->stock -= $detail->quantity;
        $product->update();
        $detail->forceDelete();
        return back()->with('success','Berhasil Hapus Data.');
    }
}
