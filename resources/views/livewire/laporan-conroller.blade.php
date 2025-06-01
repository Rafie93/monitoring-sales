<div>
    <h1 class="mt-4">{{ucfirst($type_laporan)}}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">{{ucfirst($type_laporan)}}</li>
        <li class="breadcrumb-item active">Data</li>
    </ol>
    <div class="row">
        <div class="border p-4 rounded">
            <div class="row">
                @if ($type_laporan=='laporan-pencapaian-sales')
                    <label  for="form-workphoneNumber" class="col-sm-2 col-xs-2 control-label">Salesman</label>
                    <div id="box" class="col-sm-4 col-xs-4">
                        <select style="margin-right:5px;width:80%;float:left" 
                            wire:model="id_sales" class="form-control" >
                            <option value="">-Pilih Sales-</option>
                            @foreach ($sales as $key => $value)
                                <option value="{{ $value->id_sales }}">{{ $value->nama }}</option>
                            @endforeach
                        </select>

                    </div>
                    @error('id_sales') <i class="text-danger">{{ $message }}</i> @enderror

                @else 
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
                @endif
              
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xl-3 col-md-3">
                        <br>
                        <button  class="btn btn-primary" wire:click="print"  wire:loading.attr="disabled"
                                >
                           Cetak Laporan
                           <span wire:loading>Loading..</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
