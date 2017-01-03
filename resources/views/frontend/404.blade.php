@extends('layouts.app')
@section('css')
<style>
  .menu_active{
    background-color: #f60d2b;
    border-bottom: 1px solid transparent;
  }
  li.menu_active a{
    color: #fff;
  }
</style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            &nbsp;
        </div>
    </div>
<div class="container">
    <div class="row">
        <br/><br/>
        <h4><i>Уучлаарай хуудас олдсонгүй</i></h4>
        <br/><br/>
    </div>
</div>
@endsection
@section('javascript')
<script>
  $(document).ready(function(){
    @if(isset($menu) and $menu)
    $('#menu_{{$menu->id}}').addClass('menu_active');
    @endif
  });
</script>
@endsection
