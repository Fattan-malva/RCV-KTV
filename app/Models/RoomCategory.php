<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;

    // Specify the table if the model doesn't follow the naming convention
    protected $table = 'room_categories';

    // Mass assignable attributes
    protected $fillable = ['id','name', 'description'];

    // Relationship with Room model
    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_category_id');
    }
}
