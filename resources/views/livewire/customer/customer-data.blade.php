<div>
    <h1 class="mt-4">Customer</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Customer</li>
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
                        <th>Jenis Identias</th>
                        <th>No Identias</th>
                        <th>No NPWP</th>
                        <th>Alamat KTP</th>
                        <th>Alamat Domisili</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($data as $key=> $item)
                    <tr>
                        <td>{{ $no++}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{ $item->jenis_identitas  }}</td>
                        <td>{{ $item->no_identitas }}</td>
                        <td>{{ $item->no_npwp }}</td>
                        <td>{{ $item->alamat_ktp }}</td>
                        <td>{{ $item->alamat_domisili }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->pekerjaan }}</td>
                        <td><a wire:click="edit('{{$item->id_customer}}')" class="btn btn-secondary" 
                            >Edit</a>
                            <button wire:click="delete('{{$item->id_customer}}')" class="btn btn-danger" 
                            >Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="add_menu_item_modal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{$updateMode ?'Edit ' : 'Tambah'}} Data Customer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="store">
                <div class="form-group">
                    <label for="nama">Nama (*)</label>
                    <input type="text" class="form-control" id="nama" wire:model="nama" name="nama" >
                    @error('nama') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
                <div class="form-group">
                    <label for="no_telp">No HP (*)</label>
                    <input type="text" class="form-control" id="no_hp" wire:model="no_hp" name="no_hp" >
                    @error('no_hp') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" wire:model="email" name="email" >
                    @error('email') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
                <div class="form-group">
                    <label for="email">Jenis Identias (*)</label>
                    <select wire:model="jenis_identitas"  class="form-control">
                        <option value="KTP">KTP</option>
                        <option value="SIM">SIM</option>
                        <option value="PASSPORT">PASSPORT</option>
                    </select>
                    @error('jenis_identitas') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
                <div class="form-group">
                    <label for="email">No Identias (KTP/SIM) (*)</label>
                    <input type="text" class="form-control" id="no_identitas" wire:model="no_identitas" name="no_identitas" >
                    @error('no_identitas') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
               
                <div class="form-group">
                    <label for="area_sales">Alamat (*)</label>
                    <input type="text" class="form-control"  id=" alamat_ktp " wire:model="alamat_ktp" name="alamat_ktp " >
                    @error('alamat_ktp') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
                <div class="form-group">
                    <label for="area_sales">Alamat Domisili (*)</label>
                    <input type="text" class="form-control"  id=" alamat_domisili " wire:model="alamat_domisili" name="alamat_domisili " >
                    @error('alamat_domisili') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
                <div class="form-group">
                    <label for="email">No NPWP</label>
                    <input type="text" class="form-control" id="no_npwp" wire:model="no_npwp" name="no_npwp" >
                    @error('no_npwp') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
                <div class="form-group">
                    <label for="target">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan" wire:model="pekerjaan" name="pekerjaan" >
                    @error('pekerjaan') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
               
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">{{$updateMode ? 'Update' : 'Simpan'}}</button>
              <button type="button" class="btn btn-secondary"
              data-bs-dismiss="modal">Close</button>
            </div>
        </form>

          </div>
    </div>
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
