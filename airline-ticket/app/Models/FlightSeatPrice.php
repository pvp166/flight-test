<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FlightSeatPrice extends Model
{
    //
    protected $table = 'flight_seat_prices';
    protected $fillable = ['price'];

    public function flights() : BelongsToMany
    {
        return $this->belongsToMany(Flight::class, 'flight_seat_prices');
    }

    public function seatTypes() : BelongsToMany
    {
        return $this->belongsToMany(SeatType::class, 'flight_seat_prices');
    }
    
}
