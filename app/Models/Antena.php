<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Antena extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $incrementing = false;

    protected $table = 'antenas';

    protected $fillable = [
        'id',
        'mac_address',
        'type_id'
    ];

    public function manufactureType()
    {
        return $this->belongsTo(ManufactureType::class, 'type_id');
    }

    public function workplaces()
    {
        return $this->belongsToMany(Workplace::class)->withPivot('type');
    }

    public function registrationBoxes()
    {
        return $this->hasMany(RegistrationBox::class);
    }
}
