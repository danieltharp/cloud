<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    /**
     * Which fields are protected from mass-assignment (none).
     * @var array
     */
    protected $guarded = [];

    /**
     * A location has many items.
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    /**
     * A location belongs to a parent location.
     * @return BelongsTo
     */
    public function parentlocation(): BelongsTo
    {
        return $this->belongsTo(Location::class,'location_id');
    }

    /**
     * A location can have many sub-locations.
     * @return HasMany
     */
    public function sublocations(): HasMany
    {
        return $this->hasMany(Location::class,'location_id');
    }
}
