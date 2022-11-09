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

    protected $fillable = [
        'id',
        'item_id',
        'workplace_id',
        'article',
        'mac',
        'deleted_at'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
