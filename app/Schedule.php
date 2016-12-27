<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Schedule
 *
 * @property int $id
 * @property int $member_id
 * @property bool $active
 * @property string $issued_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Member $member
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ScheduleItem[] $items
 * @method static \Illuminate\Database\Query\Builder|\App\Schedule whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Schedule whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Schedule whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Schedule whereIssuedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Schedule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Schedule extends Model
{

    protected $guarded = ['id'];

    public $dates = ['issued_date'];

    /**
     * Get Member schedule from schedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    /**
     * Get the Schedule's items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(ScheduleItem::class, 'schedule_id', 'id');
    }

}
