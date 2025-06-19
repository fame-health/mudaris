<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'package_interest',
        'message',
        'status',
        'admin_notes',
        'responded_at'
    ];

    protected $casts = [
        'responded_at' => 'datetime'
    ];

    /**
     * Status options
     */
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Package options
     */
    const PACKAGE_REGULER = 'Paket Reguler';
    const PACKAGE_VIP = 'Paket VIP';
    const PACKAGE_KELUARGA = 'Paket Keluarga';

    /**
     * Get all status options
     */
    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_NEW => 'Baru',
            self::STATUS_IN_PROGRESS => 'Sedang Diproses',
            self::STATUS_COMPLETED => 'Selesai',
            self::STATUS_CANCELLED => 'Dibatalkan'
        ];
    }

    /**
     * Get all package options
     */
    public static function getPackageOptions(): array
    {
        return [
            self::PACKAGE_REGULER => 'Paket Reguler',
            self::PACKAGE_VIP => 'Paket VIP',
            self::PACKAGE_KELUARGA => 'Paket Keluarga'
        ];
    }

    /**
     * Scope untuk status baru
     */
    public function scopeNew($query)
    {
        return $query->where('status', self::STATUS_NEW);
    }

    /**
     * Scope untuk status dalam proses
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    /**
     * Scope untuk status selesai
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope untuk data hari ini
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    /**
     * Scope untuk data minggu ini
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    /**
     * Accessor untuk status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_NEW => 'warning',
            self::STATUS_IN_PROGRESS => 'info',
            self::STATUS_COMPLETED => 'success',
            self::STATUS_CANCELLED => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Accessor untuk status label
     */
    public function getStatusLabelAttribute(): string
    {
        return self::getStatusOptions()[$this->status] ?? 'Unknown';
    }

    /**
     * Accessor untuk formatted phone
     */
    public function getFormattedPhoneAttribute(): ?string
    {
        if (!$this->phone) return null;

        // Menghilangkan karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $this->phone);

        // Format dengan pemisah
        if (strlen($phone) >= 10) {
            return preg_replace('/(\d{4})(\d{4})(\d+)/', '$1-$2-$3', $phone);
        }

        return $this->phone;
    }

    /**
     * Accessor untuk WhatsApp link
     */
    public function getWhatsappLinkAttribute(): ?string
    {
        if (!$this->phone) return null;

        // Menghilangkan karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $this->phone);

        // Mengubah format dari 08xx menjadi 628xx
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        return 'https://wa.me/' . $phone;
    }

    /**
     * Mark as responded
     */
    public function markAsResponded(): void
    {
        $this->update([
            'responded_at' => now(),
            'status' => self::STATUS_IN_PROGRESS
        ]);
    }

    /**
     * Mark as completed
     */
    public function markAsCompleted(string $notes = null): void
    {
        $this->update([
            'status' => self::STATUS_COMPLETED,
            'admin_notes' => $notes ?? $this->admin_notes
        ]);
    }
}
