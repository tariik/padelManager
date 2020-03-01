<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Util\Movie;
use Illuminate\Support\Facades\Redis;

use function GuzzleHttp\json_decode;

class MovieController extends BaseController
{
	protected $movie;

    public function __construct(Movie $movie)
    {
    	$this->movie = $movie;
    }

    public function topRated(Request $request)
    {
        $page = $request->get('page');

        if (!$page ) {

            return $this->sendResponse($page,'page Not found error.');
        }

         // movie found then it will return  without touching the database
        /*if ($movies = Redis::get('movies.top'.$page)) {
            
            return $this->sendResponse(json_decode($movies), 'redis movies retrieved successfully.');

         }*/

        $movies = $this->movie->topRated($page);

        if (!$movies) {

            return $this->sendResponse($movies,' movie Not found error.');
        }
        // store in redis 24h
        Redis::setex('movies.top'.$page, 60 * 60 * 24, json_encode(['data'  => $movies])); 

    	return $this->sendResponse(['data'  => $movies], 'movies retrieved successfully.');
    }

    public function show($id)
    {
        if (!$id) {

            return $this->sendResponse($id, 'Not found.');
        }

         // movie found then it will return  without touching the database
         if ($movie = Redis::get('movies.detalle'.$id)) {
            
            return $this->sendResponse(json_decode($movie), 'redis movie retrieved successfully.');

         }

        $movie = $this->movie->findById($id);

        // store data into redis for next 24 hours 
        Redis::setex('movies.detalle'.$id, 60 * 60 * 24,json_encode(['data'  => $movie]));


        return $this->sendResponse($movie, 'movie retrieved successfully.');

    }
}