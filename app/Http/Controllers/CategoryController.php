<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;

class CategoryController extends Controller
{


     public function getAutocompleteData(Request $request)
     {
          if ($request->has('query')) {
               $q = $request->input('query');
               $cats = Category::where('name', 'LIKE', "%{$q}%")->get();
               $response = [];
               foreach ($cats as $cat) {
                    $response[] = $this->transform($cat);
               }
               return $response;
          }
     }

     public function transform(Category $cat)
     {
          return [
               'value' => $cat->id,
               'label' => $cat->name,
          ];
     }

     public function create()
     {
          return view('categories.create');
     }

     public function index()
     {
          $categories = Category::get()->toQuery()->paginate(15);
          return view('categories.index', compact('categories'));
     }

     public function show($id)
     {
          $category = Category::findOrFail($id);
          return view('categories.show', compact('category'));
     }

     public function store(Request $request)
     {
          $user = Auth::user();
          $request->validate([
               'name' => 'required|unique:App\Models\Category,name',
               'description' => 'required|',
          ]);


          $cat = new Category();
          $cat->name = request('name');
          $cat->description = request('description');
          $cat->save();

          return redirect('/categories');
     }

     public function edit($id)
     {
          $cat = Category::findOrFail($id);
          return view('categories.edit',compact('cat'));
     }

     public function update($id,Request $request)
     {
          $user = Auth::user();
          $request->validate([
               'name' => 'required|unique:App\Models\Category,name',
               'description' => 'required|',
          ]);


          $cat = Category::findOrFail($id);
          $cat->update(['name' => request('name'),'description' => request('description')]);

          return redirect('/categories');
     }

     public function destroy($id)
     {

          $user = Auth::user();
          $article = Category::findOrFail($id);
          $article->delete();
          return redirect('/categories');
     }
}
