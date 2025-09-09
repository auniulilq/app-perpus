@extends('app')
@section('title', 'Tambah User')
@section('content')

<div class="card">
    <div class="card-body">
        <h3 class="card-title">Tambah Role</h3>

        <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">pilih Role</label>
                <select class="form-control" id="name" name="roles[]" multiple>
                    @foreach($roles as $role)
                        <option {{ $user->roles->contains($role->id) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{url()->previous()}}" class="btn btn-success">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection