<div>
    <h1 class="mt-4">Pencapaian Salesman</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Pencapaian Salesman</li>
        <li class="breadcrumb-item active">Data</li>
    </ol>
    <div class="row">
        <div class="card mb-4">
           
            <div class="col-xl-12 col-md-12">
                <br>
                    <a wire:navigate href="{{route('pencapaian.create')}}"
                     class="btn btn-primary" 
                   
                        >
                    <i class="fas fa-plus-circle fs-4 me-2"></i>
                    Tambah
                    </a>
                    <select style="margin-right:5px;width:20%;float:right" 
                            wire:model="tahun" class="form-control" >
                            {{-- {{ $year = date('Y') }} --}}
                            @foreach (getTahun() as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <select style="margin-right:5px;width:20%;float:right" 
                            wire:model="bulan" class="form-control" >
                            <option value="">Semua Bulan</option>
                            @foreach (getBulan() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                    </select>
            </div>
           
            <div class="card-body ">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Nama</th>
                            <th>Target</th>
                            <th>Kehadiran</th>
                            <th>Penjualan</th>
                            <th>Pencapaian</th>
                            <th>Rangking</th>
                        </tr>
                    </thead>
                   <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($data as $key=> $item)
                    <tr>
                        <td>{{ $no++}}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ intToMonth($item->bulan )}}</td>
                        <td>{{ $item->sales->nama }}</td>  
                        <td align="center">{{ $item->target_penjualan }}</td>
                        <td align="center">{{ $item->kehadiran }}</td>
                        <td align="center">{{ $item->penjualan }} Unit</td>
                        <td align="center">{{ number_format( $item->hasil_pencapaian,4) }}</td>
                        <td align="center">{{ $item->rangking }}</td>

                    </tr>
                    @endforeach
                   </tbody>
                </table>
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>
