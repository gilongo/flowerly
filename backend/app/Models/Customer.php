<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'email',
        'phone',
    ];

    protected $casts = [
        'phone' => 'string',
    ];

    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->attributes[$model->getKeyName()] = (string) Str::uuid();
            }
        });
    }
}
