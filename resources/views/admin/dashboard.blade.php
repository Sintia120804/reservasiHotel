@extends('layouts.admin')

@section('title', 'Dashboard Admin - Hotel Sintia')
@section('header', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fas fa-money-bill-wave fa-lg"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5">Rp{{ number_format($totalIncome, 0, ',', '.') }}</div>
                        <div class="text-muted small">Total Income</div>
                    </div>
                </div>
                <div class="mt-2 text-success small">+2.4% dari minggu lalu</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fas fa-user-plus fa-lg"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5">{{ $newGuest }}</div>
                        <div class="text-muted small">New Guest</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fas fa-bed fa-lg"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5">{{ $totalRooms }}</div>
                        <div class="text-muted small">Rooms</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-danger bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fas fa-calendar-check fa-lg"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5">{{ $totalReservations }}</div>
                        <div class="text-muted small">Total Reservations</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Rooms -->
    <div class="mb-4">
        <h5 class="fw-bold mb-3">Popular Rooms</h5>
        <div class="row g-3 flex-nowrap overflow-auto" style="white-space:nowrap;">
            @foreach(\App\Models\SintiaRoomType::with('rooms')->orderBy('id')->take(5)->get() as $roomType)
            <div class="col-md-3 d-inline-block" style="min-width:270px; max-width:300px;">
                <div class="card border-0 shadow-sm h-100">
                    @if($roomType->image)
                        <img src="{{ asset('storage/' . $roomType->image) }}" class="card-img-top" style="height:160px; object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/300x160?text=No+Image" class="card-img-top" style="height:160px; object-fit:cover;">
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-{{ $roomType->rooms->where('status','available')->count() ? 'success' : 'danger' }}">
                                {{ $roomType->rooms->where('status','available')->count() ? 'Available' : 'Booked' }}
                            </span>
                            <span class="badge bg-light text-dark">Type {{ $roomType->id }}</span>
                        </div>
                        <h6 class="fw-bold mb-1">{{ $roomType->name }}</h6>
                        <div class="text-muted small mb-2">{{ $roomType->rooms->count() }} Room(s)</div>
                        <a href="{{ route('admin.room-types') }}" class="btn btn-outline-primary btn-sm w-100">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Guest Activity & Rooms Availability -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-3 h-100">
                <h6 class="fw-bold mb-3">Guest Activity</h6>
                <div class="d-flex align-items-center mb-2">
                    <span class="badge bg-danger me-2">Check In</span> {{ $weeklyCheckIn }} Guest
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="badge bg-warning me-2">Check Out</span> {{ $weeklyCheckOut }} Guest
                </div>
                <div class="mt-4">
                    <div class="progress mb-2" style="height: 18px;">
                        <div class="progress-bar bg-success" style="width: {{ $weeklyCheckIn + $weeklyCheckOut > 0 ? ($weeklyCheckIn / ($weeklyCheckIn + $weeklyCheckOut)) * 100 : 0 }}%;">
                            Weekly
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 18px;">
                        <div class="progress-bar bg-info" style="width: {{ $monthlyCheckIn + $monthlyCheckOut > 0 ? ($monthlyCheckIn / ($monthlyCheckIn + $monthlyCheckOut)) * 100 : 0 }}%;">
                            Monthly
                        </div>
                    </div>
                    <div class="progress" style="height: 18px;">
                        <div class="progress-bar bg-secondary" style="width: {{ $dailyCheckIn + $dailyCheckOut > 0 ? ($dailyCheckIn / ($dailyCheckIn + $dailyCheckOut)) * 100 : 0 }}%;">
                            Day
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-3 h-100">
                <h6 class="fw-bold mb-3">Rooms Availability</h6>
                <div class="mb-2">Total Rooms: <strong>{{ $totalRooms }}</strong></div>
                <div class="mb-2">Available: <span class="badge bg-success">{{ \App\Models\SintiaRoom::where('status','available')->count() }}</span></div>
                <div class="mb-2">Occupied: <span class="badge bg-danger">{{ \App\Models\SintiaRoom::where('status','occupied')->count() }}</span></div>
                <div class="mb-2">Maintenance: <span class="badge bg-warning">{{ \App\Models\SintiaRoom::where('status','maintenance')->count() }}</span></div>
                <div class="mt-4">
                    <div class="progress mb-2" style="height: 18px;">
                        <div class="progress-bar bg-success" style="width: {{ $totalRooms ? (\App\Models\SintiaRoom::where('status','available')->count()/$totalRooms)*100 : 0 }}%;">
                            Available
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 18px;">
                        <div class="progress-bar bg-danger" style="width: {{ $totalRooms ? (\App\Models\SintiaRoom::where('status','occupied')->count()/$totalRooms)*100 : 0 }}%;">
                            Occupied
                        </div>
                    </div>
                    <div class="progress" style="height: 18px;">
                        <div class="progress-bar bg-warning" style="width: {{ $totalRooms ? (\App\Models\SintiaRoom::where('status','maintenance')->count()/$totalRooms)*100 : 0 }}%;">
                            Maintenance
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 