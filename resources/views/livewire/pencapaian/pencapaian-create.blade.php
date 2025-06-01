<div>
    <h1 class="mt-4">Pencapaian Salesman</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Pencapaian Salesman</li>
        <li class="breadcrumb-item"><a href="{{route('pencapaian')}}" wire:navigate>Data</a></li>

        <li class="breadcrumb-item active">Proses Pencapaian</li>
    </ol>
    <div class="row">
        <div class="border p-4 rounded">
            <div class="form-group">
                <div class="row">
                    <label  for="form-workphoneNumber" class="col-sm-2 col-xs-2 control-label">Tahun</label>
                    <div id="box" class="col-sm-4 col-xs-4">
                        <select style="margin-right:5px;width:80%;float:left" 
                             wire:model="tahun" class="form-control" >
                             {{-- {{ $year = date('Y') }} --}}
                             @foreach (getTahun() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('tahun') <i class="text-danger">{{ $message }}</i> @enderror

                    </div>
                    <label  for="form-workphoneNumber" class="col-sm-2 col-xs-2 control-label">Bulan</label>
                    <div id="box" class="col-sm-4 col-xs-4">
                        <select style="margin-right:5px;width:80%;float:left" 
                             wire:model="bulan" class="form-control" >
                             <option value="">Pilih Bulan</option>
                             @foreach (getBulan() as $key => $value)
                                 <option value="{{ $key }}">{{ $value }}</option>
                             @endforeach
                        </select>
                        @error('bulan') <i class="text-danger">{{ $message }}</i> @enderror

                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xl-3 col-md-3">
                        <br>
                        <button  class="btn btn-primary" wire:click="proses"  wire:loading.attr="disabled"
                                >
                           Proses Rekap Pencapaian
                           <span wire:loading>Menghitung..</span>
                        </button>
                    </div>
                    <div class="card-body mt-2">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th align="center" rowspan="2">No</th>
                                    <th align="center" rowspan="2">Nama</th>
                                    <th align="center" rowspan="2">Target (Unit) </th>
                                    <th align="center" rowspan="2">Hari Kerja </th>
                                    <th align="center" rowspan="2">Tidak Hadir</th>
                                    <th align="center" rowspan="2">Penjualan (Unit)</th>
                                    <th align="center" colspan="2">Persentase (%)</th>
                                    <th align="center" colspan="2">Bobot (%)</th>
                                    <th align="center" rowspan="2">Hasil Pencapaian</th>
                                </tr>
                                <tr>
                                    <th align="center">Absensi</th>
                                    <th align="center">Penjualan</th>
                                    <th align="center">Absensi</th>
                                    <th align="center">Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($results)
                                    @foreach ($results as $item)
                                        <tr>
                                            <td>{{$item['no']}}</td>
                                            <td>{{$item['nama_sales']}}</td>
                                            <td align="center">{{$item['target']}}</td>
                                            <td align="center">{{$item['hari_kerja']}}</td>
                                            <td align="center">{{$item['tidak_hadir']}}</td>
                                            <td align="center">{{$item['penjualan']}}</td>
                                            <td align="center">{{number_format($item['presentasiKehadiran'],4)}} %</td>
                                            <td align="center">{{number_format($item['presentasiPenjualan'],2)}} %</td>
                                            <td align="center">{{$item['bobot_absensi']}}</td>
                                            <td align="center">{{$item['bobot_penjualan']}}</td>

                                            <td align="center">{{number_format($item['pencapaian'],3)}}</td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                           
                        </table>
                    </div>
                </div>
               @if ($results)
                <div class="row">
                    <div class="col-xl-3 col-md-3">
                        <br>
                        <button  class="btn btn-primary" wire:click="store"  wire:loading.attr="disabled"
                                >
                            <i class="fas fa-plus-circle fs-4 me-2"></i>
                        Simpan Hasil
                        <span wire:loading>Saving..</span>
                        </button>
                    </div>
                </div>
               @endif
            </div>

        </div>
    </div>
</div>