<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Type
 *
 * @property int $id
 * @property string $name
 * @property int $days
 * @property int $discount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Member[] $members
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereDays($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Type extends Model
{

    protected $guarded = ['id'];

    /**
     * Get the member type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany(Member::class, 'type_id', 'id');
    }
}
