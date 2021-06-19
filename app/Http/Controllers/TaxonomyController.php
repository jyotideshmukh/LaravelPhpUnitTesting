<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaxonomyController extends Controller
{
    //

    public function newTaxonomy(){
        $taxonomy = new Taxonomy();
        $taxonomy->title = $request->input('title');
        $taxonomy->parent = $request->input('parent');
        $taxonomy->description = $request->input('description');
        $taxonomy->save();
    }
}
