<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class ArticleController extends Controller
{
    
    public function index()
    {
        $articles = Article::sortable()->paginate(15);
        return view('articles.index',compact('articles'));
    }

    public function indexByCategory($id)
    {
        $category = Category::findOrFail($id);
        $articles = $category->articles()->paginate(15);
        return view('articles.index',compact('articles'));
    }

    public function indexByTag($id)
    {
        $tag = Tag::findOrFail($id);
        $articles = $tag->articles()->paginate(15);
        return view('articles.index',compact('articles'));
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $articles = Article::query()->where('title', 'LIKE', "%{$q}%")->orWhere('body', 'LIKE', "%{$q}%")->paginate(15);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show',['article'=>$article]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'Title' => 'required|',
            'Description' => 'required|',
            'tags_json' => 'array|required',
            'tags_json.*' => 'integer',
            'cats_json' => 'array|required|size:1',
            'cats_json.*' => 'integer',
            'Image' => 'file|required'
        ]);


        $article = new Article();
      $article->title = request('Title');
       $article->body = request('Description');
       $article->image = file_get_contents(request('Image')->getRealPath());
       $article->author()->associate($user->id);
       $cats_json = request('cats_json');
       $cat = Category::findOrFail(intval(array_values($cats_json)[0]));
       $article->category_id = $cat->id;
       $tags_json = request("tags_json");
       $article->save();
       foreach(array_values($tags_json) as $tag)
       {
        $tag_ = Tag::findOrFail(intval($tag));
        $article->tags()->attach($tag_->id);
       }
       $article->save();
        return redirect('/');

    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit',compact('article'));
    }

    public function update($id,Request $request)
    {
        $article = Article::findOrFail($id);
        $user = Auth::user();
        if($article->author == $user || $user->is_admin == 1){
        $request->validate([
            'Title' => 'required|',
            'Description' => 'required|',
            'tags_json' => 'array|required',
            'tags_json.*' => 'integer',
            'cats_json' => 'array|required|size:1',
            'cats_json.*' => 'integer',
            'Image' => 'file'
        ]);


        $cat = Category::findOrFail(intval(array_values(request('cats_json'))[0]));
        $tags_json = request("tags_json");
        $tags_arr = [];
        $counter = 0;
        foreach(array_values($tags_json) as $tag)
        {
         $tag_ = Tag::findOrFail(intval($tag));
         $tags_arr[$counter] = $tag_->id;
         $counter += 1;
        }
        $article->tags()->sync($tags_arr);
        $new_image = $article->image;
        if ($request->hasFile('Image'))
        {
            $new_image = file_get_contents(request('Image')->getRealPath());
        }
        $article->update(['title' => $request->has('Title') ? request('Title'):$article->title,'body'=>$request->has('Description') ? request('Description'):$article->body,'image'=> $new_image,'category_id' => $cat->id]);
       
        return redirect('/');
    }

    }

    public function destroy($id)
    {

        $user = Auth::user();
        $article = Article::findOrFail($id);
        if($article->author == $user || $user->is_admin == 1){
            $article->delete();
            return redirect('/');
        }
    }
}
