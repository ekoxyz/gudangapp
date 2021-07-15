@extends('layouts.admin.app')
@section('title', 'Roles')

@section('content')
@include('layouts.messages')
<div class="row py-4 mr-4 ml-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th>Create</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $no => $item)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if ($item->guard_name == 'web')
                                <span class="badge badge-info">{{ $item->guard_name }}</span>
                                @elseif ($item->guard_name == 'api')
                                <span class="badge badge-danger">{{ $item->guard_name }}</span>
                                @else
                                <span class="badge badge-dark">{{ $item->guard_name }}</span>

                                @endif

                            </td>
                            <td>todo</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Tambah Permission</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Permission</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="nama permission ...">
                    </div>
                    <div class="form-group">
                        <label for="guard_name">Guard Nama Permission</label>
                        <input type="text" class="form-control" name="guard_name" id="guard_name" placeholder='default "web"'>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
