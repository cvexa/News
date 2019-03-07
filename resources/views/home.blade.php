@extends('layouts.app')
@section('title', 'Home')
@section('content')
	@include('layouts.top-bar')
	 
	<div class="col-md-12 d-flex flex-row flex-wrap news-wrapper align-items-stretch">
		@if (!empty(Session::get('success')))
                <p>
                    <div class="alert alert-success">
                        <p>{{ session('success') }}</p>
                    </div>
                </p>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if ($message = Session::get('error'))
                <p>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">
                        </button>
                        <p>{{ $message }}</p>
                    </div>
                </p>
        @endif
        @if(Auth::user()->isAdmin())
            <div class="col-md-12 add-new-story-wrapp">
                <a href="{{route('news.create')}}">
                    <button class="btn btn-success">add new Story</button>
                </a>
            </div>
        @endif
		@foreach($news as $story)
            
		        <div class="col-md-4 text-center one-story">
                @if(!is_null($story->deleted_at))
    		 	    <div class="col-md-12 inner-story deleted">
                @else
                    <div class="col-md-12 inner-story">
                @endif
		 	<div class="story-title">{{$story->title}}</div>
		 	<div class="story-picture"><img src="{{asset('images/news/'.$story->picture)}}" alt="story-pic"></div>
		 	<div class="sub-title">{{$story->sub_title}}</div>
		 	<div class="story-desc">{{mb_substr($story->description, 0, 200)}}...<a href="{{route('news.show',['news' => $story->id])}}">more</a></div>
		 	<div class="story-views col-md-6"><i class="fas fa-list-ul"></i> Category: {{$story->Category->category}}</div>
		 	<div class="story-views col-md-6"><i class="far fa-eye"></i> Views: {{$story->views}}</div>
            <div class="cold-md-12 text-center"><i class="far fa-calendar-alt"></i> {{$story->show_date}}</div>
            @if(Auth::user()->isAdmin())
            <div class="col-md-4">
                <a href="{{route('news.edit',$story->id)}}">
                    <button type="submit" class="btn btn-info" value="edit"><i class="fas fa-edit"></i></button>
                </a>
            </div>
             @if($story->is_active > 0)
                    <div class="col-md-4 active-wrapp">
                        <i class="fas fa-check-circle"></i> Active
                @else
                    <div class="col-md-4 not-active-wrapp">
                        <i class="fas fa-times-circle"></i> Not Active
                @endif
            </div>
            <div class="col-md-4">
                @if(is_null($story->deleted_at))
                     <form action="{{ route('news.destroy',$story->id) }}" method="POST" id="delete-user" onsubmit="return ConfirmDelete()">
                          {{ method_field('DELETE') }}
                          {{ csrf_field() }}
                          <p class="col-md-12 text-center">
                              <button type="submit" class="btn btn-danger" value="DELETE"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </p>
                      </form>
                @else
                    <a href="{{route('news.restore',$story->id)}}">
                        <button type="submit" class="btn btn-success" value="edit">restore</button>
                    </a>
                @endif
              </div>
            @endif
		 	</div>
		 </div>
		@endforeach


	<div class="col-md-12">{{ $news->links() }}</div>
	</div>

    <script>
    function ConfirmDelete() {
        var x = confirm("Are you sure to delete STORY with all its data ?");
        if (x)
            return true;
        else
            return false;
    }
 </script>
@endsection