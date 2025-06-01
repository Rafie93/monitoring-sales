<div>
    <h1 class="mt-4">Absensi Salesman</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Absensi Salesman</li>
        <li class="breadcrumb-item active">Data</li>
    </ol>
    <div class="row">
        <div class="card mb-4">
           
            <div class="col-xl-3 col-md-3">
                <br>
                {{-- @if ($role==2) --}}
                    <a  class="btn btn-primary" 
                    href="{{route('absensi.create')}}"
                        > <i class="fas fa-plus-circle fs-4 me-2"></i>Tambah
                    </a>
                {{-- @else
                    <p class="p-2">Hanya Sales Dapat Melakukan Absensi</p>
                @endif --}}
            </div>
            <div class="col-xl-9 col-md-9">
            </div>
            <div class="card-body ">
                <table class="table table-bordered">
                   <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Sales</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Foto Masuk</th>
                        <th>Foto Keluar</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                   </thead>
                    <tbody>
                        @php
                        $no=1;
                    @endphp
                    @foreach ($data as $key=> $item)
                    <tr>
                        <td>{{ $no++}}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->sales->nama }}</td>
                        <td>{{ $item->jam_masuk }}</td>  
                        <td>{{ $item->jam_keluar }}</td>
                        <td class="p-2">
                            <div class="text-center">
                                <img src="{{ $item->foto_masuk }}" class="rounded-md" width="100px"
                                    height="100px">
                            </div>
                        </td>


                        <td class="p-2">
                            <div class="text-center">
                                @if ($item->foto_keluar)
                                    <img src="{{ $item->foto_keluar }}" class="rounded-md" width="100px"
                                        height="100px">
                                @endif
                            </div>
                        </td>
                        {{-- <td>
                          <a wire:navigate href="{{route('pesanan.pembayaran.create',$item->id_pesanan)}}" class="btn btn-primary" 
                                >Pembayaran</a>
                            <a wire:click="detail('{{$item->id_pesanan}}')" class="btn btn-success" 
                                >View</a>
                            <a wire:navigate href="{{route('pesanan.edit',$item->id_pesanan)}}" class="btn btn-secondary" 
                            >Edit</a> 
                       </td> --}}
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>
