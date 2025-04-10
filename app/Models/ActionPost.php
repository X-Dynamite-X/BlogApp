<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionPost extends Model
{
    //
    protected $fillable = [
        'post_id',
        'user_id',
        'action',
        "view"
    ];

    // العلاقة مع المنشور
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
