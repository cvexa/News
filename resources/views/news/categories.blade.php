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
    <p>
      <a href="{{route('category.create')}}">
        <button class="btn btn-success">add new Category</button>
      </a>
    </p>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Category</th>
          <th scope="col">Operations</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <th>{{$category->id}}</th>
          <td>{{$category->category}}</td>
          <td class="text-center">
            <form action="{{ route('category.destroy',$category->id) }}" method="POST" id="delete-category" onsubmit="return ConfirmDelete()">
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
        var x = confirm("Are you sure to delete this category ?");
        if (x)
            return true;
        else
            return false;
    }
 </script>
@endsection