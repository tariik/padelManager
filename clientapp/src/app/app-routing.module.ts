import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { SignInComponent } from './sign-in/sign-in.component';
import { SignUpComponent } from './sign-up/sign-up.component';
import { MyMoviesComponent } from './my-movies/my-movies.component';
import {TopRatedComponent } from './top-rated/top-rated.component';
import { AuthGuard } from './helpers/auth.guard';
import { HomeComponent } from './home/home.component';


const routes: Routes = [
  { path: '', component: SignInComponent },
  { path: 'sign-in', component: SignInComponent },
  { path: 'sign-up', component: SignUpComponent },
  {
    path: 'home', canActivate: [AuthGuard], component: HomeComponent,
    children: [
      { path: 'my-movies', component: MyMoviesComponent, canActivate: [AuthGuard] },
      { path: 'top-movies', component: TopRatedComponent, canActivate: [AuthGuard] },
    ]
  },


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
