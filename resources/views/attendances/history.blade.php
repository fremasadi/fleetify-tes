@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Detail Riwayat Absensi</h1>

    <div class="mb-3">
        <a href="{{ route('attendances.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-table"></i> Ringkasan Absensi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            @if(auth()->user()->role === 'admin')
                                <th>Karyawan</th>
                            @endif
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Waktu</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histories as $history)
                            <tr>
                                @if(auth()->user()->role === 'admin')
                                    <td>
                                        <div class="d-flex align-items-center">
                                
                                            <div class="ml-2">
                                                <div class="font-weight-bold">{{ $history->employee->user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                                <td>
                                    <div>{{ \Carbon\Carbon::parse($history->date_attendance)->format('d M Y') }}</div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($history->created_at)->format('H:i:s') }}</small>
                                </td>
                                <td>
                                    @if($history->attendance_type === 1)
                                        <span class="badge badge-success">
                                            <i class="fas fa-sign-in-alt"></i>
                                            Clock In
                                        </span>
                                    @elseif($history->attendance_type === 2)
                                        <span class="badge badge-danger">
                                            <i class="fas fa-sign-out-alt"></i>
                                            Clock Out
                                        </span>
                                    @else
                                        <span class="badge badge-info">{{ $history->attendance_type }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($history->attendance_type === 1 && $history->attendance)
                                        <strong class="text-success">{{ $history->attendance->clock_in_time }}</strong>
                                    @elseif($history->attendance_type === 2 && $history->attendance)
                                        <strong class="text-danger">{{ $history->attendance->clock_out_time }}</strong>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="text-truncate" title="{{ $history->description }}">
                                        {{ $history->description }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? '5' : '4' }}" class="text-center">
                                    Belum ada riwayat absensi
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