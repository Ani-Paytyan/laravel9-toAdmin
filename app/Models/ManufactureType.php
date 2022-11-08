<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufactureType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'manufacture_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public function antenas()
    {
        return $this->hasMany(Antena::class);
    }
}
