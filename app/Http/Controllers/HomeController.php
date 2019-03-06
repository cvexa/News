<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Category;
use App\News;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = News::where([
            ['is_active','>','0'],
            ['show_date','<',Carbon::now()->addDay()->format('Y-m-d')]
        ])->whereNull('deleted_at')->with('Category')->orderBy('show_date', 'DESC')->paginate(9);

        if(Auth::user()->isAdmin()){
            $news = News::with('Category')->orderBy('show_date', 'DESC')->withTrashed()->paginate(9);
        }

        return view('home',['news' => $news]);
    }
}
