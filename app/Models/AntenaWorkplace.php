<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AntenaWorkplace extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'antena_workplace';

    protected $fillable = [
        'type',
        'address_id',
        'workplace_id',
    ];

    protected $casts = [
        'type' => 'string',
        'address_id' => 'string',
        'workplace_id' => 'string',
    ];
}
