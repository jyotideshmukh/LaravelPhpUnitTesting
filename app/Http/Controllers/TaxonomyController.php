<?php

namespace App\Http\Controllers;

use App\Models\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //checked before login is it executing or not -- ah its executing
        //dd('we are here- checking auth');

        //validate
       /* $validated = $request->validate([
            'title' => 'required|unique:taxonomies|max:255',
            'owner_id' => 'required'
        ]);*/

        //now removed owner_id from required and Owner should be authenticated user
        $validated = $request->validate([
            'title' => 'required|unique:taxonomies|max:255'
        ]);
        $validated['description'] = $request->input('description');
        $validated['parent'] = $request->input('parent');
        //persist
        //this saving we have done before Auth
       /* $taxonomy = new Taxonomy();
        $taxonomy->title = $request->input('title');
        $taxonomy->parent = $request->input('parent');
        $taxonomy->description = $request->input('description');
        //setting owner by auth
        $taxonomy->owner_id = Auth()->id();
        $taxonomy->save();
       */
        //creating user for authenticated user
        Auth::user()->projets()->create($validated);

        //redirect
        return redirect()->action([TaxonomyController::class, 'index']);
    }

    public function storeForUser(){

    }



}
