@extends('layouts.admin.app')
@section('title', 'Roles')

@section('styles')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
<style>
    .select2-selection__choice{
        color: #495057 !important
    }.select2 {
        width: 100% !important;
    }
</style>
@endsection

@section('content')
@include('layouts.messages')
<div class="row py-4 mr-4 ml-4">
    <div class="col-md-6">
        <div class="card card-indigo">
            <div class="card-header">
                <h3 class="card-title">Sync Role & Permissions for {{ $role->name }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('assign.update', $role) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" name="role" id="role" value="{{ $role->name }}" readonly>
                        @error('role')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <select name="permissions[]" id="permissions" class="form-control select2 text-dark" multiple>
                            @foreach ($permissions as $item)
                            <option {{ $role->permissions()->find($item->id) ? "selected":"" }} value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('permissions')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('admin/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Select a Permissions"
        });
    });

</script>
@endpush
