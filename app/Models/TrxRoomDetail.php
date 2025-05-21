<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxRoomDetail extends Model
{
    use HasFactory;

    // Specify the table if the model doesn't follow the naming convention
    protected $table = 'TrxRoomDetail';

    // Mass assignable attributes
    protected $fillable = ['CheckInTime', 'CheckInTime', 'TrxId', 'RoomId', 'GuestId','GuestName', 'Notes'];

    // Relationship with RoomCategory model
    public function category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }
}
