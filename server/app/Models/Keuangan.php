<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $fillable = [
        'periode', 
        'pendapatan', 
        'ekspektasi', 
        'status'
    ];

    protected $attributes = [
        'pendapatan' => 0,
        'ekspektasi' => 0,
        'status' => false,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // set default periode to today
            $model->periode = $model->periode ?? now()->toDateString();

            // automatically set status
            $model->status = $model->pendapatan >= $model->ekspektasi;
        });

        static::updating(function ($model) {
            $model->status = $model->pendapatan >= $model->ekspektasi;
        });
    }
}
