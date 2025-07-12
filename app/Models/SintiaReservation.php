<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SintiaReservation extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'number_of_guests',
        'total_price',
        'status',
        'special_requests',
        'admin_notes',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get user who made the reservation
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get room for this reservation
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(SintiaRoom::class, 'room_id');
    }
}
