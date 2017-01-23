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
      <h1>Poll</h1>
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
          <form method="post">
              {{ csrf_field() }}
              @foreach ($question->pollAnswers as $answer)
                  <p>
                      <button type="submit"
                              formaction="{{ route('polls.answers.votes.store', $answer) }}"
                              class="btn btn-default btn-block"
                              style="white-space: normal;"
                      >{{ $answer->text }}</button>
                  </p>
              @endforeach
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
