@extends('layouts.app')

@section('title', 'Detail Registrasi #' . $registration->id . ' - PPKD Hotel')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('registrations.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0" style="color: var(--hotel-primary)">
            <i class="bi bi-person-badge me-2"></i>Detail Registrasi #{{ $registration->id }}
        </h4>
        <small class="text-muted">Terdaftar: {{ $registration->created_at->format('d M Y, H:i') }}</small>
    </div>
    <div class="ms-auto d-flex gap-2">
        <a href="{{ route('registrations.print', $registration) }}" target="_blank"
           class="btn btn-outline-secondary">
            <i class="bi bi-printer me-1"></i> Cetak
        </a>
        <a href="{{ route('registrations.edit', $registration) }}" class="btn btn-primary-hotel">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
    </div>
</div>

{{-- Room Info Banner --}}
<div class="card mb-4" style="background: linear-gradient(135deg, var(--hotel-primary), #2d5986); color: #fff; border: none;">
    <div class="card-body d-flex flex-wrap gap-4 align-items-center py-3">
        <div>
            <small class="opacity-75 d-block">Kamar</small>
            <div class="d-flex gap-2 mt-1">
                @if($registration->room_number_1)
                    <span class="badge badge-room fs-6">{{ $registration->room_number_1 }}</span>
                @endif
                @if($registration->room_number_2)
                    <span class="badge badge-room fs-6">{{ $registration->room_number_2 }}</span>
                @endif
                @if(!$registration->room_number_1 && !$registration->room_number_2)
                    <span class="opacity-50">-</span>
                @endif
            </div>
        </div>
        <div class="vr opacity-25"></div>
        <div>
            <small class="opacity-75 d-block">Tipe Kamar</small>
            <strong>{{ $registration->room_type ?? '-' }}</strong>
        </div>
        <div class="vr opacity-25"></div>
        <div>
            <small class="opacity-75 d-block">Jumlah Tamu</small>
            <strong>{{ $registration->number_of_persons ?? '-' }} orang</strong>
        </div>
        <div class="vr opacity-25"></div>
        <div>
            <small class="opacity-75 d-block">Lama Menginap</small>
            <strong>{{ $registration->duration_of_stay ?? '-' }} malam</strong>
        </div>
        <div class="vr opacity-25"></div>
        <div>
            <small class="opacity-75 d-block">Resepsionis</small>
            <strong>{{ $registration->receptionist ?? '-' }}</strong>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Data Tamu --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="section-title"><i class="bi bi-person me-2"></i>Data Tamu</div>
                <table class="table table-borderless table-sm">
                    <tr><td class="text-muted" style="width:40%">Nama</td><td class="fw-semibold">{{ $registration->name }}</td></tr>
                    <tr><td class="text-muted">Pekerjaan</td><td>{{ $registration->profession ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Perusahaan</td><td>{{ $registration->company ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Kebangsaan</td><td>{{ $registration->nationality ?? '-' }}</td></tr>
                    <tr><td class="text-muted">No. KTP/Paspor</td><td>{{ $registration->id_passport_number ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Tanggal Lahir</td><td>{{ $registration->birth_date?->format('d M Y') ?? '-' }}</td></tr>
                    <tr><td class="text-muted">No. Member</td><td>{{ $registration->member_number ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Kontak --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="section-title"><i class="bi bi-telephone me-2"></i>Kontak & Alamat</div>
                <table class="table table-borderless table-sm">
                    <tr><td class="text-muted" style="width:40%">Alamat</td><td>{{ $registration->address ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Telepon</td><td>{{ $registration->phone ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Handphone</td><td>{{ $registration->mobile_phone ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Email</td><td>{{ $registration->email ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Waktu Menginap --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="section-title"><i class="bi bi-calendar-range me-2"></i>Waktu Menginap</div>
                <table class="table table-borderless table-sm">
                    <tr><td class="text-muted" style="width:40%">Tgl. Kedatangan</td><td>{{ $registration->arrival_date?->format('d M Y') ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Waktu Kedatangan</td><td>{{ $registration->arrival_time?->format('H:i') ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Tgl. Keberangkatan</td><td>{{ $registration->departure_date?->format('d M Y') ?? '-' }}</td></tr>
                    <tr>
                        <td class="text-muted">Lama Menginap</td>
                        <td>
                            @if($registration->duration_of_stay !== null)
                                <span class="badge bg-info-subtle text-info fw-semibold">
                                    {{ $registration->duration_of_stay }} malam
                                </span>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Safety Deposit Box --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="section-title"><i class="bi bi-safe me-2"></i>Kotak Deposit</div>
                <table class="table table-borderless table-sm">
                    <tr><td class="text-muted" style="width:40%">Nomor Kotak</td><td>{{ $registration->safety_deposit_box_number ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Dikeluarkan Oleh</td><td>{{ $registration->issued_by ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Tanggal</td><td>{{ $registration->issued_date?->format('d M Y') ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
