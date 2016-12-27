<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Member
 *
 * @property int $id
 * @property int $type_id
 * @property string $name
 * @property string $last_name
 * @property string $nic
 * @property string $email
 * @property string $address
 * @property string $phone
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Schedule[] $schedules
 * @property-read \App\Type $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Service[] $services
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereNic($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Member extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get all the Payments of a member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'member_id', 'id');
    }

    /**
     * Get all the schedules of a member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'member_id', 'id');
    }

    /**
     * Get the membership type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    /**
     * Get all the services that member subscribed to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'member_service', 'member_id', 'service_id');
    }

    /**
     * Get the measurements of a member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function measurements()
    {
        return $this->hasMany(Measurements::class, 'member_id', 'id');
    }

    /**
     * Return the id of type ( Member Pay Type )
     *
     * @return int
     */
    public function getTypesAttribute()
    {
        return $this->type_id;
    }

    public function getServiceListAttribute()
    {
        return $this->services->pluck('id')->toArray();
    }

    /*--------------------------------------------
     *                Local Scopes
     *--------------------------------------------
     */

    /**
     * Scope for active members only
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsActive($query)
    {
        return $query->where('active', 1);
    }
}
