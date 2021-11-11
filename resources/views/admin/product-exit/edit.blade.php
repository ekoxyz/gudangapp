@extends('layouts.admin.app')
@section('title', 'Edit Produk Keluar')
@push('styles')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    .stock-limit {
        display: none;
    }

</style>

@endpush

@section('content')
@include('layouts.messages')
<div id="alert">
</div>
<form action="{{ route('product-exit.update', $productExit->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
                            placeholder="L 1234 QW" value="{{ $productExit->plat_number }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date">Tanggal</label>
                        <input name="date" id="date" class="form-control" type="date" value="{{ $productExit->date }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="driver_name">Nama Driver</label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name"
                            placeholder="Paiman ..." value="{{ $productExit->driver_name }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="driver_phone">HP Driver</label>
                        <input type="number" class="form-control" id="driver_phone" name="driver_phone"
                            placeholder="08123..." value="{{ $productExit->driver_phone }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Notes</label>
                        <textarea class="form-control" id="description" name="description" rows="5"
                            placeholder="isikan catatan, kosongkan jika tidak ada">{{ $productExit->description }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address">Alamat Lengkap</label>
                        <textarea class="form-control" id="address" name="address" rows="5"
                            placeholder="Isikan Alamat Lengkap">{{ $productExit->address }}</textarea>
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
                    @foreach ($productExit->detail as $detail)
                    <div class="row product-group">
                        <input type="hidden" name="detail_id[]" value="{{ $detail->id }}">
                        <div class="form-group col-md-8">
                            <select name="product_id[]" class="form-control select2bs4"
                                style="max-width: 100% !important">
                                <option value=""></option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-stock="{{ $product->stock }}"
                                    {{$product->id == $detail->product_id ? 'selected':''}}>
                                    {{ $product->name .' [' . $product->stock . ']' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="number" class="form-control quantity" name="quantity[]" placeholder="Kuantiti."
                                value="{{ $detail->quantity }}" data-stock="{{ $detail->product->stock }}"
                                data-oldqty="{{ $detail->quantity }}">
                            <div class="text-danger stock-limit"></div>
                        </div>
                        <div class="form-group col-md-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-addmore"><i
                                        class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-sm btn-danger btn-delete"
                                    data-id="{{ $detail->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div id="add-more">
                        {{-- TEMPAT FORM INPUT BARU --}}
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit" value="save"
                        id="btn-save">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- FORM UNTUK DICOPY --}}
<div hidden id="data-select">
    @foreach ($products as $item)
    <option value="{{ $item->id }}" data-stock="{{ $item->stock }}">{{ $item->name .'[' . $item->stock . ']'}}</option>
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
            <select name="new_product_id[]" class="form-control new-select" style="max-width: 100% !important">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <input type="number" class="form-control new-quantity" name="new_quantity[]" placeholder="Kuantiti">
            <div class="text-danger stock-limit">Kuantiti Melebihi Stock</div>
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
        $(this).parents('.product-group').empty();
    });

    /**
     * for delete database using ajax
     */
    $(document).on('click', '.btn-delete', function () {
        if (!confirm("Yakin dihapus?")) {
            return false;
        }

        $(this).parents('.product-group').empty();
        let id = $(this).data('id');
        $.ajax({
            url: `{{ route('product-exit-detail.destroy') }}`,
            method: 'DELETE',
            data: {
                '_token': '{{ csrf_token() }}',
                id: id
            },
            success: function (response) {
                let alert = `
                <div class="alert alert-info alert-dismissible show fade" role="alert">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>` +
                    response.message + `
                    </div>
                </div>
                `;
                $('#alert').append(alert);
            }
        });
    });

    /**
     * untuk mengisi data-stock pada kolom input qty
     */
    $(document).on('change', '.select2bs4', function () {
        let stock = $(this).find(':selected').data('stock');
        let inputQty = $(this).parents().next().find(".quantity").first();
        inputQty.data('stock', stock);
        console.log(stock);
    });
    $(document).on('change', '.new-select', function () {
        let id = $(this).val();
        let stock = $(this).find(':selected').data('stock');
        let inputQty = $(this).parents().next().find(".new-quantity").first();
        inputQty.data('stock', stock);
    });

    /**
     * untuk cek apakah kuantiti melebihi stock yang tersedia
     */
    $(document).on('keyup', '.quantity', function () {
        let divLimit = $(this).next();
        divLimit.hide();
        $('#btn-save').prop('disabled', false);
        let newQty = $(this).val();
        let oldStock = $(this).data('stock');
        let oldQty = $(this).data('oldqty');
        let tempStock = oldStock+oldQty;
            if (newQty > tempStock) {
                divLimit.empty();
                let spanStock = `Kuantiti Melebihi Stock <small class="text-muted"> Stock Tersedia setelah di edit:`+tempStock+`</small>`
                divLimit.append(spanStock);
                divLimit.show();
                $('#btn-save').prop('disabled', true);
            }
        console.log("oldqty:" + oldQty);
        console.log("tempSTock:" + tempStock);
    });
    $(document).on('keyup', '.new-quantity', function () {
        let divLimit = $(this).next();
        divLimit.hide();
        $('#btn-save').prop('disabled', false);
        let qty = $(this).val();
        let stock = $(this).data('stock');
        if (qty > stock) {
            divLimit.show();
            $('#btn-save').prop('disabled', true);
        }
        console.log(stock);
    });

</script>
@endpush
