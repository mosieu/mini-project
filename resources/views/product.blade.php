@extends('index')

@section('title')
    Product
@endsection

@section('content')
<img src="{{$product->image}}">
<p>
    {{$product->title.$product->category}}
</p>
@endsection
