<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    //
    protected $fillable = [
        'post_id',
        'user_id',
        'view'
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function incrementView()
    {
        
        $this->increment('view');
        $this->save();
    }

}
