<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SintiaFacility extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get room types that have this facility
     */
    public function roomTypes(): BelongsToMany
    {
        return $this->belongsToMany(SintiaRoomType::class, 'sintia_room_facilities', 'facility_id', 'room_type_id');
    }
}
