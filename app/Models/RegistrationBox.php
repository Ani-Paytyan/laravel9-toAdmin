<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationBox extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'registration_boxes';

    protected $fillable = [
        'id',
        'name',
        'rssi_throttle',
        'antena_id',
    ];

    public function antenas()
    {
        return $this->belongsTo(Antena::class);
    }
}
