import { Routes } from '@angular/router';

import { CrearSolicitudComponent } from './crear/crear-solicitud.component';
import { ListarSolicitudesComponent } from './listar/listar-solicitudes.component';

export const SolicitudesRoutes: Routes = [
  {
    path: '',
    children: [
      {
        path: '',
        component: ListarSolicitudesComponent,
        data: {
          title: 'Solicitudes',
          urls: [{title: 'Solicitudes', url: '/solicitudes'},{title: 'Solicitudes'}]
        }
      },
      {
        path: 'crear',
        component: CrearSolicitudComponent,
        data: {
          title: 'Nueva solicitud',
          urls: [{title: 'Nueva solicitud', url: '/solicitudes/crear'},{title: 'Nueva solicitud'}]
        }
      }]
  }
];
