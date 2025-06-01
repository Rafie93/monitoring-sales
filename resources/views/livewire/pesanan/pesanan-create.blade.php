<div>
    <h1 class="mt-4">Pesanan Kendaraan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Pesanan Kendaraan</li>
        <li class="breadcrumb-item">
            <a href="{{route('pesanan')}}" wire:navigate>Data</a>
        </li>
        <li class="breadcrumb-item active">{{$id_pesanan?'Edit' : 'Tambah'}} Pesanan Kendaraan</li>
    </ol>
    <div class="row">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
              <form wire:submit.prevent="store">
                <!-- No SPK and Tanggal SPK -->
               <div class=" row g-3 border border-1-5 border-black p-3 mb-4 rounded">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="namaCustomer" class="form-label d-flex align-items-center gap-4">
                            <span style="width: 200px;">No SPK</span>
                            <input
                                type="text"
                                id="noSpk"
                                maxlength="50"
                                class="form-control"
                                aria-label="No SPK"
                                wire:model="no_spk"
                            />
                            @error('no_spk') <i class="text-danger">{{ $message }}</i> @enderror

                            <span style="width: 200px;">Tanggal SPK</span>
                            <input
                            type="date"
                            id="tanggalSpk"
                            maxlength="10"
                            class="form-control"
                            value="/ /"
                            aria-label="Tanggal SPK"
                            wire:model="tanggal_pesanan"
                            />
                            @error('tanggal_pesanan') <i class="text-danger">{{ $message }}</i> @enderror

                        </label>
                    </div>
                      
                </div>
               </div>
                
    
                <!-- Data Customer and Data STNK -->
                <div class="row g-4 mb-4">
                  <!-- Data Customer -->
                  <fieldset class="col-md-6">
                    <legend>Data Customer</legend>
                    <div class="mb-3" wire:ignore>
                      <label for="namaCustomer" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 200px;">Nama</span>
                          <select wire:change="getCustomer"
                            id="namaCustomer" wire:model="id_customer" 
                            class="form-control select2" aria-label="Nama Customer">
                              <option value="">--Cari Data Customer--</option>
                              @foreach ($customers as $item)
                                  <option value="{{$item->id_customer}}">{{$item->nama}} || {{$item->no_identitas}}</option>
                              @endforeach
                          </select>
                          @error('id_customer') <i class="text-danger">{{ $message }}</i> @enderror

                      </label>
                    </div>
                    <div class="mb-3">
                      <label for="alamatKtp" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 300px;">Alamat KTP</span>
                        <input
                          type="text"
                          id="alamatKtp"
                          disabled
                          class="form-control"
                          aria-label="Alamat KTP"
                          wire:model="alamat_ktp"
                        />
                      </label>
                    </div>
                    <div class="mb-3">
                      <label for="alamatDomisili" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 300px;">Alamat Domisili</span>
                        <input
                          type="text"
                          id="alamatDomisili"
                          maxlength="255"
                          disabled
                          class="form-control"
                          aria-label="Alamat Domisili"
                          wire:model="alamat_domisili"
                        />
                      </label>
                    </div>
                    <button type="button" class="btn-link-custom" aria-label="Lihat Selengkapnya">
                      Lihat Selengkapnya &gt;&gt;
                    </button>
                  </fieldset>
    
                  <!-- Data STNK -->
                  <fieldset class="col-md-6">
                    <legend>Data STNK</legend>
                    <div class="mb-3">
                      <label for="namaStnk" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 100px;">Nama</span>
                        <input
                          type="text"
                          id="namaStnk"
                          maxlength="50"
                          class="form-control"
                          aria-label="Nama STNK"
                          wire:model="stnk_nama"
                        />
                        @error('nama_stnk') <i class="text-danger">{{ $message }}</i> @enderror

                      </label>
                    </div>
                    <div class="mb-3">
                      <label for="nik" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 100px;">NIK</span>
                        <input
                          type="text"
                          id="nik"
                          maxlength="50"
                          class="form-control"
                          aria-label="NIK"
                          wire:model="stnk_nik"
                        />
                        @error('stnk_nik') <i class="text-danger">{{ $message }}</i> @enderror

                      </label>
                    </div>
                    <div class="mb-3">
                      <label for="alamatStnk" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 100px;">Alamat</span>
                        <input
                          type="text"
                          id="alamatStnk"
                          maxlength="255"
                          class="form-control"
                          aria-label="Alamat STNK"
                          wire:model="stnk_alamat"
                        />
                        @error('stnk_alamat') <i class="text-danger">{{ $message }}</i> @enderror

                      </label>
                    </div>
                  </fieldset>
                </div>
    
                <!-- Data Mobil -->
                <fieldset class="border border-1-5 border-black rounded p-3 mb-4">
                  <legend>Data Mobil</legend>
                  <div class="mb-3" wire:ignore>
                    <label for="tipe_mobil" class="form-label d-flex align-items-center gap-2">
                      <span style="width: 160px;">Tipe Mobil</span>
                      <select id="id_mobil" wire:model="id_mobil" wire:change="getMobil"  
                      class="form-control select2" aria-label="Tipe Mobi">
                          <option value="">--Cari Data Tipe Mobil--</option>
                          @foreach ($mobils as $item)
                            <option value="{{$item->id_mobil}}"> {{$item->tipe->tipe.' | '.$item->sub_tipe.' | '.$item->jenis_transmisi.' | '.$item->kapasitas_mesin}}</option>
                        @endforeach
                      </select>
                      @error('id_mobil') <i class="text-danger">{{ $message }}</i> @enderror

                    </label>
                  </div>
                  <div class="mb-3">
                    <label for="alamatKtp" class="form-label d-flex align-items-center gap-2">
                      <span style="width: 190px;">Warna Mobil</span>
                      <select id="warna" wire:model="warna" 
                      class="form-control" aria-label="Tipe Mobi">
                          <option value="">--Pilih Warna Mobil--</option>
                        @foreach ($warnas as $item)
                            <option value="{{$item}}"> {{$item}}</option>
                        @endforeach
                      </select>
                      @error('warna') <i class="text-danger">{{ $message }}</i> @enderror

                      {{-- <input type="text" disabled class="form-control" wire:model="warna"> --}}
                    </label>
                  </div>
                  <div class="mb-3">
                    <label for="alamatKtp" class="form-label d-flex align-items-center gap-2">
                      <span style="width: 190px;">Tipe Plat</span>
                      <select id="tipe_mobil" wire:model="tipe_plat" class="form-control" aria-label="Tipe Plat">
                            <option value="">--Pilih Tipe Plat Mobil--</option>
                            <option value="Putih">Putih</option>
                            <option value="Merah">Merah</option>
                            <option value="Kuning">Kuning</option>
                            <option value="Hitam">Hitam</option>
                            
                        </select>
                        @error('tipe_plat') <i class="text-danger">{{ $message }}</i> @enderror

                    </label>
                  </div>
                    
                   
                  </div>
                </fieldset>
    
                <!-- Rincian Biaya -->
                <fieldset class="border border-1-5 border-black rounded p-3 mb-4">
                  <legend>Rincian Biaya</legend>
                  <div class="row g-3">
                    <div class="col-auto" style="min-width: 180px;">
                      <label for="harga" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 80px;">Harga</span>
                        <input
                          type="number"
                          id="harga" disabled
                          maxlength="11"
                          class="form-control"
                          style="max-width: 160px;"
                          aria-label="Harga"
                          wire:model="harga"
                        />
                        @error('harga') <i class="text-danger">{{ $message }}</i> @enderror

                      </label>
                    </div>
                    <div class="col-auto" style="min-width: 180px;">
                      <label for="jumlahUnit" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 80px;">Jumlah Unit</span>
                        <input
                          type="number"
                          id="jumlahUnit"
                          maxlength="2"
                          class="form-control"
                          value="1"
                          style="max-width: 60px;"
                          aria-label="Jumlah Unit"
                          wire:model="jumlah_unit"
                          wire:keyup="hitung"
                          wire:change="hitung"
                        />
                        @error('jumlah_unit') <i class="text-danger">{{ $message }}</i> @enderror

                      </label>
                    </div>
                    <div class="col-auto" style="min-width: 180px;">
                      <label for="hargaTotal" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 80px;">Harga Total</span>
                        <input
                          type="number"
                          id="hargaTotal"
                          maxlength="11"
                          disabled
                          class="form-control"
                          style="max-width: 160px;"
                          aria-label="Harga Total"
                          wire:model="harga_total"
                        />
                        @error('harga_total') <i class="text-danger">{{ $message }}</i> @enderror

                      </label>
                    </div>
                    <div class="col-auto" style="min-width: 180px;">
                      <label for="diskon" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 80px;">Diskon</span>
                        <input
                          type="number"
                          id="diskon"
                          maxlength="11"
                          class="form-control"
                          style="max-width: 100px;"
                          aria-label="Diskon"
                          wire:model="diskon"
                          wire:keyup="hitung"
                        />
                        @error('diskon') <i class="text-danger">{{ $message }}</i> @enderror

                      </label>
                    </div>
                    <div class="col-auto" style="min-width: 180px;">
                      <label for="totalAkhir" class="form-label d-flex align-items-center gap-2">
                        <span style="width: 80px;">Total Akhir</span>
                        <input
                          type="number"
                          disabled
                          id="totalAkhir"
                          maxlength="11"
                          class="form-control"
                          style="max-width: 180px;"
                          aria-label="Total Akhir"
                          wire:model="total"
                        />
                        @error('total') <i class="text-danger">{{ $message }}</i> @enderror

                      </label>
                    </div>
                  </div>
                </fieldset>
                
                @if ($role==1)
                    <fieldset class="border border-1-5 border-black rounded p-3 mb-4">
                      <div class="mb-3" wire:ignore>
                        <label for="sales" class="form-label d-flex align-items-center gap-2">
                          <span style="width: 160px;">Sales</span>
                          <select id="id_sales" wire:model="id_sales"  
                          class="form-control select2" aria-label="Sales Mobil">
                              <option value="">--Cari Data Sales--</option>
                              @foreach ($sales as $item)
                                <option value="{{$item->id_sales}}"> {{$item->nama.' | '.$item->area_sales}}</option>
                            @endforeach
                          </select>
                          @error('id_sales') <i class="text-danger">{{ $message }}</i> @enderror

                        </label>
                      </div>
                    </fieldset>
                @endif
                <!-- Buttons -->
                <div class="d-flex gap-3">
                  <button type="submit"
                   class="btn btn-primary border border-1-5 border-black text-white fw-bold" 
                   style="font-family: monospace; font-size: 0.875rem; height: 36px;">
                    {{$id_pesanan ? 'UPDATE ' : 'SIMPAN '}} & LANJUTKAN
                  </button>
                  <button type="reset" class="btn btn-light border border-1-5 border-black text-black fw-bold" style="font-family: monospace; font-size: 0.875rem; width: 120px; height: 36px;">
                    RESET
                  </button>
                </div>
              </form>
              <br><br>
            </div>
          </div>
    </div>
    
</div>

@push('styles')
<style>
    /* Custom border thickness and font to match original */
    .border-1-5 {
      border-width: 1.5px !important;
    }
    .form-control, .form-select {
      font-family: monospace !important;
      font-size: 0.875rem !important; /* text-sm */
      border: 1.5px solid black !important;
      height: 28px !important;
      padding-left: 0.25rem !important;
    }
    .form-control:focus, .form-select:focus {
      box-shadow: none !important;
      border-color: black !important;
    }
    fieldset {
      border: 1.5px solid black !important;
      padding: 1rem 1rem 1rem 1rem !important;
      margin-bottom: 1.5rem;
      border-radius: 0.375rem;
      background: #fff;
    }
    legend {
      font-family: monospace;
      font-size: 0.75rem;
      padding: 0 0.5rem;
      width: auto;
    }
    label > span {
      font-family: monospace;
      font-size: 0.75rem;
      display: inline-block;
      width: 60px;
    }
    .btn-link-custom {
      font-family: monospace;
      font-size: 0.75rem;
      text-decoration: underline;
      background: none;
      border: none;
      padding: 0;
      margin-top: 0.25rem;
      color: #0d6efd;
      cursor: pointer;
    }
    .calendar-icon {
      color: black;
      font-size: 1rem;
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      pointer-events: none;
    }
    .form-label {
      font-family: monospace;
      font-size: 0.75rem;
      margin-bottom: 0.25rem;
    }
    .btn-custom {
      border: 1.5px solid black;
      background-color: white;
      color: black;
      font-family: monospace;
      font-size: 0.875rem;
      width: 120px;
      height: 36px;
      padding: 0;
    }
  </style>
@endpush

@push('scripts')
  <script>
     $(document).ready(function() {
          $('#namaCustomer').on('change', function(e) {
                var data = $('#namaCustomer').select2("val");
                @this.set('id_customer', data);
                @this.getCustomer()
          });

          $('#id_mobil').on('change', function(e) {
                var data = $('#id_mobil').select2("val");
                @this.set('id_mobil', data);
                @this.getMobil()
          });

          $('#id_sales').on('change', function(e) {
                var data = $('#id_sales').select2("val");
                @this.set('id_sales', data);
          });
     });
  </script>
@endpush
