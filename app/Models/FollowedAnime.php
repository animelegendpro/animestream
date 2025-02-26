<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowedAnime extends Model
{
    use HasFactory;

    protected $table = 'followed_anime';
    
    protected $fillable = [
        'user_id',
        'anime_id',
        'name',
        'poster',
        'episodes'
    ];

    protected $casts = [
        'episodes' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}