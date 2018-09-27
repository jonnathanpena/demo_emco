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
        const usuario = JSON.parse(response['_body']);
        if (usuario.data.length > 0) {
          if (usuario.data[0].de_clave === this.usuario.clave) {
            this.insertLogLogin(usuario.data[0].de_user_id);
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

    insertLogLogin(id) {
      this.services.insertLogLogin(
        {
          de_usuario_log: id,
          de_fecha_log: this.now
        }
      ).subscribe(response => {
        if (response['_body'] === 'false' || response['_body'] === false) {
          notify('Verifique su conexión a internet e intente nuevamente', 'error', 2000);
        } else {
          notify('Puedes ingresar', 'success', 2000);
        }
      });
    }

}
