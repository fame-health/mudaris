<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Paket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pakets'; // Changed to plural form following Laravel convention

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category',
        'is_featured',
        'image_path',
        'features',
        'departure_date', // Added to match migration
        'departure_schedule',
        'hotel_rating',
        'meals_description', // Fixed typo from 'meals_description'
        'inclusions',
        'exclusions',
        'duration_days',
        'status',
    ];

    protected $casts = [
        'features' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'departure_date' => 'date',
    ];

    protected $appends = [
        'formatted_price',
        'main_image',
        'icon',
        'gradient_colors'
    ];

    // Accessors
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getMainImageAttribute(): string
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            return Storage::url($this->image_path);
        }
        return asset('images/default-package.jpg');
    }

    public function getIconAttribute(): string
    {
        return match($this->category) {
            'vip' => 'crown',
            'family' => 'users',
            default => 'star',
        };
    }

    public function getGradientColorsAttribute(): array
    {
        return match($this->category) {
            'vip' => ['from' => 'yellow-400', 'to' => 'orange-500'],
            'family' => ['from' => 'green-400', 'to' => 'blue-400'],
            default => ['from' => 'yellow-400', 'to' => 'orange-400'],
        };
    }

    // Image handling
    public function uploadImage($file): string
    {
        // Delete old image if exists
        $this->deleteImage();

        $path = $file->store('package-images', 'public');
        $this->update(['image_path' => $path]);

        return $path;
    }

    public function deleteImage(): void
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            Storage::disk('public')->delete($this->image_path);
        }
    }

    // Model events
    protected static function booted(): void
    {
        static::deleting(function ($package) {
            if (!$package->isForceDeleting()) {
                return;
            }
            $package->deleteImage();
        });
    }

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeComingSoon($query)
    {
        return $query->where('status', 'coming_soon');
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    // Additional helpful methods
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isFeatured(): bool
    {
        return $this->is_featured;
    }
}
