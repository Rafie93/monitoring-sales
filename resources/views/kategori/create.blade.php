
@extends('layouts.app')
@section('breadcrumb')
<h1 class="mt-4">Kategori</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Kategori</li>
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Tambah Kategori</li>
</ol>
@endsection
@section('content')

<div class="row">
   <div class="card">
        <div class="card-body">
            <form action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
               
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
   </div>
</div>
@endsection