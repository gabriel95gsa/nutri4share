<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Posts_img_upload extends Model
{
    protected $fillable = [
        'post_id', 'path',
    ];
    
    /*
     * Set the post_id attribute
     */
    public function setPostIdAttribute($value) {
        $this->attributes['post_id'] = $value;
    }
    
    /*
     * Set the path attribute
     */
    public function setPathAttribute($value) 
    {
        $this->attributes['path'] = $value;
    }
    
    /*
     * Get the post_id attribute
     */
    public function getPostIdAttribute()
    {
        return $this->attributes['post_id'];
    }
    
    /*
     * Get the path attribute
     */
    public function getPathAttribute()
    {
        return $this->attributes['path'];
    }
    
    /*
     * Set the directory default path
     */
    public function getDefaultPath()
    {
        return '/files/users/' . Auth::user()->username . '/posts_uploads/';
    }
    
}