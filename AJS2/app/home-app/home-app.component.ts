import { Component, OnInit } from '@angular/core';
import { TFMApiService } from '../services/tfm-api.service';
import {SeoService} from '../services/seo.service';
var $ = require('jquery');

(<any>window).$ = $;
(<any>window).jQuery = $;
// require('../../theme/js/jquery-2.1.4.min.js');
require('../../theme/js/bootstrap.min.js');

require('../../theme/js/jquery-ui.min.js');
//require('../../theme/js/idangerous.swiper.min.js');
require('../../theme/js/jquery.viewportchecker.min.js');
require('../../theme/js/isotope.pkgd.min.js');
require('../../theme/js/jquery.mousewheel.min.js');
//require('../../theme/js/map.js');
require('../../theme/js/all.js');

@Component({
  selector: 'app-home-app',
  templateUrl: './home-app.component.html',
  styleUrls: ['./home-app.component.css']
})
export class HomeAppComponent implements OnInit {
  configSlider: Object = {
    pagination: '.swiper-pagination',
    paginationClickable: true,
    nextButton: '.swiper-arrow-right',
    prevButton: '.swiper-arrow-left',
    spaceBetween: 0,
    slidesPerView:1,
    center:0,
    loop:1,
    autoplay:5000,
    speed:2000
  };
  configTestimonials: Object = {
    pagination: '.swiper-pagination',
    paginationClickable: true,
    nextButton: '.swiper-arrow-right',
    prevButton: '.swiper-arrow-left',
    spaceBetween: 0,
    slidesPerView:4
  };

  private packagesPromo: any;
  
  constructor(private seoService: SeoService, private _service: TFMApiService) {
    this.seoService.setTitle("Luxury Golfing Holidays");
    this.seoService.setMetaDescription("");
    this.seoService.setMetaKeywords("");      
    this.seoService.setMetaRobots('Index, Follow');
  }

  ngOnInit() {
    this._service.getPackages().subscribe(res => this.packagesPromo = this._service.filterPackages(res, null, true));
  }
}
