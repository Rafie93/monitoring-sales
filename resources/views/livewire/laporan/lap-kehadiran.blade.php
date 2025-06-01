@inject('query', 'App\Models\KehadiranQuery')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Kehadiran</title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}" />
    <style type="text/css">
        @page {
            size: A4;
            margin: 0;
            /* landscape */
            size: 29.7cm 21cm;
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

<body >
    <section class="sheet padding-5mm">

        @include('livewire.laporan.header')
        <hr>

        <h2>
            <center>LAPORAN KEHADIRAN</center>
        </h2>
        <br>
        <h3>
            {{-- BULAN --}}
            <center>
                @if (request()->get('bulan'))
                    @php
                        $bulan = request()->get('bulan');
                        $bulanString = intToMonth($bulan);
                    @endphp
                    {{ strtoupper($bulanString) }}
                @endif
                {{-- TAHUN --}}
                @if (request()->get('tahun'))
                    {{ strtoupper(request()->get('tahun')) }}
                @endif
            </center>
        </h3>

        <br />
        <table style="width: 100%" class="receipt-table full-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    {{-- LOOPING TANGGAL --}}
                    @if (request()->get('bulan') && request()->get('tahun'))
                        @php
                            $days = cal_days_in_month(CAL_GREGORIAN, request()->get('bulan'), request()->get('tahun'));
                        @endphp
                        @for ($i = 1; $i <= $days; $i++)
                            <th>{{ $i }}</th>
                        @endfor
                    @endif
                    <th>HR KRJA</th>
                    <th>HADIR</th>
                    <th>TDK HADIR</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
               
                 @foreach ($data as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->nama }}</td>
                        @php
                            $jumlah_hadir = 0;
                            $jumlah_tidak_hadir = 0;
                            $jumlah_sabtu_minggu = 0;
                            $jumlah_hari_libur = 0;
                        @endphp
                        @if (request()->get('bulan') && request()->get('tahun'))
                            @for ($i = 1; $i <= $days; $i++)
                                @php
                                    $tgl = $i < 10 ? '0'.$i : $i;
                                    $date = request()->get('tahun') . '-' . request()->get('bulan') . '-' .$tgl ;
                                    $absen = $query->getKehadiran($row->id_sales, $date);
                                 
                                    $hari_libur = null;
                                    $jumlah_hadir += $absen ? 1 : 0;

                                    // jumlah hari sebulan tanpa hari sabtu dan minggu
                                    $days = cal_days_in_month(
                                        CAL_GREGORIAN,
                                        request()->get('bulan') < 10 ? "0".request()->get('bulan') : request()->get('bulan'),
                                        request()->get('tahun'),
                                    );
                                    //cek hari sabtu minggu
                                    $hari = date('D', strtotime($date));
                                    if ($hari == 'Sat' || $hari == 'Sun') {
                                    } else {
                                        // $hari_libur = $query->getHariLibur($date);
                                        // if ($hari_libur) {
                                        //     $jumlah_hari_libur++;
                                        // }
                                    }
                                    $jharikerja = $query->jumlahHariKerja( request()->get('tahun'),request()->get('bulan'));
                                    $jumlah_hari_kerja = $jharikerja;

                                @endphp
                                <td align="center">
                                   
                                    @if ($absen)
                                        <p style="color: green"> {{ $absen }}</p>
                                    @elseif ($hari_libur)
                                        <p style="color: red"> {{ $hari_libur }}</p>
                                    @else
                                        @php
                                            //cek hari sabtu minggu
                                            $day = date('D', strtotime($date));
                                            if ($day == 'Sat' || $day == 'Sun') {
                                                $jumlah_sabtu_minggu++;
                                                echo ' <p style="color: red">L</p>';
                                            } else {
                                                echo '-';
                                            }

                                        @endphp
                                    @endif
                                </td>
                            @endfor
                        @endif
                        @php
                            // $jumlah_tidak_hadir = ($jumlah_hari_kerja-$jumlah_sabtu_minggu)-$jumlah_hadir;
                            $jumlah_tidak_hadir = $jumlah_hari_kerja-$jumlah_hadir;
                        @endphp
                        <td align="center">{{$jumlah_hari_kerja}}</td>
                        <td align="center">{{$jumlah_hadir}}</td>
                        <td align="center">{{$jumlah_tidak_hadir}}</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        <br>
        <p>
            KETERANGAN : <br>
            H = HADIR <br>
            L = LIBUR <br>
            - = TIDAK HADIR / BELUM HADIR<br>
        </p>
       
        @include('livewire.laporan.footer')
    </section>
</body>

</html>
