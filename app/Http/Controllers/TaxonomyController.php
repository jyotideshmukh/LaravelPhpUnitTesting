<?php

namespace App\Http\Controllers;

use App\Models\Taxonomy;
use Illuminate\Http\Request;

class TaxonomyController extends Controller
{
    //

    public function index(){
        $taxonomies =  Taxonomy::all();
        return view('index',['taxonomies'=>$taxonomies]);
    }

    public function show(Taxonomy $taxonomy){
        $taxonomy =  Taxonomy::findOrFail();
        return view('show',['taxonomy'=>$taxonomy]);
    }

    public function store(Request $request){
        //validate
        $validated = $request->validate([
            'title' => 'required|unique:taxonomies|max:255'
        ]);


        //persist
        $taxonomy = new Taxonomy();
        $taxonomy->title = $request->input('title');
        $taxonomy->parent = $request->input('parent');
        $taxonomy->description = $request->input('description');
        $taxonomy->save();

        //redirect
        return redirect()->action([TaxonomyController::class, 'index']);
    }



}
