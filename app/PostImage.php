<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = "post_images";
    protected $primaryKey = "id";
    public $timestamps = false;
}
