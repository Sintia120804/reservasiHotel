@extends('layouts.app')

@section('title', 'Reservasi Kamar')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Reservasi Kamar</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="room_type_id" class="form-label">Tipe Kamar</label>
            <select name="room_type_id" id="room_type_id" class="form-select" required>
                <option value="">-- Pilih Tipe Kamar --</option>
                @foreach($roomTypes as $type)
                    <option value="{{ $type->id }}" {{ old('room_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }} (Rp{{ number_format($type->price_per_night, 0, ',', '.') }}/malam)
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="check_in_date" class="form-label">Tanggal Check-in</label>
            <input type="date" name="check_in_date" id="check_in_date" class="form-control" value="{{ old('check_in_date') }}" required>
        </div>
        <div class="mb-3">
            <label for="check_out_date" class="form-label">Tanggal Check-out</label>
            <input type="date" name="check_out_date" id="check_out_date" class="form-control" value="{{ old('check_out_date') }}" required>
        </div>
        <div class="mb-3">
            <label for="number_of_guests" class="form-label">Jumlah Tamu</label>
            <input type="number" name="number_of_guests" id="number_of_guests" class="form-control" min="1" value="{{ old('number_of_guests', 1) }}" required>
        </div>
        <div class="mb-3">
            <label for="special_requests" class="form-label">Permintaan Khusus</label>
            <textarea name="special_requests" id="special_requests" class="form-control" rows="2">{{ old('special_requests') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 