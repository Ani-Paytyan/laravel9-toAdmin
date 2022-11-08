<?php

namespace App\Models;

use App\Traits\SoftDeletePerformUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Workplace
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Antena[] $antenas
 * @property-read int|null $antenas_count
 * @property-read \App\Models\Company|null $company
 * @method static \Illuminate\Database\Eloquent\Builder|Workplace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Workplace newQuery()
 * @method static \Illuminate\Database\Query\Builder|Workplace onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Workplace query()
 * @method static \Illuminate\Database\Query\Builder|Workplace withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Workplace withoutTrashed()
 * @mixin \Eloquent
 */
class Workplace extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftDeletePerformUpdate;

    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'workplaces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'company_id',
        'name',
        'address',
        'deleted_at'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function antenas()
    {
        return $this->belongsToMany(Antena::class);
    }

    public function items()
    {
        return $this->morphToMany(Item::class, 'taggable');
    }
}
