@extends('layouts.app')
@section('title', 'Single story')
@section('content')
	@include('layouts.top-bar')
	<div class="col-md-2"></div>
	<div class="col-md-8 single-story-wrapper">
		<div class="single-title text-center">
			{{$story->title}}
		</div>
		<div class="single-picture col-md-12 text-center">
			<img src="{{asset('images/news/'.$story->picture)}}" alt="story-pic" class="single-pic">
		</div>
		<div class="single-sub text-center col-md-12">
			{{$story->sub_title}}
		</div>
		<div class="single-desc text-justify col-md-12">
			{{$story->description}}
		</div>
		<div class="single-category col-md-6 text-center">
			<i class="fas fa-list-ul"></i> Category:{{$story->Category->category}}
		</div>
		<div class="single-views col-md-6 text-center">
			<i class="far fa-eye"></i> Views:{{$story->views}}
		</div>
		<div class="cold-md-12 text-center">
			<i class="far fa-calendar-alt"></i> {{$story->show_date}}
		</div>
		<div class="col-md-12 text-center back-btn-wrap">
			<a href="{{route('home')}}"><button class="btn btn-success">BACK</button></a>
		</div>
	</div>
	<div class="col-md-2"></div>
@endsection