import { Component, OnInit } from '@angular/core';
import { Movie } from '../models/movie';
import { Observable, Subscription } from 'rxjs';
import { AuthService } from '../services/auth.service';
import { ActivatedRoute, Params, NavigationEnd, Router } from '@angular/router';
import { MoviesService } from '../services/movies.service';

@Component({
  selector: 'app-my-movies',
  templateUrl: './my-movies.component.html',
  styleUrls: ['./my-movies.component.scss']
})
export class MyMoviesComponent implements OnInit {

  dataParam: string;
  movies: Movie[];
  parameter: string | number;
  currentPage = 1;
  loading: boolean;
  totalPages: number;

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
  }

  top(){
    this.moviesService.top().subscribe(
      response => {
        this.loading = false;
        this.movies = response.data.data.results;
        this.currentPage = Number(response.data.data.currentPage);
        this.totalPages =Number(response.data.data.totalPages)
        console.log('response'+response.data.data)
      }
    );
  }

  getMovies(currentPage) {
    this.loading = true;
    console.log(currentPage)
    this.moviesService.getMyMovie(currentPage).subscribe(
      response => {
        this.loading = false;
        this.movies = response.data.data.results;
        this.currentPage = Number(response.data.data.currentPage);
        this.totalPages =Number(response.data.data.totalPages)
        console.log('response'+response.data.data)
      }
    );
  }
}