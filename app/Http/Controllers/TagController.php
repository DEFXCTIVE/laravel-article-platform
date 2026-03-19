<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;


class TagController extends Controller
{
     public function getAutocompleteData(Request $request)
     {
          if ($request->has('query')) {
               $q = $request->input('query');
               $tags = Tag::where('name', 'LIKE', "%{$q}%")->get();
               $response = [];
               foreach ($tags as $tag) {
                    $response[] = $this->transform($tag);
               }
               return $response;
          }
     }

     public function transform(Tag $tag)
     {
          return [
               'value' => $tag->id,
               'label' => $tag->name,
          ];
     }

     public function create()
     {
          return view('tags.create');
     }

     public function index()
     {
          $tags = Tag::get()->toQuery()->paginate(15);
          return view('tags.index', compact('tags'));
     }

     public function show($id)
     {
          $tag = Tag::findOrFail($id);
          return view('tags.show', compact('tag'));
     }

     public function store(Request $request)
     {
          $user = Auth::user();
          $request->validate([
               'name' => 'required|unique:App\Models\Tag,name',
          ]);


          $tag = new Tag();
          $tag->name = request('name');
          $tag->save();

          return redirect('/tags');
     }

     public function edit($id)
     {    
          $tag = Tag::findOrFail($id);
          return view('tags.edit',compact('tag'));
     }

     public function update($id,Request $request)
     {
          $user = Auth::user();
          $request->validate([
               'name' => 'required|unique:App\Models\Tag,name',
          ]);


          $tag = Tag::findOrFail($id);
          $tag->update(['name' => request('name')]);

          return redirect('/tags');
     }


     public function destroy($id)
     {

          $user = Auth::user();
          $tag = Tag::findOrFail($id);
          $tag->delete();
          return redirect('/tags');
     }
}
