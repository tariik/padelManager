
import { Component, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router, ActivatedRoute } from '@angular/router';

import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';
import { AuthService } from './../services/auth.service';

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.scss']
})
export class SignUpComponent implements OnInit {

  error: string;
  loginForm: FormGroup;
  loading = false;
  submitted = false;
  returnUrl: string;
  errorMsg = '';
  

  constructor(
    private router: Router,
    private authService: AuthService,
    private snackBar: MatSnackBar,
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
  ) { 
  // redirect to home if already logged in
     if (this.authService.tokenInfoValue) { 
        this.router.navigate(['home/my-movies']);
      }
    }


ngOnInit() {
    this.loginForm = this.formBuilder.group({
      name: ['', Validators.required],
      username: ['', Validators.required],
      password: ['', Validators.required]
    });

    // get return url from route parameters or default to '/'
  }

  // convenience getter for easy access to form fields
  get f() { return this.loginForm.controls; }

  onSubmit() {
    this.submitted = true;
    // stop here if form is invalid
    if (this.loginForm.invalid) { return; }
    this.loading = true;
    this.authService
      .register(this.f.name.value, this.f.username.value, this.f.password.value)
      .pipe(first())
      .subscribe(
        data => {
          this.router.navigate(['sign-in']);
          console.log('register' + data);
          if (data.email) {
            

          }
        },
        error => {
          this.error = error;
          if (error.error.message.email) {
            this.errorMsg =  error.error.message.email[0];

          }else{
            this.errorMsg =  'duplicated email or name invalid';

          }
          console.log(error.error.message);
          this.loading = false;
        }
    );
  }
}