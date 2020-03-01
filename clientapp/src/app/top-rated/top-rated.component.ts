import { Component, OnInit } from '@angular/core';
import { Movie } from '../models/movie';
import { Observable, Subscription } from 'rxjs';
import { AuthService } from '../services/auth.service';
import { ActivatedRoute, Params, NavigationEnd, Router } from '@angular/router';
import { MoviesService } from '../services/movies.service';

@Component({
  selector: 'app-top-rated',
  templateUrl: './top-rated.component.html',
  styleUrls: ['./top-rated.component.scss']
})
export class TopRatedComponent implements OnInit {

  dataParam: string;
  movies: Movie[];
  parameter: string | number;
  totalPages = 100;
  currentPage = 1;
  loading: boolean;

  constructor(
    public authService: AuthService,
    public moviesService: MoviesService,
    private route: ActivatedRoute,
    private router: Router
  ) {
    this.getMovies(1);
    }

  ngOnInit() {
    this.loading = true;

    //this.currentPage ? this.currentPage = Number(getCurrentPage) : this.currentPage = 1;
  }

  getMovies(currentPage) {
    this.loading = true;
    console.log(currentPage)
    this.moviesService.getTopMovie(currentPage).subscribe(
      response => {
        this.loading = false;
        this.movies = response.data.data.results;
        this.currentPage = Number(response.data.data.page);
        console.log('response'+response.data.data.results)
      }
    );
  }

  next(){

  }

}