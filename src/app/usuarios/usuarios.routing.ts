import { Routes } from '@angular/router';

import { CrearUsuarioComponent } from './crear/crear-usuario.component';
import { ListarUsuariosComponent } from './listar/listar-usuarios.component';

export const UsuariosRoutes: Routes = [
  {
    path: '',
    children: [
      {
        path: '',
        component: ListarUsuariosComponent,
        data: {
          title: 'Usuarios',
          urls: [{title: 'Usuarios', url: '/usuarios'},{title: 'Usuarios'}]
        }
      },
      {
        path: 'crear',
        component: CrearUsuarioComponent,
        data: {
          title: 'Nuevo usuario',
          urls: [{title: 'Nuevo usuario', url: '/usuarios/crear'},{title: 'Nuevo usuario'}]
        }
      }]
  }
];
