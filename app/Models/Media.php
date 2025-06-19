<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'url',
        'embed_id',
        'alt_text',
        'image_path', // Tambahan untuk upload gambar
        'is_active',
        'is_featured',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    // Scope untuk media aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk media unggulan
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope berdasarkan tipe
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accessor untuk mendapatkan URL gambar poster
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->type === 'poster' && $this->image_path) {
                    return asset('storage/' . $this->image_path);
                }
                return null;
            }
        );
    }

    // Accessor untuk mendapatkan embed URL
    protected function embedUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return match($this->type) {
                    'tiktok' => "https://www.tiktok.com/embed/{$this->embed_id}",
                    'instagram' => "https://www.instagram.com/p/{$this->embed_id}/embed",
                    'youtube' => "https://www.youtube.com/embed/{$this->embed_id}",
                    'facebook' => $this->url,
                    default => null
                };
            }
        );
    }
}
