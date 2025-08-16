@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-clock"></i>
                        Absensi Harian
                    </h4>
                </div>
                <div class="card-body text-center">
                    {{-- Tampilkan tanggal hari ini --}}
                    <div class="mb-4">
                        <h5 class="text-muted">{{ now()->isoFormat('dddd, D MMMM Y') }}</h5>
                        <h3 class="text-primary" id="current-time">{{ now()->format('H:i:s') }}</h3>
                    </div>

                    {{-- Status absensi hari ini --}}
                    @if($todayAttendance)
                        <div class="alert alert-info mb-4">
                            <strong>Status Hari Ini:</strong><br>
                            Clock In: {{ $todayAttendance->clock_in_time ?? '-' }}<br>
                            @if($todayAttendance->clock_out)
                                Clock Out: {{ $todayAttendance->clock_out_time }}
                            @else
                                <span class="text-warning">Belum Clock Out</span>
                            @endif
                        </div>
                    @endif

                    {{-- Jadwal Kerja Departemen --}}
                    <div class="mb-4">
                        <h5 class="text-success">
                            Jam Kerja: 
                            {{ $employee->departement->max_clock_in_time ?? '-' }} 
                            - 
                            {{ $employee->departement->max_clock_out_time ?? '-' }}
                        </h5>
                    </div>


                    {{-- Tombol Clock In/Out --}}
                    <div class="row">
                        <div class="col-md-6">
                            @if(!$todayAttendance)
                                <form action="{{ route('attendances.clockIn') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        <i class="fas fa-sign-in-alt"></i>
                                        Clock In
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-success btn-lg btn-block" disabled>
                                    <i class="fas fa-check"></i>
                                    Sudah Clock In
                                </button>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($todayAttendance && !$todayAttendance->clock_out)
                                <form action="{{ route('attendances.clockOut') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-lg btn-block">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Clock Out
                                    </button>
                                </form>
                            @elseif($todayAttendance && $todayAttendance->clock_out)
                                <button class="btn btn-secondary btn-lg btn-block" disabled>
                                    <i class="fas fa-check"></i>
                                    Sudah Clock Out
                                </button>
                            @else
                                <button class="btn btn-secondary btn-lg btn-block" disabled>
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Clock In Dulu
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Link ke riwayat absensi --}}
                    <div class="mt-4">
                        <a href="{{ route('attendances.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-history"></i>
                            Lihat Riwayat Absensi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update waktu setiap detik
    setInterval(function() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID');
        document.getElementById('current-time').textContent = timeString;
    }, 1000);
</script>
@endsection