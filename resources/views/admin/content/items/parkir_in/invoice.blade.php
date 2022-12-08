<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .container {
            width: 300px;
        }
        .header {
            margin: 0;
            text-align: center;
        }
        h2, p {
            margin: 0;
        }
        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }
        .flex-container-1 > div {
            text-align : left;
        }
        .flex-container-1 .right {
            text-align : right;
            width: 200px;
        }
        .flex-container-1 .left {
            width: 100px;
        }
        .flex-container {
            width: 300px;
            display: flex;
        }
        .flex-container > div {
            -ms-flex: 1;  /* IE 10 */
            flex: 1;
        }
        ul {
            display: contents;
        }
        ul li {
            display: block;
        }
        hr {
            border-style: dashed;
        }
        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header" style="margin-bottom: 30px;">
            @if (Auth::user()->level == 'master')
            <h2>Pemerintahan Kabupaten Demak</h2>
            <small>Jalan Kyai Turmudzi Kabupaten Demak
            </small>
            @endif
            @if (Auth::user()->level == 'admintembiring')
            <h2>Tembiring Jogo Indah</h2>
            <small>Jalan Kyai Turmudzi Kabupaten Demak
            </small>
            @endif
            @if (Auth::user()->level == 'adminkadilangu')
            <h2>Kadilangu Jogo Indah</h2>
            <small>Jalan kadilangu Kabupaten Demak
            </small>
            @endif
        </div>
        <hr>
        No Porporasi : {{$data->porporasi}}
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>No Polisi</li>
                    <li>Rombongan</li>
                    <li>Petugas Jaga</li>
                    <li>Tanggal</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li> {{ $data->plat }} </li>
                    <li> {{ $data->rombongan }} </li>
                    <li> {{ $data->user->name }} </li>
                    <li> {{ date('Y-m-d : H:i:s', strtotime($data->updated_at)) }} </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Type</div>
            <div>Harga/Tarif</div>
            <div>Total Bayar</div>
        </div>
        <div class="flex-container" style="text-align: right;">
            <div style="text-align: left;">{{ $data->kategori->items}}</div>
            <div>Rp {{ number_format($data->kategori->price) }} </div>
            <div>Rp {{ number_format($data->kategori->price) }} </div>
        </div> 
        <hr>
        <div class="header" style="margin-top: 50px;">
            <h3>Terimakasih</h3>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
