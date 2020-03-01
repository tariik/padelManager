import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable } from 'rxjs';

import { AuthService } from '../services/auth.service';

@Injectable()
export class JwtInterceptor implements HttpInterceptor {
    constructor(private authService: AuthService) { }

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        // add authorization header with jwt token if available
        let tokenInfoValue = this.authService.tokenInfoValue;

        if (tokenInfoValue && tokenInfoValue.access_token) {
            request = request.clone({
                setHeaders: {
                    Authorization: `Bearer ${tokenInfoValue.access_token}`,
                    'Access-Control-Allow-Methods': 'GET, POST, DELETE, PUT'
                }
            });
        }
        return next.handle(request);
    }
}