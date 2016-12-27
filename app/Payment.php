<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Payment
 *
 * @property int $id
 * @property int $member_id
 * @property int $amount
 * @property bool $active
 * @property string $month
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Member $member
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{

    protected $guarded = ['id'];

    public $dates = ['created_at', 'updated_at', 'month'];

    /**
     * Get the Payment Owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

}
