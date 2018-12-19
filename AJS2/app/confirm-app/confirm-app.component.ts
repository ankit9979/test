import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { TFMApiService } from '../services/tfm-api.service';
import {SeoService} from '../services/seo.service';

@Component({
  selector: 'app-confirm-app',
  templateUrl: './confirm-app.component.html',
  styleUrls: ['./confirm-app.component.css']
})
export class ConfirmAppComponent implements OnInit {
  private itinGuid: any;
  private itin: any;
  private itinItems: any;

  constructor(private seoService: SeoService, private route: ActivatedRoute, private _service: TFMApiService) {
    this.seoService.setTitle("Thank You");
    this.seoService.setMetaDescription("");
    this.seoService.setMetaKeywords("");      
    this.seoService.setMetaRobots('Index, Follow');
  }

  ngOnInit() {
    localStorage.removeItem("itin");
    this._service.itinGuid(null);
    
    this.route.params.subscribe(params => {
      if (params["guid"]){
        this._service.getItin(params["guid"]).subscribe(res=>{          
          this.itin = res;

          if (this.itin && this.itin.content.itinerary.id > 0){
            this._service.getItinItems(this.itin.content.itinerary.guid).subscribe(res=>{
              this.itinItems = res;
            });
          }
        })
      }
    });
  }
}
