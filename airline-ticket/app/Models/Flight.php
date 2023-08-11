<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flight extends Model
{
    protected $table = 'flights';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = ['destination', 'flight_number', 'departure_time'];
    public function extraFees(): BelongsToMany
    {
        return $this->belongsToMany(ExtraFee::class, 'flight_extrafees');
    }
    public function seatTypes(): BelongsToMany {
        return $this->belongsToMany(SeatType::class, 'flight_seat_prices')->withPivot('price');
    }
    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }
}
