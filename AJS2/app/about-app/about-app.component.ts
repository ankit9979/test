import { Component, OnInit } from '@angular/core';
import {SeoService} from '../services/seo.service';

@Component({
  selector: 'app-about-app',
  templateUrl: './about-app.component.html',
  styleUrls: ['./about-app.component.css']
})
export class AboutAppComponent implements OnInit {

  constructor(private seoService: SeoService) { 
    this.seoService.setTitle("About");
    this.seoService.setMetaDescription("");
    this.seoService.setMetaKeywords("");      
    this.seoService.setMetaRobots('Index, Follow');
  }

  ngOnInit() {
  }

}
