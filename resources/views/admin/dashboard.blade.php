@extends('layouts.app')

@section('title', 'Admin Dashboard - Hotel Sintia')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold">Admin Dashboard</h1>
                    <p class="text-muted">Selamat datang di panel admin, {{ Auth::user()->name }}!</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.room-types') }}" class="btn btn-primary">
                        <i class="fas fa-bed me-2"></i>Kelola Kamar
                    </a>
                    <a href="{{ route('admin.reservations') }}" class="btn btn-success">
                        <i class="fas fa-calendar me-2"></i>Kelola Reservasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $totalUsers }}</h3>
                            <p class="text-muted mb-0">Total Pengguna</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-bed fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $totalRooms }}</h3>
                            <p class="text-muted mb-0">Total Kamar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $totalReservations }}</h3>
                            <p class="text-muted mb-0">Total Reservasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $pendingReservations }}</h3>
                            <p class="text-muted mb-0">Menunggu Konfirmasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-bolt me-2 text-warning"></i>Aksi Cepat
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-2">
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-users me-2"></i>Kelola User
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.room-types') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-bed me-2"></i>Tipe Kamar
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.rooms') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-door-open me-2"></i>Kamar
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.facilities') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-star me-2"></i>Fasilitas
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.reservations') }}" class="btn btn-outline-danger w-100">
                                <i class="fas fa-calendar me-2"></i>Reservasi
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-home me-2"></i>Website
                            </a>
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
                        <a href="{{ route('admin.reservations') }}" class="btn btn-outline-primary btn-sm">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($recentReservations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>User</th>
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
                                            <strong>{{ $reservation->user->name }}</strong><br>
                                            <small class="text-muted">{{ $reservation->user->email }}</small>
                                        </td>
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
                                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                                    data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $reservation->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
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
                            <p class="text-muted">Tidak ada reservasi terbaru untuk ditampilkan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modals -->
@foreach($recentReservations as $reservation)
<div class="modal fade" id="updateStatusModal{{ $reservation->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status Reservasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.reservations.update-status', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="checked_in" {{ $reservation->status == 'checked_in' ? 'selected' : '' }}>Check In</option>
                            <option value="checked_out" {{ $reservation->status == 'checked_out' ? 'selected' : '' }}>Check Out</option>
                            <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Catatan Admin</label>
                        <textarea class="form-control" name="admin_notes" rows="3">{{ $reservation->admin_notes }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection 