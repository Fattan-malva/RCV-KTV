<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxRoomBooking extends Model
{
    use HasFactory;

    protected $table = 'TrxBookingRoom';
    protected $primaryKey = 'TrxId'; // Tambahkan ini
    public $incrementing = false;    // Jika TrxId bukan auto-increment
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['TrxId', 'TrxDate', 'TrxTime', 'RoomId', 'GuestId', 'GuestName', 'TimeIn', 'Notes', 'BookPack'];

}
