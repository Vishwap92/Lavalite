<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'original_price',
        'deal_price',
        'discount_percentage',
        'image',
        'category',
        'start_date',
        'end_date',
        'status',
        'merchant_name',
        'merchant_website',
        'terms_conditions',
        'view_count',
        'featured'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'featured' => 'boolean',
        'original_price' => 'decimal:2',
        'deal_price' => 'decimal:2'
    ];

    // Automatically calculate discount percentage
    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($deal) {
            if ($deal->original_price && $deal->deal_price) {
                $deal->discount_percentage = round((($deal->original_price - $deal->deal_price) / $deal->original_price) * 100);
            }
        });
    }

    // Scope for active deals
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
    }

    // Scope for featured deals
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    // Scope for category
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Check if deal is expired
    public function isExpired()
    {
        return $this->end_date < now();
    }

    // Check if deal is active
    public function isActive()
    {
        return $this->status === 'active' && 
               $this->start_date <= now() && 
               $this->end_date >= now();
    }

    // Get formatted discount percentage
    public function getFormattedDiscountPercentageAttribute()
    {
        return $this->discount_percentage ? $this->discount_percentage . '%' : '0%';
    }

    // Get savings amount
    public function getSavingsAttribute()
    {
        return $this->original_price - $this->deal_price;
    }

    // Increment view count
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }
}
