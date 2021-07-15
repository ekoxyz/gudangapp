@extends('layouts.admin.app')
@section('title', 'Categories')
@section('styles')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
<style>
    .select2-selection__choice {
        color: #495057 !important
    }

    .select2 {
        width: 100% !important;
    }

</style>
@endsection

@section('content')
@include('layouts.messages')
<div class="row py-4 mr-4 ml-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Image</th>
                            <th>Nama</th>
                            <th>slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-4">
        @can('create user')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Categories</h3>
            </div>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name...">
                        @error('name')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent Kategori</label>
                        <select name="parent_id[]" id="parent_id" class="form-control select2" multiple="multiple">
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        @endcan
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Select a Permissions'
        });
    });
</script>
@endpush


