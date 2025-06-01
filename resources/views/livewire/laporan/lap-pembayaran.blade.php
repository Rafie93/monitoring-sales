<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran</title>
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
            <center>LAPORAN PEMBAYARAN</center>
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
                    <th>TANGGAL BAYAR</th>
                    <th>KETERANGAN</th>
                    <th>CUSTOMER</th>
                    <th>JUMLAH BAYAR</th>
                   
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
                       <td>{{$item->created_at->format('d-M-Y')}}</td>
                       <td>{{ $item->keterangan_bayar }}</td>
                       <td>{{ $item->pesananKendaraan->customer->nama }}</td>
                       <td align="right">Rp. {{number_format($item->jumlah_bayar )}}</td>
                    </tr>
                    @php
                        $total+=$item->jumlah_bayar;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="4">Total</td>
                    <td align="right">Rp. {{number_format($total )}}</td>

                </tr>
            </tbody>
        </table>
        @include('livewire.laporan.footer')
    </section>
</body>

</html>
