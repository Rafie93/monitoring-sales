<div>
    <h1 class="mt-4">Hari Kerja</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Hari Kerja</li>
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
                        <th>Tahun</th>                        
                        <th>Bulan</th>
                        <th>Jumlah Kerja</th>
                        <th>Aksi</th>
                    </tr>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($data as $key=> $k)
                    <tr>
                        <td>{{ $no++}}</td>
                        <td align="center">{{$k->tahun}}</td>
                        <td align="center">{{intToMonth($k->bulan)}}</td>
                        <td align="center">{{$k->jumlah_kerja}}</td>
                        <td><a wire:click="showForm('{{$k->id}}')" class="btn btn-secondary" 
                            >Edit</a>
                            <button wire:click="delete('{{$k->id}}')" class="btn btn-danger" 
                            >Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{-- {{ $data->links('pagination::bootstrap-5') }} --}}
            </div>
        </div>
    </div>

    
    {{-- @if ($openForm) --}}
    <div wire:ignore.self class="modal fade" tabindex="-1" id="add_menu_item_modal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{$openForm ?'Edit ' : 'Tambah'}} Data Hari Kerja</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="store">
                <div class="form-group">
                    <label for="recipient" class="form-control-label">Tahun :</label>
                    <select 
                        wire:model="tahun" class="form-control" >
                        {{-- {{ $year = date('Y') }} --}}
                        @foreach (getTahun() as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('tahun') <i class="text-danger">{{ $message }}</i> @enderror
                </div>
                <div class="form-group">
                    <label for="recipient" class="form-control-label">Bulan :</label>
                    <select
                        wire:model="bulan" class="form-control" >
                        <option value="">Pilih Bulan</option>
                        @foreach (getBulan() as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('bulan') <i class="text-danger">{{ $message }}</i> @enderror
                </div>

                <div class="form-group">
                  <label for="recipient" class="form-control-label">Jumlah Kerja :</label>
                  <input type="number" class="form-control" id="recipient" wire:model="jumlah_kerja">
                  @error('jumlah_kerja') <i class="text-danger">{{ $message }}</i> @enderror

                </div>
               
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">{{$openForm ? 'Update' : 'Simpan'}}</button>
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
