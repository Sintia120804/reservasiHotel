@extends('layouts.app')

@section('title', 'Kamar - Hotel Sintia')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Kamar Kami</h1>
                <p class="lead mb-4">Pilihan kamar yang nyaman dan elegan untuk berbagai kebutuhan Anda. Setiap kamar dirancang dengan detail yang sempurna.</p>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-bed" style="font-size: 200px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Room Types -->
<section class="py-5">
    <div class="container">
        @if($roomTypes->count() > 0)
            <div class="row g-4">
                @foreach($roomTypes as $roomType)
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                @if($roomType->image)
                                    <img src="{{ asset('storage/' . $roomType->image) }}" alt="{{ $roomType->name }}" class="img-fluid rounded-start w-100 h-100 object-fit-cover" style="min-height:200px;max-height:220px;">
                                @else
                                    <div class="bg-primary bg-gradient d-flex align-items-center justify-content-center" style="height: 100%; min-height: 200px;">
                                        <i class="fas fa-bed fa-4x text-white"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h4 class="card-title fw-bold mb-2">{{ $roomType->name }}</h4>
                                    <p class="card-text text-muted mb-3">{{ Str::limit($roomType->description, 120) }}</p>
                                    
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <small class="text-muted">Kapasitas:</small><br>
                                            <span class="badge bg-primary">{{ $roomType->capacity }} Orang</span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Harga per malam:</small><br>
                                            <strong class="text-primary">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                    
                                    @if($roomType->facilities->count() > 0)
                                    <div class="mb-3">
                                        <small class="text-muted">Fasilitas:</small><br>
                                        @foreach($roomType->facilities->take(3) as $facility)
                                            <span class="badge bg-light text-dark me-1">{{ $facility->name }}</span>
                                        @endforeach
                                        @if($roomType->facilities->count() > 3)
                                            <span class="badge bg-light text-dark">+{{ $roomType->facilities->count() - 3 }} lagi</span>
                                        @endif
                                    </div>
                                    @endif
                                    
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('room.detail', $roomType->id) }}" class="btn btn-primary flex-fill">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </a>
                                        @auth
                                            <a href="{{ route('reservations.create') }}" class="btn btn-outline-primary">
                                                <i class="fas fa-calendar-plus me-2"></i>Reservasi
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                                <i class="fas fa-sign-in-alt me-2"></i>Login
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-bed fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada kamar tersedia</h4>
                <p class="text-muted">Kami sedang mempersiapkan kamar-kamar terbaik untuk Anda.</p>
            </div>
        @endif
    </div>
</section>

<!-- Room Features -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">Fitur Kamar</h2>
                <p class="text-muted">Nikmati berbagai fasilitas modern di setiap kamar kami</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <div class="bg-primary bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-wifi fa-2x"></i>
                    </div>
                    <h5>WiFi Gratis</h5>
                    <p class="text-muted">Akses internet cepat di seluruh area kamar</p>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="text-center">
                    <div class="bg-success bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-snowflake fa-2x"></i>
                    </div>
                    <h5>AC</h5>
                    <p class="text-muted">Pendingin ruangan untuk kenyamanan maksimal</p>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="text-center">
                    <div class="bg-info bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-tv fa-2x"></i>
                    </div>
                    <h5>TV LED</h5>
                    <p class="text-muted">Televisi dengan berbagai channel hiburan</p>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="text-center">
                    <div class="bg-warning bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shower fa-2x"></i>
                    </div>
                    <h5>Kamar Mandi</h5>
                    <p class="text-muted">Kamar mandi dalam dengan air panas</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Booking CTA -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Siap untuk Menginap?</h2>
        <p class="lead mb-4">Pilih kamar favorit Anda dan nikmati pengalaman menginap terbaik di Hotel Sintia</p>
        <div class="d-flex justify-content-center gap-3">
            @auth
                <a href="{{ route('reservations.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-calendar-plus me-2"></i>Buat Reservasi
                </a>
            @else
                <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
            @endauth
        </div>
    </div>
</section>
@endsection 