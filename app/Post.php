<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title','tag_id', 'user_id' ,'content', 'url', 'picture', 'published', 'shared'
    ];
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
