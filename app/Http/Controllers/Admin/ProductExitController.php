<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductExit;
use App\Models\ProductExitDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductExitController extends Controller
{

    public function index()
    {
        $productExits = ProductExit::orderBy('id', 'DESC')->paginate(10);
        return view('admin.product-exit.index',compact('productExits'));
    }
    public function create()
    {
        $products = Product::where('stock','>',0)->get();
        return view('admin.product-exit.create',compact('products') );
    }
    public function store(Request $request)
    {
        $newProductExit = new ProductExit();
        $newProductExit->date = Carbon::parse($request->date);
        $newProductExit->plat_number = $request->plat_number;
        $newProductExit->driver_name = $request->driver_name;
        $newProductExit->driver_phone = $request->driver_phone;
        $newProductExit->description = $request->description;
        $newProductExit->address = $request->address;
        $newProductExit->created_by = Auth::user()->email;
        $newProductExit->save();

        $productExitDetail = [];
        $lenght = sizeof($request->product_id);
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        for ($i = 0; $i < $lenght; $i++) {
            $product = Product::findOrFail($product_id[$i]);
            if ($product) {
                $data = [
                    'product_id' => $product_id[$i],
                    'product_exit_id' => $newProductExit->id,
                    'quantity' => $quantity[$i]
                ];
                array_push($productExitDetail, $data);
                $product->stock -= $quantity[$i];
                $product->update();
            }
        }
        ProductExitDetail::insert($productExitDetail);
        return back()->with('success', 'Berhasil Menambah Data!');
    }
    public function edit($id)
    {
        $productExit = ProductExit::with('detail')->findOrFail($id);
        $products = Product::all();
        return view('admin.product-exit.edit', compact('productExit', 'products'));
    }
    public function update(Request $request, $id)
    {
        $productExit = ProductExit::findOrFail($id);
        $productExit->date = Carbon::parse($request->date);
        $productExit->plat_number = $request->plat_number;
        $productExit->driver_name = $request->driver_name;
        $productExit->driver_phone = $request->driver_phone;
        $productExit->description = $request->description;
        $productExit->address = $request->address;
        $productExit->updated_by = User::authEmail();
        $productExit->update();

        /**
         * Update detail exit
         */
        $lenght = sizeof($request->detail_id);
        $detail_id = $request->detail_id;
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        for ($i = 0; $i < $lenght; $i++) {
            $detail_exit = ProductExitDetail::findOrFail($detail_id[$i]);
            $oldProduct = Product::findOrFail($detail_exit->product_id);
            $newProduct = Product::findOrFail($product_id[$i]);
            // $product = Product::findOrFail($product_id[$i]);
            $oldQty = $detail_exit->quantity;
            $newQty = $quantity[$i];

            if ($newProduct->id == $oldProduct->id) {
                $oldStock = $newProduct->stock;
                $newStock = ($oldStock+$oldQty)-$newQty;

                $detail_exit->quantity = $newQty;
                $detail_exit->product_id = $newProduct->id;
                $detail_exit->update();
                $newProduct->stock = $newStock;
                $newProduct->updated_by = User::authEmail();
                $newProduct->update();
            } else {
                /**
                 * mengembalikan stok awal pada produk yang salah pilih
                 */
                $oldProduct->stock += $oldQty;
                $oldProduct->updated_by = User::authEmail();
                $oldProduct->update();

                /**
                 * Menambahkan stok pada item produk yang terpilih
                 */
                $detail_exit->quantity = $newQty;
                $detail_exit->product_id = $newProduct->id;
                $detail_exit->update();
                $newProduct->stock -= $newQty;
                $newProduct->updated_by = User::authEmail();
                $newProduct->update();
            }
        }

        /**
         * Add new data from update form
         */
        if ($request->new_product_id) {
            $newProductExitDetail = [];
            $newLenght = sizeof($request->new_product_id);
            $newProductId = $request->new_product_id;
            $newQuantity = $request->new_quantity;
            for ($i = 0; $i < $newLenght; $i++) {
                $product = Product::findOrFail($newProductId[$i]);
                if ($product) {
                    $data = [
                        'product_id' => $newProductId[$i],
                        'product_exit_id' => $productExit->id,
                        'quantity' => $newQuantity[$i]
                    ];
                    array_push($newProductExitDetail, $data);
                    $product->stock -= $newQuantity[$i];
                    $product->update();
                }
            }
            ProductExitDetail::insert($newProductExitDetail);
        }
        return back()->with('success', 'Berhasil Update Data!');

    }
}
