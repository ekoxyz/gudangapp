@extends('layouts.admin.app')
@section('title', 'Partners')
@push('styles')

@endpush
@section('content-header')
<div class="col-sm-6">
    <h1>Partners</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Partners</li>
    </ol>
</div>
@endsection
@section('content')
@include('layouts.messages')
<div class="row py-4 mx-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('partners.create') }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-plus"></i>
                    Tambah Partner
                </a>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        {{ $partners->links() }}
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partners as $no => $item)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td class="text-wrap">
                                {{ $item->name }}
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone}}</td>
                            <td>
                                <a href="{{ route('partners.edit', $item) }}" class="btn btn-sm btn-primary">Edit</a>
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

@push('scripts')

@endpush
