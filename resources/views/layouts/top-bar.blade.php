<div class="col-md-12 flex flex-row head-menu">
<div class="col-md-10 text-left">
        <a href="{{route('home')}}" class="nav-link {{ Route::is('home') ? 'selected-nav' : '' }}"><span>News</span></a>
        @if(Auth::user()->isAdmin())
        	<a href="{{route('users.index')}}" class="nav-link {{ Route::is('users.index') ? 'selected-nav' : '' }}"><span>Users</span></a>
        @endif
        @if(Auth::user()->isAdmin())
            <a href="{{route('categories')}}" class="nav-link {{ Route::is('categories') ? 'selected-nav' : '' }}"><span>Categories</span></a>
        @endif
    </div>

    <div class="col-md-2 text-right">
        <a id="logout-btn" class="btn btn-info" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fa-1x"></i>
                {{ __('LOGOUT') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
    </div>
</div>    