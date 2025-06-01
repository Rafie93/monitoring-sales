
@extends('layouts.app')
@section('breadcrumb')
<h1 class="mt-4">Kategori</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Kategori</li>
    <li class="breadcrumb-item active">Data</li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="card mb-4">
        <div class="card-header">
            Data Kategori
        </div>
        <br/>
        <div class="col-xl-3 col-md-3">
            <a href="{{route('category.create')}}" 
            class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="col-xl-9 col-md-9">
        </div>
        <div class="card-body ">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($data as $key=> $k)
                <tr>
                    <td>{{ $key + $data->firstItem() }}</td>
                    <td>{{$k->name}}</td>
                    <td>{{$k->status()}}</td>
                    <td><a class="btn btn-secondary" href="{{route('category.edit',$k->id_kategori)}}">Edit</a>
                        <a class="btn btn-danger" href="{{route('category.destroy',$k->id_kategori)}}">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
