

import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RoutingModule } from './app-routing.module';

import { TypeaheadModule, AccordionModule, TabsModule, DatepickerModule, TooltipModule, ModalModule } from 'ng2-bootstrap';
import { MyDatePickerModule } from 'MyDatePicker';
import { SwiperModule } from 'angular2-useful-swiper';

import { Configuration } from './app.configuration';
import { TFMApiService } from './services/tfm-api.service';
import { SeoService } from './services/seo.service';

import { AppComponent } from './app.component';
import { HomeAppComponent } from './home-app/home-app.component';
import { AboutAppComponent } from './about-app/about-app.component';
import { ContactAppComponent } from './contact-app/contact-app.component';
import { ContentAppComponent } from './content-app/content-app.component';
import { ContentsAppComponent } from './contents-app/contents-app.component';
import { ResultAppComponent } from './result-app/result-app.component';
import { ResultDetailAppComponent } from './result-detail-app/result-detail-app.component';
import { TermsConditionsAppComponent } from './terms-conditions-app/terms-conditions-app.component';
import { BookingAppComponent } from './booking-app/booking-app.component';
import { ConfirmAppComponent } from './confirm-app/confirm-app.component';
import { SearchAppComponent } from './Partial/search-app/search-app.component';
import { RegistrationAppComponent } from './registration-app/registration-app.component';
import { LoginAppComponent } from './login-app/login-app.component';
import { ProfileAppComponent } from './profile-app/profile-app.component';
import { AuthGuard } from './app.auth-guard';
import { AUTH_PROVIDERS } from 'angular2-jwt';
import { LoaderAppComponent } from './Partial/loader-app/loader-app.component';
import { DatepickerComponent } from './partial/datepicker/datepicker.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeAppComponent,
    AboutAppComponent,
    ContactAppComponent,
    ContentAppComponent,
    ContentsAppComponent,
    ResultAppComponent,
    ResultDetailAppComponent,
    TermsConditionsAppComponent,
    BookingAppComponent,
    ConfirmAppComponent,
    SearchAppComponent,
    RegistrationAppComponent,
    LoginAppComponent,
    ProfileAppComponent,
    LoaderAppComponent,
    DatepickerComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    RoutingModule,
    TypeaheadModule, AccordionModule, SwiperModule, DatepickerModule, TabsModule, MyDatePickerModule, TooltipModule, ModalModule
  ],
  providers: [
    Configuration, TFMApiService,
    SeoService,AuthGuard,AUTH_PROVIDERS
  ],
  bootstrap: [AppComponent]
})
export class AppModule { 
    
}
