@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        @if(auth()->user()->role === 'admin')
            Log Absensi Karyawan
        @else
            Ringkasan Absensi
        @endif
    </h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(auth()->user()->role === 'admin')
    <!-- Filter Section for Admin -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('attendances.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <label for="date_from">Tanggal Dari:</label>
                        <input type="date" class="form-control" name="date_from" 
                               value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="date_to">Tanggal Sampai:</label>
                        <input type="date" class="form-control" name="date_to" 
                               value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="departement_id">Departemen:</label>
                        <select class="form-control" name="departement_id">
                            <option value="">Semua Departemen</option>
                            @foreach($departements as $dept)
                                <option value="{{ $dept->id }}" 
                                        {{ request('departement_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->departement_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-search"></i> Filter
                        </button>
                        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
                            <i class="fas fa-refresh"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            @if(auth()->user()->role === 'admin')
                                <th>Nama Karyawan</th>
                                <th>Departemen</th>
                            @endif
                            <th>Tanggal</th>
                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Status</th>
                            @if(auth()->user()->role === 'admin')
                                <th>Ketepatan</th>
                                <th>Durasi Kerja</th>
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                            <tr>
                                @if(auth()->user()->role === 'admin')
                                    <td>{{ $attendance->employee->user->name }}</td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $attendance->employee->departement->departement_name ?? 'Tidak ada' }}
                                        </span>
                                    </td>
                                @endif
                                <td>{{ $attendance->date }}</td>
                                <td>
                                    {{ $attendance->clock_in_time ?? '-' }}
                                    @if(auth()->user()->role === 'admin' && $attendance->clock_in)
                                        <br>
                                        <small class="text-muted">
                                            Max: {{ $attendance->employee->departement->max_clock_in_time ?? 'Tidak diatur' }}
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    {{ $attendance->clock_out_time ?? '-' }}
                                    @if(auth()->user()->role === 'admin' && $attendance->clock_out)
                                        <br>
                                        <small class="text-muted">
                                            Max: {{ $attendance->employee->departement->max_clock_out_time ?? 'Tidak diatur' }}
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @if($attendance->clock_out)
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-warning">Belum Clock Out</span>
                                    @endif
                                </td>
                                @if(auth()->user()->role === 'admin')
                                    <td>
                                        <!-- Clock In Status -->
                                        @if($attendance->clock_in_status === 'on_time')
                                            <span class="badge badge-success mb-1">
                                                <i class="fas fa-check"></i> Tepat Waktu
                                            </span>
                                        @elseif($attendance->clock_in_status === 'late')
                                            @php
                                                $lateMinutes = (int) round(abs($attendance->clock_in_late_minutes)); // buang minus & bulatkan
                                                $hours = floor($lateMinutes / 60);
                                                $minutes = $lateMinutes % 60;
                                                $formatted = '';
                                                if ($hours > 0) {
                                                    $formatted .= $hours . ' jam ';
                                                }
                                                if ($minutes > 0) {
                                                    $formatted .= $minutes . ' menit';
                                                }
                                            @endphp

                                            <span class="badge badge-danger mb-1">
                                                <i class="fas fa-clock"></i> Terlambat {{ $formatted }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary mb-1">
                                                <i class="fas fa-question"></i> Tidak ada aturan
                                            </span>
                                        @endif
                                        <br>
                                        
                                        <!-- Clock Out Status -->
                                        @if($attendance->clock_out)
                                            @if($attendance->clock_out_status === 'on_time')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check"></i> Pulang Tepat
                                                </span>
                                            @elseif($attendance->clock_out_status === 'late')
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock"></i> Pulang Terlambat {{ $attendance->clock_out_late_minutes }} menit
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">
                                                    <i class="fas fa-question"></i> Tidak ada aturan
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($attendance->work_duration)
                                            <span class="badge badge-info">
                                                <i class="fas fa-hourglass-half"></i> {{ $attendance->work_duration }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('attendances.edit', $attendance->id) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? '9' : '4' }}" class="text-center">
                                    Tidak ada data absensi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection