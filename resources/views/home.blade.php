@extends('layouts.app')

@section('title', 'Beranda - Hotel Sintia')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Selamat Datang di Hotel Sintia</h1>
                <p class="lead mb-4">Nikmati pengalaman menginap terbaik dengan fasilitas lengkap dan pelayanan prima. Tempat yang sempurna untuk liburan dan bisnis Anda.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('rooms') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-bed me-2"></i>Lihat Kamar
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-hotel" style="font-size: 200px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">Mengapa Memilih Hotel Sintia?</h2>
                <p class="text-muted">Kami menyediakan pengalaman menginap terbaik dengan berbagai keunggulan</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-concierge-bell fa-2x"></i>
                        </div>
                        <h5 class="card-title">Pelayanan 24 Jam</h5>
                        <p class="card-text text-muted">Tim kami siap melayani Anda 24 jam non-stop untuk memastikan kenyamanan maksimal.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-success bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-wifi fa-2x"></i>
                        </div>
                        <h5 class="card-title">WiFi Gratis</h5>
                        <p class="card-text text-muted">Akses internet cepat dan gratis di seluruh area hotel untuk kebutuhan Anda.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-warning bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <h5 class="card-title">Keamanan Terjamin</h5>
                        <p class="card-text text-muted">Sistem keamanan 24 jam dengan CCTV dan petugas keamanan profesional.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Room Types Section -->
@if($roomTypes->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">Tipe Kamar Kami</h2>
                <p class="text-muted">Pilihan kamar yang nyaman untuk berbagai kebutuhan Anda</p>
            </div>
        </div>
        
        <div class="row g-4">
            @foreach($roomTypes->take(3) as $roomType)
            <div class="col-lg-4 col-md-6">
                <div class="card card-hover border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-bed fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title text-center">{{ $roomType->name }}</h5>
                        <p class="card-text text-muted text-center">{{ Str::limit($roomType->description, 100) }}</p>
                        <div class="text-center">
                            <span class="badge bg-primary mb-2">{{ $roomType->capacity }} Orang</span>
                            <h4 class="text-primary fw-bold">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}/malam</h4>
                            <a href="{{ route('room.detail', $roomType->id) }}" class="btn btn-primary">
                                <i class="fas fa-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('rooms') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-list me-2"></i>Lihat Semua Kamar
            </a>
        </div>
    </div>
</section>
@endif

<!-- Facilities Section -->
@if($facilities->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">Fasilitas Hotel</h2>
                <p class="text-muted">Nikmati berbagai fasilitas modern untuk kenyamanan Anda</p>
            </div>
        </div>
        
        <div class="row g-4">
            @foreach($facilities->take(6) as $facility)
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center p-3 border rounded">
                    <div class="bg-primary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="{{ $facility->icon ?? 'fas fa-star' }}"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">{{ $facility->name }}</h6>
                        <small class="text-muted">{{ Str::limit($facility->description, 50) }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Siap untuk Menginap?</h2>
        <p class="lead mb-4">Daftar sekarang dan dapatkan pengalaman menginap terbaik di Hotel Sintia</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-phone me-2"></i>Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection 