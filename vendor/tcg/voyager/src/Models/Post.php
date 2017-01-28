<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = [
        'slug', 'name', 'title', 'category_id', 'author_id', 'seo_title', 'excerpt', 'body', 'image', 'slug', 'meta_description', 'meta_keywords', 'status', 'featured',
    ];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->id;
        }

        parent::save();
    }

    public function user(){
      return $this->hasOne("TCG\Voyager\Models\User", 'id', 'author_id');
    }

    public function author_id()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->hasOne("TCG\Voyager\Models\Category", 'id', 'category_id');
    }

    public function commentCount()
    {
        return $this->hasMany("App\Comments", 'postid', 'id')->count();
    }

    public function sliders()
    {
        return $this->hasMany("App\PostImage", 'post_id', 'id')->get();
    }

    public function plusView(){
      $this->viewcount = $this->viewcount+1;
      $this->update();
    }
}
