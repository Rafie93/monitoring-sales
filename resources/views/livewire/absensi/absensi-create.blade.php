<div>
    <h1 class="mt-4">Absensi Salesman</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Absensi Salesman</li>
        
        <li class="breadcrumb-item">
            <a href="{{route('absensi')}}" wire:navigate>Data</a>
        </li>
        <li class="breadcrumb-item active">Tambah Absensi</li>
    </ol>
    <div class="row">
        {{-- <form wire:submit.prevent="store" enctype="multipart/form-data"> --}}
            <div class="border p-4 rounded">
                @if ($role==1 || $role==3)
                <div class="form-group ">
                    <div class="row">
                        <label  for="form-workphoneNumber" class="col-sm-4 col-xs-4 control-label">Sales</label>
                        <div id="box" class="col-sm-8 col-xs-8">
                            <select id="id_sales" style="margin-right:5px;width:80%;float:left" 
                             wire:model="id_sales"  wire:change="getData"
                            class="form-control" aria-label="Sales Mobil">
                                <option value="">--Cari Data Sales--</option>
                                  @foreach ($salesman as $item)
                                      <option value="{{$item->id_sales}}"> {{$item->nama.' | '.$item->area_sales}}</option>
                                  @endforeach
                            </select>
                            @error('id_sales') <i class="text-danger">{{ $message }}</i> @enderror
      
                        </div>
                    </div>
                </div>
               

                @endif
                <div class="form-group mt-4">
                    <div class="row">
                        <label  for="form-workphoneNumber" class="col-sm-4 col-xs-4 control-label">Tanggal</label>
                        <div id="box" class="col-sm-8 col-xs-8">
                            <input style="margin-right:5px;width:80%;float:left" 
                            type="date" wire:model="tanggal" class="form-control" >
                        </div>
                        @error('tanggal') <i class="text-danger">{{ $message }}</i> @enderror
                    </div>
                </div>
                <div class="form-group mt-4">
                    <div class="row">
                        <label  for="form-workphoneNumber" class="col-sm-4 col-xs-4 control-label">Waktu</label>
                        <div id="box" class="col-sm-8 col-xs-8">
                            <span id="jam"  style="margin-right:5px;width:80%;float:left" ></span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-4">
                    <div class="row">
                        <div   class="col-sm-6 col-xs-6 control-label">
                            <div wire:ignore id="my_camera"></div> 
                           <center>
                            <button class="btn btn-warning" 
                            style="margin-right:5px;width:50%;float:center"
                            onClick="take_snapshot()">CAPTURE</button> 
                           </center>
                        </div>
                        <div id="box" class="col-sm-6 col-xs-6">
                            <input type="hidden" name="image" class="image-tag">

                            @if ($image)
                                <img src="{{ $image }}"  style="margin-right:5px;width:80%;float:left"  width="100%" height="100%" alt="Gambar"
                                    class="rounded-md" />
                               
                            @else
                                <div id="results"  style="margin-right:5px;width:80%;float:left" >Your captured image will appear here...</div>
                            @endif
                            <br/>
                          
                        </div>
                    </div>
                </div>   
               
                <div class="row mt-4 p-10">
                    <button  wire:click.prevent="store" type="button"
                        class="btn btn-primary border border-1-5 border-black text-white fw-bold" 
                        style="font-family: monospace; font-size: 0.875rem; height: 36px;">
                            {{$display_check}}
                    </button>
                </div>

               
                
            </div>

        {{-- </form> --}}
    </div>
   
</div>


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script language="JavaScript">
        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h + ':' + m + ':' + s;

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }
        Webcam.set({
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {

            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                // alert(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
                @this.set('image', data_uri);
            });

        }
    </script>
@endpush
