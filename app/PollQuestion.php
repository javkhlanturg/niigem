<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static PollQuestion first
 * @method static Collection latest
 * @property mixed      id
 * @property mixed      text
 * @property Collection pollAnswers
 * @property mixed      votes
 */
class PollQuestion extends Model
{
    protected $fillable = ['text'];

    public function pollAnswers()
    {
        return $this->hasMany('App\PollAnswer','poll_question_id','id');
    }

    public function getVotesAttribute()
    {
        return $this->pollAnswers()->getBaseQuery()->sum('votes');
    }
}
