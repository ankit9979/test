import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { TFMApiService } from '../services/tfm-api.service';
import { AuthGuard } from '../app.auth-guard';
import {SeoService} from '../services/seo.service';

@Component({
  selector: 'app-login-app',
  templateUrl: './login-app.component.html',
  styleUrls: ['./login-app.component.css']
})
export class LoginAppComponent implements OnInit {
  content: any = {};
  status: any;
  
  constructor(private seoService: SeoService, private router: Router, private _service: TFMApiService, public auth: AuthGuard) {
    this.seoService.setTitle("Login");
    this.seoService.setMetaDescription("");
    this.seoService.setMetaKeywords("");      
    this.seoService.setMetaRobots('Index, Follow');
  }

  ngOnInit() {
    if (this.auth.loggedIn()) {
      this.router.navigate(['/profile']);
    } else {
      this.auth.logout();
    }
  }

  submitLoginForm(content): void {
    this.status = null;

    this._service.login(content).subscribe(res => {
      if (res.success || res.id_token) {
        this.status = '';
        localStorage.setItem('id_token', res.id_token);
        localStorage.setItem('userGuid', res.user.GUID);
        localStorage.setItem('userId', res.user.Id);

        this.router.navigate(['/profile']);
      }
      else {
        this.status = res.message;
      }
    });
  }
}
