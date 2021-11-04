@extends('layouts.admin.app')
@section('title', 'Product Enter')
@push('styles')

@endpush

@section('content')
<div class="row py-4 mx-4">
    <div class="col-md-12">
        <div class="card py-4">
            <div class="card-header">
                <a href="{{ route('product-enter.create') }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-plus"></i>
                    Tambah Barang Masuk
                </a>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        {{-- {{ $products->links() }} --}}
                    </ul>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-responsive-sm table-responsive-md">
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
