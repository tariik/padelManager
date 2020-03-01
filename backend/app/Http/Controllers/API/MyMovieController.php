<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\MyMovie;
use App\Util\Movie;
use Illuminate\Support\Facades\Redis;


class MyMovieController extends BaseController
{
    protected $movie;

    public function __construct(Movie $movie)
    
    {
        $this->movie = $movie;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->get('page');
        $usrId = $request->user()->id; 

        if (!$page ) {

            return $this->sendResponse($page,'Not found error.');
        }

         // movies found then it will return all post without touching the database
       if ($data = Redis::get('movies.my'.$page.$usrId)) {
            
            return $this->sendResponse(json_decode($data), ' redis movies retrieved successfully.');
        }


        $movies = MyMovie::getMovies($page, $usrId);
        $count = MyMovie::getMoviesCount($page, $usrId);

        $data = array(
            'results' => $movies,
            'currentPage' => $page,
            'totalPages' => ceil($count/20),
        );

        Redis::setex('movies.my'.$page.$usrId, 60 * 60 * 24, json_encode(['data'  => $data])); 

    	return $this->sendResponse(['data'  => $data], 'movies retrieved successfully.');
    }

    /**
     * Store resource 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($id, Request $request)
    {

        if(!$id){
            
            return $this->sendError('id not found.', $id);       
        }

        $movie = MyMovie::find($id); 


        if(!$movie){
            
            $movie = $this->movie->findById($id);
            MyMovie::create([
                'id'=>$movie->id,
                'title'=>$movie->title,
                'release_date'=>$movie->release_date,
                'poster_path'=>$movie->poster_path,
                'overview'=>$movie->overview,
                'tagline'=>$movie->tagline,
                'popularity'=>$movie->popularity,
                'vote_average'=>$movie->vote_average,
                'vote_count'=>$movie->vote_count,
            ] 
        );
        }
       
     

        $user = $request->user();
        
        $moviedb = MyMovie::find($id); 

        $user->MyMovies()->attach($moviedb);

       

        return $this->sendResponse($moviedb, 'Movie created successfully.');
    }
    
    /**
     * Delete resource 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete($id, Request $request)
    {
        if(!$id){
            
            return $this->sendError('id not found.', $id);       
        }

        $movies = MyMovie::find($id); 

        if(!$movies){
            
            return $this->sendError('movie not found .', $movies);       
        }

        $movies = MyMovie::find($id); 

        $user = $request->user();

        $user->MyMovies()->detach($movies);
       
        return $this->sendResponse($movies->toArray(), 'Movie deleted successfully.');
    }

    /**
     * Display specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$id){
            
            return $this->sendError('id not found.', $id);       
        }

        $movies = MyMovie::find($id);

        if (is_null($movies)) {
            return $this->sendError('Movie not found.');
        }

        return $this->sendResponse($movies, 'Movie retrieved successfully.');
    }

     /**
     * Display list of button TOP.
     *
     * @return \Illuminate\Http\Response
     */
    public function topBTN(Request $request)
    {
        $page = $request->get('page');
        $usrId = $request->user()->id; 

         // movies found then it will return all post without touching the database
        if ($data = Redis::get('movies.topBTN'.$page)) {
            
            return $this->sendResponse(json_decode($data), ' redis movies retrieved successfully.');
        }

      
        $movies = MyMovie::getTop($page, $usrId);
        $count = MyMovie::getTopCount($page, $usrId);
        
        $data = array(
            'results' => $movies,
            'currentPage' => $page,
            'totalPages' => ceil($count/20),
        );

        Redis::setex('movies.topBTN'.$page, 60 * 60 * 24, json_encode(['data'  => $movies])); 

    	return $this->sendResponse(['data'  => $data], 'movies retrieved successfully.');
    }

}