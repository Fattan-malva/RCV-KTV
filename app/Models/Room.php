<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Specify the table if the model doesn't follow the naming convention
    protected $table = 'rooms';

    // Mass assignable attributes
    protected $fillable = ['name', 'roomId', 'room_category_id', 'capacity','tablet_number', 'available'];

    // Relationship with RoomCategory model
    public function category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }

    public function currentTrx()
    {
        return $this->hasOne(\App\Models\TrxRoomDetail::class, 'RoomId', 'roomId')
            ->whereNull('CheckOutTime');
    }
}
