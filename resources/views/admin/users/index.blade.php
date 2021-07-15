@extends('layouts.admin.app')
@section('title', 'Users')
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
                        {{ $users->links() }}
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $no => $item)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>
                                {{ $item->name }}
                                <span>(&#35;{{ $item->id }})</span>
                                <br>
                                <span class="text-muted">{{ $item->email }}</span>
                            </td>
                            <td class="text-wrap" style="max-width: 100px">
                                @foreach ($item->getRoleNames()->toArray() as $permission)
                                <span class="badge badge-danger">{{ $permission }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $item) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-4">
        @can('create user')
        <div class="card card-indigo">
            <div class="card-header">
                <h3 class="card-title">Tambah User</h3>
            </div>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="example@mail.com">
                        @error('email')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="roles">Roles</label>
                        <select name="roles[]" id="roles" class="form-control select2" multiple="multiple">
                            @foreach ($roles as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('permissions')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
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
        $('.select2').select2({
            placeholder: 'Select a Permissions'
        });
    });
</script>
@endpush
