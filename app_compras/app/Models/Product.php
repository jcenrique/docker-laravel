<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{

    use HasFactory;

    protected $fillable =  [
        'name',
        'supermarket_id',
        'category_id',
        'unit_id',
        'price',
        'units_quantity',
        'image'


    ];



    public function category() :BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function supermarket() :BelongsTo {
        return $this->belongsTo(Supermarket::class);
    }

    public function unit() :BelongsTo {
        return $this->belongsTo(Unit::class);
    }
}
