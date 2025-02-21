<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string card_name
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'card_number'];
}
