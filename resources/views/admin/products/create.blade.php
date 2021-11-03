@extends('layouts.admin.app')
@section('title', 'Create Product')
@section('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content-header')
<div class="col-sm-6">
    <h1>Tambah Produk</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Produk</a></li>
        <li class="breadcrumb-item active">Tambah Produk</li>
    </ol>
</div>
@endsection
@section('content')
@include('layouts.messages')
<div class="row py-4 mx-4">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Produk</h3>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-4">
                    <div class="form-group">
                        <label for="SKU">SKU</label>
                        <div class="input-group mb-3">
                            <input type="text" id="sku" name="sku" class="form-control"
                                placeholder="Klik tombol untuk generate" aria-label="Klik tombol untuk generate"
                                aria-describedby="btn-generate-sku">
                            <div class="input-group-append">
                                <button class="btn btn-outline-info" type="button"
                                    id="btn-generate-sku">Generate</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="laptop 14 inch ...">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="6"
                            placeholder="terkait spek produk ..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="harga isikan angka ...">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="stock">Stok</label>
                                <input type="number" class="form-control" id="stock" name="stock" placeholder="isikan berupa angka ...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select name="category" id="category" class="form-control select2 select2bs4"
                            style="width: 100% !important">
                            <option value="" selected disabled> -- pilih kategory --- </option>
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
{{-- FOR GENERATE RANDOM STRING SKU --}}
<script>
    $('#btn-generate-sku').click(function () {
        let sku = randomString(10);
        $('#sku').val(sku);
    });

    function randomString(length) {
        let result = '';
        let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                characters.length));
        }
        return result;
    }

</script>
@endpush
