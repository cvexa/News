<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\NewsView;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Image;
use File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('news.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'picture' => 'required|file|image|mimes:jpeg,png,gif,webp,ico,jpg|max:4000',
            'title' => 'required|max:50',
            'sub_title' => 'required|max:100',
            'description' => 'required',
            'show_date' => 'required|date_format:Y-m-d',
            'category_id' => 'required|numeric',
            'is_active' => 'required'
        ]);

        $storyPic = Input::file('picture');
        $image = Image::make($storyPic->getRealPath());
        $image->fit(1024, 768, function ($constraint) {
            $constraint->upsize();
        });
        $name = time()."_".$storyPic->getClientOriginalName();
        $name = str_replace(' ', '', strtolower($name));
        $name = md5($name);
        $data['picture'] = $name;
        $data['views'] = 0;

        $createStory = News::create($data);
        
        $path = public_path().'/images/news';
        
        $image->save($path.'/'.$name, 90);

        $message = __("Succeffully added new story!");
        return redirect('/home')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story = News::withTrashed()->find($id)->load('Category');
        $isViewed = NewsView::where([
            ['news_id',$story->id],
            ['user_id', Auth::user()->id],
        ])->first();

        if(!Auth::user()->isAdmin() && is_null($isViewed)){
            $addView = new NewsView;
            $addView->news_id = $story->id;
            $addView->user_id = Auth::user()->id;
            $addView->save();
            $story->views = ($story->views + 1);
            $story->save();
        }
        return view('news.show',['story' => $story]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $story = News::withTrashed()->find($id);
        if(is_null($story->deleted_at)){
            $categories = Category::all();

            return view('news.edit',['story' => $story,'categories' => $categories]);
        }

        $message = __("Story is deleted restore it first !");
        return redirect('/home')->with('error', $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'picture' => 'sometimes|file|image|mimes:jpeg,png,gif,webp,ico,jpg|max:4000',
            'title' => 'required|max:50',
            'sub_title' => 'required|max:100',
            'description' => 'required',
            'show_date' => 'required|date_format:Y-m-d',
            'category_id' => 'required|numeric',
            'is_active' => 'required'
        ]);

        $story = News::find($id);

        $storyPic = Input::file('picture');
        if($storyPic){
            $image = Image::make($storyPic->getRealPath());
            $image->fit(1024, 768, function ($constraint) {
                $constraint->upsize();
            });
            $name = time()."_".$storyPic->getClientOriginalName();
            $name = str_replace(' ', '', strtolower($name));
            $name = md5($name);
            $story->picture = $name;

            if (file_exists(public_path().'/images/news/'.$story->picture)) {
                File::delete(public_path().'/images/news/'.$story->picture);
            }

            $path = public_path().'/images/news';
        
            $image->save($path.'/'.$name, 90);
        }
        
        $story->title = $request->title;
        $story->sub_title = $request->sub_title;
        $story->description = $request->description;
        $story->show_date = $request->show_date;
        $story->category_id = $request->category_id;
        $story->is_active = $request->is_active;
        $story->save();
        
        $message = __("Succeffully edited story!");
        return redirect('/home')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delNews = News::withTrashed()->find($id);
        $delNews->is_active = 0;
        $delNews->save();
        $delNews->delete();

        $message = __("Succeffully deleted story!");
        return redirect('/home')->with('success', $message);
    }

    public function restore($news)
    {
        $restore = News::withTrashed()->find($news);
        $restore->is_active = 1;
        $restore->save();
        $restore->restore();
        
        $message = __("Succeffully restored story!");
        return redirect('/home')->with('success', $message);
    }

    public function showAllCategories()
    {
        $categories = Category::all();
        return view('news.categories',['categories' => $categories]);
    }

    public function createCategory()
    {
        return view('news.create_category');
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|max:10',
        ]);
        $addCategory = new Category;
        $addCategory->category = $request->category;
        $addCategory->save();

        $message = __("Succeffully added new category!");
        return redirect('/categories/all')->with('success', $message);
    }

    public function deleteCategory($id)
    {
        $deleteCategory = Category::find($id);
        $deleteCategory->delete();

        $message = __("Succeffully deleted category!");
        return redirect('/categories/all')->with('success', $message);
    }
}
