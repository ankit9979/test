import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { TFMApiService } from '../services/tfm-api.service';
import {SeoService} from '../services/seo.service';

@Component({
  selector: 'app-contents-app',
  templateUrl: './contents-app.component.html',
  styleUrls: ['./contents-app.component.css']
})
export class ContentsAppComponent implements OnInit {
  private _service: TFMApiService;
  private contents: any;
  public type: string = "";

  constructor(private seoService: SeoService, private route: ActivatedRoute, tfm: TFMApiService) { 
    this._service = tfm;

    this.route.data.subscribe(data => {
        this.type = data["type"];
    });
  }

  ngOnInit() {
    this._service.getContents().subscribe(res=>{
      this.contents = this._service.filterContents(res, this.type, null);
      
      this.seoService.setTitle("");
      this.seoService.setMetaDescription("");
      this.seoService.setMetaKeywords("");
      this.seoService.setMetaRobots('Index, Follow');
    });
  }

}
