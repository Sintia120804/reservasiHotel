@extends('layouts.admin')

@section('title', 'Kelola Kategori Kamar - Hotel Sintia')
@section('header', 'Kategori Kamar')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Kelola Kategori Kamar</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">
            <i class="fas fa-plus me-2"></i>Tambah Kategori
        </button>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($roomTypes->count() > 0)
        <div class="row g-4">
            @foreach($roomTypes as $type)
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm card-hover h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if($type->image)
                                <img src="{{ asset('storage/' . $type->image) }}" alt="Gambar" class="img-fluid rounded-start w-100 h-100 object-fit-cover" style="min-height:200px;max-height:220px;">
                            @else
                                <div class="bg-primary bg-gradient d-flex align-items-center justify-content-center" style="height: 100%; min-height: 200px;">
                                    <i class="fas fa-bed fa-4x text-white"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h4 class="card-title fw-bold mb-2">{{ $type->name }}</h4>
                                <p class="card-text text-muted mb-3">{{ Str::limit($type->description, 120) }}</p>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <small class="text-muted">Kapasitas:</small><br>
                                        <span class="badge bg-primary">{{ $type->capacity }} Orang</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Harga per malam:</small><br>
                                        <strong class="text-primary">Rp {{ number_format($type->price_per_night, 0, ',', '.') }}</strong>
                                    </div>
                                </div>
                                @if($type->facilities->count() > 0)
                                <div class="mb-3">
                                    <small class="text-muted">Fasilitas:</small><br>
                                    @foreach($type->facilities->take(3) as $facility)
                                        <span class="badge bg-light text-dark me-1">{{ $facility->name }}</span>
                                    @endforeach
                                    @if($type->facilities->count() > 3)
                                        <span class="badge bg-light text-dark">+{{ $type->facilities->count() - 3 }} lagi</span>
                                    @endif
                                </div>
                                @endif
                                <div class="mb-2">
                                    @if($type->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Nonaktif</span>
                                    @endif
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRoomTypeModal{{ $type->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.room-types.update', $type->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit -->
                <div class="modal fade" id="editRoomTypeModal{{ $type->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.room-types.update', $type->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Kategori Kamar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 text-center">
                                        @if($type->image)
                                            <img src="{{ asset('storage/' . $type->image) }}" alt="Gambar" width="100" class="rounded mb-2 shadow-sm">
                                        @else
                                            <img src="https://via.placeholder.com/100x70?text=No+Image" alt="No Image" width="100" class="rounded mb-2 shadow-sm">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ganti Gambar</label>
                                        <input type="file" name="image" class="form-control">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control" value="{{ $type->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="description" class="form-control" required>{{ $type->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Harga per Malam</label>
                                        <input type="number" name="price_per_night" class="form-control" value="{{ $type->price_per_night }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kapasitas</label>
                                        <input type="number" name="capacity" class="form-control" value="{{ $type->capacity }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fasilitas</label>
                                        <select name="facilities[]" class="form-select" multiple>
                                            @foreach($facilities as $facility)
                                                <option value="{{ $facility->id }}" {{ $type->facilities->contains($facility->id) ? 'selected' : '' }}>{{ $facility->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="is_active" class="form-select">
                                            <option value="1" {{ $type->is_active ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ !$type->is_active ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-bed fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Belum ada kategori kamar tersedia</h4>
            <p class="text-muted">Silakan tambahkan kategori kamar baru.</p>
        </div>
    @endif
    <!-- Modal Tambah -->
    <div class="modal fade" id="addRoomTypeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.room-types.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori Kamar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga per Malam</label>
                            <input type="number" name="price_per_night" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kapasitas</label>
                            <input type="number" name="capacity" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fasilitas</label>
                            <select name="facilities[]" class="form-select" multiple>
                                @foreach($facilities as $facility)
                                    <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="is_active" class="form-select">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 