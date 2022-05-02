<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    /**
     * Which vars are protected against mass-assignment (none).
     * @var array
     */
    protected $guarded = [];

    /**
     * An item belongs to a location.
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * An item has many photos.
     * @return HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
}
