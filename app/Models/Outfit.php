<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Outfit extends Model
{
    use HasFactory;

    protected $fillable = [
        'outfit', 'description', 'comments', 'favorites_count', 'favorites_by_user'
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
        'url', 'favorites_count'
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\Models\User', 'favorites')->withTimestamps();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    public function getFavoritesByUserAttribute()
    {
        if (Auth::guest()) {
            return false;
        }

        return $this->favorites->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }
}
