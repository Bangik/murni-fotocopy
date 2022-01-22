@extends('layouts.admin.app')

@section('css-admin')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content-admin')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{route('transactions.index')}}">Transaksi</a></div>
                <div class="breadcrumb-item">Tambah Transaksi</div>
            </div>
        </div>
        <div class="section-body">
            <form action="{{route('transactions.store')}}" method="POST" class="transaction-form">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Transaksi</h4>
                            </div>
                            <div class="card-body">
                                <table class="table-responsive">
                                    <thead>
                                        <tr class="d-flex">
                                            <th class="col-4">Nama</th>
                                            <th class="col-2">Harga</th>
                                            <th class="col-2">Jumlah</th>
                                            <th class="col-3">Subtotal</th>
                                            <th class="col-1">#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="add-more-product">
                                        <tr class="d-flex">
                                            <td class="col-4">
                                                <select class="form-control select2 @error('product') is-invalid @enderror product" name="product[]" id="product">
                                                    <option value="">Pilih</option>
                                                    @foreach ($products as $key => $category)
                                                    <optgroup label="{{$key}}">
                                                        @foreach ($category as $product)
                                                        <option data-price="{{$product->price}}" value="{{$product->id}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="col-2">
                                                <input type="text" class="form-control @error('price') is-invalid @enderror price" name="price[]" id="price" readonly>
                                            </td>
                                            <td class="col-2">
                                                <input type="number" class="form-control @error('quantity') is-invalid @enderror quantity" name="quantity[]" id="quantity" min="1" value="1">
                                            </td>
                                            <td class="col-3">
                                                <input type="text" class="form-control @error('subtotal') is-invalid @enderror subtotal" name="subtotal[]" id="subtotal" readonly>
                                            </td>
                                            <td class="col-1">
                                                <button type="button" class="btn btn-primary add-product"><i class="fas fa-plus"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Total : <b class="total">0</b> </h4>
                            </div>
                            <div class="card-body">
                                <h5>Total </h5>
                                <input type="text" class="form-control @error('total') is-invalid @enderror" name="total" id="total" readonly>
                                <h5>Bayar </h5>
                                <input type="number" class="form-control @error('pay') is-invalid @enderror pay" name="pay" id="pay" min="0">
                                <h5>Kembalian </h5>
                                <input type="number" class="form-control @error('change') is-invalid @enderror change" name="change" id="change" readonly>
                                <input type="hidden" id="status" name="status">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block" id="btn-pay-lunas">Bayar</button>
                                <button type="submit" class="btn btn-danger btn-block" id="btn-pay-bon">Bon</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-receipt" tabindex="-1" role="dialog" aria-labelledby="modal-receipt" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Transaksi Sukses!!
            </div>
            <div class="modal-footer">
                <a href="" target="_blank" class="btn btn-primary" id="print-nota">Print Nota</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Transaksi Baru</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-admin')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('.add-product').click(function() {
            let product = $('#product').html();
            let tr = `<tr class="d-flex added-product">
                        <td class="col-4">
                            <select class="form-control select2 @error('product') is-invalid @enderror product" name="product[]" id="product">
                                ${product}
                            </select>
                        </td>
                        <td class="col-2">
                            <input type="text" class="form-control @error('price') is-invalid @enderror price" name="price[]" id="price" readonly>
                        </td>
                        <td class="col-2">
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror quantity" name="quantity[]" id="quantity" min="1" value="1">
                        </td>
                        <td class="col-3">
                            <input type="text" class="form-control @error('subtotal') is-invalid @enderror subtotal" name="subtotal[]" id="subtotal" readonly>
                        </td>
                        <td class="col-1">
                            <button type="button" class="btn btn-danger remove-product"><i class="fas fa-minus"></i></button>
                        </td>
                    </tr>`;
            $('.add-more-product').append(tr);
            $('.select2').select2();
        });

        function totals(){
            let total = 0;
            $('.subtotal').each(function(index, el) {
                total += $(this).val() - 0;
            });
            $('.total').html(total);
            $('#total').val(total);
        }

        $('.add-more-product').delegate('.product', 'change', function() {
            let tr = $(this).parent().parent();
            let price = tr.find('.product option:selected').data('price');
            tr.find('.price').val(price);
            let quantity = tr.find('#quantity').val();
            let subtotal = price * quantity;
            tr.find('.subtotal').val(subtotal);
            totals();
        });

        $('.add-more-product').delegate('.quantity', 'keyup click', function() {
            let tr = $(this).parent().parent();
            let price = tr.find('.product option:selected').data('price');
            let quantity = tr.find('.quantity').val();
            let subtotal = price * quantity;
            tr.find('.subtotal').val(subtotal);
            totals();
        });

        $('.add-more-product').delegate('.remove-product', 'click', function() {
            $(this).parent().parent().remove();
            totals();
            $('.select2').select2();
        });

        $('.pay').on('keyup click',function() {
            let total = $('.total').html();
            let pay = $('.pay').val();
            let change = pay - total;
            $('.change').val(change);
        });

        function submitPayment() {
            let form = $('.transaction-form');
            let url = form.attr('action');
            let method = form.attr('method');
            let data = form.serialize();
            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function(response) {                  
                    toastr.success('Transaksi berhasil');
                    let url = "{{ route('transactions.nota', ['id' => 'ids']) }}";
                    url = url.replace('ids', response.id);
                    $('#print-nota').attr('href', url);
                    $('#modal-receipt').modal('show');
                }
            });
        }

        function clearForm() {
            $('.pay').val(0);
            $('.change').val(0);
            $('.total').html(0);
            $('.subtotal').val(0);
            $('.product').val('').trigger('change');
            $('.quantity').val(0);
            $('.added-product').remove();
            $('.select2').select2();
        }

        $('#btn-pay-lunas').click(function(event) {
            event.preventDefault();
            $('#status').val('lunas');
            submitPayment();
            clearForm();
        });

        $('#btn-pay-bon').click(function(event) {
            event.preventDefault();
            $('#status').val('bon');
            submitPayment();
            clearForm();
        });
    });
</script>
@endsection