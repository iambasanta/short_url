<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Url extends Model
{
    use HasFactory;
    protected $fillable = ['original_url', 'shorten_url'];
    //boot method overriding for create a method
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($url) {
            $url->shorten_url = Str::random();
        });
    }
    public function getRouteKeyName()
    {
        return 'shorten_url';
    }
}
