@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Dashboard HR</h1>
    <a href="{{ route('materials.create') }}" class="btn btn-primary mb-3">Tambah Materi</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Views</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
            <tr>
                <td>{{ $material->title }}</td>
                <td>{{ $material->category->name }}</td>
                <td>{{ $material->views }}</td>
                <td>
                    <a href="{{ route('materials.show', $material->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection