@extends('layouts.app')
@section('title', 'Categories')
@section('content')
  @include('layouts.top-bar')
  <div class="col-md-12 users-table">
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
 				<form action="{{route('news.update',$story->id)}}" method="POST" class="col-md-12" id="create_story" name="create_story" enctype="multipart/form-data">
 					 {{ method_field('PUT') }}
                    {{ csrf_field() }}
                <div class="col-md-2"></div>
	            <div class="col-md-8 text-center create-story-wrapper">
	                <p>
	                    <label for="title">Title</label><br>
	                    <input type="text" id="title" name="title" placeholder=""  value="{{$story->title}}">
	                </p>

	                <p>
	                	<div class="col-md-12 picture-holder text-center">
	                    <label for="picture-story-title">
	                        <img src="{{asset('/images/news/'.$story->picture)}}" alt="course-pic" id="story-picture">
	                        <br>
	                    </label>
	                </div>

	                <div class="col-md-12 picture-button text-center">
	                    <label class="picture-label" for="picture-story-title"><span class="upload-pic">upload<input type="file" id="picture-story-title" name="picture" onChange="imagePreview(this);"></span></label>
	                </div>
	                </p>

	                <p>
	                    <label for="title">Sub Title</label><br>
	                    <input type="text" id="sub_title" name="sub_title" placeholder="" value="{{$story->sub_title}}">
	                </p>

	                <p>
                        <label for="description">Description</label><br>
                        <textarea id="description" cols="30" rows="5" name="description" placeholder="" style="width: 30vw;">{{$story->description}}</textarea>
                    </p>

                    <p class="show_date_wrapper">
                        <label for="show_date">Show Date</label><br>
                        <input type="date" name="show_date" id="show_date" value="{{$story->show_date}}">
                    </p>

                    <p>
                    	<label for="category_id">Category</label><br>
                    	<select name="category_id" id="category_id">
                    	 @foreach($categories as $category)
                    		 
								@if($story->category_id == $category->id)
									<option value="{{$category->id}}" selected="selected">{{$category->category}}</option>
								@else
									<option value="{{$category->id}}">{{$category->category}}</option>
								@endif
                    	 @endforeach
                    	 </select>
                    </p>

                    <p>
                    	<label for="show_date">Active</label><br>
                    		@if($story->is_active > 0)
								<input type="radio" name="is_active" value="1" id="active-true" checked><label for="active-true">True</label>
								<input type="radio" name="is_active" value="0" id="active-false"><label for="active-false">False</label><br>
							@else
								<input type="radio" name="is_active" value="1" id="active-true"><label for="active-true">True</label>
								<input type="radio" name="is_active" value="0" id="active-false" checked><label for="active-false">False</label><br>
							@endif
                    </p>
                     <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-edit"></i> Edit</button>
	                
	            </div>
            	<div class="col-md-2"></div>
        </div>
        </form>
        <div class="col-md-12 text-center back-btn-wrap">
			<a href="{{route('home')}}"><button class="btn btn-success">BACK</button></a>
		</div>

        <script>
        	function imagePreview( input ) {
			var ext = input.files[ 0 ][ 'name' ].substring( input.files[ 0 ][ 'name' ].lastIndexOf( '.' ) + 1 ).toLowerCase();
			if ( input.files && input.files[ 0 ] && ( ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" ) ) {
				img = new Image( 1024, 768 );
				var _URL = window.URL || window.webkitURL;
				img.src = _URL.createObjectURL( input.files[ 0 ] );
				img.onload = function () {

					var reader = new FileReader();
					reader.onload = function ( e ) {
						$( '#story-picture' ).attr( 'src', e.target.result );
					}
					reader.readAsDataURL( input.files[ 0 ] );
				}
			} else {
				alert( 'The fail must be a picture !' );
			}
		}
        </script>

        <script>
        	var datefield = document.createElement( "input" )

			datefield.setAttribute( "type", "date" )
        	if ( datefield.type != "date" ) { //if browser doesn't support input type="date", load files for jQuery UI Date Picker
					var datePicker = document.createElement( "script" );
					datePicker.src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js";
					$( 'head' ).append( datePicker );
					$( 'head' ).append( '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css" as="style">' );
					$( '.show_date' ).remove();
					$( '.show_date_wrapper' ).append('<input type="text" id="show_date" name="show_date" value=""></p>' );
					setTimeout( function () {
						$( '#show_date' ).datepicker( {
							format: 'yyyy-mm-dd'
						} );
					}, 200 );
				}
        </script>
@endsection