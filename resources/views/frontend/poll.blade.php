
<style type="text/css" media="screen">
#sanal{
  margin-bottom: 20px
}
.hide {
  display:none;
}

.poll-results {
  background:#fff;
  color:#000;
  padding:10px;
}

.poll-option {
  margin:10px 0;
}

.poll-result {
  margin:0;
}

.result-box {
  background:#e1e1e1;
  border:solid 1px #c1c1c1;
  margin-top: 5px;
  height:20px;
  overflow:hidden;
}

.result-bg {
  height:20px;
  width:0;
}

.result-bg-fill {
  background:rgb(134, 170, 218);
  height:20px;
  width:0;
}

.poll-results.animate .result-bg-fill {
  width:100%;
  -webkit-transition: width 500ms ease-out 500ms;
  -moz-transition: width 500ms ease-out 500ms;
  -o-transition: width 500ms ease-out 500ms;
  transition: width 500ms ease-out 500ms;
}
</style>

<div id="sanal">
  <h3>Санал асуулга</h3>
  <p>{{ $question->text }}</p>
  <form action="{{route('addPoll')}}" method="post" class="poll-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value="{{$question->id}}">
    @foreach ($question->pollAnswers as $answer)

    <p>
      <input name="answer" type="radio" value="{{$answer->id}}"> {{ $answer->text }}
    </p>
    @endforeach
    <button type="submit" class="btn btn-default btn-block" style="white-space: normal;">Санал өгөх</button>
  </form>

  @foreach ($question->pollAnswers as $answer)
  <?php $answer_sum = App\PollAnswer::where('poll_question_id',$answer->id)->sum('votes');?>
  <div class="poll-results hide" data-total="{{($answer_sum)}}">

    <div class="poll-result" data-score="{{($answer->votes)}}" data-answer="{{$answer->text}}">
      <span>{{$answer->text}} </span>
      <div class="result-box">
        <div class="result-bg">
          <div class="result-bg-fill"><p style="text-align:center"><span class="percent">{{ $answer->percentage }}%</span></p></div>
        </div>
      </div>
    </div>
  </div>
  @endforeach


</div>



<script type="text/javascript" charset="utf-8" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){

  $('form.poll-form').on('submit', function(e){

    e.preventDefault();

    var	submittedAnswer = $('input[name="answer"]:checked').val();

    if ( ! submittedAnswer ) {

      $('.poll-form--error').removeClass('hide');

    } else {

      $.post( $( this ).attr('action'), $( this ).serialize() );

      var total = $('.poll-results').data('total') + 1;
      var score, percent;

      $('.poll-result').each(function(index, value){
        score = $(value).data('score');

        if ( submittedAnswer == $(value).data('answer') ) {
          score++;
        }

        percent = Math.round( score / total * 100);
        $(value).find('.result-bg').css('width', percent.toString()+'%');
        $(value).find('span.percent').html(percent.toString()+'%');
      });

      $( this ).addClass('hide');
      $('.poll-btn-enter').addClass('hide');

      $('.poll-results').removeClass('hide');
      $('.poll-btn-back').removeClass('hide');

      window.setTimeout(function(){
        $('.poll-results').addClass('animate');
      }, 10);
    }
  });


  $('.poll-btn-back').on('click', function() {
    $('form.poll-form, .poll-btn-enter').removeClass('hide');
    $('.poll-results, .poll-btn-back, .poll-form--error').addClass('hide');
    $('.poll-results').removeClass('animate');
    $('form.poll-form')[0].reset();
    return false;
  });

});

</script>
