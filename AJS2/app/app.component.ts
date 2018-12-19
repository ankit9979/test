import { Component } from '@angular/core';
import { AuthGuard } from './app.auth-guard';
import { TFMApiService } from './services/tfm-api.service';
import { Router, NavigationEnd } from '@angular/router';
import {SeoService} from './services/seo.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  private destinations:any;
  private packages: any;
  private itinGuid: string;

  constructor(private seoService: SeoService, private router: Router, public auth: AuthGuard, private _service: TFMApiService) {
    this._service.itinGuid$.subscribe(item => this.itinGuid = item);
  }

  ngOnInit() {
    this.seoService.setTitle("");      
    this.seoService.setMetaDescription("");      
    this.seoService.setMetaKeywords("");      
    this.seoService.setMetaRobots('Index, Follow');

    this.router.events.subscribe((evt) => {
        if (!(evt instanceof NavigationEnd)) {
            return;
        }
        document.body.scrollTop = 0;
    });

    this._service.getContents().subscribe(res => this.destinations = this._service.filterContents(res, 'destination'));
    this._service.getPackages().subscribe(res => this.packages = this._service.filterPackages(res, null));
  }
}
