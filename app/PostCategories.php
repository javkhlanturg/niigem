<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model
{
    protected $table = "post_cats";
    protected $primaryKey = "id";
    public $timestamps = false;
}
