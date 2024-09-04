<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_title',
        'post_content',
        'user_id',
    ];
    public function user() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
