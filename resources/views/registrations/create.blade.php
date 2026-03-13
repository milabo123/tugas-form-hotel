@extends('layouts.app')

@section('title', 'Registrasi Tamu Baru - PPKD Hotel')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('registrations.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0" style="color: var(--hotel-primary)">
            <i class="bi bi-person-plus me-2"></i>Registrasi Tamu Baru
        </h4>
        <small class="text-muted">Formulir Pendaftaran / Registration Form</small>
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
        <form action="{{ route('registrations.store') }}" method="POST" novalidate>
            @csrf
            @include('registrations.form')
            <hr>
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('registrations.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-lg me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-hotel px-4">
                    <i class="bi bi-save me-1"></i> Simpan Registrasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
