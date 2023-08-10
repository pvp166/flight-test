<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AirlineExtraWeightPrice extends Model
{
    protected $table = 'airline_extraweightprice';
    protected $fillable = [
        'price'
    ];
    public function airlines(): BelongsToMany
    {
        return $this->belongsToMany(Airline::class, 'airline_extraweightprice', 'extra_fee_id', 'flight_id');
    }
    public function extraWeightPrices(): BelongsToMany
    {
        return $this->belongsToMany(ExtraWeightFee::class, 'airline_extraweightprice','flight_id', 'extra_fee_id' );
    }
}