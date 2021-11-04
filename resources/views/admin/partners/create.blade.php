@extends('layouts.admin.app')
@section('title', 'Create Partner')
@push('styles')

@endpush
@section('content-header')
<div class="col-sm-6">
    <h1>Tambah Partner</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('partners.index') }}">Partner</a></li>
        <li class="breadcrumb-item active">Tambah Partner</li>
    </ol>
</div>
@endsection
@section('content')
@include('layouts.messages')
<div class="row py-4 mx-4">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Partner</h3>
            </div>
            <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Nama Partner</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="PT. Ladang ...">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="example@mail.com">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    placeholder="082240xxxx">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea type="text" class="form-control" id="address" name="address"
                                    placeholder="jl. Kutisari ... " rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
