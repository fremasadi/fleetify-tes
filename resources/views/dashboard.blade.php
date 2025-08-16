@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>



{{-- Jika role admin --}}
@if(Auth::user()->role === 'admin')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow border-left-primary">
            <div class="card-body">
                <h5>Total Karyawan</h5>
                <h3>{{ $totalEmployees }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card shadow border-left-success">
            <div class="card-body">
                <h5>Total Absensi Hari Ini</h5>
                <h3>{{ $todayAttendances }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card shadow border-left-warning">
            <div class="card-body">
                <h5>Departemen</h5>
                <h3>{{ $totalDepartments }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Riwayat Absensi Terbaru</h5>
            </div>
            <div class="card-body">
                <ul>
                    @forelse($latestHistories as $history)
                        <li>
                            {{ $history->employee->user->name }} -
                            {{ $history->description }} ({{ $history->date_attendance }})
                        </li>
                    @empty
                        <li>Belum ada data absensi</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Jika role karyawan --}}
@if(Auth::user()->role === 'employee')
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow border-left-info">
            <div class="card-body text-center">
                <h5>Jam Kerja</h5>
                <p>
                    Masuk: {{ Auth::user()->employee->departement->max_clock_in_time ?? '-' }} <br>
                    Pulang: {{ Auth::user()->employee->departement->max_clock_out_time ?? '-' }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow border-left-success">
            <div class="card-body text-center">
                <h5>Status Absensi Hari Ini</h5>
                @if($todayAttendance)
                    <p>Clock In: {{ $todayAttendance->clock_in ?? '-' }}</p>
                    <p>Clock Out: {{ $todayAttendance->clock_out ?? '-' }}</p>
                @else
                    <p class="text-warning">Belum melakukan absensi</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection
