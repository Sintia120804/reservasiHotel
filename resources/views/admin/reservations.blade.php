@extends('layouts.admin')

@section('title', 'Manajemen Reservasi')
@section('header', 'Manajemen Reservasi')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Daftar Reservasi</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tamu</th>
                                    <th>Kamar</th>
                                    <th>Tipe Kamar</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $i => $reservation)
                                    <tr>
                                        <td>{{ $i + $reservations->firstItem() }}</td>
                                        <td>{{ $reservation->user->name ?? '-' }}</td>
                                        <td>{{ $reservation->room->room_number ?? '-' }}</td>
                                        <td>{{ $reservation->room->roomType->name ?? '-' }}</td>
                                        <td>{{ $reservation->check_in_date->format('d-m-Y') }}</td>
                                        <td>{{ $reservation->check_out_date->format('d-m-Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $reservation->status === 'pending' ? 'warning' : ($reservation->status === 'confirmed' ? 'success' : ($reservation->status === 'cancelled' ? 'danger' : 'secondary')) }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </td>
                                        <td>Rp{{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            <form action="{{ route('admin.reservations.update-status', $reservation->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select form-select-sm d-inline w-auto" style="min-width:120px;display:inline-block;">
                                                    <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                    <option value="checked_in" {{ $reservation->status === 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                                    <option value="checked_out" {{ $reservation->status === 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                                    <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                                <input type="text" name="admin_notes" class="form-control form-control-sm d-inline w-auto" placeholder="Catatan admin" value="{{ $reservation->admin_notes }}" style="min-width:120px;display:inline-block;">
                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $reservations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 