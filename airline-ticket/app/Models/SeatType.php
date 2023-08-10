<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SeatType extends Model
{
    //
    protected $table = 'seat_types';
    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function flights() : BelongsToMany
    {
        return $this->belongsToMany(Flight::class, 'flight_seat_prices');
    }
}
