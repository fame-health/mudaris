<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_address',
        'phone_1',
        'phone_2',
        'email_1',
        'email_2',
        'monday_friday_hours',
        'saturday_hours',
        'facebook_url',
        'whatsapp_url',
        'instagram_url',
        'youtube_url',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Scope untuk mendapatkan kontak yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Mendapatkan kontak yang aktif (singleton pattern)
     */
    public static function getActiveContact()
    {
        return static::active()->first();
    }

    /**
     * Accessor untuk nomor WhatsApp yang sudah diformat
     */
    public function getFormattedWhatsappAttribute()
    {
        if (!$this->phone_1) return null;

        // Menghilangkan karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $this->phone_1);

        // Mengubah format dari 08xx menjadi 628xx
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
    }

    /**
     * Accessor untuk link WhatsApp
     */
    public function getWhatsappLinkAttribute()
    {
        if (!$this->whatsapp_url && !$this->phone_1) return null;

        if ($this->whatsapp_url) {
            return $this->whatsapp_url;
        }

        return 'https://wa.me/' . $this->formatted_whatsapp;
    }

    /**
     * Accessor untuk semua social media links
     */
    public function getSocialMediaLinksAttribute()
    {
        return [
            'facebook' => $this->facebook_url,
            'whatsapp' => $this->whatsapp_link,
            'instagram' => $this->instagram_url,
            'youtube' => $this->youtube_url,
        ];
    }
}
