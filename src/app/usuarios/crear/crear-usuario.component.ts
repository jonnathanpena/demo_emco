import { Component, OnInit} from '@angular/core';
import notify from 'devextreme/ui/notify';
import { UsuariosProvider } from '../usuarios.providers';
import { Router } from '@angular/router';

@Component({
  templateUrl: './crear-usuario.component.html',
  styleUrls: ['./crear-usuario.component.scss']
})

export class CrearUsuarioComponent implements OnInit {
  usuario: any = {
    de_id_persona: '',
    de_nombre_per: '',
    de_apellido_per: '',
    de_celular_per: '',
    de_correo_per: '',
    de_provincia_per: '',
    de_canton_per: '',
    de_id_user: '',
    de_usuario: '',
    de_clave: '',
    confirme: '',
    de_persona_id: ''
  };
  usuario_departamento: any = {
    de_user_id: '',
    de_dpto_id: ''
  };
  provincias: any = [];
  cantones: any = [];
  departamentos: any = [];
  guardando: any = false;
  acceso: any = {
    admin: true,
    user: false
  };

  constructor(
    private services: UsuariosProvider,
    private router: Router
  ) {}

  ngOnInit() {
    if (localStorage.getItem('demo_emco_user') === '') {
      this.router.navigate(['/authentication/login']);
    } else {
      const usuario = JSON.parse(localStorage.getItem('demo_emco_user'));
      if (usuario.de_nombre_dpto === null) {
        this.acceso = {
          admin: true,
          user: false
        };
        this.usuario = {
          de_id_persona: '',
          de_nombre_per: '',
          de_apellido_per: '',
          de_celular_per: '',
          de_correo_per: '',
          de_canton_per: '',
          de_id_user: '',
          de_usuario: '',
          de_clave: '',
          confirme: '',
          de_persona_id: ''
        };
        this.cantones = [];
        this.provincias = [];
        this.departamentos = [];
        this.guardando = false;
        this.usuario_departamento = {
          de_user_id: '',
          de_dpto_id: ''
        };
        this.services.allProvincias().subscribe(response =>  {
          this.provincias = response.data;
        });
        this.services.allDepartamentos().subscribe(response => {
          this.departamentos = response.data;
        });
      } else {
        this.acceso = {
          admin: false,
          user: true
        };
      }
    }
  }

  guardar(e) {
    e.preventDefault();
    this.guardando = true;
    this.validarDatos();
  }

  validarDatos() {
    if (this.usuario.de_clave !== this.usuario.confirme) {
      notify('Las claves no coinciden', 'error', 2000);
      this.guardando = false;
      this.usuario.confirme = '';
      this.usuario.de_clave = '';
    } else {
      if (this.usuario.de_canton_per === '' || this.usuario_departamento.de_dpto_id === '') {
        notify('Debe seleccionar provincia, cantón y depatamento', 'error', 2000);
        this.guardando = false;
      } else {
        this.insertPersona();
      }
    }
  }

  insertPersona() {
    this.services.insertPersona(this.usuario).subscribe(response => {
      if (response['_body'] !== 'false' || response['_body'] !== false) {
        this.usuario.de_persona_id = response['_body'];
        this.insertUsuario();
      } else {
        notify('Algo malo ocurrió, verifique los datos e intente nuevamente', 'error', 1000);
        this.cancelar();
      }
    });
  }

  insertUsuarioDepartamento() {
    this.services.insertUsuarioDepartamento(this.usuario_departamento).subscribe(response => {
      if (response['_body'] !== 'false' || response['_body'] !== false) {
        notify('Usuario agregado exitosamente', 'success', 2000);
      } else {
        notify('Algo malo ocurrió, verifique los datos e intente nuevamente', 'error', 1000);
      }
      this.cancelar();
    });
  }

  insertUsuario() {
    this.services.insertUsuario(this.usuario).subscribe(response => {
      if (response['_body'] !== 'false' || response['_body'] !== false) {
        this.usuario_departamento.de_user_id = response['_body'];
        this.insertUsuarioDepartamento();
      } else {
        notify('Algo malo ocurrió, verifique los datos e intente nuevamente', 'error', 1000);
        this.cancelar();
      }
    });
  }

  cambiaProvincia(e) {
    const id = e.value * 1;
    this.services.allCantonesByProvincia({prov_canton_id: id}).subscribe(response => {
      const cantones = JSON.parse(response['_body']);
      this.cantones = cantones.data;
    });
  }

  cambiaCanton(e) {
    const id = e.value * 1;
    this.usuario.de_canton_per = id;
  }

  cambiaDepartamento(e) {
    const id = e.value * 1;
    this.usuario_departamento.de_dpto_id = id;
  }

  cancelar() {
    this.usuario.de_id_persona = '';
    this.usuario.de_nombre_per = '';
    this.usuario.de_apellido_per = '';
    this.usuario.de_celular_per = '';
    this.usuario.de_correo_per = '';
    this.usuario.de_id_user = '';
    this.usuario.de_usuario = '';
    this.usuario.de_clave = '';
    this.usuario.confirme = '';
    this.usuario.de_persona_id = '';
    this.guardando = false;
  }
}
