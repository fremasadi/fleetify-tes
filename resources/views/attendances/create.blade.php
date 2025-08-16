@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Absensi</h1>

    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="employee_id">Karyawan</label>
            <select name="employee_id" class="form-control" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="clock_in">Clock In</label>
            <input type="datetime-local" name="clock_in" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="clock_out">Clock Out</label>
            <input type="datetime-local" name="clock_out" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
