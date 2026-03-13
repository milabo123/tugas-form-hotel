@extends('layouts.app')

@section('title', 'Edit Registrasi #' . $registration->id . ' - PPKD Hotel')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('registrations.show', $registration) }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0" style="color: var(--hotel-primary)">
            <i class="bi bi-pencil me-2"></i>Edit Registrasi #{{ $registration->id }}
        </h4>
        <small class="text-muted">{{ $registration->name }}</small>
    </div>
</div>

<div class="card">
    <div class="card-header-hotel d-flex align-items-center justify-content-between">
        <div>
            <div class="fw-bold fs-5">PPKD HOTEL</div>
            <div class="small opacity-75"><em>Formulir Pendaftaran / Registration</em></div>
        </div>
        <div class="text-end opacity-75 small">
            Check Out Time: 12.00 Noon<br>
            Waktu Lapor Keluar: Jam 12.00 Siang
        </div>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('registrations.update', $registration) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            @include('registrations.form')
            <hr>
            <div class="d-flex justify-content-between mt-3">
                <form action="{{ route('registrations.destroy', $registration) }}" method="POST"
                      onsubmit="return confirm('Hapus data registrasi ini secara permanen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash me-1"></i> Hapus Data
                    </button>
                </form>
                <div class="d-flex gap-2">
                    <a href="{{ route('registrations.show', $registration) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary-hotel px-4">
                        <i class="bi bi-save me-1"></i> Perbarui Registrasi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
