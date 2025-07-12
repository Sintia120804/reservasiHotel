<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SintiaRoomType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'capacity',
        'image',
        'is_active',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get rooms of this type
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(SintiaRoom::class, 'room_type_id');
    }

    /**
     * Get facilities for this room type
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(SintiaFacility::class, 'sintia_room_facilities', 'room_type_id', 'facility_id');
    }
}
