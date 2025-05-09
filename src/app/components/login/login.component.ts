

import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { RouterLink } from '@angular/router';

@Component({
  imports: [RouterLink
,    FormsModule,//
    CommonModule,//import all the ng, and ng-class,ng-if
    ReactiveFormsModule //Angular does recognize formGroup
   ],
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  loginForm: FormGroup;
  submitted = false;

  constructor(private formBuilder: FormBuilder) {
    this.loginForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(6)]]
    });
  }

  ngOnInit(): void {
    // Any initialization logic can go here
  }

  // Convenience getter for easy access to form fields
  get f() { return this.loginForm.controls; }

  onSubmit(): void {
    this.submitted = true;
    
    // Stop here if form is invalid
    if (this.loginForm.invalid) {
      return;
    }
    
    // Form is valid, proceed with authentication
    console.log('Form submitted successfully', this.loginForm.value);
    // Here you would typically call your authentication service
  }

  // Helper method to determine if a field is invalid and was touched
  isInvalid(fieldName: string): boolean {
    const field = this.loginForm.get(fieldName);
    return field ? (field.invalid && (field.dirty || field.touched || this.submitted)) : false;
  }
}