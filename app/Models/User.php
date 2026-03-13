<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_type',
        'floor',
        'capacity',
        'price_per_night',
        'status',
        'notes',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
    ];

    // ──────────────────────────────────────────
    // Relationships
    // ──────────────────────────────────────────

    /** Registrasi yang menggunakan kamar ini sebagai kamar pertama */
    public function registrationsAsRoom1()
    {
        return $this->hasMany(Registration::class, 'room_id_1');
    }

    /** Registrasi yang menggunakan kamar ini sebagai kamar kedua */
    public function registrationsAsRoom2()
    {
        return $this->hasMany(Registration::class, 'room_id_2');
    }

    // ──────────────────────────────────────────
    // Scopes
    // ──────────────────────────────────────────

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeOccupied($query)
    {
        return $query->where('status', 'occupied');
    }

    // ──────────────────────────────────────────
    // Helpers
    // ──────────────────────────────────────────

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'available'   => 'Tersedia',
            'occupied'    => 'Terisi',
            'maintenance' => 'Maintenance',
            default       => ucfirst($this->status),
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'available'   => 'success',
            'occupied'    => 'danger',
            'maintenance' => 'warning',
            default       => 'secondary',
        };
    }
}
