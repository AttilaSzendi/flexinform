<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property string card_number
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Collection cars
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'card_number'];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
