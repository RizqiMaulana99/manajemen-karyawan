@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Edit Karyawan</div>
        <div class="card-body">
            <form method="POST" action="{{ route('karyawan.store') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $karyawan->nama }}" required>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="{{ $karyawan->jabatan }}" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                @if ($karyawan->foto)
                <img src="{{ asset('storage/' . $karyawan->foto) }}" width="120" class="mb-3">
                @endif

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
