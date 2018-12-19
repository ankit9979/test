var $ = require('jquery');

(<any>window).$ = $;
(<any>window).jQuery = $;

import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { TFMApiService } from '../services/tfm-api.service';
import {SeoService} from '../services/seo.service';

@Component({
  selector: 'app-booking-app',
  templateUrl: './booking-app.component.html',
  styleUrls: ['./booking-app.component.css']
})
export class BookingAppComponent implements OnInit {
  private itinGuid: any;
  private itin: any;
  private itinItems: any;

  public firstName: string;
  public lastName: string;
  public emailAddress: string;
  public emailAddressVerify: string;
  public contactNumber: string;
  public contactNumberCode: string = "+27";

  constructor(private seoService: SeoService, private route: ActivatedRoute, private _service: TFMApiService, private router:Router) {
    this.seoService.setTitle("Confirm Your Booking");
    this.seoService.setMetaDescription("");
    this.seoService.setMetaKeywords("");      
    this.seoService.setMetaRobots('Index, Follow');
  }

  ngOnInit() {
    $('.drop').on( "click", function() {
      if($(this).find('.drop-list').hasClass('act')){
        $(this).find('.drop-list').removeClass('act');
        $(this).find('span').slideUp(300);
      } else {
        $('.drop span').slideUp(300);
        $('.drop .act').removeClass('act');
        $(this).find('.drop-list').addClass('act');
        $(this).find('span').slideDown(300);
      }
		  
      return false;
	  });
    $('.drop span a').on( "click", function() {
      if ($(this).data("type") == "TelCode") {
        this.contactNumberCode = $(this).data("value");
      }

      $(this).parent().parent().find('b').text($(this).text());
      $('.drop').find('span').slideUp(300);
    });
    
    this.route.params.subscribe(params => {
      this.itinGuid = params["guid"];

      this.getItin();
    });
  }
  public clearItin(){
    localStorage.removeItem("itin");
    this.itinGuid = null;
    this.getItin();
  }
  public getItin(){
    if (this.itinGuid){
      this._service.getItin(this.itinGuid).subscribe(res=>{
        this.itin = res;

        if (this.itin && this.itin.content.itinerary.id > 0){
          localStorage.setItem("itin", this.itin.content.itinerary.guid);
          this._service.itinGuid(this.itin.content.itinerary.guid);
            
          this.getItinItems();
        }
      });
    }
    else{
      this.itin = null;
    }

    this._service.itinGuid(this.itinGuid);
  }
  public getItinItems(){
    if (this.itinGuid){
      this._service.getItinItems(this.itinGuid).subscribe(res=>{
        this.itinItems = res;
      });
    }
  }
  public confirmItinerary() {
    this.itin.content.itinerary.firstName = this.firstName;
    this.itin.content.itinerary.lastName = this.lastName;
    this.itin.content.itinerary.emailAddress = this.emailAddress;
    this.itin.content.itinerary.contactNumber = this.contactNumberCode + ' ' + this.contactNumber;

    this.itin.content.itinerary.status = "Confirmed";

    this._service.updateItin(this.itin.content.itinerary.guid, this.itin.content.itinerary).subscribe(res => {
      this.router.navigate(['/confirm-itinerary', this.itin.content.itinerary.guid]);
    });
  }
}
