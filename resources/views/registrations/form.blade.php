{{-- resources/views/registrations/_form.blade.php --}}
@php
    $reg     = $registration ?? null;
    $hasRoom2 = old('room_id_2', $reg?->room_id_2) != null;
@endphp

{{-- ==================== SECTION: INFORMASI KAMAR ==================== --}}
<div class="mb-4">
    <div class="section-title"><i class="bi bi-door-closed me-2"></i>Informasi Kamar</div>
    <div class="row g-3">

        {{-- ── KAMAR 1 ────────────────────────────────────────────── --}}
        <div class="col-md-5">
            <label class="form-label fw-semibold">
                Nomor Kamar <span class="text-danger">*</span>
            </label>
            <select name="room_id_1" id="room_id_1"
                    class="form-select @error('room_id_1') is-invalid @enderror"
                    onchange="onRoomChange(this, 'room_id_2')">
                <option value="">-- Pilih Kamar --</option>
                @foreach($roomsByFloor as $floor => $rooms)
                    <optgroup label="Lantai {{ $floor }}">
                        @foreach($rooms as $room)
                            @php
                                $isOccupiedByThis = $reg && ($reg->room_id_1 == $room->id || $reg->room_id_2 == $room->id);
                                $isOccupied    = $room->status === 'occupied' && !$isOccupiedByThis;
                                $isMaintenance = $room->status === 'maintenance';
                                $isDisabled    = $isOccupied || $isMaintenance;
                                $selected      = old('room_id_1', $reg?->room_id_1) == $room->id;
                            @endphp
                            <option value="{{ $room->id }}"
                                {{ $selected   ? 'selected' : '' }}
                                {{ $isDisabled ? 'disabled' : '' }}
                                data-type="{{ $room->room_type }}"
                                data-status="{{ $room->status }}"
                                data-price="{{ (float) $room->price_per_night }}"
                                data-occupied="{{ $isOccupied ? 'true' : 'false' }}"
                                data-maintenance="{{ $isMaintenance ? 'true' : 'false' }}">
                                {{ $room->room_number }} — {{ $room->room_type }}
                                @if($isOccupied)        [Terisi / Occupied]
                                @elseif($isMaintenance) [Maintenance]
                                @else                   [Tersedia]
                                @endif
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            @error('room_id_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <div id="room1-info" class="mt-1" style="min-height:22px">
                @if($reg?->room1)
                    <span class="badge bg-{{ $reg->room1->statusColor() }}-subtle text-{{ $reg->room1->statusColor() }} border border-{{ $reg->room1->statusColor() }}-subtle">
                        <i class="bi bi-door-closed me-1"></i>
                        {{ $reg->room1->room_number }} — {{ $reg->room1->room_type }}
                    </span>
                @endif
            </div>
        </div>

        {{-- ── Tombol Tambah Kamar ─────────────────────────────────── --}}
        <div class="col-md-3 d-flex align-items-start" style="padding-top:1.9rem">
            <button type="button" id="btn-add-room"
                    class="btn btn-outline-primary btn-sm"
                    onclick="showRoom2()"
                    {{ $hasRoom2 ? 'style=display:none' : '' }}>
                <i class="bi bi-plus-circle me-1"></i> Tambah Kamar
            </button>
        </div>

        {{-- ── KAMAR 2 (tersembunyi by default) ───────────────────── --}}
        <div class="col-12" id="room2-wrapper" {{ $hasRoom2 ? '' : 'style=display:none' }}>
            <div class="p-3 border border-primary-subtle rounded-3 position-relative"
                 style="background-color:#f0f7ff">
                <button type="button"
                        class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2"
                        onclick="hideRoom2()" title="Batal tambah kamar">
                    <i class="bi bi-x-lg me-1"></i> Batal
                </button>
                <div class="small fw-semibold text-primary mb-2">
                    <i class="bi bi-door-open me-1"></i> Kamar Tambahan
                </div>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label">Nomor Kamar Tambahan</label>
                        <select name="room_id_2" id="room_id_2"
                                class="form-select @error('room_id_2') is-invalid @enderror"
                                onchange="onRoomChange(this, 'room_id_1')">
                            <option value="">-- Pilih Kamar --</option>
                            @foreach($roomsByFloor as $floor => $rooms)
                                <optgroup label="Lantai {{ $floor }}">
                                    @foreach($rooms as $room)
                                        @php
                                            $isOccupiedByThis = $reg && ($reg->room_id_1 == $room->id || $reg->room_id_2 == $room->id);
                                            $isOccupied    = $room->status === 'occupied' && !$isOccupiedByThis;
                                            $isMaintenance = $room->status === 'maintenance';
                                            $isDisabled    = $isOccupied || $isMaintenance;
                                            $selected      = old('room_id_2', $reg?->room_id_2) == $room->id;
                                        @endphp
                                        <option value="{{ $room->id }}"
                                            {{ $selected   ? 'selected' : '' }}
                                            {{ $isDisabled ? 'disabled' : '' }}
                                            data-type="{{ $room->room_type }}"
                                            data-status="{{ $room->status }}"
                                            data-price="{{ (float) $room->price_per_night }}"
                                            data-occupied="{{ $isOccupied ? 'true' : 'false' }}"
                                            data-maintenance="{{ $isMaintenance ? 'true' : 'false' }}">
                                            {{ $room->room_number }} — {{ $room->room_type }}
                                            @if($isOccupied)        [Terisi / Occupied]
                                            @elseif($isMaintenance) [Maintenance]
                                            @else                   [Tersedia]
                                            @endif
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('room_id_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div id="room2-info" class="mt-1" style="min-height:22px">
                            @if($reg?->room2)
                                <span class="badge bg-{{ $reg->room2->statusColor() }}-subtle text-{{ $reg->room2->statusColor() }} border border-{{ $reg->room2->statusColor() }}-subtle">
                                    <i class="bi bi-door-closed me-1"></i>
                                    {{ $reg->room2->room_number }} — {{ $reg->room2->room_type }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Legenda Status ──────────────────────────────────────── --}}
        <div class="col-md-4">
            <div class="p-2 bg-light rounded">
                <div class="small fw-semibold mb-1 text-muted">Keterangan Status</div>
                <div class="d-flex flex-column gap-1 small">
                    <span><span class="badge bg-success-subtle text-success border border-success-subtle">Tersedia</span> Dapat dipilih</span>
                    <span><span class="badge bg-danger-subtle text-danger border border-danger-subtle">Terisi</span> Tidak dapat dipilih</span>
                    <span><span class="badge bg-warning-subtle text-warning border border-warning-subtle">Maintenance</span> Tidak dapat dipilih</span>
                </div>
            </div>
        </div>

        {{-- ── Ringkasan Harga ─────────────────────────────────────── --}}
        <div class="col-12">
            <div id="price-summary" class="rounded-3 border p-3" style="background:#f8fdf8; display:none">
                <div class="row g-2 align-items-center">

                    {{-- Jumlah kamar (readonly, otomatis) --}}
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold text-muted mb-1">
                            Jumlah Kamar
                        </label>
                        <input type="number" name="number_of_rooms" id="number_of_rooms"
                               class="form-control form-control-sm text-center fw-bold"
                               value="{{ old('number_of_rooms', $reg?->number_of_rooms) }}"
                               readonly tabindex="-1"
                               style="background:#e9ecef; cursor:default">
                        <div class="form-text text-center" style="font-size:.7rem">otomatis</div>
                    </div>

                    {{-- Rincian harga per kamar --}}
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-muted mb-1">Rincian Harga / Malam</label>
                        <div id="price-breakdown" class="d-flex flex-column gap-1">
                            {{-- Diisi JS --}}
                        </div>
                    </div>

                    {{-- Jumlah malam + Total --}}
                    <div class="col-md-4">
                        <div class="p-2 rounded border" style="background:#fff">
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Lama menginap</span>
                                <span id="nights-count" class="fw-semibold">— malam</span>
                            </div>
                            <hr class="my-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold">Total Estimasi</span>
                                <span id="grand-total" class="fw-bold fs-5 text-success">Rp —</span>
                            </div>
                            <div class="form-text text-end" style="font-size:.7rem">
                                harga per malam × jumlah malam
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Hidden input untuk jumlah kamar saat price-summary tidak tampil --}}
            {{-- (tetap kirim nilai 0 / null jika belum ada kamar dipilih) --}}
        </div>

        {{-- Jumlah Tamu --}}
        <div class="col-md-2">
            <label class="form-label">Jumlah Tamu <small class="text-muted">(No. of Person)</small></label>
            <input type="number" name="number_of_persons"
                   class="form-control @error('number_of_persons') is-invalid @enderror"
                   value="{{ old('number_of_persons', $reg?->number_of_persons) }}" min="1">
            @error('number_of_persons')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

    </div>
</div>

{{-- ==================== SECTION: DATA TAMU ==================== --}}
<div class="mb-4">
    <div class="section-title"><i class="bi bi-person me-2"></i>Data Tamu</div>
    <div class="row g-3">
        <div class="col-md-8">
            <label class="form-label">Nama / Name <span class="text-danger">*</span></label>
            <input type="text" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $reg?->name) }}"
                   placeholder="Tulis dengan huruf cetak" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Pekerjaan / Profession</label>
            <input type="text" name="profession"
                   class="form-control @error('profession') is-invalid @enderror"
                   value="{{ old('profession', $reg?->profession) }}">
            @error('profession')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Perusahaan / Company</label>
            <input type="text" name="company"
                   class="form-control @error('company') is-invalid @enderror"
                   value="{{ old('company', $reg?->company) }}">
            @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Kebangsaan / Nationality</label>
            <input type="text" name="nationality"
                   class="form-control @error('nationality') is-invalid @enderror"
                   value="{{ old('nationality', $reg?->nationality) }}"
                   placeholder="WNI / WNA">
            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">No. KTP / Passport</label>
            <input type="text" name="id_passport_number"
                   class="form-control @error('id_passport_number') is-invalid @enderror"
                   value="{{ old('id_passport_number', $reg?->id_passport_number) }}">
            @error('id_passport_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Tanggal Lahir / Birth Date</label>
            <input type="date" name="birth_date"
                   class="form-control @error('birth_date') is-invalid @enderror"
                   value="{{ old('birth_date', $reg?->birth_date?->format('Y-m-d')) }}">
            @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

{{-- ==================== SECTION: KONTAK ==================== --}}
<div class="mb-4">
    <div class="section-title"><i class="bi bi-telephone me-2"></i>Kontak & Alamat</div>
    <div class="row g-3">
        <div class="col-12">
            <label class="form-label">Alamat / Address</label>
            <textarea name="address" rows="2"
                      class="form-control @error('address') is-invalid @enderror"
                      placeholder="Tulis dengan huruf cetak">{{ old('address', $reg?->address) }}</textarea>
            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Telepon / Phone</label>
            <input type="tel" name="phone"
                   class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone', $reg?->phone) }}" placeholder="021-XXXXXXX">
            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Handphone / Mobile Phone</label>
            <input type="tel" name="mobile_phone"
                   class="form-control @error('mobile_phone') is-invalid @enderror"
                   value="{{ old('mobile_phone', $reg?->mobile_phone) }}" placeholder="08XXXXXXXXXX">
            @error('mobile_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Email</label>
            <input type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $reg?->email) }}" placeholder="email@domain.com">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">No. Member</label>
            <input type="text" name="member_number"
                   class="form-control @error('member_number') is-invalid @enderror"
                   value="{{ old('member_number', $reg?->member_number) }}">
            @error('member_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

{{-- ==================== SECTION: WAKTU MENGINAP ==================== --}}
<div class="mb-4">
    <div class="section-title"><i class="bi bi-calendar-range me-2"></i>Waktu Menginap</div>
    <div class="row g-3">
        <div class="col-md-3">
            <label class="form-label">Tanggal Kedatangan / Arrival Date</label>
            <input type="date" name="arrival_date" id="arrival_date"
                   class="form-control @error('arrival_date') is-invalid @enderror"
                   value="{{ old('arrival_date', $reg?->arrival_date?->format('Y-m-d')) }}">
            @error('arrival_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Waktu Kedatangan / Arrival Time</label>
            <input type="time" name="arrival_time_only"
                   class="form-control @error('arrival_time') is-invalid @enderror"
                   value="{{ old('arrival_time_only', $reg?->arrival_time?->format('H:i')) }}">
            @error('arrival_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Tanggal Keberangkatan / Departure Date</label>
            <input type="date" name="departure_date" id="departure_date"
                   class="form-control @error('departure_date') is-invalid @enderror"
                   value="{{ old('departure_date', $reg?->departure_date?->format('Y-m-d')) }}">
            @error('departure_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <div class="p-2 bg-light rounded w-100 text-center">
                <small class="text-muted d-block">Lama Menginap</small>
                <strong id="duration-text" class="fs-5">-</strong>
            </div>
        </div>
    </div>
</div>

{{-- ==================== SECTION: SAFETY DEPOSIT BOX ==================== --}}
<div class="mb-4">
    <div class="section-title"><i class="bi bi-safe me-2"></i>Nomor Kotak Deposit / Safety Deposit Box</div>
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Nomor Kotak Deposit</label>
            <input type="text" name="safety_deposit_box_number"
                   class="form-control @error('safety_deposit_box_number') is-invalid @enderror"
                   value="{{ old('safety_deposit_box_number', $reg?->safety_deposit_box_number) }}">
            @error('safety_deposit_box_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Dikeluarkan Oleh / Issued By</label>
            <input type="text" name="issued_by"
                   class="form-control @error('issued_by') is-invalid @enderror"
                   value="{{ old('issued_by', $reg?->issued_by) }}">
            @error('issued_by')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Tanggal / Date</label>
            <input type="date" name="issued_date"
                   class="form-control @error('issued_date') is-invalid @enderror"
                   value="{{ old('issued_date', $reg?->issued_date?->format('Y-m-d')) }}">
            @error('issued_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

@push('scripts')
<script>
// ─────────────────────────────────────────────────────────────────────────────
// Format angka ke Rupiah
// ─────────────────────────────────────────────────────────────────────────────
function rupiah(n) {
    if (!n || isNaN(n)) return 'Rp —';
    return 'Rp ' + Number(n).toLocaleString('id-ID');
}

// ─────────────────────────────────────────────────────────────────────────────
// Ambil data dari option yang terpilih
// ─────────────────────────────────────────────────────────────────────────────
function getSelectedRoomData(selectId) {
    const sel = document.getElementById(selectId);
    if (!sel || !sel.value) return null;
    const opt = sel.options[sel.selectedIndex];
    return {
        id    : sel.value,
        number: opt.text.split('—')[0].trim(),
        type  : opt.dataset.type  || '',
        price : parseFloat(opt.dataset.price) || 0,
        status: opt.dataset.status || 'available',
    };
}

// ─────────────────────────────────────────────────────────────────────────────
// Hitung dan render ringkasan harga
// ─────────────────────────────────────────────────────────────────────────────
function updatePriceSummary() {
    const room1 = getSelectedRoomData('room_id_1');
    const room2 = getSelectedRoomData('room_id_2');

    const rooms       = [room1, room2].filter(Boolean);
    const roomCount   = rooms.length;
    const nights      = getNights();
    const summary     = document.getElementById('price-summary');
    const breakdown   = document.getElementById('price-breakdown');
    const nightsEl    = document.getElementById('nights-count');
    const grandTotalEl= document.getElementById('grand-total');
    const roomsInput  = document.getElementById('number_of_rooms');

    // Update jumlah kamar otomatis
    roomsInput.value = roomCount > 0 ? roomCount : '';

    if (roomCount === 0) {
        summary.style.display = 'none';
        return;
    }

    summary.style.display = 'block';

    // Rincian per kamar
    let totalPerMalam = 0;
    breakdown.innerHTML = rooms.map(r => {
        totalPerMalam += r.price;
        return `<div class="d-flex align-items-center gap-2">
            <span class="badge bg-secondary-subtle text-secondary border" style="font-size:.8rem; min-width:60px">
                ${r.number}
            </span>
            <span class="small text-muted">${r.type}</span>
            <span class="ms-auto fw-semibold small">${rupiah(r.price)} <span class="text-muted fw-normal">/ malam</span></span>
        </div>`;
    }).join('');

    // Jumlah malam
    if (nights > 0) {
        nightsEl.textContent  = nights + ' malam';
        const total           = totalPerMalam * nights;
        grandTotalEl.textContent = rupiah(total);
        grandTotalEl.className   = 'fw-bold fs-5 text-success';
    } else {
        nightsEl.textContent     = '— malam';
        grandTotalEl.textContent = rupiah(totalPerMalam) + ' / malam';
        grandTotalEl.className   = 'fw-bold fs-6 text-muted';
    }
}

// ─────────────────────────────────────────────────────────────────────────────
// Hitung jumlah malam dari input tanggal
// ─────────────────────────────────────────────────────────────────────────────
function getNights() {
    const a = document.getElementById('arrival_date')?.value;
    const d = document.getElementById('departure_date')?.value;
    if (!a || !d) return 0;
    const diff = (new Date(d) - new Date(a)) / 86400000;
    return diff > 0 ? diff : 0;
}

// ─────────────────────────────────────────────────────────────────────────────
// Hitung lama menginap (tampilan di box bawah tanggal)
// ─────────────────────────────────────────────────────────────────────────────
function calcDuration() {
    const nights      = getNights();
    const durationEl  = document.getElementById('duration-text');
    if (nights > 0) {
        durationEl.textContent = nights + ' malam';
        durationEl.className   = 'fs-5 text-success';
    } else if (document.getElementById('arrival_date')?.value && document.getElementById('departure_date')?.value) {
        durationEl.textContent = 'Tidak valid';
        durationEl.className   = 'fs-5 text-danger';
    } else {
        durationEl.textContent = '-';
        durationEl.className   = 'fs-5';
    }
    updatePriceSummary(); // re-hitung total setiap tanggal berubah
}

// ─────────────────────────────────────────────────────────────────────────────
// Tampilkan / Sembunyikan kamar 2
// ─────────────────────────────────────────────────────────────────────────────
function showRoom2() {
    document.getElementById('room2-wrapper').style.display = 'block';
    document.getElementById('btn-add-room').style.display  = 'none';
    updatePriceSummary();
}

function hideRoom2() {
    const sel = document.getElementById('room_id_2');
    sel.value = '';
    document.getElementById('room2-info').innerHTML = '';
    syncDisabledOptions('room_id_1', '');
    document.getElementById('room2-wrapper').style.display = 'none';
    document.getElementById('btn-add-room').style.display  = 'inline-flex';
    updatePriceSummary();
}

// ─────────────────────────────────────────────────────────────────────────────
// Sinkronisasi disabled + badge info + harga
// ─────────────────────────────────────────────────────────────────────────────
function onRoomChange(changedSelect, otherSelectId) {
    const selectedId = changedSelect.value;
    const infoDivId  = changedSelect.id === 'room_id_1' ? 'room1-info' : 'room2-info';

    updateRoomBadge(changedSelect, infoDivId);
    syncDisabledOptions(otherSelectId, selectedId);
    updatePriceSummary();
}

function syncDisabledOptions(targetSelectId, excludeId) {
    const target = document.getElementById(targetSelectId);
    if (!target) return;
    Array.from(target.options).forEach(opt => {
        if (!opt.value) return;
        opt.disabled = opt.dataset.occupied === 'true'
                    || opt.dataset.maintenance === 'true'
                    || (excludeId && opt.value === excludeId);
    });
}

function updateRoomBadge(select, divId) {
    const div = document.getElementById(divId);
    if (!div) return;
    const opt = select.options[select.selectedIndex];
    if (!select.value || !opt) { div.innerHTML = ''; return; }

    const status   = opt.dataset.status || 'available';
    const colorMap = { available: 'success', occupied: 'danger', maintenance: 'warning' };
    const color    = colorMap[status] || 'secondary';
    const text     = opt.text.split('[')[0].trim();

    div.innerHTML = `
        <span class="badge bg-${color}-subtle text-${color} border border-${color}-subtle">
            <i class="bi bi-door-closed me-1"></i>${text}
        </span>`;
}

// ─────────────────────────────────────────────────────────────────────────────
// Event listeners & inisialisasi
// ─────────────────────────────────────────────────────────────────────────────
document.getElementById('arrival_date')?.addEventListener('change', calcDuration);
document.getElementById('departure_date')?.addEventListener('change', calcDuration);

document.addEventListener('DOMContentLoaded', () => {
    calcDuration();
    const r1 = document.getElementById('room_id_1');
    const r2 = document.getElementById('room_id_2');
    if (r1?.value) { updateRoomBadge(r1, 'room1-info'); syncDisabledOptions('room_id_2', r1.value); }
    if (r2?.value) { updateRoomBadge(r2, 'room2-info'); syncDisabledOptions('room_id_1', r2.value); }
    updatePriceSummary();
});
</script>
@endpush
