@extends('layouts.admin.app')
@section('title', 'Roles')

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
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nama</th>
                                <th>Guard</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $no => $item)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if ($item->guard_name == 'web')
                                    <span class="badge badge-primary">{{ $item->guard_name }}</span>
                                    @elseif ($item->guard_name == 'api')
                                    <span class="badge badge-danger">{{ $item->guard_name }}</span>
                                    @else
                                    <span class="badge badge-dark">{{ $item->guard_name }}</span>

                                    @endif

                                </td>
                                {{-- <td>{{ implode(', ', $item->getPermissionNames()->toArray()) }}</td> --}}
                                <td class="text-wrap" style="max-width: 100px">
                                    @foreach ($item->getPermissionNames()->toArray() as $permission)
                                    <span class="badge badge-danger">{{ $permission }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('assign.edit', $item) }}" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @if (count($roles2) !=0)
        <div class="card card-indigo">
            <div class="card-header">
                <h3 class="card-title">Tambah Role</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('assign.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="" selected disabled>Choose a Role</option>
                            @foreach ($roles2 as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple">
                            @foreach ($permissions as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Select a Permissions'
        });
    });

</script>
@endpush
