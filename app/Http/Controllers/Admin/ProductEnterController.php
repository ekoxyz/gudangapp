<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Product;
use App\Models\ProductEnter;
use App\Models\ProductEnterDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductEnterController extends Controller {
    public function index() {
        $productEnters=ProductEnter::orderBy('id', 'DESC')->paginate(10);
        return view('admin.product-enter.index', compact('productEnters'));
    }

    public function create() {
        $products=Product::all();
        $partners=Partner::all();
        return view('admin.product-enter.create', compact('products', 'partners'));
    }

    public function store(Request $request) {
        $request->validate([ 'plat_number'=> ['required'],
            'date'=> ['required'],
            'driver_name'=> ['required'],
            'partner_id'=> ['required'],
            'product_id'=> ['required'],
            'quantity'=> ['required']]);

        $newProductEnter=new ProductEnter();
        $newProductEnter->partner_id=$request->partner_id;
        $newProductEnter->date=Carbon::parse($request->date);
        $newProductEnter->plat_number=$request->plat_number;
        $newProductEnter->driver_name=$request->driver_name;
        $newProductEnter->driver_phone=$request->driver_phone;
        $newProductEnter->description=$request->description;
        $newProductEnter->created_by=Auth::user()->email;
        $newProductEnter->save();

        $productEnterDetail=[];
        $lenght=sizeof($request->product_id);
        $product_id=$request->product_id;
        $quantity=$request->quantity;

        for ($i=0; $i < $lenght; $i++) {
            $product=Product::findOrFail($product_id[$i]);

            if ($product) {
                $data=[ 'product_id'=>$product_id[$i],
                'product_enter_id'=>$newProductEnter->id,
                'quantity'=>$quantity[$i]];
                array_push($productEnterDetail, $data);
                $product->stock+=$quantity[$i];
                $product->update();
            }
        }

        ProductEnterDetail::insert($productEnterDetail);
        return back()->with('success', 'Berhasil Menambah Data!');
    }

    public function edit($id) {
        $productEnter=ProductEnter::with('enterDetail')->findorFail($id);
        $products=Product::all();
        $partners=Partner::all();
        return view('admin.product-enter.edit', compact('productEnter', 'products', 'partners'));
    }

    public function update(Request $request, $id) {
        $productEnter=ProductEnter::findOrFail($id);
        $productEnter->partner_id=$request->partner_id;
        $productEnter->date=Carbon::parse($request->date);
        $productEnter->plat_number=$request->plat_number;
        $productEnter->driver_name=$request->driver_name;
        $productEnter->driver_phone=$request->driver_phone;
        $productEnter->description=$request->description;
        $productEnter->updated_by= User::authEmail();
        $productEnter->update();

        /**
         * Udate the detail is exist
         */
        $lenght=sizeof($request->detail_id);
        $detail_id=$request->detail_id;
        $product_id=$request->product_id;
        $quantity=$request->quantity;

        for ($i=0; $i < $lenght; $i++) {
            $detail_enter=ProductEnterDetail::findOrFail($detail_id[$i]);
            $oldProduct=Product::findOrFail($detail_enter->product->id);
            $newProduct=Product::findOrFail($product_id[$i]);
            $oldQty=$detail_enter->quantity;
            $newQty=$quantity[$i];
            if ($newProduct->id==$oldProduct->id) {
                /**
                 * Inisiasi data
                 */
                $oldStock=$newProduct->stock;
                $newStock=($oldStock-$oldQty)+$newQty;
                /**
                 * Save Data
                 */
                $detail_enter->quantity=$newQty;
                $detail_enter->product_id=$newProduct->id;
                $detail_enter->update();
                $newProduct->stock=$newStock;
                $newProduct->updated_by = User::authEmail();
                $newProduct->update();
            }else {
                /**
                 * mengurangi data stock untuk data barang yang salah dipilih
                 */
                $oldProduct->stock -= $oldQty;
                $oldProduct->update();
                /**
                 * Menambah stock pada product baru
                 */
                $detail_enter->quantity=$newQty;
                $detail_enter->product_id=$newProduct->id;
                $detail_enter->update();
                $newProduct->stock += $newQty;
                $newProduct->updated_by = User::authEmail();
                $newProduct->update();
            }
        }
        /**
         * Add new data from update form
         */
        if ($request->new_product_id) {
            $newProductEnterDetail=[];
            $newLenght=sizeof($request->new_product_id);
            $newProductId=$request->new_product_id;
            $newQuantity=$request->new_quantity;
            for ($i=0; $i < $newLenght; $i++) {
                $product=Product::findOrFail($newProductId[$i]);
                if ($product) {
                    $data=[ 'product_id'=>$newProductId[$i],
                    'product_enter_id'=>$productEnter->id,
                    'quantity'=>$newQuantity[$i]];
                    array_push($newProductEnterDetail, $data);
                    $product->stock+=$newQuantity[$i];
                    $product->update();
                }
            }
            ProductEnterDetail::insert($newProductEnterDetail);
        }
        return back()->with('success', 'Berhasil Update Data!');
    }
}
