import { Component, OnInit, Input } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { AuthService } from '../services/auth.service';
import { Movie } from '../models/movie';
import { MoviesService } from '../services/movies.service';

@Component({
  selector: 'app-movie-list',
  templateUrl: './movie-list.component.html',
  styleUrls: ['./movie-list.component.scss']
})
export class MovieListComponent {
  @Input() movies: Movie[];
  @Input() pagina: any;

  constructor(
    public authService: AuthService,
    private snackBar: MatSnackBar,
    private movieService: MoviesService
  ) { }

  movieById(movie: Movie) {
    return movie.id;
  }

  addMovie(id) {
    this.movieService.addMovie(id).subscribe(response => {console.log(response)})
  }

  deleteMovie(id) {
    this.movieService.deleteMovie(id).subscribe(response => {  location.reload(true)
    })
  }
}