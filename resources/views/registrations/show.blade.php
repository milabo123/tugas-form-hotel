@extends('layouts.app')

@section('title', 'Detail Registrasi #' . $registration->id . ' - PPKD Hotel')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('registrations.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0" style="font-family:'Playfair Display',serif; color: var(--primary)">
            <i class="bi bi-person-badge me-2" style="color:var(--gold)"></i>Detail Registrasi #{{ $registration->id }}
        </h4>
        <small class="text-muted">Terdaftar: {{ $registration->created_at->format('d M Y, H:i') }}</small>
    </div>
    <div class="ms-auto d-flex gap-2">
        <a href="{{ route('registrations.print', $registration) }}" target="_blank"
           class="btn btn-sm btn-outline-secondary" style="border-radius:8px">
            <i class="bi bi-printer me-1"></i> Cetak
        </a>
        <a href="{{ route('registrations.edit', $registration) }}" class="btn btn-ppkd-primary btn-sm">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
    </div>
</div>

{{-- Room Info Banner --}}
<div class="card mb-4" style="background: linear-gradient(120deg, var(--primary) 0%, var(--primary-mid) 100%); border: none; border-bottom: 3px solid var(--gold);">
    <div class="card-body d-flex flex-wrap gap-4 align-items-center py-3 px-4">
        <div>
            <small style="color:rgba(255,255,255,.6); display:block; font-size:.75rem; letter-spacing:.5px; text-transform:uppercase;">Kamar</small>
            <div class="d-flex gap-2 mt-1">
                @if($registration->room_number_1)
                    <span class="badge-room" style="font-size:.9rem;">{{ $registration->room_number_1 }}</span>
                @endif
                @if($registration->room_number_2)
                    <span class="badge-room" style="font-size:.9rem;">{{ $registration->room_number_2 }}</span>
                @endif
                @if(!$registration->room_number_1 && !$registration->room_number_2)
                    <span style="color:rgba(255,255,255,.4)">-</span>
                @endif
            </div>
        </div>
        <div style="width:1px; height:36px; background:rgba(255,255,255,.15)"></div>
        <div>
            <small style="color:rgba(255,255,255,.6); display:block; font-size:.75rem; letter-spacing:.5px; text-transform:uppercase;">Tipe Kamar</small>
            <strong style="color:#fff">{{ $registration->room_type ?? '-' }}</strong>
        </div>
        <div style="width:1px; height:36px; background:rgba(255,255,255,.15)"></div>
        <div>
            <small style="color:rgba(255,255,255,.6); display:block; font-size:.75rem; letter-spacing:.5px; text-transform:uppercase;">Jumlah Tamu</small>
            <strong style="color:#fff">{{ $registration->number_of_persons ?? '-' }} orang</strong>
        </div>
        <div style="width:1px; height:36px; background:rgba(255,255,255,.15)"></div>
        <div>
            <small style="color:rgba(255,255,255,.6); display:block; font-size:.75rem; letter-spacing:.5px; text-transform:uppercase;">Lama Menginap</small>
            <strong style="color:#fff">{{ $registration->duration_of_stay ?? '-' }} malam</strong>
        </div>
        <div style="width:1px; height:36px; background:rgba(255,255,255,.15)"></div>
        <div>
            <small style="color:rgba(255,255,255,.6); display:block; font-size:.75rem; letter-spacing:.5px; text-transform:uppercase;">Resepsionis</small>
            <strong style="color:#fff">{{ $registration->receptionist ?? '-' }}</strong>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Data Tamu --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body p-4">
                <div class="section-title"><i class="bi bi-person me-2"></i>Data Tamu</div>
                <table class="table table-borderless table-sm mb-0">
                    <tr><td class="text-muted small" style="width:40%; padding-left:0">Nama</td><td class="fw-semibold">{{ $registration->name }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Pekerjaan</td><td>{{ $registration->profession ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Perusahaan</td><td>{{ $registration->company ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Kebangsaan</td><td>{{ $registration->nationality ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">No. KTP/Paspor</td><td>{{ $registration->id_passport_number ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Tanggal Lahir</td><td>{{ $registration->birth_date?->format('d M Y') ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">No. Member</td><td>{{ $registration->member_number ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Kontak --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body p-4">
                <div class="section-title"><i class="bi bi-telephone me-2"></i>Kontak & Alamat</div>
                <table class="table table-borderless table-sm mb-0">
                    <tr><td class="text-muted small" style="width:40%; padding-left:0">Alamat</td><td>{{ $registration->address ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Telepon</td><td>{{ $registration->phone ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Handphone</td><td>{{ $registration->mobile_phone ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Email</td><td>{{ $registration->email ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Waktu Menginap --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body p-4">
                <div class="section-title"><i class="bi bi-calendar-range me-2"></i>Waktu Menginap</div>
                <table class="table table-borderless table-sm mb-0">
                    <tr><td class="text-muted small" style="width:40%; padding-left:0">Tgl. Kedatangan</td><td>{{ $registration->arrival_date?->format('d M Y') ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Waktu Kedatangan</td><td>{{ $registration->arrival_time?->format('H:i') ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Tgl. Keberangkatan</td><td>{{ $registration->departure_date?->format('d M Y') ?? '-' }}</td></tr>
                    <tr>
                        <td class="text-muted small" style="padding-left:0">Lama Menginap</td>
                        <td>
                            @if($registration->duration_of_stay !== null)
                                <span class="badge" style="background:rgba(30,80,153,.1); color:var(--primary-light); font-weight:600;">
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
            <div class="card-body p-4">
                <div class="section-title"><i class="bi bi-safe me-2"></i>Kotak Deposit</div>
                <table class="table table-borderless table-sm mb-0">
                    <tr><td class="text-muted small" style="width:40%; padding-left:0">Nomor Kotak</td><td>{{ $registration->safety_deposit_box_number ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Dikeluarkan Oleh</td><td>{{ $registration->issued_by ?? '-' }}</td></tr>
                    <tr><td class="text-muted small" style="padding-left:0">Tanggal</td><td>{{ $registration->issued_date?->format('d M Y') ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
