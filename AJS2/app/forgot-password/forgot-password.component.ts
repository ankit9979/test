import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { TFMApiService } from '../services/tfm-api.service';

@Component({
  selector: 'app-forgot-password',
  templateUrl: './forgot-password.component.html',
  styleUrls: ['./forgot-password.component.css']
})
export class ForgotPasswordComponent implements OnInit {
   _service: TFMApiService;
  status: any;
  resetPayload: any;
 private options: RequestOptions = new RequestOptions({ headers: this.headers });
   constructor(private http: Http, private router: Router, tfm: TFMApiService) { this._service = tfm; }

  ngOnInit() {
    console.log(this.route.snapshot.params['email']);
    this.resetPayload = this.route.snapshot.params['email'];
  }
  ResetEmail(event, username) {
    this.dealer.email = username;
    this.dealerService.resetEmail(this.dealer).subscribe(res => {
      this.status = res;
      this.dealer = new Dealer();
    });
  }

  Reset(event, password, cpassword) {
    if (password == cpassword) {
      this.status = '';
      this.dealer.email = this.resetPayload;
      this.dealer.password = password;
      this.dealerService.reset(this.dealer).subscribe(res => {
        this.status = res;
        this.dealer = new Dealer();
        //event.reset();
      });
    }
    else{
      this.status = 'Confirm password does not match';
    }
  }
}
