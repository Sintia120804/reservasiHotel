@extends('layouts.app')

@section('title', 'Dashboard - Hotel Sintia')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold">Dashboard</h1>
                    <p class="text-muted">Selamat datang kembali, {{ Auth::user()->name }}!</p>
                </div>
                <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Buat Reservasi
                </a>
            </div>
        </div>
    </div>

    <!-- User Info Card -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-user me-2 text-primary"></i>Informasi Profil
                    </h5>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Nama:</strong></p>
                            <p class="text-muted">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Email:</strong></p>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    @if(Auth::user()->phone)
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Telepon:</strong></p>
                            <p class="text-muted">{{ Auth::user()->phone }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Alamat:</strong></p>
                            <p class="text-muted">{{ Auth::user()->address ?: 'Tidak diisi' }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-chart-bar me-2 text-success"></i>Statistik Reservasi
                    </h5>
                    @php
                        $totalReservations = Auth::user()->reservations()->count();
                        $pendingReservations = Auth::user()->reservations()->where('status', 'pending')->count();
                        $confirmedReservations = Auth::user()->reservations()->where('status', 'confirmed')->count();
                        $completedReservations = Auth::user()->reservations()->whereIn('status', ['checked_out'])->count();
                    @endphp
                    <div class="row text-center">
                        <div class="col-6">
                            <h3 class="text-primary fw-bold">{{ $totalReservations }}</h3>
                            <p class="text-muted mb-0">Total Reservasi</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-warning fw-bold">{{ $pendingReservations }}</h3>
                            <p class="text-muted mb-0">Menunggu Konfirmasi</p>
                        </div>
                    </div>
                    <div class="row text-center mt-3">
                        <div class="col-6">
                            <h3 class="text-info fw-bold">{{ $confirmedReservations }}</h3>
                            <p class="text-muted mb-0">Dikonfirmasi</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-success fw-bold">{{ $completedReservations }}</h3>
                            <p class="text-muted mb-0">Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Reservasi Terbaru
                        </h5>
                        <a href="{{ route('reservations.index') }}" class="btn btn-outline-primary btn-sm">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $recentReservations = Auth::user()->reservations()
                            ->with('room.roomType')
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp
                    
                    @if($recentReservations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Kamar</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentReservations as $reservation)
                                    <tr>
                                        <td>
                                            <strong>{{ $reservation->room->room_number }}</strong><br>
                                            <small class="text-muted">{{ $reservation->room->roomType->name }}</small>
                                        </td>
                                        <td>{{ $reservation->check_in_date->format('d/m/Y') }}</td>
                                        <td>{{ $reservation->check_out_date->format('d/m/Y') }}</td>
                                        <td>Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            @switch($reservation->status)
                                                @case('pending')
                                                    <span class="badge bg-warning">Menunggu</span>
                                                    @break
                                                @case('confirmed')
                                                    <span class="badge bg-info">Dikonfirmasi</span>
                                                    @break
                                                @case('checked_in')
                                                    <span class="badge bg-primary">Check In</span>
                                                    @break
                                                @case('checked_out')
                                                    <span class="badge bg-success">Selesai</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge bg-danger">Dibatalkan</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ route('reservations.show', $reservation->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada reservasi</h5>
                            <p class="text-muted">Mulai buat reservasi pertama Anda sekarang!</p>
                            <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Buat Reservasi
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-bolt me-2 text-warning"></i>Aksi Cepat
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('reservations.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus me-2"></i>Buat Reservasi
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('reservations.index') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-list me-2"></i>Lihat Reservasi
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('rooms') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-bed me-2"></i>Lihat Kamar
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('contact') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-phone me-2"></i>Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 