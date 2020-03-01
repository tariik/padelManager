import { Component, HostListener, OnInit, ChangeDetectorRef, OnDestroy, ViewChild } from '@angular/core';
import { MediaMatcher } from '@angular/cdk/layout';

import { MatSnackBar } from '@angular/material/snack-bar';

import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit, OnDestroy {

  mobileQuery: MediaQueryList;
  lang: string;
  shouldRun = [/(^|\.)plnkr\.co$/, /(^|\.)stackblitz\.io$/].some(h => h.test(window.location.host));

// tslint:disable-next-line: variable-name
  private _mobileQueryListener: () => void;
  @ViewChild('snav', { static: true }) snav: any;
  title = 'clientapp';
  loggedin = false ;
  tokenInfoValue: any;
  constructor(
      //public authService: AuthService,
      
      changeDetectorRef: ChangeDetectorRef,
      media: MediaMatcher,
      private router: Router,
      private snackbar: MatSnackBar,
      private authService: AuthService,
      //public translateService: TranslateService,
  ) 
  {
      this.mobileQuery = media.matchMedia('(max-width: 731px)');
      this._mobileQueryListener = () => changeDetectorRef.detectChanges();
  // tslint:disable-next-line: deprecation
      this.mobileQuery.addListener(this._mobileQueryListener);
      
      this.tokenInfoValue = this.authService.tokenInfoValue;

      //this.translateService.setDefaultLang('en-US');

  }

  ngOnInit() {
      if(this.tokenInfoValue){
          this.loggedin =true;
      }
      console.log('loggedin' + this.loggedin)
      //this.lang = this.storageService.read('language');
      //!this.lang ? this.storageService.save('language', 'en-US') : this.lang = this.lang;
      //this.translateService.use(this.lang);
  }

  ngOnDestroy(): void {
// tslint:disable-next-line: deprecation
      this.mobileQuery.removeListener(this._mobileQueryListener);
    }

  @HostListener('window:scroll', ['$event']) scrollHandler(event) {
      const height = window.scrollY;
      const el = document.getElementById('btn-returnToTop');
      height >= 500 ? el.className = 'show' : el.className = 'hide';
  }

  scrollTop() {
      window.scrollTo({left: 0, top: 0, behavior: 'smooth'});
  }

  searchMovie(term: string) {
      term === '' ? this.router.navigate(['/movies/now-playing']) : this.router.navigate(['/movies/search', { term }]);
  }

  onSignOut() {
      this.authService.logout();
      this.router.navigate(['/'])
  }

  closeSidenav() {
      if (this.mobileQuery.matches !== false) {
          this.snav.close();
      }
  }

  resetPagination() {
      sessionStorage.setItem('hubmovies-current-page', '1');
  }
}
