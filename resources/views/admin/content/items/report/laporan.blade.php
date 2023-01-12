<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/assets/img/logo.png" type="image/x-icon"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{asset('front/assets/img/logodemak.png')}}" rel="icon">
    <link href="{{asset('front/assets/img/logodemak.png')}}" rel="apple-touch-icon">
    <title>Laporan</title>
  </head>

  <body style="background-color: white"; onload="window.print()">

    <style>
        .line-title{
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table style="width:100%">
                        <tr>
                            <td align="left">
                                <span style="line-height: 1.6; font-weight:bold;">
                                   {{-- Rekapan Bulan <?php echo date('F Y'); ?> <br>  --}}
                                   <h6 style="float: right; font-size:12px;"> Rekapan <?php echo date('j F Y'); ?> </h6>
                                    @if (Auth::user()->level == 'master')
                                    <h4><img src="{{asset('front/assets/img/logodemak.png')}}" alt=""style="width:2%;"> Dinas Pariwista Demak</h4>
                                    {{-- <small>Jalan Kyai Turmudzi Kabupaten Demak
                                    </small> --}}
                                    @endif
                                    @if (Auth::user()->level == 'admintembiring')
                                    <h4><img src="{{asset('front/assets/img/logodemak.png')}}" alt=""style="width:2%;"> Tembiring Jogo Indah</h4>
                                    
                                    @endif
                                    @if (Auth::user()->level == 'adminkadilangu')
                                    <h4><img src="{{asset('front/assets/img/logodemak.png')}}" alt=""style="width:2%;"> Kadilangu Jogo Indah</h4>
                                    @endif
                                     
                                </span>
                            </td>
                        </tr>
                    </table>
                    <hr class="line-title">
                    <p align="center">
                       <b>LAPORAN RETRIBUSI</b> <br>
                        <?php echo date('j/m/Y - H:i'); ?> - By ( <b>{{Auth::user()->name}}</b> )
                    </p>
                    <p align="center">
                        Periode <b>{{date('d F Y', strtotime($tgl_mulai))}} s/d {{date('d F Y', strtotime($tgl_selesai))}}</b>
                    </p>
                    <hr/>

                    <table class="table table-bordered">
                        <tr style="text-align: center">

                            <th scope="col">Petugas</th>
                            <th scope="col">Hari & Tanggal</th>
                            <th scope="col">Plat Kendaraan</th>
                            <th scope="col">Type Kendaraan</th>
                            <th scope="col">Total Bayar</th>
                        </tr>
                        @foreach ($data as $key => $row)
                            <tr style="text-align: center">

                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->created_at->isoFormat('dddd, D/M/Y, hh:mm') }}</td>
                                {{-- <td>{{ $row->created_at->isoFormat('D/M/Y, hh:mm') }}</td> --}}
                                {{-- <td>{{ $row->updated_at}}</td> --}}
                                <td>{{ $row->plat }}</td>
                                <td>{{ $row->kategori->items }}</td>
                                <td>{{ number_format($row->total), 2, '.', '.' }}</td>

                            </tr>
                        @endforeach
                       
                            <tr class="text-center">
                                <td colspan="4">Nominal Total</td>
                                <td>Rp. {{number_format($sum_total)}},-</td>
                            </tr>
                        
                    </table>
                    <h6 style="text-align: right"> <br></h6>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>