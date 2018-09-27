import { ULRProvider } from '../providers/url.providers';
import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/map';

@Injectable()
export class  SolicitudesProvider {

  constructor(
    private http: Http,
    private urlProvider: ULRProvider) {}

  public allFormularios() {
    return this.http.get(this.urlProvider.getAllFormularios())
    .map((res: Response) => res.json());
  }

  public formularioIdMax() {
    return this.http.get(this.urlProvider.getFormularioIdMax())
    .map((res: Response) => res.json());
  }

  public formularioById(objeto: any) {
    return this.http.post(this.urlProvider.getFormularioById(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

  public formularioByUsuario(objeto: any) {
    return this.http.post(this.urlProvider.getFormulariosByUsuario(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

  public insertFormulario(objeto: any) {
    return this.http.post(this.urlProvider.insertFormulario(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

  public insertFormularioAll(objeto: any) {
    return this.http.post(this.urlProvider.insertFormularioAll(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

  public insertDetalleFormulario(objeto: any) {
    return this.http.post(this.urlProvider.insertDetalleFormulario(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

  public moveImage(objeto: any) {
    return this.http.post(this.urlProvider.moveImage(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

}
