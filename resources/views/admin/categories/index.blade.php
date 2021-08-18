@extends('layouts.admin.app')
@section('title', 'Categories')
@section('styles')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<style>
    .cell-action {
        width: 25%
    }

</style>
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
        <div class="card card-teal">
            <div class="card-header">
                <h3 class="card-title">Kategori</h3>
            </div>
            <!-- ./card-header -->
            <div class="card-body p-0">
                <table class="table table-hover table-bordered">
                    <tbody>
                        @foreach ($parentCategory as $item)
                        @if (!count($item->children))
                        <tr>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td class="cell-action">
                                <form id="delete-form" action="{{ route('categories.destroy', $item) }}" method="POST"
                                    class="" onsubmit="return confirm('Delete this User Permanently?')">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-edit" data-toggle="modal"
                                            data-target="#modal-edit" data-id="{{ $item }}"
                                            data-all="{{ $categories }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @else
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>
                                <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                {{ $item->name }}
                            </td>
                            <td class="cell-action">
                                <form id="delete-form" action="{{ route('categories.destroy', $item) }}" method="POST"
                                    class="" onsubmit="return confirm('Delete this User Permanently?')">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-edit" data-toggle="modal"
                                            data-target="#modal-edit" data-id="{{ $item }}"
                                            data-all="{{ $categories }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        {{-- <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button> --}}
                                    </div>
                                </form>
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

    {{-- ADD CATEGORY --}}
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
                            <option value="" disabled selected>Choose Option</option>
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

{{-- MODAL EDIT --}}
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="form-update">
                <div class="modal-body">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_edit">Name</label>
                            <input type="text" class="form-control" name="name_edit" id="name_edit"
                                placeholder="Your Name...">
                            @error('name')
                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="parent_i_edit">Parent Kategori</label>
                            <select name="parent_id_edit" id="parent_id_edit" class="form-control select2bs4"
                                style="max-width: 100% !important">
                            </select>
                            @error('parent_id')
                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

@push('scripts')
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });

    $('.btn-edit').click(function () {
        let data = $(this).attr('data-id');
        let categories = $(this).attr('data-all');
        let jsonData = JSON.parse(data);
        let jsonCategories = JSON.parse(categories);

        let nameCategories = jsonData.name;
        let idCategories = jsonData.id;
        let parentId = jsonData.parent_id;
        $('#name_edit').val(nameCategories);
        $('#parent_id_edit').empty();
        $('#parent_id_edit').append('<option value="" selected disabled>' + "---=---" + '</option>');
        $.each(jsonCategories, function (key, value) {
            if (value.id == parentId) {
                $('#parent_id_edit').append('<option value="' + value.id + '" selected>' + value.name +
                    '</option>');
            } else {
                $('#parent_id_edit').append('<option value="' + value.id + '">' + value.name +
                    '</option>');
            }
        });
        $('#form-update').attr('action', '/admin/categories/' + idCategories);
    });

</script>
@endpush
