<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Service
 *
 * @property int $id
 * @property string $name
 * @property int $fees
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Member[] $members
 * @method static \Illuminate\Database\Query\Builder|\App\Service whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Service whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Service whereFees($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Service whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Service extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the Members belong to a service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_service', 'service_id', 'member_id');
    }
}
