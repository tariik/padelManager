import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { BehaviorSubject, Observable, from } from 'rxjs';
import { map } from 'rxjs/operators';
import { Global} from './global';
import { Router } from '@angular/router';

@Injectable({ providedIn: 'root' })
export class AuthService {

    private tokenInfoValueSubject: BehaviorSubject<any>;
    public tokenInfo: Observable<any>;

    constructor(
        private http: HttpClient, 
        private global : Global,
        private router: Router,
        ) {
        this.tokenInfoValueSubject = new BehaviorSubject<any>(JSON.parse(localStorage.getItem('tokenInfo')));
        this.tokenInfo = this.tokenInfoValueSubject.asObservable();
    }

    public get tokenInfoValue(): any {
        return this.tokenInfoValueSubject.value;
    }

    login(username: string, password: string) {
     
      const headers = new HttpHeaders({
        'Content-Type': 'application/x-www-form-urlencoded'
      });
      const body = new HttpParams()
        .set('grant_type', 'password')
        .set('username', username)
        .set('password', password)
        .set('client_secret', this.global.client_secret)
        .set('client_id', this.global.client_id); //Letters are dummy here for security reasons
    
    //URL preceded by https
      return this.http.post<any>(`${this.global.api}/oauth/token`, body , {headers: headers })
            .pipe(map(data => {
                // store user details and jwt token in local storage to keep user logged in between page refreshes
                    localStorage.setItem('tokenInfo', JSON.stringify(data));
                    this.tokenInfoValueSubject.next(data);
                    
                    return data;
            }));
    }

    logout() {
        // remove user from local storage to log user out
        localStorage.removeItem('tokenInfoValue');
        localStorage.removeItem('tokenInfo');
        this.tokenInfoValueSubject.next(null);
    }

    register(name:string ,username: string, password: string){
        const headers = new HttpHeaders({
            'Content-Type': 'application/x-www-form-urlencoded'
          });
          const body = new HttpParams()
            .set('name', name)
            .set('email', username)
            .set('password', password)
            .set('c_password', password)

        //URL preceded by https
          return this.http.post<any>(`${this.global.api}/api/register`, body , {headers: headers })
                .pipe(map(data => {
                    // store user details and jwt token in local storage to keep user logged in between page refreshes
                    console.log('this.register'+data)    
                    //localStorage.setItem('tokenInfo', JSON.stringify(data));
                        //this.tokenInfoValueSubject.next(data);
                        
                        return data;
                }));
    }
}
