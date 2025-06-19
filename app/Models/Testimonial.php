<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'message',
        'rating',
        'avatar',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer'
    ];

    /**
     * Scope untuk mendapatkan testimoni yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk mendapatkan testimoni berdasarkan rating
     */
    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Accessor untuk format rating bintang
     */
    public function getStarsAttribute()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    /**
     * Accessor untuk avatar URL
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // Default avatar jika tidak ada
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=f59e0b&color=fff&size=128';
    }
}
