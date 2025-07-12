@extends('layouts.app')

@section('title', 'Tentang Kami - Hotel Sintia')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Tentang Hotel Sintia</h1>
                <p class="lead mb-4">Hotel Sintia adalah destinasi terbaik untuk pengalaman menginap yang nyaman dan mewah di jantung kota.</p>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-hotel" style="font-size: 200px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-4">Sejarah Hotel Sintia</h2>
                        <p class="lead text-muted mb-4">
                            Hotel Sintia didirikan pada tahun 2020 dengan visi untuk memberikan pengalaman menginap terbaik 
                            dengan menggabungkan kenyamanan modern dan pelayanan tradisional Indonesia.
                        </p>
                        
                        <p class="mb-4">
                            Berlokasi strategis di pusat kota, Hotel Sintia menawarkan akses mudah ke berbagai destinasi 
                            wisata, pusat perbelanjaan, dan pusat bisnis. Dengan desain yang elegan dan fasilitas yang lengkap, 
                            kami memastikan setiap tamu merasakan kenyamanan maksimal selama menginap.
                        </p>
                        
                        <p class="mb-4">
                            Tim kami yang profesional dan ramah siap melayani kebutuhan Anda 24 jam sehari. 
                            Kami berkomitmen untuk memberikan pengalaman menginap yang tak terlupakan dengan 
                            standar pelayanan tertinggi.
                        </p>
                        
                        <div class="row g-4 mt-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Pelayanan Terbaik</h6>
                                        <small class="text-muted">Tim profesional 24 jam</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Keamanan Terjamin</h6>
                                        <small class="text-muted">Sistem keamanan 24 jam</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Lokasi Strategis</h6>
                                        <small class="text-muted">Pusat kota yang mudah diakses</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Fasilitas Lengkap</h6>
                                        <small class="text-muted">Semua kebutuhan tersedia</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision Mission -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-eye fa-3x text-primary"></i>
                        </div>
                        <h4 class="text-center fw-bold mb-3">Visi</h4>
                        <p class="text-center text-muted">
                            Menjadi hotel terdepan yang memberikan pengalaman menginap terbaik dengan 
                            menggabungkan kenyamanan modern dan pelayanan tradisional Indonesia.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-bullseye fa-3x text-success"></i>
                        </div>
                        <h4 class="text-center fw-bold mb-3">Misi</h4>
                        <p class="text-center text-muted">
                            Memberikan pelayanan terbaik kepada setiap tamu dengan standar kualitas tertinggi, 
                            menciptakan lingkungan yang nyaman dan aman untuk semua pengunjung.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h2 class="fw-bold mb-4">Hubungi Kami</h2>
                <p class="text-muted mb-5">Kami siap melayani pertanyaan dan kebutuhan Anda</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center">
                    <div class="bg-primary bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                    </div>
                    <h5>Alamat</h5>
                    <p class="text-muted">Jl. Hotel No. 123<br>Jakarta Pusat, 10110</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="text-center">
                    <div class="bg-success bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-phone fa-2x"></i>
                    </div>
                    <h5>Telepon</h5>
                    <p class="text-muted">+62 21 1234 5678<br>+62 21 1234 5679</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="text-center">
                    <div class="bg-info bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-envelope fa-2x"></i>
                    </div>
                    <h5>Email</h5>
                    <p class="text-muted">info@hotelsintia.com<br>reservation@hotelsintia.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 