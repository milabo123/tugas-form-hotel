@extends('layouts.app')

@section('title', 'Daftar Registrasi Tamu - PPKD Hotel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color: var(--hotel-primary)">
            <i class="bi bi-list-ul me-2"></i>Daftar Registrasi Tamu
        </h4>
        <small class="text-muted">PPKD Hotel Jakarta Pusat</small>
    </div>
    <a href="{{ route('registrations.create') }}" class="btn btn-primary-hotel">
        <i class="bi bi-plus-lg me-1"></i> Registrasi Baru
    </a>
</div>

{{-- Filter & Search --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('registrations.index') }}" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label mb-1 small fw-semibold">Cari Nama / Nomor Kamar</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control"
                           value="{{ request('search') }}" placeholder="Nama tamu atau nomor kamar...">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label mb-1 small fw-semibold">Filter Tanggal Kedatangan</label>
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="staying" value="1"
                           id="staying" {{ request('staying') ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="staying">
                        Sedang Menginap
                    </label>
                </div>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary-hotel flex-fill">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('registrations.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Kamar</th>
                        <th>Nama Tamu</th>
                        <th>Kebangsaan</th>
                        <th>Tgl. Masuk</th>
                        <th>Tgl. Keluar</th>
                        <th>Lama</th>
                        <th>Status</th>
                        <th class="text-center pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $reg)
                    <tr>
                        <td class="ps-3 text-muted small">{{ $reg->id }}</td>
                        <td>
                            @if($reg->room_number_1)
                                <span class="badge badge-room me-1">{{ $reg->room_number_1 }}</span>
                            @endif
                            @if($reg->room_number_2)
                                <span class="badge badge-room">{{ $reg->room_number_2 }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $reg->name }}</div>
                            <small class="text-muted">{{ $reg->profession ?? '-' }}</small>
                        </td>
                        <td>{{ $reg->nationality ?? '-' }}</td>
                        <td>{{ $reg->arrival_date?->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ $reg->departure_date?->format('d/m/Y') ?? '-' }}</td>
                        <td>
                            @if($reg->duration_of_stay !== null)
                                <span class="badge bg-info-subtle text-info fw-semibold">{{ $reg->duration_of_stay }} malam</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $today = now()->toDateString();
                                $arrival = $reg->arrival_date?->format('Y-m-d');
                                $departure = $reg->departure_date?->format('Y-m-d');
                            @endphp
                            @if($arrival && $departure && $today >= $arrival && $today <= $departure)
                                <span class="badge bg-success-subtle text-success fw-semibold">Menginap</span>
                            @elseif($departure && $today > $departure)
                                <span class="badge bg-secondary-subtle text-secondary fw-semibold">Check-out</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning fw-semibold">Upcoming</span>
                            @endif
                        </td>
                        <td class="text-center pe-3">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('registrations.show', $reg) }}"
                                   class="btn btn-sm btn-outline-primary" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('registrations.edit', $reg) }}"
                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('registrations.print', $reg) }}"
                                   class="btn btn-sm btn-outline-secondary" title="Cetak" target="_blank">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <form action="{{ route('registrations.destroy', $reg) }}" method="POST"
                                      onsubmit="return confirm('Hapus data registrasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada data registrasi tamu.
                            <br>
                            <a href="{{ route('registrations.create') }}" class="btn btn-primary-hotel mt-3">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Registrasi
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($registrations->hasPages())
    <div class="card-footer d-flex justify-content-between align-items-center bg-white">
        <small class="text-muted">
            Menampilkan {{ $registrations->firstItem() }}-{{ $registrations->lastItem() }}
            dari {{ $registrations->total() }} data
        </small>
        {{ $registrations->links() }}
    </div>
    @endif
</div>
@endsection
