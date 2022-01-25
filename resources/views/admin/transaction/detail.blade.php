@extends('layouts.admin.app')

@section('content-admin')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{route('transactions.index')}}">Riwayat Transaksi</a></div>
                <div class="breadcrumb-item">Detail Transaksi</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Detail Transaksi</h2>
            <p class="section-lead">
                Transaksi No {{$transaction->id}} <br>
                Tanggal : {{date('D, d M Y - H.i', strtotime($transaction->created_at))}} <br>
                Status : <span id="status" class="{{$transaction->status == 'bon' ? 'text-danger' : ''}}">{{$transaction->status}}</span> <br>
                <button type="button" class="btn btn-primary btn-sm" data-id="{{$transaction->id}}" id="btn-status">Ubah Status</button>
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Produk</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $detail)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$detail->product->name}}</td>
                                            <td>{{$detail->quantity}}</td>
                                            <td>@currency($detail->subtotal)</td>
                                        </tr>
                                        @endforeach                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">Total</td>
                                            <td>@currency($transaction->total)</td>                                          
                                        </tr>
                                        <tr>
                                            <td colspan="3">Bayar</td>
                                            <td>@currency($transaction->pay)</td>
                                        </tr>
                                        <tr>
                                            @if($transaction->changes >= 0)
                                            <td colspan="3">Kembali</td>
                                            @else
                                            <td colspan="3">Kurang</td>
                                            @endif
                                            <td>@currency($transaction->changes)</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
@section('js-admin')
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#btn-status').click(function(){
                let id = $(this).attr('data-id');
                let urlFull = "{{route('transactions.update', ['id' => 'ids'])}}";
                urlFull = urlFull.replace('ids', id);
                $.ajax({
                    url: urlFull,
                    type: "POST",
                    data: {
                        status: 'lunas',
                        pay: '{{$transaction->total}}',
                        changes: 0,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data){
                        toastr.success('Status berhasil dirubah');
                        $('#status').text('lunas');
                        $('#status').removeClass('text-danger');
                    }
                });
            });
        });
    </script>
@endsection