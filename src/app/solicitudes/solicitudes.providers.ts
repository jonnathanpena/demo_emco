import { ULRProvider } from '../providers/url.providers';
import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/map';

@Injectable()
export class  SolicitudesProvider {

  constructor(
    private http: Http,
    private urlProvider: ULRProvider) {}

  public allProvincias() {
    return this.http.get(this.urlProvider.getAllProvincias())
    .map((res: Response) => res.json());
  }

  public allCantonesByProvincia(objeto: any) {
    return this.http.post(this.urlProvider.getCantonesByProvincia(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

}
