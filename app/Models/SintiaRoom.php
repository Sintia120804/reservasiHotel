<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SintiaRoom extends Model
{
    protected $fillable = [
        'room_number',
        'room_type_id',
        'status',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get room type
     */
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(SintiaRoomType::class, 'room_type_id');
    }

    /**
     * Get reservations for this room
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(SintiaReservation::class, 'room_id');
    }
}
