import { Injectable } from '@angular/core';

@Injectable()
export class Configuration {
    public _local : boolean = false;
    public _debug : boolean = false;

    constructor() {
        if (this._local){
            this.TFMApiEntryLink.href = "http://localhost:64449/entry";
        } 
        else {
           this.TFMApiEntryLink.href = "http://localhost:64449/entry";
        }
        this.TFMApiEntryLink.method = "get";
    }

    public TFMApiEntryLink: any = {};
    public TFMApiAgencyID: number = 1;
    public TFMApiSiteID: number = 1;
}