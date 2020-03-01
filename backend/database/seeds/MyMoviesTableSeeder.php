<?php

use Illuminate\Database\Seeder;
use App\Util\Movie;
use App\User;
use App\MyMovie;


class MyMoviesTableSeeder extends Seeder
{
    protected $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user ) {
            for ($i=110; $i < 115; $i++) { 

            $movie = $this->movie->findById($i);
            
            if (is_object($movie)) {
                
               /* $movie = \App\MyMovie::create(
                    [
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
                );*/

                $myMovie = MyMovie::find($i);
                //$user->MyMovies()->attach($myMovie);
            }
        }
        }
        
    }
}
