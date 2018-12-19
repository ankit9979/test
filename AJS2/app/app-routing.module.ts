import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { HomeAppComponent } from './home-app/home-app.component';
import { ContactAppComponent } from './contact-app/contact-app.component';
import { AboutAppComponent } from './about-app/about-app.component';
import { ContentsAppComponent } from './contents-app/contents-app.component';
import { ContentAppComponent } from './content-app/content-app.component';
import { ResultAppComponent } from './result-app/result-app.component';
import { TermsConditionsAppComponent } from './terms-conditions-app/terms-conditions-app.component';
import { ResultDetailAppComponent } from './result-detail-app/result-detail-app.component';
import { BookingAppComponent } from './booking-app/booking-app.component';
import { ConfirmAppComponent } from './confirm-app/confirm-app.component';
import { RegistrationAppComponent } from './registration-app/registration-app.component';
import { LoginAppComponent } from './login-app/login-app.component';
import { ProfileAppComponent } from './profile-app/profile-app.component';
import { AuthGuard } from './app.auth-guard';

const routes: Routes = [
  { path: 'home', component: HomeAppComponent },
  { path: 'about', component: AboutAppComponent },
  { path: 'terms-and-conditions', component: TermsConditionsAppComponent },
  { path: 'contact', component: ContactAppComponent },

  { path: 'articles', component: ContentsAppComponent, data: {type:'article'} },
  { path: 'article/:alias', component: ContentAppComponent, data: {type:'article'} },
  { path: 'destinations', component: ContentsAppComponent, data: {type:'destination'} },
  { path: 'destination/:alias', component: ContentAppComponent, data: {type:'destination'} },
  
  { path: 'packages/specials-and-promotions', component: ResultAppComponent, data: {type:'package', onPromo:true} },

  { path: 'packages/:tag', component: ResultAppComponent, data: {type:'package'} },
  { path: 'package/:alias', component: ResultDetailAppComponent, data: {type:'package'} },
  
  { path: 'search-results/:guid', component: ResultAppComponent, data: {type:'search'} },
  { path: 'book-itinerary/:guid', component: BookingAppComponent },
  { path: 'confirm-itinerary/:guid', component: ConfirmAppComponent },

  { path: 'login', component: LoginAppComponent },
  { path: 'profile', component: ProfileAppComponent,canActivate: [AuthGuard] },
  { path: 'signup', component: RegistrationAppComponent },
  
  { path: '', redirectTo: '/home', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
  providers: []
})
export class RoutingModule { }
