@extends('layouts.app')

@section('title', 'Detail Reservasi')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Detail Reservasi</h2>
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="card mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nomor Kamar</dt>
                <dd class="col-sm-9">{{ $reservation->room->room_number ?? '-' }}</dd>

                <dt class="col-sm-3">Tipe Kamar</dt>
                <dd class="col-sm-9">{{ $reservation->room->roomType->name ?? '-' }}</dd>

                <dt class="col-sm-3">Check-in</dt>
                <dd class="col-sm-9">{{ $reservation->check_in_date->format('d-m-Y') }}</dd>

                <dt class="col-sm-3">Check-out</dt>
                <dd class="col-sm-9">{{ $reservation->check_out_date->format('d-m-Y') }}</dd>

                <dt class="col-sm-3">Jumlah Tamu</dt>
                <dd class="col-sm-9">{{ $reservation->number_of_guests }}</dd>

                <dt class="col-sm-3">Total Harga</dt>
                <dd class="col-sm-9">Rp{{ number_format($reservation->total_price, 0, ',', '.') }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-{{ $reservation->status === 'pending' ? 'warning' : ($reservation->status === 'confirmed' ? 'success' : ($reservation->status === 'cancelled' ? 'danger' : 'secondary')) }}">
                        {{ ucfirst($reservation->status) }}
                    </span>
                </dd>

                @if($reservation->special_requests)
                <dt class="col-sm-3">Permintaan Khusus</dt>
                <dd class="col-sm-9">{{ $reservation->special_requests }}</dd>
                @endif

                @if($reservation->admin_notes)
                <dt class="col-sm-3">Catatan Admin</dt>
                <dd class="col-sm-9">{{ $reservation->admin_notes }}</dd>
                @endif
            </dl>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Kembali ke Daftar Reservasi</a>
        
        @if($reservation->status === 'confirmed')
            <a href="{{ route('reservations.print', $reservation->id) }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-print"></i> Cetak Reservasi
            </a>
        @endif
    </div>
</div>
@endsection 