import { Component, OnInit } from '@angular/core';
import { DealerService } from '../services/dealer.service';
import { Dealer } from '../model/Dealer';
import { Router } from '@angular/router';
import { AuthGuard } from '../app.auth-guard';

@Component({
  selector: 'app-edit-profile-app',
  templateUrl: './edit-profile-app.component.html',
  styleUrls: ['./edit-profile-app.component.css'],
  providers: [DealerService]
})
export class EditProfileAppComponent implements OnInit {
  dealer: Dealer = new Dealer();
  data: any;
  status: any;
  IsEdit: boolean = false;
  constructor(private dealerService: DealerService, public router: Router, public auth: AuthGuard) { }

  ngOnInit() {
    this.dealer.dealerId = +localStorage.getItem('dealerId');
    this.dealer.email = localStorage.getItem('dealerEmail');
    this.dealerService.getDealer(this.dealer).subscribe(res => {
      this.data = res.extdealer;
      this.dealer.email = res.extdealer.Email;
      this.dealer.businessName = res.extdealer.BusinessName;
      this.dealer.physicalAddress = res.extdealer.PhysicalAddress;
      this.dealer.telephone = res.extdealer.Telephone;
      this.dealer.website = res.extdealer.Website;
    },
      error => {
        this.router.navigate(['/dealer-login']);
      });
  }

  updateDealer() {
    this.dealerService.updateDealer(this.dealer).subscribe(res => {
      this.data = res.extdealer;
      this.IsEdit = false;
    },
      error => {
        this.status = 'Something went wrong! Please try later.';
      });
  }
  updatePassword(event, oldpassword, newpassword, cpassword) {
    if (newpassword == cpassword) {
      this.status = '';
      this.dealer.password = oldpassword;
      this.dealer.newpassword = newpassword;
      this.dealerService.updatePassword(this.dealer).subscribe(res => {
        this.auth.logout();
      },
        error => {
          this.status = error;
        });
    }
    else {
      this.status = 'Confirm password does not match';
    }
  }


}
