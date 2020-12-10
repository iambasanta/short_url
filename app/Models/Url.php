<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Url extends Model
{
    use HasFactory;
    protected $fillable = ['original_url', 'shorten_url', 'user_id', 'title'];
    protected $appends = ['path'];
    //boot method overriding for create a method
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($url) {
            $url->shorten_url = Str::random(7);
        });
    }
    public function getRouteKeyName()
    {
        return 'shorten_url';
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getPathAttribute()
    {
        return asset("u/$this->shorten_url");
    }
}
