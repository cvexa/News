@extends('layouts.app')
@section('title', 'Users')
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
    <p>
      <a href="{{route('users.create')}}">
        <button class="btn btn-success">add new User</button>
      </a>
    </p>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Created at</th>
          <th scope="col">Updated at</th>
          <th scope="col">Operations</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <th>{{$user->id}}</th>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->Role->role}}</td>
          <td>{{$user->created_at->format('Y-m-d H:m:s')}}</td>
          <td>{{$user->updated_at->format('Y-m-d H:m:s')}}</td>
          <td class="text-center">
            <p>
              <a href="{{route('users.edit',$user->id)}}"><button class="btn btn-primary">edit</button></a> 
            <p/>
            <form action="{{ route('users.destroy',$user->id) }}" method="POST" id="delete-user" onsubmit="return ConfirmDelete()">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <p class="col-md-12 text-center">
                          <button type="submit" class="btn btn-danger delete-user-btn" value="DELETE"><i class="fa fa-trash" aria-hidden="true"></i></button>
                      </p>
                  </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>

 <script>
    function ConfirmDelete() {
        var x = confirm("Are you sure to delete this user ?");
        if (x)
            return true;
        else
            return false;
    }
 </script>
@endsection