<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory, Notifiable;
    use HasTranslations;
    protected $fillable =[
        'name',
    ];


    public function products() : HasMany {
        return $this->hasMany(Product::class);
    }
}
