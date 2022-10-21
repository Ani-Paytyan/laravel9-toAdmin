<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ManufactureType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Antena[] $antenas
 * @property-read int|null $antenas_count
 * @method static \Illuminate\Database\Eloquent\Builder|ManufactureType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManufactureType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManufactureType query()
 * @mixin \Eloquent
 */
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
