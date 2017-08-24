<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'user_id', 'content', 'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];
    
    /*
     * Set the user_id attribute
     */
    public function setUserIdAttribute($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }
    
    /*
     * Set the content attribute
     */
    public function setContentAttribute($content)
    {
        $this->attributes['content'] = $content;
    }
    
    /*
     * Set the created_at attribute
     */
    public function setCreatedAtAttribute($created_at)
    {
        $this->attributes['created_at'] = $created_at;
    }
    
    /*
     * Set the updated_at attribute
     */
    public function setUpdatedAtAttribute($updated_at)
    {
        $this->attributes['updated_at'] = $updated_at;
    }
    
    /*
     * Get the user_id attribute
     */
    public function getUserIdAttribute()
    {
        return $this->attributes['user_id'];
    }
    
    /*
     * Get the content attribute
     */
    public function getContentAttribute()
    {
        return $this->attributes['content'];
    }
    
    /*
     * Get the created_at attribute
     */
    public function getCreatedAtAttribute()
    {
        return $this->attributes['created_at'];
    }
    
    /*
     * Get the carbon format created_at attribute
     */
    public function getCarbonCreatedAttribute() {
        return Carbon::parse($this->attributes['created_at']);
    }
    
    /*
     * Get the updated_at attribute
     */
    public function getUpdatedAtAttribute()
    {
        return $this->attributes['updated_at'];
    }
    
    /*
     * Get the carbon format updated_at attribute
     */
    public function getCarbonUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at']);
    }
    
    /*
     * Return the post content with the limit of caracters
     */
    public function getShortContentAttribute()
    {
        if(strlen($this->content) > 200) {
            return substr($this->content, 0, 200);
        } else {
            return $this->content;
        }
    }
    
    /*
     * Get the name of the user that created the post
     */
    public function getUserName()
    {
        $record = DB::table('users')->select('name')->whereId($this->user_id)->first();
        
        return $record->name;
    }
    
    /*
     * Get the path of the post image in the directory
     */
    public function getImgPath() 
    {
        $record = DB::table('posts_img_uploads')->select('path')->where('post_id', $this->id)->first();
        
        //return $record->path;
        
        $teste = "images\login_register_background.jpg";
        
        return $teste;
    }
    
    /*
     * Get the post number of likes 
     */
    public function getNumberOfLikes()
    {
        $record = DB::table('posts_likes')->where('post_id', $this->id)
                                          ->count();
        
        return $record;
    }
    
    /*
     * Verify if the post is liked by the user and return a boolean
     */
    public function getIfPostIsLiked($post_id, $user_id) 
    {
        $record = DB::table('posts_likes')->where('post_id', $post_id)
                                          ->where('user_id', $user_id)
                                          ->count();
        
        if($record > 0) {
            return true;
        } else {
            return false;
        }
    }
    
}