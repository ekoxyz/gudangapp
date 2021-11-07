@extends('layouts.admin.app')
@section('title', 'Product Enter')
@push('styles')

@endpush

@section('content')
<div class="row py-4 mx-4">
    <div class="col-md-12">
        <div class="card py-4">
            <div class="card-header">
                <a href="{{ route('product-enter.create') }}" class="btn btn-warning">
                    <i class="fas fa-plus"></i>
                    Tambah Barang Masuk
                </a>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        {{ $productEnters->links() }}
                    </ul>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-responsive-md table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Plat Nomor</th>
                            <th>Nama Driver</th>
                            <th>Total Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productEnters as $item)
                        <tr>
                            <td>{{$item->date}}</td>
                            <td>{{$item->plat_number}}</td>
                            <td>
                                {{$item->driver_name}} <br>
                                <span class="text-muted">{{$item->driver_phone}}</span>

                            </td>
                            <td>{{$item->enterDetail->sum('quantity')}}</td>
                            <td>
                                <form id="delete-form" action="#" method="POST" class=""
                                    onsubmit="return confirm('Delete this User Permanently?')">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <a href="{{ route('product-enter.edit', $item->id) }}" class="btn btn-sm btn-info btn-edit"> <i
                                            class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
