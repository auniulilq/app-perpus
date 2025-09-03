@extends('app')
@section('title', 'Create Location of Books')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Create Location</div>
        </div>
        <div class="card-body">
            <form action="{{ route('lokasi.store') }}" method="post">
                @csrf
                <label for="" class="form-label">Kode Lokasi</label>
                <input type="text" class="form-control" name="kode_lokasi">

                <label for="" class="form-label">Label</label>
                <input type="text" class="form-control" name="label">

                <label for="" class="form-label">Rak Buku</label>
                <input type="text" class="form-control" name="rak">

                <button type="submit" class="btn btn-primary mt-2">Kirim</button>
            </form>
        </div>
    </div>
@endsection
