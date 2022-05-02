<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    /**
     * Which vars are protected from mass-assignment (none).
     * @var array
     */
    protected $guarded = [];

    /**
     * A photo is of (belongs to) an item.
     * @return BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

}
