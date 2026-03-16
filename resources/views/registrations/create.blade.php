@extends('layouts.app')

@section('title', 'Registrasi Tamu Baru - PPKD Hotel')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('registrations.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0" style="font-family:'Playfair Display',serif; color: var(--primary)">
            <i class="bi bi-person-plus me-2" style="color:var(--gold)"></i>Registrasi Tamu Baru
        </h4>
        <small class="text-muted">Formulir Pendaftaran / Registration Form</small>
    </div>
</div>

<div class="card">
    <div class="card-header-ppkd d-flex align-items-center justify-content-between">
        <div>
            <div class="fw-bold fs-5" style="font-family:'Playfair Display',serif; letter-spacing:.3px">PPKD HOTEL</div>
            <div class="small" style="color:rgba(255,255,255,.65); font-style:italic">Formulir Pendaftaran / Registration</div>
        </div>
        <div class="text-end small" style="color:rgba(255,255,255,.55)">
            Check Out Time: 12.00 Noon<br>
            Waktu Lapor Keluar: Jam 12.00 Siang
        </div>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('registrations.store') }}" method="POST" novalidate>
            @csrf
            @include('registrations.form')
            <hr style="border-color:var(--border); margin: 1.5rem 0">
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('registrations.index') }}" class="btn btn-outline-secondary" style="border-radius:8px">
                    <i class="bi bi-x-lg me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-ppkd-primary px-4">
                    <i class="bi bi-save me-1"></i> Simpan Registrasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
