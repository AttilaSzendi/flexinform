<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int client_id
 * @property int car_id
 * @property int log_number
 * @property string event
 * @property Carbon event_time
 * @property string document_id
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Service extends Model
{
    use HasFactory;

    protected $casts = [
        'event_time' => 'datetime'
    ];
}
