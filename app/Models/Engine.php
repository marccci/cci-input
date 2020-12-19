<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Engine extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'engines';

    protected $appends = [
        'files',
        'images',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ENGINE_POWER_UNITS_RADIO = [
        'hp' => 'HP',
        'ps' => 'PS',
        'kw' => 'KW',
    ];

    const ENGINE_SIZE_UNITS_RADIO = [
        'metric'   => 'Metric',
        'imperial' => 'Imperial',
    ];

    const BLOCK_CONFIG_RADIO = [
        'i' => 'Inline',
        'v' => 'V',
        'b' => 'Boxer',
        'w' => 'W',
        'o' => 'Rotary',
        'r' => 'Radial',
    ];

    public static $searchable = [
        'name',
        'cylinder_number',
        'engine_power',
        'engine_size',
        'bore',
        'files',
        'block_config',
    ];

    protected $fillable = [
        'creator_id',
        'owner_id',
        'name',
        'description',
        'manufacturer_id',
        'cylinder_number',
        'engine_power',
        'engine_power_units',
        'engine_size',
        'engine_size_units',
        'bore',
        'stroke',
        'created_at',
        'block_config',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
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

    public function getFilesAttribute()
    {
        return $this->getMedia('files')->last();
    }

    public function getImagesAttribute()
    {
        $files = $this->getMedia('images');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
}
