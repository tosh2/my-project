<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Carbon\Carbon;

class Record extends Model
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
        'vehicle_id' => 'integer',
        'total' => 'float',
        'calculated_total' => 'double:2'
    ];

    protected $appends = ['time_in_minutes', 'calculated_total'];


    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getTimeInMinutesAttribute()
    {
        if(!is_null($this->leave_at))
        {
            return Carbon::create($this->leave_at)
                ->diffInMinutes(Carbon::create($this->created_at));
        }

        return Carbon::now()
                ->diffInMinutes(Carbon::create($this->created_at));

    }

    public function getCalculatedTotalAttribute()
    {
        if(is_null($this->total))
        {
            return round((double)$this->vehicle->price_per_minute * (double)$this->time_in_minutes, 2);
        }

        return round((double)$this->total, 2);
    }
}
