@extends('layouts.admin.app')
@section('title', 'Categories')
@section('styles')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content-header')
<div class="col-sm-6">
    <h1>Category</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Category</li>
    </ol>
</div>
@endsection

@section('content')
@include('layouts.messages')
<div class="row py-4 mr-4 ml-4">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kategori</h3>
            </div>
            <!-- ./card-header -->
            <div class="card-body p-0">
                <table class="table table-hover">
                    <tbody>
                        @foreach ($parentCategory as $item)
                        @if (!count($item->children))
                        <tr>
                            <td>
                                {{ $item->name }}
                            </td>
                        </tr>
                        @else
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>
                                <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                {{ $item->name }}
                            </td>
                        </tr>
                        <tr class="expandable-body d-none">
                            <td>
                                <div class="p-0" style="display: none;">
                                    @include('admin.categories.child', ['childs'=> $item->children])
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
                        <select name="parent_id" id="parent_id" class="form-control select2bs4"
                            style="max-width: 100% !important">
                            <option value="" disabled selected>Chosee Option</option>
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

@push('scripts')
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });

</script>
@endpush
