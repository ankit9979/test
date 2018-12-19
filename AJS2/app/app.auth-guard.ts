import { Injectable } from '@angular/core';
import { Router, CanActivate } from '@angular/router';
import { tokenNotExpired } from 'angular2-jwt';


@Injectable()
export class AuthGuard implements CanActivate {
    constructor(private router: Router) { }

    canActivate() {
        // Check to see if a user has a valid JWT
        if (tokenNotExpired()) {
            // If they do, return true and allow the user to load the home component
            return true;
        }

        // If not, they redirect them to the login page
        this.router.navigate(['']);
        return false;
    }

    logout() {

        localStorage.removeItem('id_token');
        localStorage.removeItem('userGuid');
        localStorage.removeItem('userId');

        this.router.navigateByUrl('login');
    }

    // Finally, this method will check to see if the user is logged in. We'll be able to tell by checking to see if they have a token and whether that token is valid or not.
    loggedIn() {
        return tokenNotExpired();
    }
}