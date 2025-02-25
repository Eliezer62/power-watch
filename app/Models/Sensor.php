<?php

namespace App\Models;

use App\Enum\SensorStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasUuids;
    /**
     * Model's table sensor
     * @var string
     */
    protected $table = 'sensors';

    /**
     * Model's timestamp
     * @var bool
     */
    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'model',
        'notes',
        'local',
        'status'
    ];

    protected $casts = [
        'local' => 'string',
        'status' => SensorStatus::class
    ];
}
