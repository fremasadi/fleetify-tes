@extends('layouts.app')

@section('title', 'Edit Departemen')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Departemen</h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('departments.update', $department) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Departemen</label>
                    <input type="text" name="departement_name" class="form-control @error('departement_name') is-invalid @enderror" value="{{ old('departement_name', $department->departement_name) }}" required>
                    @error('departement_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Batas Clock In</label>
                    <input type="time" name="max_clock_in_time" class="form-control @error('max_clock_in_time') is-invalid @enderror" value="{{ old('max_clock_in_time', $department->max_clock_in_time) }}">
                    @error('max_clock_in_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Batas Clock Out</label>
                    <input type="time" name="max_clock_out_time" class="form-control @error('max_clock_out_time') is-invalid @enderror" value="{{ old('max_clock_out_time', $department->max_clock_out_time) }}">
                    @error('max_clock_out_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
