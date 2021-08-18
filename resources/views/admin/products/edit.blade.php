@extends('layouts.admin.app')
@section('title', 'Edit Product')
@section('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content-header')
<div class="col-sm-6">
    <h1>Edit Produk : {{ $product->name }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Produk</a></li>
        <li class="breadcrumb-item active">Edit Produk</li>
    </ol>
</div>
@endsection
@section('content')
@include('layouts.messages')
<div class="row py-4 mx-4">
    <div class="col-md-8">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Produk</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="SKU">SKU</label>
                        <input type="text" class="form-control" id="SKU" name="sku" placeholder="Stock Keeping Unit"
                            value="{{ $product->sku }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="laptop 14 inch ..."
                            value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="6"
                            placeholder="lorem ....">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="lorem ...."
                            value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="lorem ...."
                            value="{{ $product->stock }}">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control select2 select2bs4"
                            style="width: 100% !important">
                            <option value="" selected disabled> -- pilih kategory --- </option>
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}" {{$product->category_id == $item->id ? "selected" : ""}}>
                                {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="PRODUCT_PUBLISHED" {{$product->status == 'PRODUCT_PUBLISHED' ? 'selected' : ''}} >Publish</option>
                                    <option value="PRODUCT_ARCHIVED" {{$product->status == 'PRODUCT_PUBLISHED' ? 'selected' : ''}}>Arsipkan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('products.index') }}" class="ml-4 text-gray">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
        bsCustomFileInput.init();
    });
    $('.select2').select2()
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

</script>
@endpush
