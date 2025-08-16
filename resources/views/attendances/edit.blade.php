@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Absensi - {{ $attendance->employee->user->name }}</h1>
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Waktu Absensi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="employee_name" class="form-label">Nama Karyawan</label>
                                <input type="text" class="form-control" value="{{ $attendance->employee->user->name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="text" class="form-control" value="{{ $attendance->created_at->format('d/m/Y') }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="clock_in" class="form-label">Clock In <span class="text-danger">*</span></label>
                                <input type="time" 
                                       class="form-control @error('clock_in') is-invalid @enderror" 
                                       id="clock_in" 
                                       name="clock_in" 
                                       value="{{ $attendance->clock_in ? $attendance->clock_in->format('H:i') : '' }}" 
                                       required>
                                @error('clock_in')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="clock_out" class="form-label">Clock Out</label>
                                <input type="time" 
                                       class="form-control @error('clock_out') is-invalid @enderror" 
                                       id="clock_out" 
                                       name="clock_out" 
                                       value="{{ $attendance->clock_out ? $attendance->clock_out->format('H:i') : '' }}">
                                @error('clock_out')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Kosongkan jika belum clock out</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('attendances.index') }}" class="btn btn-secondary ml-2">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Informasi</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Waktu Clock In Saat Ini:</strong><br>
                        <span class="text-primary">
                            {{ $attendance->clock_in ? $attendance->clock_in->format('H:i:s') : 'Belum clock in' }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong>Waktu Clock Out Saat Ini:</strong><br>
                        <span class="text-success">
                            {{ $attendance->clock_out ? $attendance->clock_out->format('H:i:s') : 'Belum clock out' }}
                        </span>
                    </div>
                    <div class="alert alert-warning">
                        <small>
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Perhatian:</strong> Perubahan ini akan tercatat dalam history absensi.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection