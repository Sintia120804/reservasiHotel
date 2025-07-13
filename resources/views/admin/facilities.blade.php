@extends('layouts.admin')

@section('title', 'Manajemen Fasilitas')
@section('header', 'Manajemen Fasilitas')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Daftar Fasilitas</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facilities as $i => $facility)
                                    <tr>
                                        <td>{{ $i + $facilities->firstItem() }}</td>
                                        <td>{{ $facility->name }}</td>
                                        <td>{{ $facility->description }}</td>
                                        <td><i class="{{ $facility->icon }}"></i> {{ $facility->icon }}</td>
                                        <td>
                                            <span class="badge bg-{{ $facility->is_active ? 'success' : 'danger' }}">
                                                {{ $facility->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $facilities->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Tambah Fasilitas</div>
                <div class="card-body">
                    <form action="{{ route('admin.facilities.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Fasilitas</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (opsional, FontAwesome)</label>
                            <input type="text" name="icon" id="icon" class="form-control" placeholder="cth: fas fa-wifi">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Fasilitas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 