<div>
    <h1 class="mt-4">Pesanan Kendaraan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Pesanan Kendaraan</li>
        <li class="breadcrumb-item active">Data</li>
    </ol>
    <div class="row">
        <div class="card mb-4">
           
            <div class="col-xl-3 col-md-3">
                <br>
                <a  class="btn btn-primary" 
                    href="{{route('pesanan.create')}}"
                        >
                    <i class="fas fa-plus-circle fs-4 me-2"></i>
                    Buat SPK
                </a>
            </div>
            <div class="col-xl-9 col-md-9">
            </div>
            <div class="card-body ">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>No SPK</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Sales</th>
                        <th>Mobil</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($data as $key=> $item)
                    <tr>
                        <td>{{ $no++}}</td>
                        <td>{{$item->no_spk}}</td>
                        <td>{{ $item->tanggal_pesanan }}</td>
                        <td>{{ $item->customer->nama }}</td>
                        <td>{{ $item->sales->nama }}</td>
                        <td>{{ $item->mobil->sub_tipe.' '.$item->mobil->jenis_transmisi.'('.$item->warna.")" }}</td>
                        <td align="right">{{ number_format($item->total) }}</td>
                        <td align="right">{{ number_format($item->pembayaran->sum('jumlah_bayar')) }}</td>
                        <td>{{ $item->status_pesanan }}</td>

                        <td>
                            <a wire:navigate href="{{route('pesanan.pembayaran.create',$item->id_pesanan)}}" class="btn btn-primary" 
                                >Pembayaran</a>
                            <a wire:click="detail('{{$item->id_pesanan}}')" class="btn btn-success" 
                                >View</a>
                            <a wire:navigate href="{{route('pesanan.edit',$item->id_pesanan)}}" class="btn btn-secondary" 
                            >Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>
