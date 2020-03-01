import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Global } from './global';

@Injectable({
  providedIn: 'root'
})

export class MoviesService {

  constructor(private http: HttpClient,private global: Global) { }

  getMyMovie(page) {
    return this.http.get<any>(`${this.global.api}/api/movies/my-movies?page=${page}`);
    //return this.http.get<any>(`${this.global.api}/api/movies/top-rated?page=${page}`);

  }
  getTopMovie(page) {
    return this.http.get<any>(`${this.global.api}/api/movies/top-movies?page=${page}`);
  }
  addMovie(id) {
    return this.http.get<any>(`${this.global.api}/api/movies/${id}/add`);
  }

 deleteMovie(id) {
  return this.http.get<any>(`${this.global.api}/api/movies/${id}/delete`);
 }

 top(){
    return this.http.get<any>(`${this.global.api}/api/movies/top-btn`);
 }
}
