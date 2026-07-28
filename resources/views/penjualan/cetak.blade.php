<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi</title>

    <style>
        body {
            font-family: 'Courier New', monospace;
            background: #eee;
        }

        .struk {
            width: 320px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        .center {
            text-align: center;
        }

        h2 {
            margin: 0;
            font-size: 20px;
        }

        p {
            margin: 5px 0;
            font-size: 13px;
        }

        .garis {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        table {
            width: 100%;
            font-size: 13px;
        }

        td {
            padding: 3px 0;
        }

        .kanan {
            text-align: right;
        }

        .total {
            font-weight: bold;
            font-size: 15px;
        }

        .btn-cetak {
            margin-top: 15px;
            padding: 8px 15px;
            border: none;
            background: #0A2540;
            color:white;
            border-radius:5px;
            cursor:pointer;
        }


        @media print {

            body {
                background:white;
            }

            .struk {
                box-shadow:none;
                margin:0;
                width:280px;
            }

            .btn-cetak {
                display:none;
            }
        }

    </style>

</head>

<body>


<div class="struk">

    <div class="center">

        <h2>POS ADITYA</h2>

        <p>Struk Transaksi</p>

        <p>
            {{ $penjualan->created_at->format('d-m-Y H:i') }}
        </p>

        <p>
            Kasir : 
            {{ $penjualan->user->name ?? '-' }}
        </p>

    </div>


    <div class="garis"></div>


    <table>

        @foreach($penjualan->itemPenjualan as $item)

        <tr>
            <td colspan="2">
                {{ $item->produk->nama }}
            </td>
        </tr>

        <tr>

            <td>
                {{ $item->jumlah }} x 
                {{ number_format($item->harga_satuan) }}
            </td>

            <td class="kanan">
                {{ number_format($item->subtotal) }}
            </td>

        </tr>


        @endforeach


    </table>


    <div class="garis"></div>



    <table>

        <tr>
            <td class="total">
                Total
            </td>

            <td class="kanan total">

                Rp {{ number_format($penjualan->total_pembayaran) }}

            </td>

        </tr>


    </table>


    <div class="garis"></div>


    <p>
        Metode :
        {{ $penjualan->metode_pembayaran }}
    </p>


    <div class="center">

        <p>
            Terima kasih
        </p>


        <button 
            class="btn-cetak"
            onclick="window.print()">
            Cetak
        </button>


    </div>


</div>



</body>
</html>