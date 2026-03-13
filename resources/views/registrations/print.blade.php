<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Registrasi #{{ $registration->id }} - PPKD Hotel</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; font-size: 11pt; background: #fff; color: #000; }
        .page { width: 21cm; min-height: 29.7cm; margin: 0 auto; padding: 1.5cm; }

        .header { text-align: center; margin-bottom: 1rem; }
        .header h2 { font-size: 14pt; letter-spacing: 2px; font-weight: bold; }
        .header p  { font-size: 10pt; font-style: italic; }

        table.main { width: 100%; border-collapse: collapse; }
        table.main td { border: 1px solid #555; padding: 5px 8px; vertical-align: top; }

        .label { font-size: 8.5pt; color: #555; display: block; }
        .value { font-size: 10.5pt; font-weight: bold; min-height: 18px; }

        .empty-row { height: 60px; }
        .signature-row td { height: 90px; vertical-align: bottom; padding-bottom: 8px; }

        @media print {
            body { margin: 0; }
            .page { margin: 0; padding: 1cm; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
<div class="page">

    {{-- Print Button (screen only) --}}
    <div class="no-print" style="text-align:right; margin-bottom:1rem; display:flex; gap:.5rem; justify-content:flex-end">
        <button onclick="window.print()"
                style="padding:.5rem 1.5rem; cursor:pointer; background:#1a3a5c; color:#fff; border:none; border-radius:4px; font-size:11pt;">
            🖨 Cetak
        </button>
        <button onclick="window.close()"
                style="padding:.5rem 1rem; cursor:pointer; border:1px solid #999; background:#fff; border-radius:4px; font-size:11pt;">
            ✕ Tutup
        </button>
    </div>

    {{-- Header --}}
    <div class="header">
        <h2>PPKD HOTEL</h2>
        <p><em>Formulir Pendaftaran</em></p>
        <p><em>Registration</em></p>
    </div>

    <table class="main">

        {{-- Baris 1: Room No. + Jumlah Tamu --}}
        <tr>
            <td style="width:25%" rowspan="2">
                <span class="label">Room No.</span>
                <span class="value">
                    {{ $registration->room1?->room_number ?? '-' }}
                    @if($registration->room2)
                        &nbsp;/&nbsp;{{ $registration->room2->room_number }}
                    @endif
                </span>
            </td>
            <td style="width:30%">
                <span class="label">Jumlah Tamu / No. of Person</span>
                <span class="value">{{ $registration->number_of_persons ?? '' }}</span>
            </td>
            <td colspan="2">&nbsp;</td>
        </tr>

        {{-- Baris 2: Jumlah Kamar + Jenis Kamar + Receptionist --}}
        <tr>
            <td>
                <span class="label">Jumlah Kamar / No. of Room</span>
                <span class="value">{{ $registration->number_of_rooms ?? '' }}</span>
            </td>
            <td>
                <span class="label">Jenis Kamar / Room Type</span>
                <span class="value">
                    {{ $registration->room1?->room_type ?? $registration->room_type ?? '' }}
                </span>
            </td>
            <td>
                {{-- Receptionist: hanya tampil di cetak, tidak ada input di form --}}
                <span class="label">Receptionist</span>
                <span class="value" style="min-height:22px; border-bottom: 1px dotted #aaa; display:block">
                    &nbsp;
                </span>
            </td>
        </tr>

        {{-- Notice --}}
        <tr>
            <td colspan="4" style="text-align:center; font-size:9.5pt;">
                Check Out Time : 12.00 Noon &nbsp;|&nbsp; Waktu Lapor Keluar : Jam 12.00 Siang
            </td>
        </tr>

        {{-- Block Letter Notice + Waktu Kedatangan --}}
        <tr>
            <td colspan="3" style="font-style:italic; font-size:9pt;">
                Harap tulis dengan huruf cetak — Please print in block letters
            </td>
            <td>
                <span class="label">Waktu Kedatangan / Arrival Time</span>
                <span class="value">{{ $registration->arrival_time?->format('H:i') ?? '' }}</span>
            </td>
        </tr>

        {{-- Nama --}}
        <tr>
            <td colspan="3">
                <span class="label">Nama / Name</span>
                <span class="value" style="font-size:12pt;">{{ $registration->name }}</span>
            </td>
            <td rowspan="3">
                <span class="label">Tanggal Kedatangan / Arrival Date</span>
                <span class="value">{{ $registration->arrival_date?->format('d/m/Y') ?? '' }}</span>
            </td>
        </tr>

        {{-- Pekerjaan --}}
        <tr>
            <td colspan="3">
                <span class="label">Pekerjaan / Profession</span>
                <span class="value">{{ $registration->profession ?? '' }}</span>
            </td>
        </tr>

        {{-- Perusahaan --}}
        <tr>
            <td colspan="3">
                <span class="label">Perusahaan / Company</span>
                <span class="value">{{ $registration->company ?? '' }}</span>
            </td>
        </tr>

        {{-- Kebangsaan + No. KTP + Tanggal Lahir + Tanggal Keberangkatan --}}
        <tr>
            <td>
                <span class="label">Kebangsaan / Nationality</span>
                <span class="value">{{ $registration->nationality ?? '' }}</span>
            </td>
            <td>
                <span class="label">No. KTP / Passport No.</span>
                <span class="value">{{ $registration->id_passport_number ?? '' }}</span>
            </td>
            <td>
                <span class="label">Tanggal Lahir / Birth Date</span>
                <span class="value">{{ $registration->birth_date?->format('d/m/Y') ?? '' }}</span>
            </td>
            <td>
                <span class="label">Tgl. Keberangkatan / Departure Date</span>
                <span class="value">{{ $registration->departure_date?->format('d/m/Y') ?? '' }}</span>
            </td>
        </tr>

        {{-- Alamat + Telepon --}}
        <tr>
            <td colspan="2" style="height:55px">
                <span class="label">Alamat / Address</span>
                <span class="value">{{ $registration->address ?? '' }}</span>
            </td>
            <td>
                <span class="label">Telephone / Phone</span>
                <span class="value">{{ $registration->phone ?? '' }}</span>
                <br>
                <span class="label" style="margin-top:4px">Handphone / Mobile phone</span>
                <span class="value">{{ $registration->mobile_phone ?? '' }}</span>
            </td>
            <td>&nbsp;</td>
        </tr>

        {{-- Email --}}
        <tr>
            <td colspan="3">
                <span class="label">Email</span>
                <span class="value">{{ $registration->email ?? '' }}</span>
            </td>
            <td>&nbsp;</td>
        </tr>

        {{-- No. Member --}}
        <tr>
            <td colspan="3">
                <span class="label">No. Member</span>
                <span class="value">{{ $registration->member_number ?? '' }}</span>
            </td>
            <td>&nbsp;</td>
        </tr>

        {{-- Baris kosong untuk catatan tambahan --}}
        <tr class="empty-row"><td colspan="4">&nbsp;</td></tr>
        <tr class="empty-row"><td colspan="4">&nbsp;</td></tr>

        {{-- Tanda Tangan --}}
        <tr class="signature-row">
            <td colspan="2" style="text-align:center;">
                <span class="label">Tanda Tangan Tamu / Guest Signature</span>
                <div style="border-top:1px solid #000; margin-top:55px; padding-top:4px;">
                    {{ $registration->name }}
                </div>
            </td>
            <td colspan="2" style="text-align:center;">
                <span class="label">Resepsionis / Receptionist</span>
                {{-- Dikosongkan: diisi tangan oleh resepsionis --}}
                <div style="border-top:1px solid #000; margin-top:55px; padding-top:4px;">
                    &nbsp;
                </div>
            </td>
        </tr>

        {{-- Safety Deposit Box --}}
        <tr>
            <td colspan="2">
                <span class="label">Nomor Kotak Deposit / Safety Deposit Box Number</span>
                <span class="value">{{ $registration->safety_deposit_box_number ?? '' }}</span>
            </td>
            <td>
                <span class="label">Dikeluarkan oleh / Issued</span>
                <span class="value">{{ $registration->issued_by ?? '' }}</span>
            </td>
            <td>
                <span class="label">Tanggal / Date</span>
                <span class="value">{{ $registration->issued_date?->format('d/m/Y') ?? '' }}</span>
            </td>
        </tr>

    </table>

    <div style="margin-top:1rem; font-size:8.5pt; color:#888; text-align:right;">
        Dicetak: {{ now()->format('d/m/Y H:i') }} &mdash; Reg. #{{ $registration->id }}
    </div>
</div>
</body>
</html>
