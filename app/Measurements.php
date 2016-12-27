<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurements extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the member of a measurement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
