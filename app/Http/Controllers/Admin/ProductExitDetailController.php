<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductExitDetail;
use Illuminate\Http\Request;

class ProductExitDetailController extends Controller
{
    public function destroy()
    {
        $id = request('id');
        $detail = ProductExitDetail::findorFail($id);
        $product = Product::findOrFail($detail->product_id);
        $product->stock += $detail->quantity;
        $product->update();
        $detail->forceDelete();
        return response()->json([
            'message' => 'Success Delete'
        ]);
    }
}
