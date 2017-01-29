<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed        id
 * @property PollQuestion pollQuestion
 * @property mixed        votes
 * @method increment($field)
 */
 class PollAnswer extends Model
 {
     protected $fillable = ['text', 'votes'];

     public function pollQuestion()
     {
         return $this->hasOne('App\PollQuestion','id','poll_question_id');
     }

     public function getPercentageAttribute()
     {
         return round($this->votes / $this->pollQuestion->votes * 100);
     }
 }
