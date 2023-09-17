<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected $appends = ['price_per_minute'];


    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }

    public function getPricePerMinuteAttribute()
    {
        if($this->type == 'official') return 0.0;
        if($this->type == 'resident') return 0.05;
        if($this->type == 'non-resident') return 0.50;
        return 0.0;
    }
}
