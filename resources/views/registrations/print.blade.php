<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation #{{ $registration->id }} - PPKD Hotel</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10.5pt;
            background: #fff;
            color: #000;
        }

        .page {
            width: 21cm;
            min-height: 29.7cm;
            margin: 0 auto;
            padding: 1.8cm 2cm 1.5cm 2cm;
            position: relative;
        }

        /* ── Header ── */
        .header {
            text-align: center;
            margin-bottom: 1rem;
        }

        .header .logo {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            border: 2px solid #1a3a5c;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 6px;
            overflow: hidden;
            background: #f0f4f8;
        }

        .header .logo-text {
            font-size: 7pt;
            font-weight: bold;
            color: #1a3a5c;
            text-align: center;
            line-height: 1.2;
            padding: 4px;
        }

        .header h1 {
            font-size: 13pt;
            font-weight: bold;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .header .sub-title {
            font-size: 10pt;
            font-weight: normal;
            font-style: normal;
            letter-spacing: 1px;
        }

        /* ── Divider ── */
        .divider {
            border: none;
            border-top: 1px solid #000;
            margin: 8px 0;
        }

        .divider-thick {
            border: none;
            border-top: 2px solid #000;
            margin: 10px 0;
        }

        /* ── Section: To / Company info ── */
        .to-section {
            margin-bottom: 6px;
        }

        .to-section .to-label {
            font-size: 10pt;
            margin-bottom: 4px;
        }

        /* ── Two-column info table ── */
        table.info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        table.info-table td {
            padding: 2px 0;
            vertical-align: top;
            font-size: 10pt;
        }

        table.info-table .lbl {
            width: 30%;
            font-weight: normal;
            white-space: nowrap;
        }

        table.info-table .colon {
            width: 12px;
            text-align: center;
            padding: 2px 4px;
        }

        table.info-table .val {
            font-weight: normal;
            border-bottom: 1px solid #888;
            min-width: 120px;
        }

        table.info-table .val-bold {
            font-weight: bold;
            border-bottom: 1px solid #888;
        }

        /* ── Two-column layout for company/telp block ── */
        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 24px;
            margin-bottom: 4px;
        }

        /* ── Guest details block ── */
        table.guest-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        table.guest-table td {
            padding: 3px 0;
            font-size: 10pt;
            vertical-align: top;
        }

        table.guest-table .lbl {
            width: 32%;
            font-weight: normal;
        }

        table.guest-table .colon {
            width: 14px;
            text-align: center;
        }

        table.guest-table .val {
            font-weight: bold;
        }

        /* ── Guarantee section ── */
        .guarantee-box {
            margin: 8px 0;
        }

        .guarantee-box p {
            font-size: 9.5pt;
            line-height: 1.55;
            text-align: justify;
            margin-bottom: 8px;
        }

        table.bank-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        table.bank-table td {
            padding: 2px 0;
            font-size: 10pt;
            vertical-align: top;
        }

        table.bank-table .lbl { width: 38%; }
        table.bank-table .colon { width: 14px; text-align: center; }
        table.bank-table .val {
            border-bottom: 1px solid #888;
            min-width: 100px;
        }

        /* ── Credit Card section ── */
        .cc-section {
            margin: 6px 0;
        }

        .cc-section .cc-title {
            font-size: 10pt;
            margin-bottom: 4px;
        }

        /* ── Cancellation policy ── */
        .policy-section {
            margin-top: 8px;
        }

        .policy-section .policy-title {
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .policy-section ol {
            padding-left: 22px;
            font-size: 9.5pt;
            line-height: 1.6;
        }

        /* ── Signature ── */
        .signature-area {
            margin-top: 20px;
            text-align: right;
        }

        .signature-area .sig-line {
            display: inline-block;
            border-top: 1px solid #000;
            min-width: 180px;
            text-align: center;
            padding-top: 4px;
            font-size: 10pt;
        }

        /* ── Print button ── */
        .no-print {
            position: fixed;
            top: 12px;
            right: 16px;
            display: flex;
            gap: 8px;
            z-index: 999;
        }

        .btn-print {
            padding: 8px 20px;
            cursor: pointer;
            background: #1a3a5c;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 11pt;
            font-family: Arial, sans-serif;
        }

        .btn-close-w {
            padding: 8px 14px;
            cursor: pointer;
            border: 1px solid #999;
            background: #fff;
            border-radius: 4px;
            font-size: 11pt;
            font-family: Arial, sans-serif;
        }

        @media print {
            body  { margin: 0; }
            .page { margin: 0; padding: 1cm 1.5cm; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

{{-- Print / Close buttons --}}
<div class="no-print">
    <button class="btn-print" onclick="window.print()">🖨 Cetak</button>
    <button class="btn-close-w" onclick="window.close()">✕ Tutup</button>
</div>

<div class="page">

    {{-- ══ HEADER ══ --}}
    <div class="header">
        {{-- Logo PPKD Jakarta Pusat --}}
        <div class="logo">
            <img src="{{ asset('images/Logo-PPKD-JakPus.jpeg') }}"
                 alt="Logo PPKD Jakarta Pusat"
                 style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
        </div>
        <h1>PPKD HOTEL</h1>
    </div>

    <div class="sub-title" style="text-align:left; font-size:10pt; margin-bottom:4px;">
        Reservation Confirmation
    </div>
    <hr class="divider">

    {{-- ══ TO ══ --}}
    <div class="to-section">
        <table class="info-table">
            <tr>
                <td class="lbl">To.</td>
                <td class="colon">:</td>
                <td class="val-bold">{{ $registration->name }}</td>
                <td style="width:10%"></td>
                <td></td>
            </tr>
        </table>
    </div>

    <br>

    {{-- ══ COMPANY / BOOKING BLOCK (2 kolom) ══ --}}
    <div class="two-col">
        {{-- Kolom kiri --}}
        <table class="info-table">
            <tr>
                <td class="lbl">Company / Agent</td>
                <td class="colon">:</td>
                <td class="val">{{ $registration->company ?? '' }}</td>
            </tr>
            <tr>
                <td class="lbl">Booking No.</td>
                <td class="colon">:</td>
                <td class="val">{{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="lbl">Book By</td>
                <td class="colon">:</td>
                <td class="val">{{ $registration->receptionist ?? '' }}</td>
            </tr>
            <tr>
                <td class="lbl">Phone</td>
                <td class="colon">:</td>
                <td class="val">{{ $registration->phone ?? '' }}</td>
            </tr>
            <tr>
                <td class="lbl">Email</td>
                <td class="colon">:</td>
                <td class="val">{{ $registration->email ?? '' }}</td>
            </tr>
        </table>

        {{-- Kolom kanan --}}
        <table class="info-table">
            <tr>
                <td class="lbl">Telp</td>
                <td class="colon">:</td>
                <td class="val">{{ $registration->mobile_phone ?? '' }}</td>
            </tr>
            <tr>
                <td class="lbl">Fax</td>
                <td class="colon">:</td>
                <td class="val">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl">Email</td>
                <td class="colon">:</td>
                <td class="val">{{ $registration->email ?? '' }}</td>
            </tr>
            <tr>
                <td class="lbl">Date</td>
                <td class="colon">:</td>
                <td class="val">{{ now()->format('d/m/Y') }}</td>
            </tr>
        </table>
    </div>

    <hr class="divider">

    {{-- ══ GUEST DETAILS ══ --}}
    @php
        $nights = ($registration->arrival_date && $registration->departure_date)
            ? $registration->arrival_date->diffInDays($registration->departure_date)
            : '-';

        $roomLabel = $registration->room1?->room_number ?? '-';
        if ($registration->room2) $roomLabel .= ' / ' . $registration->room2->room_number;

        $roomType = $registration->room1?->room_type ?? $registration->room_type ?? '-';

        $pricePerNight = ($registration->room1?->price_per_night ?? 0)
                       + ($registration->room2?->price_per_night ?? 0);

        $totalPrice = is_numeric($nights) ? $pricePerNight * $nights : 0;

        $paymentLabel = match($registration->payment_method ?? '') {
            'cash'        => 'Tunai (Cash)',
            'credit_card' => 'Kartu Kredit',
            'debit_card'  => 'Kartu Debit',
            'transfer'    => 'Transfer Bank',
            'qris'        => 'QRIS',
            'ovo'         => 'OVO',
            'gopay'       => 'GoPay',
            'dana'        => 'DANA',
            default       => $registration->payment_method ?? '-',
        };
    @endphp

    <table class="guest-table">
        <tr>
            <td class="lbl">First Name</td>
            <td class="colon">:</td>
            <td class="val">{{ $registration->name }}</td>
        </tr>
        <tr>
            <td class="lbl">Arrival Date</td>
            <td class="colon">:</td>
            <td class="val">{{ $registration->arrival_date?->format('d/m/Y') ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">Departure Date</td>
            <td class="colon">:</td>
            <td class="val">{{ $registration->departure_date?->format('d/m/Y') ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">Total Night</td>
            <td class="colon">:</td>
            <td class="val">{{ $nights }} Night(s)</td>
        </tr>
        <tr>
            <td class="lbl">Room / Unit Type</td>
            <td class="colon">:</td>
            <td class="val">{{ $roomLabel }} — {{ $roomType }}</td>
        </tr>
        <tr>
            <td class="lbl">Person Pax</td>
            <td class="colon">:</td>
            <td class="val">{{ $registration->number_of_persons ?? '-' }} Person(s)</td>
        </tr>
        <tr>
            <td class="lbl">Room Rate Net</td>
            <td class="colon">:</td>
            <td class="val">
                @if($totalPrice > 0)
                    Rp {{ number_format($totalPrice, 0, ',', '.') }}
                    <span style="font-weight:normal; font-size:9.5pt">
                        (Rp {{ number_format($pricePerNight, 0, ',', '.') }} × {{ $nights }} malam)
                    </span>
                @else
                    &nbsp;
                @endif
            </td>
        </tr>
    </table>

    <hr class="divider">

    {{-- ══ GUARANTEE TEXT ══ --}}
    <div class="guarantee-box">
        <p>
            Please guarantee this booking with credit card number with clear copy of the card both sides and card holder
            signature in the column provided the copy of credit card both sides should be faxed to hotel fax number.
            Please settle your outstanding to or account:
        </p>

        {{-- Bank Transfer --}}
        <table class="bank-table">
            <tr>
                <td class="lbl" style="font-weight:bold">Bank Transfer</td>
                <td class="colon"></td>
                <td></td>
            </tr>
            <tr>
                <td class="lbl">Mandiri Account</td>
                <td class="colon">:</td>
                <td class="val">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl">Mandiri Name Account</td>
                <td class="colon">:</td>
                <td class="val">&nbsp;</td>
            </tr>
        </table>
    </div>

    <hr class="divider">

    {{-- ══ CREDIT CARD / PAYMENT ══ --}}
    <div class="cc-section">
        <div class="cc-title">Reservation guaranteed by the following credit card:</div>
        <table class="bank-table">
            <tr>
                <td class="lbl">Card Number</td>
                <td class="colon">:</td>
                <td class="val">
                    @if(in_array($registration->payment_method, ['credit_card', 'debit_card']))
                        {{ $registration->payment_reference ?? '&nbsp;' }}
                    @else
                        &nbsp;
                    @endif
                </td>
            </tr>
            <tr>
                <td class="lbl">Card holder name</td>
                <td class="colon">:</td>
                <td class="val">
                    @if(in_array($registration->payment_method, ['credit_card', 'debit_card']))
                        {{ $registration->name }}
                    @else
                        &nbsp;
                    @endif
                </td>
            </tr>
            <tr>
                <td class="lbl">Card Type</td>
                <td class="colon">:</td>
                <td class="val">{{ $paymentLabel }}</td>
            </tr>
            <tr>
                <td class="lbl">Or by Bank Transfer to</td>
                <td class="colon">:</td>
                <td class="val">
                    @if($registration->payment_method === 'transfer')
                        {{ $registration->payment_reference ?? '&nbsp;' }}
                    @else
                        &nbsp;
                    @endif
                </td>
            </tr>
            <tr>
                <td class="lbl">Expired date/month/year</td>
                <td class="colon">:</td>
                <td class="val">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl">Card holder signature</td>
                <td class="colon">:</td>
                <td class="val" style="height:36px">&nbsp;</td>
            </tr>
        </table>
    </div>

    <hr class="divider">

    {{-- ══ CANCELLATION POLICY ══ --}}
    <div class="policy-section">
        <div class="policy-title">Cancellation policy:</div>
        <ol>
            <li>Please note that check in time is 02.00 pm and check out time 12.00 pm.</li>
            <li>All non guaranteed reservations will automatically be released on 6 pm.</li>
            <li>The Hotel will charge 1 night for guaranteed reservations that have not been canceling before the day of arrival. Please carefully note your cancellation number.</li>
        </ol>
    </div>

    {{-- ══ SIGNATURE ══ --}}
    <div class="signature-area">
        <div class="sig-line">
            &nbsp;<br>
            &nbsp;<br>
            &nbsp;
        </div>
    </div>

    {{-- Footer kecil --}}
    <div style="margin-top:18px; font-size:8pt; color:#999; text-align:right;">
        Dicetak: {{ now()->format('d/m/Y H:i') }} &mdash; Reservation #{{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}
    </div>

</div>
</body>
</html>
