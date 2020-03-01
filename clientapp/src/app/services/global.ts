import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Subject, from } from 'rxjs';


@Injectable({
  providedIn: 'root'
})

export class Global  {
    api: string;
    client_secret: string;
    client_id: string;
    constructor() {
        this.client_secret = 'zI4Z4Vbza4TGW4EDsBltFhnhPevhJUF3meWRGEac';
        this.client_id = '2';
        
        if ( location.origin === 'http://localhost:4200') {
            this.api = 'http://127.0.0.1:8000';
        } 
        else {
            this.api = location.origin + '';
        }
        console.log(this.api);
    }
}
