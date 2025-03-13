@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Dashboard Karyawan</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Judul Materi</th>
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
                    <a href="{{ route('materials.show', $material->id) }}" class="btn btn-primary btn-sm">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection