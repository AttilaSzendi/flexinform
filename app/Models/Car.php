<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int client_id
 * @property int car_id
 * @property string type
 * @property Carbon registered
 * @property integer ownbrand
 * @property integer accidents
 */
class Car extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'type', 'registered', 'ownbrand', 'accidents'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
