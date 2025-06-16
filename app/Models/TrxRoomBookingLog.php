<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxRoomBookingLog extends Model
{
    use HasFactory;

    protected $table = 'TrxBookingLog';
    public $timestamps = false;
    protected $fillable = ['TrxId', 'TrxDate', 'TrxTime', 'RoomId', 'GuestId', 'GuestName', 'TimeIn', 'Reason'];

}
