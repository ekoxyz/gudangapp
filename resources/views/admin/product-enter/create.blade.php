@extends('layouts.admin.app')
@section('title', 'Create Product Enter')
@push('styles')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endpush

@section('content')
@include('layouts.messages')
<form action="{{ route('product-enter.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row py-4 mx-4">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Kendaraan</h3>
                </div>
                <div class="card-body p-4 row">
                    <div class="form-group col-md-3">
                        <label for="plat_number">Plat Nomor</label>
                        <input type="text" class="form-control" id="plat_number" name="plat_number"
                            placeholder="L 1234 QW">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date">Tanggal</label>
                        <input name="date" id="date" class="form-control" type="date">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="driver_name">Nama Driver</label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name"
                            placeholder="Paiman ...">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="driver_phone">HP Driver</label>
                        <input type="number" class="form-control" id="driver_phone" name="driver_phone"
                            placeholder="08123...">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="partner_id">Partner</label>
                        <select name="partner_id" id="partner_id" class="form-control"
                            style="max-width: 100% !important">
                            <option value=""></option>
                            @foreach ($partners as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="description">Notes</label>
                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="isikan catatan, kosongkan jika tidak ada"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Detail Barang</h3>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="form-group col-md-8">
                            <select name="product_id[]" class="form-control select2bs4"
                                style="max-width: 100% !important">
                                <option value=""></option>
                                @foreach ($products as $item)
                                <option value="{{ $item->id }}" >{{ $item->name .' [' . $item->id . ']' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="number" class="form-control" name="quantity[]"
                                placeholder="Kuantiti.">
                        </div>
                        <div class="form-group col-md-2">
                            <button type="button" class="btn btn-success btn-addmore">Tambah</button>
                        </div>
                    </div>
                    <div id="add-more">
                        {{-- TEMPAT FORM INPUT BARU --}}
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- FORM UNTUK DICOPY --}}
<div hidden id="data-select">
    @foreach ($products as $item)
    <option value="{{ $item->id }}">{{ $item->name .' [' . $item->id . ']'}}</option>
    @endforeach
</div>
@endsection

@push('scripts')
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            placeholder: "Select a Product"
        });
        $('#partner_id').select2({
            theme: 'bootstrap4',
            placeholder: "Select a Partner"
        });
    });

    $(document).on('click', '.btn-addmore', function () {
        let copyForm = `
        <div class="row product-group">
        <div class="form-group col-md-8 select-div">
            <select name="product_id[]" class="form-control new-select" style="max-width: 100% !important">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <input type="number" class="form-control" name="quantity[]" placeholder="Kuantiti">
        </div>
        <div class="form-group col-md-2">
            <button type="button" class="btn btn-danger btn-remove">Hapus</button>
        </div>
    </div>
        `;
        $('#add-more').append(copyForm);
        let dataSelect = $('#data-select').html();
        $('.new-select').append(dataSelect);
        $('.new-select').select2({
            theme: 'bootstrap4',
            placeholder: "Select a Product"
        });
    });
    $('body').on('click', '.btn-remove', function () {
        console.log('hapus');
        $(this).parents('.product-group').empty();
    });

</script>
@endpush
