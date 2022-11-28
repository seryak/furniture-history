<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $currentRoom
 */
class Furniture extends Model
{
    use HasFactory;
    protected $table = 'furnitures';

    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withPivot(['in_time', 'out_time']);
    }

    public function getCurrentRoomAttribute()
    {
        return $this->rooms()->orderByPivot('in_time', 'desc')->wherePivot('out_time', null)->withPivot(['in_time', 'out_time'])->first();
    }
}
