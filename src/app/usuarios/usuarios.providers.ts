import { ULRProvider } from '../providers/url.providers';
import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/map';

@Injectable()
export class  UsuariosProvider {

  constructor(
    private http: Http,
    private urlProvider: ULRProvider) {}

  public allProvincias() {
    return this.http.get(this.urlProvider.getAllProvincias())
    .map((res: Response) => res.json());
  }

  public allDepartamentos() {
    return this.http.get(this.urlProvider.getAllDepartamentos())
    .map((res: Response) => res.json());
  }

  public allUsuarios() {
    return this.http.get(this.urlProvider.getAllUsuarios())
    .map((res: Response) => res.json());
  }

  public allCantonesByProvincia(objeto: any) {
    return this.http.post(this.urlProvider.getCantonesByProvincia(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

  public insertPersona(objeto: any) {
    return this.http.post(this.urlProvider.insertPersona(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

  public insertUsuario(objeto: any) {
    return this.http.post(this.urlProvider.insertUsuario(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

  public insertUsuarioDepartamento(objeto: any) {
    return this.http.post(this.urlProvider.insertUsuarioDepartamento(), JSON.stringify(objeto), {
      headers: new Headers({'Content-Type': 'application/json'})
    })
      .map((res: Response) => res);
  }

  public graficoCantidadEstado() {
    return this.http.get(this.urlProvider.graficoCantidadEstado())
    .map((res: Response) => res.json());
  }

  public graficoValorEstado() {
    return this.http.get(this.urlProvider.graficoValorEstado())
    .map((res: Response) => res.json());
  }

}
