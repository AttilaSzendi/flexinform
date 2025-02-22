<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property int client_id
 * @property string type
 * @property Carbon registered
 * @property integer ownbrand
 * @property integer accidents
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Client client
 * @property Collection services
 * @property Service|null latestService
 */
class Car extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'type', 'registered', 'ownbrand', 'accidents'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function latestService(): HasOne
    {
        return $this->hasOne(Service::class)->latest('log_number');
    }

    protected $casts = [
        'registered' => 'datetime'
    ];
}
