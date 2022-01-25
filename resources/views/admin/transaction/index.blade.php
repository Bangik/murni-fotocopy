@extends('layouts.admin.app')

@section('content-admin')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Riwayat Transaksi</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tanggal</th>
                                            <th>Total</th>
                                            <th>Bayar</th>
                                            <th>Kembali</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{$transaction->id}}</td>
                                            <td>{{date('D, d M Y - H.i', strtotime($transaction->created_at))}}</td>
                                            <td>@currency($transaction->total)</td>
                                            <td>@currency($transaction->pay)</td>
                                            <td>@currency($transaction->changes)</td>
                                            <td>{{$transaction->status}}</td>
                                            <td>
                                                <a href="{{route('transactions.detail', ['id' => $transaction->id])}}" class="btn btn-primary"><i class="fa fa-info"></i></a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus-{{$loop->iteration}}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@foreach ($transactions as $transaction)
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-hapus-{{$loop->iteration}}" aria-labelledby="modal-hapus" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk menghapus satuan {{$transaction->id}}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <a href="{{route('transactions.delete', ['id' => $transaction->id])}}" class="btn btn-danger">Ya</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
@section('js-admin')
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "order": [[ 0, "desc" ]]
            } );
        });
    </script>
@endsection