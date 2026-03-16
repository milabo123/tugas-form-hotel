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
        'payment_status',
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

    // Relationships
    public function room1()
    {
        return $this->belongsTo(Room::class, 'room_id_1');
    }
    public function room2()
    {
        return $this->belongsTo(Room::class, 'room_id_2');
    }

    // Accessors
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

    public function getPaymentStatusLabelAttribute(): string
    {
        return match ($this->payment_status) {
            'paid'        => 'Lunas',
            'partial'     => 'Sebagian',
            'unpaid'      => 'Belum Bayar',
            'refunded'    => 'Dikembalikan',
            default       => ucfirst($this->payment_status ?? '-'),
        };
    }

    public function getPaymentStatusColorAttribute(): string
    {
        return match ($this->payment_status) {
            'paid'     => 'success',
            'partial'  => 'warning',
            'unpaid'   => 'danger',
            'refunded' => 'secondary',
            default    => 'secondary',
        };
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match ($this->payment_method) {
            'cash'         => 'Tunai (Cash)',
            'credit_card'  => 'Kartu Kredit',
            'debit_card'   => 'Kartu Debit',
            'transfer'     => 'Transfer Bank',
            'qris'         => 'QRIS',
            'ovo'          => 'OVO',
            'gopay'        => 'GoPay',
            'dana'         => 'DANA',
            default        => $this->payment_method ?? '-',
        };
    }

    // Scopes
    public function scopeCurrentlyStaying($query)
    {
        return $query->where('arrival_date', '<=', now())
            ->where('departure_date', '>=', now());
    }

    // Lifecycle Hooks - update status kamar otomatis
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
