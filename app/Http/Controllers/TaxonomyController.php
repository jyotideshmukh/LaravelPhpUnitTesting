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

    public function store(Request $request){
        $taxonomy = new Taxonomy();
        $taxonomy->title = $request->input('title');
        $taxonomy->parent = $request->input('parent');
        $taxonomy->description = $request->input('description');
        $taxonomy->save();
        return redirect()->action([TaxonomyController::class, 'index']);
    }



}
