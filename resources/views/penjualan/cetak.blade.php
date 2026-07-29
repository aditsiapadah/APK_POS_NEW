<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#eceff3;
            font-family:Arial, Helvetica, sans-serif;
            padding:30px;
        }

        .struk{
            width:340px;
            margin:auto;
            background:#fff;
            border-radius:14px;
            box-shadow:0 8px 25px rgba(0,0,0,.15);
            overflow:hidden;
        }

        .header{
            background:#0A2540;
            color:white;
            padding:20px;
            text-align:center;
        }

        .header h1{
            font-size:22px;
            margin-bottom:5px;
            letter-spacing:1px;
        }

        .header p{
            font-size:13px;
            opacity:.9;
        }

        .content{
            padding:18px;
        }

        .info{
            font-size:13px;
            line-height:1.8;
            margin-bottom:15px;
        }

        .info table{
            width:100%;
        }

        .info td:first-child{
            color:#666;
            width:90px;
        }

        .divider{
            border-top:1px dashed #bdbdbd;
            margin:15px 0;
        }

        table.items{
            width:100%;
            border-collapse:collapse;
            font-size:13px;
        }

        table.items th{
            background:#f5f7fa;
            padding:8px;
            text-align:left;
            font-size:12px;
        }

        table.items td{
            padding:8px 4px;
            border-bottom:1px solid #eee;
        }

        table.items td:last-child,
        table.items th:last-child{
            text-align:right;
        }

        .total-box{
            margin-top:18px;
            background:#0A2540;
            color:white;
            padding:12px 15px;
            border-radius:8px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-weight:bold;
            font-size:16px;
        }

        .payment{
            margin-top:15px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-size:13px;
        }

        .badge{
            background:#e8f0ff;
            color:#0A2540;
            padding:5px 12px;
            border-radius:20px;
            font-weight:bold;
        }

        .footer{
            text-align:center;
            margin-top:20px;
            font-size:12px;
            color:#666;
            line-height:1.8;
        }

        .btn-area{
            text-align:center;
            margin:20px;
        }

        .btn-print{
            background:#0A2540;
            color:white;
            border:none;
            padding:12px 30px;
            border-radius:8px;
            cursor:pointer;
            font-size:14px;
            transition:.3s;
        }

        .btn-print:hover{
            background:#163c63;
        }

        @media print{

            body{
                background:white;
                padding:0;
            }

            .struk{
                width:80mm;
                box-shadow:none;
                border-radius:0;
            }

            .btn-area{
                display:none;
            }

        }

    </style>

</head>

<body>

<div class="struk">

    <div class="header">

        <h1>POS ADITYA</h1>

        <p>Sistem Point Of Sale</p>

    </div>

    <div class="content">

        <div class="info">

            <table>

                <tr>
                    <td>No.</td>
                    <td>: #{{ str_pad($penjualan->id,5,'0',STR_PAD_LEFT) }}</td>
                </tr>

                <tr>
                    <td>Tanggal</td>
                    <td>: {{ $penjualan->created_at->format('d-m-Y H:i') }}</td>
                </tr>

                <tr>
                    <td>Kasir</td>
                    <td>: {{ $penjualan->user->name ?? '-' }}</td>
                </tr>

            </table>

        </div>

        <div class="divider"></div>

        <table class="items">

            <thead>

                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>

            </thead>

            <tbody>

            @foreach($penjualan->itemPenjualan as $item)

                <tr>

                    <td>{{ $item->produk->nama }}</td>

                    <td>{{ $item->jumlah }}</td>

                    <td>
                        Rp {{ number_format($item->subtotal,0,',','.') }}
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        <div class="total-box">

            <span>TOTAL</span>

            <span>
                Rp {{ number_format($penjualan->total_pembayaran,0,',','.') }}
            </span>

        </div>

        <div class="payment">

            <span>Metode Pembayaran</span>

            <span class="badge">
                {{ $penjualan->metode_pembayaran }}
            </span>

        </div>

        <div class="divider"></div>

        <div class="footer">

            <strong>Terima Kasih</strong><br>

            Atas kunjungan dan kepercayaan Anda.

            <br><br>

            POS ADITYA

        </div>

    </div>

</div>

<div class="btn-area">

    <button class="btn-print" onclick="window.print()">
        🖨 Cetak Struk
    </button>

</div>

</body>

</html>