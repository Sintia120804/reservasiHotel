@extends('layouts.admin')

@section('title', 'Manajemen Kamar')
@section('header', 'Manajemen Kamar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Daftar Kamar</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Kamar</th>
                                    <th>Tipe Kamar</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $i => $room)
                                    <tr>
                                        <td>{{ $i + $rooms->firstItem() }}</td>
                                        <td>{{ $room->room_number }}</td>
                                        <td>{{ $room->roomType->name ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $room->status === 'available' ? 'success' : ($room->status === 'occupied' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($room->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $room->notes }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Tambah Kamar</div>
                <div class="card-body">
                    <form action="{{ route('admin.rooms.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="room_number" class="form-label">Nomor Kamar</label>
                            <input type="text" name="room_number" id="room_number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="room_type_id" class="form-label">Tipe Kamar</label>
                            <select name="room_type_id" id="room_type_id" class="form-select" required>
                                <option value="">-- Pilih Tipe Kamar --</option>
                                @foreach($roomTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan</label>
                            <textarea name="notes" id="notes" class="form-control" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Kamar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 