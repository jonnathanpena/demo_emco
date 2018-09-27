import { ULRProvider } from '../providers/url.providers';
import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/map';

@Injectable()
export class  DashboardProvider {

  constructor(
    private http: Http,
    private urlProvider: ULRProvider) {}

    public graficoCantidadEstado() {
      return this.http.get(this.urlProvider.graficoCantidadEstado())
      .map((res: Response) => res.json());
    }

    public graficoValorEstado() {
      return this.http.get(this.urlProvider.graficoValorEstado())
      .map((res: Response) => res.json());
    }

    public graficoCantCiudad() {
      return this.http.get(this.urlProvider.graficoCantCiudad())
      .map((res: Response) => res.json());
    }

}
