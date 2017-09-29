import { Injectable } from '@angular/core';

import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import { Emisora } from '../emisora/emisora';

@Injectable()
export class EmisorasService {

  private emisoraUrl = "http://www.rcnmundo.com/wp-json/wp/v2/";

  constructor(private _http:Http) { }

  getEmisoras(_url): Observable<Emisora[]>{
    console.log('entro en el servicio');
    return this._http.get(this.emisoraUrl + _url).map((res: Response) => res.json());
  }


}
