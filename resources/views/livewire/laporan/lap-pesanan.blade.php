<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Pesanan Kendaraan</title>
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
            <center>LAPORAN PESANAN KENDARAAN</center>
        </h2>
        <br>
        <div class="row">
            <div class="col-md-6">
                <table border="0">
                    <tr>
                        <td style="width: 50%;padding-right: 5%">Periode</td>
                        <td style="width: 5%;padding-right: 5%"> : </td>
                        <td>
                            @if (request('bulan'))
                                {{intToMonth(request('bulan'))}}
                            @endif
                            {{request('tahun')}}
                        </td>
                    </tr>

                </table>
            </div>
        </div>

        <br />
        <table style="width: 100%" class="receipt-table full-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NO.SPK</th>
                    <th>MODEL/TIPE</th>
                    <th>KAPASITAS(CC)</th>
                    <th>TRANSMISI</th>
                    <th>CUSTOMER</th>
                    <th>HARGA</th>
                    <th>TERBAYAR</th>
                    <th>SISA</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                       <td>{{$no++}}</td>
                       <td>{{$item->no_spk}}</td>
                       <td>{{ $item->mobil->sub_tipe }}</td>
                       <td>{{ $item->mobil->kapasitas_mesin }}</td>
                       <td>{{ $item->mobil->jenis_transmisi }}</td>
                       <td>{{ $item->customer->nama }}</td>
                       <td align="right">Rp. {{number_format($item->total )}}</td>
                       <td align="right">Rp. {{ number_format($item->pembayaran->sum('jumlah_bayar')) }}</td>
                       <td align="right">Rp. {{ number_format($item->total - $item->pembayaran->sum('jumlah_bayar')) }}</td>
                       <td>{{ $item->status_pesanan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('livewire.laporan.footer')
    </section>
</body>

</html>
