<?php

namespace App\Models;

use App\Enum\SensorStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasUuids;
    /**
     * Model's table sensor
     * @var string
     */
    protected $table = 'reports';

    /**
     * Model's timestamp
     * @var bool
     */
    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $fillable = [
        'timestamp',
        'voltage',
        'sensor_id'
    ];

    protected $casts = [
        'timestamp' => 'timestamp',
        'voltage' => 'float',
    ];

    public function sensor(): BelongsTo
    {
        return $this->belongsTo(Sensor::class);
    }
}
