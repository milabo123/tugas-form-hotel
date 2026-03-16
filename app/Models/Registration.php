<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'registrations';

    protected $fillable = [
        'room_id_1',
        'room_id_2',
        'number_of_persons',
        'number_of_rooms',
        'room_type',
        'receptionist',
        'name',
        'profession',
        'company',
        'nationality',
        'id_passport_number',
        'birth_date',
        'address',
        'phone',
        'mobile_phone',
        'email',
        'member_number',
        'arrival_time',
        'arrival_date',
        'departure_date',
        'safety_deposit_box_number',
        'issued_by',
        'issued_date',
        'payment_method',
        'payment_amount',
        'payment_reference',
        'payment_notes',
    ];

    protected $casts = [
        'birth_date'     => 'date',
        'arrival_date'   => 'date',
        'departure_date' => 'date',
        'arrival_time'   => 'datetime',
        'issued_date'    => 'date',
        'payment_amount' => 'decimal:2',
    ];

    // ── Relationships ──────────────────────────────────────────────────────────

    public function room1()
    {
        return $this->belongsTo(Room::class, 'room_id_1');
    }

    public function room2()
    {
        return $this->belongsTo(Room::class, 'room_id_2');
    }

    // ── Accessors ──────────────────────────────────────────────────────────────

    public function getDurationOfStayAttribute(): ?int
    {
        if ($this->arrival_date && $this->departure_date) {
            return $this->arrival_date->diffInDays($this->departure_date);
        }
        return null;
    }

    public function getRoomLabelAttribute(): string
    {
        $rooms = [];
        if ($this->room1) $rooms[] = $this->room1->room_number;
        if ($this->room2) $rooms[] = $this->room2->room_number;
        return implode(' & ', $rooms) ?: '-';
    }

    /**
     * Hitung estimasi total tagihan: total harga kamar × jumlah malam.
     * Menggunakan relationLoaded() agar tidak double-query jika sudah di-eager load,
     * dan fallback ke query langsung jika relasi belum dimuat.
     */
    public function getEstimatedTotalAttribute(): float
    {
        $nights = $this->duration_of_stay ?? 0;
        if ($nights <= 0) return 0.0;

        $pricePerNight = 0.0;

        // Ambil room1 — pakai relasi jika sudah load, kalau belum query langsung
        $room1 = $this->relationLoaded('room1')
            ? $this->room1
            : ($this->room_id_1 ? Room::find($this->room_id_1) : null);

        $room2 = $this->relationLoaded('room2')
            ? $this->room2
            : ($this->room_id_2 ? Room::find($this->room_id_2) : null);

        if ($room1?->price_per_night) {
            $pricePerNight += (float) $room1->price_per_night;
        }
        if ($room2?->price_per_night) {
            $pricePerNight += (float) $room2->price_per_night;
        }

        return $pricePerNight * $nights;
    }

    /**
     * Selisih antara jumlah dibayar dan estimasi total.
     * Positif  = lebih bayar (kembalian)
     * Negatif  = kurang bayar (sisa tagihan)
     * Nol      = pas
     */
    public function getPaymentDifferenceAttribute(): float
    {
        return (float) ($this->payment_amount ?? 0) - $this->estimated_total;
    }

    /**
     * Status pembayaran dihitung otomatis dari payment_amount vs estimasi total.
     *   - Kosong / 0               → unpaid
     *   - 0 < bayar < total        → partial
     *   - bayar >= total           → paid
     * Jika harga kamar belum diset (estimated_total = 0), cek > 0 saja.
     */
    public function getAutoPaymentStatusAttribute(): string
    {
        $paid  = (float) ($this->payment_amount ?? 0);
        $total = $this->estimated_total;

        if ($paid <= 0) return 'unpaid';

        if ($total > 0) {
            // Toleransi Rp 1 untuk menghindari masalah floating point
            return $paid >= ($total - 1) ? 'paid' : 'partial';
        }

        // Harga kamar belum diset — ada nominal = anggap lunas
        return 'paid';
    }

    public function getPaymentStatusLabelAttribute(): string
    {
        return match ($this->auto_payment_status) {
            'paid'    => 'Lunas',
            'partial' => 'Sebagian',
            'unpaid'  => 'Belum Bayar',
            default   => 'Belum Bayar',
        };
    }

    public function getPaymentStatusColorAttribute(): string
    {
        return match ($this->auto_payment_status) {
            'paid'    => 'success',
            'partial' => 'warning',
            'unpaid'  => 'danger',
            default   => 'danger',
        };
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match ($this->payment_method) {
            'cash'        => 'Tunai (Cash)',
            'credit_card' => 'Kartu Kredit',
            'debit_card'  => 'Kartu Debit',
            'transfer'    => 'Transfer Bank',
            'qris'        => 'QRIS',
            'ovo'         => 'OVO',
            'gopay'       => 'GoPay',
            'dana'        => 'DANA',
            default       => $this->payment_method ?? '-',
        };
    }

    // ── Scopes ─────────────────────────────────────────────────────────────────

    public function scopeCurrentlyStaying($query)
    {
        return $query->where('arrival_date', '<=', now())
            ->where('departure_date', '>=', now());
    }

    // ── Lifecycle Hooks ────────────────────────────────────────────────────────

    protected static function booted(): void
    {
        static::created(function (Registration $reg) {
            self::markRooms($reg, 'occupied');
        });

        static::updating(function (Registration $reg) {
            $old = $reg->getOriginal();
            foreach (['room_id_1', 'room_id_2'] as $field) {
                if ($old[$field] && $old[$field] !== $reg->$field) {
                    Room::find($old[$field])?->update(['status' => 'available']);
                }
            }
        });

        static::updated(function (Registration $reg) {
            self::markRooms($reg, 'occupied');
        });

        static::deleted(function (Registration $reg) {
            self::markRooms($reg, 'available');
        });
    }

    private static function markRooms(Registration $reg, string $status): void
    {
        foreach (['room_id_1', 'room_id_2'] as $field) {
            if ($reg->$field) {
                Room::find($reg->$field)?->update(['status' => $status]);
            }
        }
    }
}
