<div>
    <h1 class="mt-4">Mobil</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Mobil</li>
        <li class="breadcrumb-item active">Data</li>
    </ol>
    <div class="row">
        <div class="card mb-4">
           
            <div class="col-xl-3 col-md-3">
                <br>
                <button type="button" class="btn btn-primary" 
                    data-bs-toggle="modal" data-bs-target="#add_menu_item_modal">
                    <i class="fas fa-plus-circle fs-4 me-2"></i>
                    Tambah Data
                </button>
            </div>
            <div class="col-xl-9 col-md-9">
            </div>
            <div class="card-body ">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Tipe Mobil</th>
                        <th>Sub Tipe</th>
                        <th>Tahun</th>
                        <th>Warna</th>
                        <th>Jenis Transmisi</th>
                        <th>Kapasitas Mesin</th>
                        <th>Tempat Duduk</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($data as $key=> $item)
                    <tr>
                        <td>{{ $no++}}</td>
                        <td>{{$item->tipe->tipe}}</td>
                        <td>{{ $item->sub_tipe }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->warna }}</td>
                        <td>{{ $item->jenis_transmisi }}</td>
                        <td>{{ $item->kapasitas_mesin }}</td>
                        <td>{{ $item->tempat_duduk }}</td>
                        <td align="right">{{ number_format($item->harga) }}</td>
                        <td><a wire:click="edit('{{$item->id_mobil}}')" class="btn btn-secondary" 
                            >Edit</a>
                            <button wire:click="delete('{{$item->id_mobil}}')" class="btn btn-danger" 
                            >Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    
    {{-- @if ($openForm) --}}
    <div wire:ignore.self class="modal fade" tabindex="-1" id="add_menu_item_modal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{$updateMode ?'Edit ' : 'Tambah'}} Data Mobil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="store">
                <div class="form-group">
                    <label for="id_tipe">Tipe Mobil</label>
                    <select class="form-control" id="id_tipe" name="id_tipe" wire:model="id_tipe">
                        <option value="">Pilih Tipe Mobil</option>
                        <!-- isi option dengan data dari database -->
                        @foreach ($tipes as $item)
                            <option value="{{$item->id_tipe}}">{{$item->tipe}}</option>
                        @endforeach
                    </select>
                    @error('id_tipe') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
                <div class="form-group">
                    <label for="sub">Sub Tipe</label>
                    <input type="text" class="form-control" wire:model="sub_tipe" id="sub" name="sub" placeholder="Masukkan Sub Tipe">
                </div>
                @error('sub_tipe') <i class="text-danger">{{ $message }}</i> @enderror

                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" class="form-control" wire:model="tahun" id="tahun" name="tahun" placeholder="Masukkan Tahun">
                </div>
                @error('tahun') <i class="text-danger">{{ $message }}</i> @enderror

                <div class="form-group">
                    <label for="warna">Warna</label>
                    <select name="warnas" multiple wire:model="warnaSelected" class="form-control">
                        @foreach ($warnas as $item)
                            <option value="{{$item}}">{{$item}}</option>
                        @endforeach
                    </select>
                    @error('warnaSelected') <i class="text-danger">{{ $message }}</i> @enderror

                    {{-- <input type="text" class="form-control" wire:model="warna" id="warna" name="warna" placeholder="Masukkan Warna"> --}}
                </div>

                <div class="form-group">
                    <label for="jenis_transmisi">Jenis Transmisi</label>
                    <select class="form-control" id="jenis_transmisi" wire:model="jenis_transmisi" name="jenis_transmisi">
                        <option value="">Pilih Jenis Transmisi</option>
                        <option value="Manual">Manual</option>
                        <option value="Otomatis">Otomatis</option>
                    </select>
                </div>
                @error('jenis_transmisi') <i class="text-danger">{{ $message }}</i> @enderror

                <div class="form-group">
                    <label for="kapasitas_mesin">Kapasitas Mesin</label>
                    <input type="text" class="form-control" wire:model="kapasitas_mesin" id="kapasitas_mesin" name="kapasitas_mesin" placeholder="Masukkan Kapasitas Mesin">
                </div>
                @error('kapasitas_mesin') <i class="text-danger">{{ $message }}</i> @enderror

                <div class="form-group">
                    <label for="tempat_duduk">Tempat Duduk</label>
                    <input type="number" class="form-control" wire:model="tempat_duduk" id="tempat_duduk" name="tempat_duduk" placeholder="Masukkan Tempat Duduk">
                </div>
                @error('tempat_duduk') <i class="text-danger">{{ $message }}</i> @enderror

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" wire:model="harga" name="harga" placeholder="Masukkan Harga">
                </div>
                @error('harga') <i class="text-danger">{{ $message }}</i> @enderror

               
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">{{$updateMode ? 'Update' : 'Simpan'}}</button>
              <button type="button" class="btn btn-secondary"
              data-bs-dismiss="modal">Close</button>
            </div>
        </form>

          </div>
    </div>
    {{-- @endif --}}
</div>

@push('scripts')
    <script>
     document.addEventListener('livewire:load', function () {
        // console.log(this.$wire.foo);
    });    
    window.addEventListener('close-modal', event => {
         $('#add_menu_item_modal').modal('hide');
    })
    Livewire.on('show-modal', () => {
      $('#add_menu_item_modal').modal('show');
    });
    </script>
@endpush
