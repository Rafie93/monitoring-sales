@inject('query', 'App\Models\KehadiranQuery')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Pencapaian Sales</title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}" />
    <style type="text/css">
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
        }

        @media screen {
            div.divFooter {
                display: none;
            }
        }

        @media print {
            div.divFooter {
                position: fixed;
                bottom: 0.6cm;
                text-align: right;

            }

            .noPrint {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <section class="sheet padding-5mm">

        @include('livewire.laporan.header')
        <hr>

        <h2>
            <center>LAPORAN PENCAPAIAN SALES</center>
        </h2>
        <br>
        <div class="row">
            <div class="col-md-6">
                <table border="0" style="width: 100%">
                    <tr>
                        <td style="width: 20%;padding-right: 10%">Nama Sales</td>
                        <td style="width: 5%;padding-right: 5%"> : </td>
                        <td style="width: 70%;padding-right: 5%"> {{$nama}}  </td>
                    </tr>

                </table>
            </div>
        </div>

        <br />
        <table style="width: 100%" class="receipt-table full-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>PERIODE</th>
                    <th>HARI KERJA</th>
                    <th>KEHADIRAN</th>
                    <th>TARGET PENJUALAN</th>
                    <th>PENJUALAN (UNIT)</th>
                    <th>PERSENTASE ABSEN</th>
                    <th>PERSENTASE PENJUALAN</th>
                    <th>HASIL PENCAPAIAN</th>
                    <th>URUTAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $total = 0;
                @endphp
                @foreach ($data as $item)
                    <tr>
                       <td>{{$no++}}</td>
                       <td>{{intToMonth($item->bulan)." ".$item->tahun}}</td>
                       <td align="center">
                        @php
                            $harikerja = $query->jumlahHariKerja($item->tahun,$item->bulan);
                        @endphp
                        {{$harikerja}} Hari
                       </td>
                       <td align="center">{{ $item->kehadiran }}</td>
                       <td align="center">{{ $item->target_penjualan }} Unit</td>
                       <td align="center">{{ $item->penjualan }} Unit</td>
                       <td align="center">{{number_format( $item->hasil_kehadiran,2) }}</td>
                       <td align="center">{{number_format( $item->hasil_penjualan,2) }}</td>
                       <td align="center">{{number_format( $item->hasil_pencapaian,2) }}</td>
                       <td align="center">{{ $item->rangking }}</td>
                    </tr>  
                @endforeach
        
            </tbody>
        </table>
        @include('livewire.laporan.footer')
    </section>
</body>

</html>
