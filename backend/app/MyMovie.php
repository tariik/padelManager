<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class MyMovie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'release_date',
        'poster_path',
        'overview',
        'tagline',
        'popularity',
        'vote_average', 
        'vote_count',
    ];

    static function getMovies($page, $usrId)
    {
        $offset = ($page - 1) * 20 ;
        $movies = DB::table('my_movies')->skip($offset)
            ->take(20)
            ->join( 'my_movie_user', 'my_movies.id', '=', 'my_movie_user.my_movie_id' )
            ->join( 'users', 'my_movie_user.user_id', '=', 'users.id' )
            ->where( 'users.id', $usrId )
            ->orderBy('vote_average')
            ->get();
        return $movies;
    }

    static function getMoviesCount($page, $usrId)
    {
        $count = DB::table('my_movies')
            ->join( 'my_movie_user', 'my_movies.id', '=', 'my_movie_user.my_movie_id' )
            ->join( 'users', 'my_movie_user.user_id', '=', 'users.id' )
            ->where( 'users.id', $usrId )
            ->orderBy('vote_average')
            ->count();
        return $count;
    }



    static function getTop($page, $usrId)
    {
        $offset = ($page - 1) * 20 ;
        $movies = DB::table('my_movies')->skip($offset)
            ->take(20)
            ->join( 'my_movie_user', 'my_movies.id', '=', 'my_movie_user.my_movie_id' )
            ->join( 'users', 'my_movie_user.user_id', '=', 'users.id' )
            ->where( 'users.id', $usrId )
            ->where('vote_average','>=',4)
            ->orderBy('vote_average')
            ->get();
        return $movies;
    }

    static function getTopCount($page, $usrId)
    {
        $count = DB::table('my_movies')
            ->join( 'my_movie_user', 'my_movies.id', '=', 'my_movie_user.my_movie_id' )
            ->join( 'users', 'my_movie_user.user_id', '=', 'users.id' )
            ->where( 'users.id', $usrId )
            ->where('vote_average','>=',4)
            ->orderBy('vote_average')
            ->count();
        return $count;
    }



    


    


   
}