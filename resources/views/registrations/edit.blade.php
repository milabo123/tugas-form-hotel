@extends('layouts.app')

@section('title', 'Edit Registrasi #' . $registration->id . ' - PPKD Hotel')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('registrations.show', $registration) }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0" style="font-family:'Playfair Display',serif; color: var(--primary)">
            <i class="bi bi-pencil me-2" style="color:var(--gold)"></i>Edit Registrasi #{{ $registration->id }}
        </h4>
        <small class="text-muted">{{ $registration->name }}</small>
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
        <form id="form-update" action="{{ route('registrations.update', $registration) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            @include('registrations.form')
            <hr style="border-color:var(--border); margin: 1.5rem 0">
            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-outline-danger" style="border-radius:8px"
                        onclick="document.getElementById('form-delete').submit()">
                    <i class="bi bi-trash me-1"></i> Hapus Data
                </button>
                <div class="d-flex gap-2">
                    <a href="{{ route('registrations.show', $registration) }}" class="btn btn-outline-secondary" style="border-radius:8px">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-ppkd-primary px-4">
                        <i class="bi bi-save me-1"></i> Perbarui Registrasi
                    </button>
                </div>
            </div>
        </form>

        <form id="form-delete" action="{{ route('registrations.destroy', $registration) }}" method="POST"
              onsubmit="return confirm('Hapus data registrasi ini secara permanen?')">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection
