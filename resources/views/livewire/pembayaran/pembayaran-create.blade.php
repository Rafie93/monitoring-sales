<div>
    <h1 class="mt-4">Pembayaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Pesanan Kendaraan</li>
        
        <li class="breadcrumb-item">
            <a href="{{route('pesanan')}}" wire:navigate>Data</a>
        </li>
        <li class="breadcrumb-item active">Pembayaran</li>
    </ol>
    {{-- @if ($pesanans->total < $list_pembayaran->sum('jumlah_bayar')) --}}
    <div class="row">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="border p-4 rounded">
                <div class="form-group">
                    <div class="row">
                        <label  for="form-workphoneNumber" class="col-sm-4 col-xs-4 control-label">No SPK</label>
                        <div id="box" class="col-sm-8 col-xs-8">
                            <input style="margin-right:5px;width:80%;float:left" 
                            type="text" class="form-control"  disabled
                            value="{{$pesanans->no_spk}}">
                        </div>
                        @error('id_pesanan') <i class="text-danger">{{ $message }}</i> @enderror
                    </div>
                </div>
                <div class="form-group mt-4">
                    <div class="row">
                        <label  for="form-workphoneNumber"
                         class="col-sm-4 col-xs-4 control-label">Metode Pembayaran</label>
                        <div id="box" class="col-sm-8 col-xs-8">
                            <select wire:model="metode_bayar"
                            style="margin-right:5px;width:80%;float:left" class="form-control">
                                <option value=""></option>
                                <option value="Tunai">Tunai</option>
                                <option value="Kredit">Kredit</option>
                            </select>
                        </div>
                        @error('metode_bayar') <i class="text-danger">{{ $message }}</i> @enderror
                    </div>
                </div>

                <div class="form-group mt-4">
                    <div class="row">
                        <label  for="form-workphoneNumber"
                         class="col-sm-4 col-xs-4 control-label">Jumlah Bayar</label>
                        <div id="box" class="col-sm-8 col-xs-8">
                            <input style="margin-right:5px;width:80%;float:left" 
                            type="number" required class="form-control"  wire:model="jumlah_bayar">
                        </div>
                        @error('jumlah_bayar') <i class="text-danger">{{ $message }}</i> @enderror
                    </div>
                </div>

                <div class="form-group mt-4">
                    <div class="row">
                        <label  for="form-workphoneNumber"
                         class="col-sm-4 col-xs-4 control-label">Keterangan</label>
                        <div id="box" class="col-sm-8 col-xs-8">
                            <input style="margin-right:5px;width:80%;float:left" 
                            type="text" class="form-control"  wire:model="keterangan">
                        </div>
                        @error('keterangan') <i class="text-danger">{{ $message }}</i> @enderror
                    </div>
                </div>

                <div class="form-group mt-4">
                    <div class="row">
                        <label  for="form-workphoneNumber"
                         class="col-sm-4 col-xs-4 control-label">Bukti Pembayaran</label>
                        <div id="box" class="col-sm-8 col-xs-8">
                            <input style="margin-right:5px;width:80%;float:left" 
                            type="file" class="form-control"  wire:model="bukti_pembayaran">
                        </div>
                        @error('bukti_pembayaran') <i class="text-danger">{{ $message }}</i> @enderror
                    </div>
                </div>

                <div class="form-group mt-4">
                    <div class="row">
                        <label  for="form-workphoneNumber"
                         class="col-sm-4 col-xs-4 control-label"></label>
                        <div id="box" class="col-sm-8 col-xs-8">
                            <button type="submit"
                                    class="btn btn-primary border border-1-5 border-black text-white fw-bold" 
                                    style="font-family: monospace; font-size: 0.875rem; height: 36px;">
                                        SIMPAN
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>

        </form>
    </div>
    {{-- @endisf --}}
   

    <div class="row mt-4">
        <fieldset>
            <h5>History Pembayaran</h5>
            <div class="card-body ">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Bayar</th>
                        <th>Metode Bayar</th>
                        <th>Jumlah Bayar</th>
                        <th>Keterangan</th>
                        <th>Bukti</th>
                    </tr>
                    @php
                        $no=1;
                        $total=0;
                    @endphp
                    @foreach ($list_pembayaran as $key=> $k)
                    <tr>
                        <td>{{ $no++}}</td>
                        <td>{{$k->created_at->format('d-M-Y H:i:s')}}</td>
                        <td>{{$k->metode_bayar}}</td>
                        <td align="right">{{number_format($k->jumlah_bayar)}}</td>
                        <td>{{$k->keterangan_bayar}}</td>
                        <td>{{$k->bukti_bayar}}</td>

                    </tr>
                    @php
                        $total += $k->jumlah_bayar;
                    @endphp
                    @endforeach
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Bayar</td>
                            <td align="right"><strong>Rp. {{number_format($total)}}</strong></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </fieldset>
    </div>
</div>
