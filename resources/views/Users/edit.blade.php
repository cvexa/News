@extends('layouts.app')
@section('title', 'Users')
@section('content')
  @include('layouts.top-bar')
  <div class="col-md-12">
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
   <form action="{{route('users.update',$user->id)}}" method="POST" class="col-md-12" id="edit_user" name="edit_user" >
                {{ method_field('PUT') }}
                {{ csrf_field() }}
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center edit-user-wrapper">
                <p>
                    <label for="name">Name</label><br>
                    <input type="text" id="name" name="name" placeholder=""  value="{{$user->name}}">
                </p>

                <p>
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email" placeholder="" value="{{$user->email}}">
                </p>

                <p>
                    <label for="email">Role</label><br>
                    <select name="user_role" id="user_role">
                    	@foreach($roles as $role)
							@if($role->id == $user->role_id)
								<option value="{{$role->id}}" selected>{{$role->role}}</option>
							@else
								<option value="{{$role->id}}">{{$role->role}}</option>
							@endif
							
                    	@endforeach
                    </select>
                </p>
                <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-edit"></i> Edit</button>
            </div>
            <div class="col-md-2"></div>
    </form>
    <div class="col-md-12 text-center back-btn-wrap">
			<a href="{{route('users.index')}}"><button class="btn btn-success">BACK</button></a>
		</div>
  </div>
@endsection