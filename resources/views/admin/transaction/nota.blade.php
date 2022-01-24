<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body{
            margin-top:20px;
            background:#fff;
        }

        .invoice {
            background: #fff;
            padding: 20px
        }

        .invoice-company {
            font-size: 20px
        }

        .invoice-header {
            margin: 0 -20px;
            background: #fff;
            padding: 20px
        }

        .invoice-date,
        .invoice-from,
        .invoice-to {
            display: table-cell;
            width: 1%
        }

        .invoice-from,
        .invoice-to {
            padding-right: 20px
        }

        .invoice-date .date,
        .invoice-from strong,
        .invoice-to strong {
            font-size: 16px;
            font-weight: 600
        }

        .invoice-date {
            text-align: right;
            padding-left: 20px
        }

        .invoice-price {
            background: #fff;
            display: table;
            width: 100%
        }

        .invoice-price .invoice-price-left,
        .invoice-price .invoice-price-right {
            display: table-cell;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            width: 75%;
            position: relative;
            vertical-align: middle
        }

        .invoice-price .invoice-price-left .sub-price {
            display: table-cell;
            vertical-align: middle;
            padding: 0 20px
        }

        .invoice-price small {
            font-size: 12px;
            font-weight: 400;
            display: block
        }

        .invoice-price .invoice-price-row {
            display: table;
            float: left
        }

        .invoice-price .invoice-price-right {
            width: 25%;
            background: #fff;
        }

        .invoice-price .invoice-price-right p {
            font-size: 18px;
            padding: 0px;
            margin: 0px;
        }

        .invoice-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px
        }

        .invoice-note {
            color: #999;
            margin-top: 80px;
            font-size: 85%
        }

        .invoice>div:not(.invoice-footer) {
            margin-bottom: 20px
        }

        .btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
            color: #2d353c;
            background: #fff;
            border-color: #d9dfe3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <div class="invoice">
                <!-- begin invoice-company -->
                <div class="invoice-company text-inverse f-w-600">
                    <span class="pull-right hidden-print">
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
                    </span>
                    Murni Fotocopy
                </div>
                <!-- end invoice-company -->
                <!-- begin invoice-header -->
                <div class="invoice-header">
                    <div class="invoice-from">
                        <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">Murni Fotocopy - Admin</strong><br>
                        Jl. Semeru Raya nomor 8<br>
                        Sumbersari, Jember<br>
                        Wa: 0851-5999-7712<br>
                        </address>
                    </div>
                    <div class="invoice-date">
                        <div class="date text-inverse m-t-5"> {{date('l, d M Y - H.i', strtotime($transaction->created_at))}}</div>
                        <div class="invoice-detail">
                        #{{$transaction->id}}
                        </div>
                    </div>
                </div>
                <!-- end invoice-header -->
                <!-- begin invoice-content -->
                <div class="invoice-content">
                    <!-- begin table-responsive -->
                    <div class="table-responsive">
                        <table class="table table-invoice">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th class="text-center" width="10%">Qty</th>
                                <th class="text-center" width="10%">Harga</th>
                                <th class="text-right" width="20%">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $detail)
                            <tr>
                                <td>
                                    <span class="text-inverse">{{$detail->product->name}}</span><br>
                                </td>
                                <td class="text-center">{{$detail->quantity}}</td>
                                <td class="text-center">@currency($detail->product->price)</td>
                                <td class="text-right">@currency($detail->subtotal)</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                    <!-- begin invoice-price -->
                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <small>Hormat Kami</small><br>
                            <small>Murni Fotocopy</small>
                        </div>
                        <div class="invoice-price-right">
                            <p>Total <span class="pull-right font-weight-bold">@currency($transaction->total)</span> </p>
                            <p>Bayar <span class="pull-right"> @currency($transaction->pay) </span></p> 
                            @if($transaction->changes >= 0)
                            <p>Kembali <span class="pull-right"> @currency($transaction->changes) </span></p>
                            @else
                            <p>Kurang <span class="pull-right"> @currency($transaction->changes) </span></p>
                            @endif
                        </div>
                    </div>
                    <!-- end invoice-price -->
                </div>
                <div class="invoice-footer">
                    <p class="text-center m-b-5 f-w-600">
                        TERIMA KASIH ATAS PESANAN ANDA
                    </p>
                    <p class="text-center">
                        {{-- <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> matiasgallipoli.com</span> --}}
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-whatsapp"></i> 0851-5999-7712</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> murnifcdigital@gmail.com</span>
                    </p>
                </div>
            <!-- end invoice-footer -->
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>