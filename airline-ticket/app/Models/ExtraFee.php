<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExtraFee extends Model
{
    protected $table = 'extra_fees';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
       'price', 'category'
    ];
    public function flights(): BelongsToMany
    {
        return $this->belongsToMany(Flight::class, 'flight_extrafees', 'extra_fee_id', 'flight_id');
    }
}
