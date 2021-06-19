<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Taxonomy;
use App\Http\Controllers\TaxonomyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::post('/tags', function (Request $request) {
    $taxonomy = new Taxonomy();
    $taxonomy->title = $request->input('title');
    $taxonomy->parent = $request->input('parent');
    $taxonomy->description = $request->input('description');
    $taxonomy->save();

});

Route::get('/tags', function (Request $request) {
    $taxonomies =  Taxonomy::all();
    return view('index',$taxonomies);
});*/

Route::get('/tags',[TaxonomyController::class, 'index']);

Route::post('/tags', [TaxonomyController::class, 'store']);
