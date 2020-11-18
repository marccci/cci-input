<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Carmodel extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'carmodels';

    public static $searchable = [
        'name',
        'last_year',
    ];

    protected $dates = [
        'first_year',
        'last_year',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'creator_id',
        'owner_id',
        'name',
        'manufacturer_id',
        'first_year',
        'last_year',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function getFirstYearAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFirstYearAttribute($value)
    {
        $this->attributes['first_year'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getLastYearAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLastYearAttribute($value)
    {
        $this->attributes['last_year'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
