<div>
    <h1 class="mt-4">Salesman</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Salesman</li>
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
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th>Area Sales</th>
                        <th>Target Jumlah Penjualan</th>
                        <th>Aksi</th>
                    </tr>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($sales as $key=> $sale)
                    <tr>
                        <td>{{ $no++}}</td>
                        <td>{{ $sale->nama }}</td>
                        <td>{{ $sale->no_telp }}</td>
                        <td>{{ $sale->email }}</td>
                        <td>{{ $sale->area_sales }}</td>
                        <td align="center">{{ $sale->target }}</td>
                        <td><a wire:click="edit('{{$sale->id_sales}}')" class="btn btn-secondary" 
                            >Edit</a>
                            <button wire:click="delete('{{$sale->id_sales}}')" class="btn btn-danger" 
                            >Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $sales->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    
    {{-- @if ($openForm) --}}
    <div wire:ignore.self class="modal fade" tabindex="-1" id="add_menu_item_modal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{$updateMode ?'Edit ' : 'Tambah'}} Data Salesman</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="store">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" wire:model="nama" name="nama" >
                </div>
                @error('nama') <i class="text-danger">{{ $message }}</i> @enderror
                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input type="text" class="form-control" id="no_telp" wire:model="no_telp" name="no_telp" >
                </div>
                @error('no_telp') <i class="text-danger">{{ $message }}</i> @enderror
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" wire:model="email" name="email" >
                </div>
                @error('email') <i class="text-danger">{{ $message }}</i> @enderror
                <div class="form-group">
                    <label for="area_sales">Area Sales</label>
                    {{-- <input type="text" class="form-control" id="area_sales" wire:model="area_sales" name="area_sales" > --}}
                    <select name="area_sales" wire:model="area_sales" class="form-control">
                        <option value="">Pilih Area sales</option>
                        <option value="Banjarbaru Sekitar">Banjarbaru Sekitar</option>
                        <option value="Palangka Raya Sekitar">Palangka Raya Sekitar</option>
                        <option value="Sampit Sekitar">Sampit Sekitar</option>
                    </select>
                    @error('area_sales') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
                <div class="form-group">
                    <label for="target">Target Jumlah Penjualan</label>
                    <input type="number" class="form-control" id="target" wire:model="target" name="target" >
                </div>
                @error('target') <i class="text-danger">{{ $message }}</i> @enderror
               
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
