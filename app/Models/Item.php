<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $incrementing = false;

    protected $table = 'items';

    protected $fillable = [
        'id',
        'serial_number',
        'name',
        'description',
    ];

    public function workplaces()
    {
        return $this->morphToMany(Workplace::class, 'taggable');
    }

    public function uniqueItem()
    {
        return $this->hasMany(UniqueItem::class);
    }
}
