@extends('layouts.app')

@section('title', $roomType->name . ' - Hotel Sintia')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('rooms') }}" class="text-white">Kamar</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $roomType->name }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-4">{{ $roomType->name }}</h1>
                <p class="lead mb-4">{{ $roomType->description }}</p>
                <div class="d-flex gap-3">
                    <span class="badge bg-light text-dark fs-6">{{ $roomType->capacity }} Orang</span>
                    <span class="badge bg-light text-dark fs-6">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}/malam</span>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="bg-primary bg-gradient rounded p-5">
                    <i class="fas fa-bed fa-5x text-white mb-3"></i>
                    <h3 class="text-white">{{ $roomType->name }}</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Room Details -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Room Information -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4">Deskripsi Kamar</h3>
                        <p class="text-muted">{{ $roomType->description }}</p>
                        
                        <div class="row g-4 mt-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Kapasitas</h6>
                                        <p class="text-muted mb-0">{{ $roomType->capacity }} Orang</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Harga per Malam</h6>
                                        <p class="text-muted mb-0">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-bed"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Tipe Tempat Tidur</h6>
                                        <p class="text-muted mb-0">Queen/King Size</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-ruler-combined"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Ukuran Kamar</h6>
                                        <p class="text-muted mb-0">25-35 m²</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Facilities -->
                @if($roomType->facilities->count() > 0)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4">Fasilitas Kamar</h3>
                        <div class="row g-3">
                            @foreach($roomType->facilities as $facility)
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border rounded">
                                    <div class="bg-primary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="{{ $facility->icon ?? 'fas fa-star' }}"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $facility->name }}</h6>
                                        <small class="text-muted">{{ $facility->description }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Available Rooms -->
                @if($roomType->rooms->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4">Kamar Tersedia</h3>
                        <div class="row g-3">
                            @foreach($roomType->rooms as $room)
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border rounded">
                                    <div class="bg-{{ $room->status === 'available' ? 'success' : ($room->status === 'occupied' ? 'danger' : 'warning') }} bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-door-open"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Kamar {{ $room->room_number }}</h6>
                                        <span class="badge bg-{{ $room->status === 'available' ? 'success' : ($room->status === 'occupied' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($room->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Booking Card -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Reservasi Kamar</h4>
                        
                        <div class="mb-4">
                            <h5 class="text-primary fw-bold">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}</h5>
                            <small class="text-muted">per malam</small>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2">Fitur Kamar:</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>WiFi Gratis</li>
                                <li><i class="fas fa-check text-success me-2"></i>AC</li>
                                <li><i class="fas fa-check text-success me-2"></i>TV LED</li>
                                <li><i class="fas fa-check text-success me-2"></i>Kamar Mandi Dalam</li>
                                <li><i class="fas fa-check text-success me-2"></i>Air Panas</li>
                                <li><i class="fas fa-check text-success me-2"></i>Mini Bar</li>
                            </ul>
                        </div>
                        
                        @auth
                            <a href="{{ route('reservations.create') }}" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="fas fa-calendar-plus me-2"></i>Buat Reservasi
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Login untuk Reservasi
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-user-plus me-2"></i>Daftar Akun
                            </a>
                        @endauth
                        
                        <hr class="my-4">
                        
                        <div class="text-center">
                            <h6 class="fw-bold mb-2">Butuh Bantuan?</h6>
                            <p class="text-muted mb-2">Hubungi customer service kami</p>
                            <a href="tel:+622112345678" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-phone me-2"></i>+62 21 1234 5678
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Similar Rooms -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-12">
                <h2 class="fw-bold">Kamar Serupa</h2>
                <p class="text-muted">Lihat pilihan kamar lainnya yang mungkin menarik untuk Anda</p>
            </div>
        </div>
        
        <div class="row g-4">
            @php
                $similarRooms = App\Models\SintiaRoomType::where('id', '!=', $roomType->id)
                    ->where('is_active', true)
                    ->take(3)
                    ->get();
            @endphp
            
            @foreach($similarRooms as $similarRoom)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm card-hover h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-bed fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title text-center fw-bold">{{ $similarRoom->name }}</h5>
                        <p class="card-text text-muted text-center">{{ Str::limit($similarRoom->description, 80) }}</p>
                        <div class="text-center">
                            <span class="badge bg-primary mb-2">{{ $similarRoom->capacity }} Orang</span>
                            <h6 class="text-primary fw-bold">Rp {{ number_format($similarRoom->price_per_night, 0, ',', '.') }}/malam</h6>
                            <a href="{{ route('room.detail', $similarRoom->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection 