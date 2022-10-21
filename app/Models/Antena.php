<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Antena
 *
 * @property-read \App\Models\ManufactureType|null $manufactureType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workplace[] $workplaces
 * @property-read int|null $workplaces_count
 * @method static \Illuminate\Database\Eloquent\Builder|Antena newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Antena newQuery()
 * @method static \Illuminate\Database\Query\Builder|Antena onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Antena query()
 * @method static \Illuminate\Database\Query\Builder|Antena withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Antena withoutTrashed()
 * @mixin \Eloquent
 */
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
        return $this->belongsTo(ManufactureType::class);
    }

    public function workplaces()
    {
        return $this->belongsToMany(Workplace::class);
    }
}
