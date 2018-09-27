import { Component, OnInit, AfterViewInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthenticationProvider } from '../authentication.providers';
import notify from 'devextreme/ui/notify';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit, AfterViewInit {
  usuario: any = {
    usuario: '',
    clave: ''
  };
  ingresando = false;
  now: Date = new Date();

    constructor(
      public router: Router,
      private services: AuthenticationProvider
    ) {}

    ngOnInit() {
      this.usuario = {
        usuario: '',
        clave: ''
      };
      this.ingresando = false;
      localStorage.setItem('demo_emco_user', '');
      const menu = [
        {
          path: '/inicio',
          title: 'Dashboards',
          icon: 'mdi mdi-gauge',
          class: '',
          extralink: false,
          submenu: []
        },
        {
          path: '',
          title: 'Usuarios',
          icon: 'mdi mdi-account-multiple',
          class: 'has-arrow',
          extralink: false,
          submenu: [
              { path: '/usuarios/crear', title: 'Nuevo', icon: '', class: '', label: '', labelClass: '', extralink: false, submenu: [] },
              { path: '/usuarios', title: 'Usuarios', icon: '', class: '', label: '', labelClass: '', extralink: false, submenu: [] },
          ]
        },
        {
          path: '',
          title: 'Solicitudes',
          icon: 'mdi mdi-equal-box',
          class: 'has-arrow',
          extralink: false,
          submenu: [
              { path: '/solicitudes/crear', title: 'Nueva', icon: '', class: '', label: '', labelClass: '', extralink: false, submenu: [] },
              { path: '/solicitudes', title: 'Solicitudes', icon: '', class: '', label: '', labelClass: '', extralink: false, submenu: [] },
          ]
        }
      ];
      localStorage.setItem('demo_emco_menu', JSON.stringify(menu));
    }

    ngAfterViewInit() {
        /*$(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            (<any>$('[data-toggle="tooltip"]')).tooltip();
        });
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });*/
    }

    onLoggedin() {
        localStorage.setItem('isLoggedin', 'true');
    }

    ingresar(e) {
      e.preventDefault();
      this.services.ingresar({de_usuario: this.usuario.usuario}).subscribe(response => {
        console.log('ingresar', response);
        const usuario = JSON.parse(response['_body']);
        if (usuario.data.length > 0) {
          if (usuario.data[0].de_clave === this.usuario.clave) {
            if (usuario.data[0].de_id_user_dpto === null) {
              localStorage.setItem('demo_emco_menu', JSON.stringify(
                [
                  {
                    path: '/inicio',
                    title: 'Dashboards',
                    icon: 'mdi mdi-gauge',
                    class: '',
                    extralink: false,
                    submenu: []
                  },
                  {
                    path: '',
                    title: 'Usuarios',
                    icon: 'mdi mdi-account-multiple',
                    class: 'has-arrow',
                    extralink: false,
                    submenu: [
                        {
                          path: '/usuarios/crear',
                          title: 'Nuevo', icon: '',
                          class: '', label: '', labelClass: '', extralink: false, submenu: []
                        },
                        {
                          path: '/usuarios',
                          title: 'Usuarios',
                          icon: '', class: '', label: '', labelClass: '', extralink: false, submenu: []
                        },
                    ]
                  },
                  {
                    path: '',
                    title: 'Solicitudes',
                    icon: 'mdi mdi-equal-box',
                    class: 'has-arrow',
                    extralink: false,
                    submenu: [
                        {
                          path: '/solicitudes/crear',
                          title: 'Nueva', icon: '', class: '',
                          label: '', labelClass: '', extralink: false, submenu: []
                        },
                        {
                          path: '/solicitudes', title: 'Solicitudes', icon: '',
                          class: '', label: '', labelClass: '', extralink: false, submenu: []
                        },
                    ]
                  }
                ]
              ));
              usuario.isLoggedin = true;
              localStorage.setItem('demo_emco_user', JSON.stringify(usuario.data[0]));
              this.router.navigate(['/dashboard/dashboard1']);
            } else {
              localStorage.setItem('demo_emco_menu', JSON.stringify(
                [
                  {
                    path: '',
                    title: 'Solicitudes',
                    icon: 'mdi mdi-equal-box',
                    class: 'has-arrow',
                    extralink: false,
                    submenu: [
                        {
                          path: '/solicitudes/crear',
                          title: 'Nueva', icon: '', class: '',
                          label: '', labelClass: '', extralink: false, submenu: []
                        },
                        {
                          path: '/solicitudes', title: 'Solicitudes', icon: '',
                          class: '', label: '', labelClass: '', extralink: false, submenu: []
                        },
                    ]
                  }
                ]
              ));
              this.insertLogLogin(usuario.data[0].de_user_id, usuario.data[0]);
            }
          } else {
            notify('Clave incorrecta, por favor, intente nuevamente', 'error', 2000);
            this.usuario = {
              usuario: '',
              clave: ''
            };
          }
        } else {
          notify('Usuario no registrado', 'error', 2000);
        }
      });
    }

    insertLogLogin(id, usuario) {
      this.services.insertLogLogin(
        {
          de_usuario_log: id,
          de_fecha_log: this.now
        }
      ).subscribe(response => {
        if (response['_body'] === 'false' || response['_body'] === false) {
          notify('Verifique su conexión a internet e intente nuevamente', 'error', 2000);
        } else {
          usuario.isLoggedin = true;
          localStorage.setItem('demo_emco_user', JSON.stringify(usuario));
          this.router.navigate(['/dashboard/dashboard1']);
        }
      });
    }

}
