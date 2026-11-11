<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Capital extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'photo',
        'short_info',
        'detailed_info',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y') : null;
    }
    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y') : null;
    }
}