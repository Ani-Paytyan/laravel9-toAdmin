<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\DeprecatedUuidMethodsTrait;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    use DeprecatedUuidMethodsTrait;

    protected $table = 'companies';

    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'address',
        'type_id',
    ];

    public function workplaces()
    {
       return $this->belongsToMany(Workplace::class);
    }
}
