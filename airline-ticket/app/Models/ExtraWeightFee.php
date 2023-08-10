<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExtraWeightFee extends Model
{
    //
    protected $table = 'extra_weight_fees';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'category','amount'
    ];
    public function airlines(): BelongsToMany
    {
        return $this->belongsToMany(Airline::class, 'airline_extraweightprice', 'extraweightprice_id', 'airline_id');
    }
}
