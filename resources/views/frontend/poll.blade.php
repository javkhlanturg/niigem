@extends('layouts.app')
@section('css')

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
          <div id="poll-container">

            @unless($pollDisabled || !$question)
      <h1>Санал асуулга</h1>
      <p>{{ $question->text }}</p>
      @if($voted)
          @foreach ($question->pollAnswers as $answer)
              <div class="progress">
                  <div class="progress-bar" style="width: {{ $answer->percentage }}%; text-align: left;">
                      <span style="white-space: nowrap; background: rgba(0,0,0,.4); line-height: 20px; display: inline-block; padding: 0 10px; min-width: 100%;">{{ $answer->text }} ({{ $answer->percentage }}%)</span>
                  </div>
              </div>
          @endforeach
      @else
          <form action="{{'addPoll'}}" method="post">
              {{ csrf_field() }}
              @foreach ($question->pollAnswers as $answer)
                  <p>
                      <input name="poll_box_answer" id="poll_box_answer4147" type="radio" value="4147"> {{ $answer->text }}
                  </p>
              @endforeach
              <button type="submit" class="btn btn-default btn-block" style="white-space: normal;">Санал өгөх</button>
          </form>
      @endif
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

				$( this ).addClass('hide');

				$('.poll-results').removeClass('hide');

				 window.setTimeout(function(){
					$('.poll-results').addClass('animate');
				}, 10);
			}
		});
	});
</script>
@endsection
