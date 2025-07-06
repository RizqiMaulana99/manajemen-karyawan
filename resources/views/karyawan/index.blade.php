@extends('layout')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('karyawan.create') }}" class="btn btn-primary">+ Tambah Karyawan</a>

        <form action="{{ route('karyawan.index') }}" method="GET" class="d-flex" role="search">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($karyawans as $i => $k)
            <tr>
                <td>{{ $karyawans->firstItem() + $i }}</td>
                <td>{{ $k->nama }}</td>
                <td>{{ $k->jabatan }}</td>
                <td>
                @if ($k->foto)
                <img src="{{ asset('storage/' . $k->foto) }}" width="60">
                @else
                Tidak ada
                 @endif
                </td>
                <td>
                    <a href="{{ route('karyawan.edit', $k->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('karyawan.destroy', $k->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak ada data ditemukan.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $karyawans->withQueryString()->links() }}
    </div>
@endsection
