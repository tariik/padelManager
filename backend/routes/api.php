<?php
  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
  
Route::post('register', 'API\UserController@register');
  
Route::middleware('auth:api')->group( function () {
	
	// THE MOVIE DB API
	Route::get('movie/{id}', 'API\MovieController@show')->name('movie_detalle');
	Route::get('movies/top-movies', 'API\MovieController@topRated')->name('top_movies');
	
	//MY MOVIES
	Route::get('movies/my-movies', 'API\MyMovieController@index')->name('my_movies');
	Route::get('movies/{id}/add', 'API\MyMovieController@add')->name('add_movie');
	Route::get('movies/{id}/delete', 'API\MyMovieController@delete')->name('delete_movie');
	Route::get('movies/top-btn', 'API\MyMovieController@topBTN')->name('top_btn');


	//USER
	Route::post('user/details', 'API\UserController@details')->name('detalle_user');


	/*Route::get('cache//movies/top-movies', function () { 
		return Cache::remember('movies.top', 60 * 60 * 24, function () { 
			return Movies::all(); 
		}); 
	});*/
});