<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class product extends Model
{
    use HasFactory;

     public $incrementing = false;
     protected $keyType = 'string';

     protected $fillable = ['product_name', 'category', 'price', 'discount'];


     protected static function boot()
     {
         parent::boot();

         static::creating(function ($model) {
             if (!$model->getKey()) {
                 $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
             }
         });
     }
}
