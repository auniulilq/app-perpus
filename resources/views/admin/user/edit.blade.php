@extends('app')
@section('title', 'Ubah User')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Ubah User</div>
        </div>
        <div class="card-body">
            <div>
                <ul style="background-color: red">
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <form action="{{ route('user.update', $edit->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ $edit->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $edit->email }}" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>


            </form>
        </div>
    </div>
                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                <a href="{{ url()->previous() }}" class="btn btn-success">Kembali</a>

            </form>
        </div>
    </div>
@endsection