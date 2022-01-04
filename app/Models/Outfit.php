<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Outfit extends Model
{
    use HasFactory;

    protected $fillable = [
        'outfit', 'description', 'comments'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id', 'users');
    }

    public function getUrlAttribute()
    {
        return Storage::url('outfits/' . $this->attributes['outfit']);
    }

    protected $appends = [
        'url',
    ];

    public function comments()
{
    return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
}
}
