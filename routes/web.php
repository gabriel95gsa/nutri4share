<?php

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

Auth::routes();

/*
 * Take to the home page
 */
Route::get('/home', 'HomeController@index')->name('home');

/*
 * Take to the user profiles
 */
Route::get('/profile/{username}', 'ProfileController@index');

/*
 * Middleware for authenticated users
 */
Route::group(['middleware' => 'authenticated'], function() {
    /*
     * Take to the posts page
     */
    Route::resource('posts', 'PostsController');
    /*
     * Take to the home page
     */
    Route::get('/', function () {
        return view('home.index');
    });
});

// ------------------------- AJAX Routes -------------------------
/*
 * Url for ajax store like function call
 */
Route::post('/ajax_store_like', 'PostsController@storeLike');

/*
 * Url for ajax create post function
 */
Route::post('/ajax_create_post', 'PostsController@store');