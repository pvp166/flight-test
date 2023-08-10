<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    //
    protected $table = 'airlines';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'name'
    ];
    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class);
    }
    public function extraWeightFee(): BelongsToMany
    {
        return $this->
        belongsToMany(ExtraWeightFee::class, 'airline_extraweightprice', 'airline_id', 'extraweightprice_id');
    }
    
}