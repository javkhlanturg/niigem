@extends('layouts.app')
@section('css')
<style type="text/css" media="screen">
.hide {
  display:none;
}

.poll-results {
  background:#fff;
  color:#000;
  padding:20px;
}

.poll-option {
  margin:10px 0;
}

.poll-result {
  margin:10px 0;
}

.result-box {
  background:#e1e1e1;
  border:solid 1px #c1c1c1;
  height:20px;
  overflow:hidden;
}

.result-bg {
  height:30px;
  width:0;
}

.result-bg-fill {
  background:rgb(134, 170, 218);
  height:30px;
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
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <div id="poll-container">

        @unless($pollDisabled || !$question)
        <h1>Санал асуулга</h1>
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
          <div class="poll-result">
            <p>{{$answer->text}} </p>
            <div class="result-box">
              <div class="result-bg">
                <div class="result-bg-fill"><p style="text-align:center"><span class="percent">{{ $answer->percentage }}%</span></p></div>
              </div>
            </div>
          </div>
          @endforeach
        @endunless



      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript" charset="utf-8" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
  $('form.poll-form').on('submit', function(e){
    // e.preventDefault();
    var	submittedAnswer = $('input[name="answer"]:checked').val();
    if ( ! submittedAnswer ) {
      $('.poll-form--error').removeClass('hide');
    } else {
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





      window.setTimeout(function(){
        $('.poll-results').addClass('animate');
      }, 10);
    }
  });
});
</script>
@endsection
