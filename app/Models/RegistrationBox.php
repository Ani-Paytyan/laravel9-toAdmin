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

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'rssi_throttle',
        'antena_id',
    ];

    public function antenna()
    {
        return $this->belongsTo(Antena::class, 'antena_id', 'id', 'antenas');
    }
}
