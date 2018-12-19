import { Component, OnInit } from '@angular/core';
import { TFMApiService } from '../services/tfm-api.service';
import {SeoService} from '../services/seo.service';

@Component({
  selector: 'app-contact-app',
  templateUrl: './contact-app.component.html',
  styleUrls: ['./contact-app.component.css']
})
export class ContactAppComponent implements OnInit {
  responseVersion: any;
  public content : any = {};
  public message : string = '';
  public success : boolean = false;

  constructor(private seoService: SeoService, private _service : TFMApiService) {
    this.seoService.setTitle("Contact");
    this.seoService.setMetaDescription("");
    this.seoService.setMetaKeywords("");      
    this.seoService.setMetaRobots('Index, Follow');
  }

 init() {
    // this._service.getVersion().subscribe(res => {
    //   this.responseVersion = res;
    //   this.linkContact = this._service.getLink(this.responseVersion._links, "contact").href;
    // });
  }

  ngOnInit() {
    this.init();
  }

  contactRequest(content): void {
    this.message = "Thank you for your message!";
    this.success = true;
    // this.status = null;
    // this.http.
    //   post(this.linkContact, content, this.options).subscribe(res => {
    //     let data = res.json();
    //     console.log(data);
    //     this.router.navigate(['/contact']);
    //   }, error => {
    //     let data = error.json();
    //     this.status = data.message;
    //   });
  }

}
