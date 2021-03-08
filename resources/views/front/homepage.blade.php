@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')

<div class="col-md-9 mx-auto id='icerik'">
    @include('front.widgets.articleList')
</div>

@include('front.widgets.categoryWidget')
@endsection
@section('js')

<script type="text/javascript">
    $(document).ready(function(){
			$(".icerik_degistir").click(function(){
               $('#icerik').load({!! route('contact') !!});
			});
	});
</script>
@endsection
