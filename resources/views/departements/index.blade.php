@extends('layouts.app') 

@section('title', 'Manajemen Departemen')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Departemen</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('departements.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Departemen
    </a>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Departemen</th>
                            <th>Batas Clock In</th>
                            <th>Batas Clock Out</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departements as $dept)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dept->departement_name }}</td>
                                <td>{{ $dept->max_clock_in_time ?? '-' }}</td>
                                <td>{{ $dept->max_clock_out_time ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('departements.edit', $dept) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('departements.destroy', $dept) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data departemen.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('components.delete-alert')

@endsection
