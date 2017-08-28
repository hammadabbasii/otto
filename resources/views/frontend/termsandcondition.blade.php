@extends( 'frontend.layout' )
@section('title', '')

@section('content')
<div class="wrap">    

    <h1 class="entry-title">{{$cms->title}}</h1>
    <div class="rht"> <img src="{{ frontend_asset('images/terms.jpg')}}" alt=""></div>
    {!!html_entity_decode($cms->body)!!}
</div>
@endsection