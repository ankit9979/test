import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import {Location} from '@angular/common';

import { TFMApiService } from '../services/tfm-api.service';
import {SeoService} from '../services/seo.service';

@Component({
  selector: 'app-content-app',
  templateUrl: './content-app.component.html',
  styleUrls: ['./content-app.component.css']
})
export class ContentAppComponent implements OnInit {
  private sub: any;
  public routeAlias: string;
  public result: any;
  public type: string = "";

  configSlider: Object = {
    pagination: '.swiper-pagination',
    paginationClickable: true,
    nextButton: '.swiper-arrow-right',
    prevButton: '.swiper-arrow-left',
    spaceBetween: 0,
    slidesPerView:1,
    center:0,
    loop:0,
    autoPlay:5000,
    speed:900
  };

  constructor(private seoService: SeoService, private route: ActivatedRoute, private location:Location, private _service: TFMApiService) {
    this.route.data.subscribe(data => {
        this.type = data["type"];
    });
   }

  ngOnInit() {
    this.sub = this.route.params.subscribe(params => {
        this.routeAlias = params["alias"];
        this._service.getContents().subscribe(res=>{
          this.result = this._service.filterContents(res, this.type, this.routeAlias);
          this.result.url = window.location.href;

          this.seoService.setTitle(this.result.seo.title);
          this.seoService.setMetaDescription(this.result.seo.description);
          this.seoService.setMetaKeywords(this.result.seo.keywords);
          this.seoService.setMetaRobots('Index, Follow');
        });
    });
  }

}
