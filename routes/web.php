<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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


// simple get type route returning string res
Route::get('first', function () {
    return 'first route';
});


// main available type request types 
// Route::get($uri, $callback);
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback); 


// we can define single route for multiple request as well 
Route::match(['get', 'post'], 'multiple-req', function () {
    return 'will work for get and post both';
});

// we can define single route for all type of request
Route::any('any-type', function () {
    return 'will work for any request type';
});


// we can pass any data using dependency-injection
Route::get('dependency-inject', function (Request $req, $extra = 'Extra') {
    dd($req, $extra);
});

// we can also  redirect to any routes and also use other methods
Route::redirect('redirect', '/');

Route::permanentRedirect('redirect2', '/');

Route::get('redirect3', function () {
    return redirect('/');
});


// we can also return views directly if we only want to return view
Route::view('view1', 'view1');

Route::view('view2', 'view2', ['name' => 'vatsal']);


// dynamic properties in url
Route::get('dynamic/{id}', function ($id) {
    return "dynamic id is $id";
});

Route::get('dynamic2/{id}', function ($id, Request $req) {
    return "dynamic id is $id and request is $req";
});

Route::get('dynamic3/{id}/and/{name}', function ($id, $name) {
    return "dynamic id is $id and name is $name";
});

// we can also declare properties as optional but we have to declare default for it 
Route::get('dynamic4/{id?}', function ($id = 1) {
    return "dynamic id is $id";
});


Route::get('regex/{name}', function () {
    return 'a to z only';
})->where('name', '[A-Za-z]+');

Route::get('regex2/{name}/{id}', function ($name, $id) {
    return 'multiple regex';
})->where(['name' => '[A-Za-z]+', 'id' => '[0-9]+']);

// we also have some commonly use regix methods as well

Route::get('regex3/{name}', function () {
    return 'alpha name';
})->whereAlpha('name');

Route::get('regex4/{name}', function () {
    return 'numeric name';
})->whereNumber('name');


Route::get('regex5/{name}', function () {
    return 'alpha numeric name';
})->whereAlphaNumeric('name');


// we can also define unique name for any route and we can use that in different places 
// like redirect etc and also provide dynamic route params and query string to that
// for more details check Named Routes laravel doc
Route::get('named-routes', function () {
    return 'named route';
})->name('name1');



// we can group routes to gather as well for that we have to use function  
// before group like middleware, prefix, name etc
// for more check Route Groups in laravel doc  
Route::middleware([])->group(function () {

    Route::get('mid-group1', function () {
        return 'mid-group1';
    });

    Route::get('mid-group2', function () {
        return 'mid-group2';
    });
});

Route::prefix('admin')->group(function () {

    Route::get('pre-group1', function () {
        return 'pre-group1';
    });
});



// fallback is use to catch all route that are not define in all app
// by default laravel will throw its awn 404 page if fallback not define 
// if we define fallback it will use our method instead of its awn
// fallback should we last in your route file
// Route::fallback(function () {
//     return 'not found';
// });
