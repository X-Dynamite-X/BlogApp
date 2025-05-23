<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'category_id',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function actions()
    {
        return $this->hasMany(ActionPost::class);
    }
    public function views()
    {
        return $this->hasMany(View::class);
    }
}
