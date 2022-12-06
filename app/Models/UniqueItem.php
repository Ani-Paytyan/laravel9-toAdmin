<?php

namespace App\Models;

use App\Traits\SoftDeletePerformUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniqueItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    use SoftDeletePerformUpdate;

    public $incrementing = false;

    protected $table = 'unique_items';

    const DEFAULT_IS_ONLINE = false;
    const DEFAULT_IS_INSIDE = false;

    protected $fillable = [
        'id',
        'item_id',
        'workplace_id',
        'article',
        'is_online',
        'is_inside',
        'mac',
        'deleted_at'
    ];

    protected $attributes = [
        'is_online' => self::DEFAULT_IS_ONLINE,
        'is_inside' => self::DEFAULT_IS_INSIDE,
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
