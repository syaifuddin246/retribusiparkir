
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('front/assets/img/logodemak.png')}}" rel="icon">
    <link href="{{asset('front/assets/img/logodemak.png')}}" rel="apple-touch-icon">
    <title>INV-{{$data->porporasi}}/{{$data->plat}}</title>
    <style>
        .m-right{
            margin-right: 65px;
        }
        .container {
            width: 225px;
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
<body style="margin: none;">
    <div class="container">
        <div style="margin-bottom: 20px; text-align:center;">
            @if (Auth::user()->level == 'master')
            <h4><b style="font-size: 18px"> Pemkab Demak </b> <br> <b style="font-size:14px;"> Jl Kalicilik Demak</b></h4>
            @endif
            @if (Auth::user()->level == 'admintembiring')
            <h4><b style="font-size: 18px"> Tembiring Jogo Indah </b> <br> <b style="font-size:14px;"> Jl Kyai Turmudzi Demak</b></h4>
            @endif
            @if (Auth::user()->level == 'adminkadilangu')
            <h4><b style="font-size: 18px"> Kadilangu Jogo Indah </b> <br> <b style="font-size:14px;"> Jl Kadilangu Demak</b></h4>
            @endif
        </div>
        <hr>
        <b style="font-size:12px;">No Porporasi</b> : {{$data->porporasi}}
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left; margin-right:65px;">No Polisi</div>
            <div>{{$data->plat}}</div>
            <div></div>
        </div>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div class="m-right" style="text-align: left;">Asal Rombongan</div>
            <div>{{$data->rombongan}}</div>
            <div></div>
        </div>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div class="m-right" style="text-align: left;">Petugas</div>
            <div>{{$data->user->name}}</div>
            <div></div>
        </div>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div class="m-right" style="text-align: left;">Tanggal</div>
            <div>{{$data->created_at}}</div>
            <div></div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div class="m-right" style="text-align: left;">Type Kendaraan</div>
            <div>{{$data->kategori->items}}</div>
            <div></div>
        </div>
        <div class="flex-container" style="text-align: right;">
            <div class="m-right" style="text-align: left;">Tarif Biaya</div>
            <div>Rp.<b>{{ number_format($data->kategori->price) }}</b>,- </div>
            <div></div>
        </div> 
        <hr>
        <div class="left" style="padding-top:12px;">
            <ul style="font-size: 11px;">
                <li><b>PERBUP KABUPATEN DEMAK <br> NOMOR 40 TAHUN 2020</b></li>
                <li><b>*Periksa kembali tiket anda untuk jumlah <br>retribusi yang dibayarkan</b></li>
                <li><b>*Simpan tiket sebagai tanda bukti masuk <br>kawasan wisata religi</b></li>
            </ul>
        </div>
        <div style="margin-top: 10px; text-align:center">
            <h4>Terimakasih <br><b style="font-size:10px;"> Dinas Pariwisata Kabupaten Demak</b></h4>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>


