<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class MovieTest extends TestCase
{
   
   public function test_can_show_movie() {

        $id = 100;

        $this->get(route('movie_detalle',$id ))
            ->assertStatus(200);
    }

    public function test_can_list_top_movies() {

        
        $this->get(route('top_movies',['page' => 1]))
            ->assertStatus(200);
    }
}