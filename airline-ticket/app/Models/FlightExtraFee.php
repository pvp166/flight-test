<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FlightExtraFee extends Model
{
    //
    protected $table = 'flight_extrafees';

    public function flights() : BelongsToMany
    {
        return $this->belongsToMany(Flight::class, 'flight_extrafees');
    }

    public function extraFees() : BelongsToMany
    {
        return $this->belongsToMany(ExtraFee::class, 'flight_extrafees');
    }
}
