import { Component, OnInit} from '@angular/core';
import { Router } from '@angular/router';
import { SolicitudesProvider } from '../solicitudes.providers';
import notify from 'devextreme/ui/notify';

@Component({
  templateUrl: './listar-solicitudes.component.html',
  styleUrls: ['./listar-solicitudes.component.scss']
})

export class ListarSolicitudesComponent implements OnInit {
  formularios: any = [];
  solicitudes: any = [];
  views: any = {
    admin: false,
    user: true
  };
  interval: any;

  constructor(
    private router: Router,
    private services: SolicitudesProvider
  ) {}

  ngOnInit() {
    this.formularios = [];
    this.solicitudes = [];
    if (localStorage.getItem('demo_emco_user') === '') {
      this.router.navigate(['/authentication/login']);
    } else {
      const usuario = JSON.parse(localStorage.getItem('demo_emco_user'));
      if (usuario.de_nombre_dpto === null) {
        this.getAllFormularios();
        this.views = {
          admin: true,
          user: false
        };
      } else {
        this.views = {
          admin: false,
          user: true
        };
        this.getMisSolicitudes(usuario.de_id_user);
      }
    }
  }

  getAllFormularios() {
    clearInterval(this.interval);
    this.interval = setInterval(() => {
      this.services.allFormularios().subscribe(response => {
        if (response.data.length > 0) {
          this.solicitudes = response.data;
        }
      });
    }, 1000);
  }

  getMisSolicitudes(id_usuario) {
    this.services.formularioByUsuario(
      {
        de_id_usuario: id_usuario
      }
    ).subscribe(response => {
      const data = JSON.parse(response['_body']);
      if (data.data.length > 0) {
        this.formularios = data.data;
      }
    });
  }

  aprobar(data) {
    this.services.updateFormulario(
      {
        de_estado_id: 2,
        de_id_formulario: data.data.de_id_formulario
      }
    ).subscribe(response => {
        if (response['_body'] === 'true' || response['_body'] === true) {
          this.sendMailAprobador(
            {
              usuario: data.data.de_usuario,
              estado: 'APROBADA',
              solicitud: data.data.de_transaccion,
              email: data.data.de_correo_per
            }
          );
          notify('Solicitud aprobada exitosamente', 'success', 2000);
        } else {
          notify('Compruebe su conexión a internet e intente nuevamente', 'error', 2000);
        }
        this.getAllFormularios();
    });
  }

  rechazar(data) {
    this.services.updateFormulario(
      {
        de_estado_id: 3,
        de_id_formulario: data.data.de_id_formulario
      }
    ).subscribe(response => {
        if (response['_body'] === 'true' || response['_body'] === true) {
          this.sendMailAprobador(
            {
              usuario: data.data.de_usuario,
              estado: 'RECHAZADA',
              solicitud: data.data.de_transaccion,
              email: data.data.de_correo_per
            }
          );
          notify('Solicitud rechazada exitosamente', 'success', 2000);
        } else {
          notify('Compruebe su conexión a internet e intente nuevamente', 'error', 2000);
        }
        this.getAllFormularios();
    });
  }

  sendMailAprobador(data) {
    this.services.sendMailAprobador(data).subscribe(response => {
      console.log('response aprobador', response);
    });
  }
}
