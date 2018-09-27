import { ULRProvider } from '../providers/url.providers';
import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/map';

@Injectable()
export class  AuthenticationProvider {

  constructor(
    private http: Http,
    private urlProvider: ULRProvider) {}

  public ingresar(objeto: any) {
    return this.http.post(this.urlProvider.ingresar(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

  public insertLogLogin(objeto: any) {
    return this.http.post(this.urlProvider.insertLogLogin(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

}
