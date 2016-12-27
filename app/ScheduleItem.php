<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ScheduleItem
 *
 * @property int $id
 * @property int $schedule_id
 * @property string $day
 * @property string $name
 * @property string $reps
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Schedule $schedule
 * @method static \Illuminate\Database\Query\Builder|\App\ScheduleItem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ScheduleItem whereScheduleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ScheduleItem whereDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ScheduleItem whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ScheduleItem whereReps($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ScheduleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ScheduleItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ScheduleItem extends Model
{

    protected $guarded = ['id'];

    /**
     * Get the Schedule of an item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }
}
