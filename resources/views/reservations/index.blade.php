@extends('layouts.app')

@section('title', 'Daftar Reservasi')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Reservasi Saya</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($reservations->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Tamu</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $i => $reservation)
                        <tr>
                            <td>{{ $i + $reservations->firstItem() }}</td>
                            <td>{{ $reservation->room->room_number ?? '-' }}</td>
                            <td>{{ $reservation->room->roomType->name ?? '-' }}</td>
                            <td>{{ $reservation->check_in_date->format('d-m-Y') }}</td>
                            <td>{{ $reservation->check_out_date->format('d-m-Y') }}</td>
                            <td>{{ $reservation->number_of_guests }}</td>
                            <td>Rp{{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $reservation->status === 'pending' ? 'warning' : ($reservation->status === 'confirmed' ? 'success' : ($reservation->status === 'cancelled' ? 'danger' : 'secondary')) }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-sm btn-info">Detail</a>
                                @if($reservation->status === 'confirmed')
                                    <a href="{{ route('reservations.print', $reservation->id) }}" class="btn btn-sm btn-primary" target="_blank">
                                        <i class="fas fa-print"></i> Cetak
                                    </a>
                                @endif
                                @if($reservation->status === 'pending')
                                    <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Batalkan reservasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Batal</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $reservations->links() }}
        </div>
    @else
        <div class="alert alert-info">Belum ada reservasi.</div>
    @endif
</div>
@endsection 