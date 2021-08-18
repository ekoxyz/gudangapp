@extends('layouts.admin.app')
@section('title', 'Products')
@section('styles')

@endsection

@section('content-header')
<div class="col-sm-6">
    <h1>Produk</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
    </ol>
</div>
@endsection
@section('content')
@include('layouts.messages')
<div class="row py-4 mx-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Produk</h3>
                <div class="card-tools">
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-plus"></i>
                        Tambah Produk
                    </a>
                    <ul class="pagination pagination-sm float-right">
                        {{ $products->links() }}
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 40%">Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $no => $item)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td class="text-wrap">
                                {{ $item->name }}
                                <br>
                                <span class="text-muted">{{ $item->sku }}</span>
                            </td>
                            @if ($item->category)
                            <td>{{ $item->category->name }}</td>
                            @else
                            <td>---</td>
                            @endif
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <a href="{{ route('products.edit', $item) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection

@push('script')

@endpush
