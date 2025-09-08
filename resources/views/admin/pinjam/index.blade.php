@extends('app')
@section('title','Data Peminjaman Buku')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{$title ?? ''}}</h3>
            <div align='right' class="mb-3">
                <a href="{{route('transaction.create')}}" class="btn btn-secondary">Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Peminjaman</th>
                            <th>Anggota</th>
                            <th>Denda</th>
                            <th>Aktual Tanggal</th>
                            <th>Denda</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $index => $borrow )
                        <tr>
                            <td>{{$index  +1 }}</td>
                            <td>{{$borrow->trans_number}}</td>
                            <td>{{$borrow->member->nama_anggota}}</td>
                            <td>{{\Carbon\Carbon::parse($borrow->return_date)->format('d-M-Y') }}</td>
                             <td>{{\Carbon\Carbon::parse($borrow->actual_return_date)->format('d-M-Y') }}</td>
                             <td>{{number_format($borrow->find)}}</td>
                             <td>{{$borrow->status ==1 ? 'Dipinjam' : 'Sudah dikembalikan'}}</td>
                            <td>
                                <a href="{{route('transaction.show',$borrow->id)}}" class="btn btn-success btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{route('transaction.destroy',$borrow->id)}}" method="post" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" href="" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @if ($borrow->status)
                                <form action="{{route('transaction.return',$borrow->id)}}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" href="" class="btn btn-warning btn-sm">
                                        Kembalikan
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection