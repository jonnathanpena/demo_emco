import { Injectable } from '@angular/core';

@Injectable()
export class ULRProvider {

  public dominio: String = 'http://proconty.com/API/demo/';

  /* PROVINCIAS     */
  public getAllProvincias() {
    return this.dominio + 'provincia/getAll.php';
  }
  /* FIN PROVINCIAS */

  /* CANTONES     */
  public getCantonesByProvincia() {
    return this.dominio + 'canton/getById.php';
  }
  /* FIN CANTONES */

  /* DEPARTAMENTOS     */
  public getAllDepartamentos() {
    return this.dominio + 'departamento/getAll.php';
  }
  /* FIN DEPARTAMENTOS */

  /* PERSONAS     */
  public getAllPersonas() {
    return this.dominio + 'persona/getAll.php';
  }

  public getPersonasById() {
    return this.dominio + 'persona/getAll.php';
  }

  public insertPersona() {
    return this.dominio + 'persona/insert.php';
  }

  public updatePersona() {
    return this.dominio + 'persona/update.php';
  }
  /* FIN PERSONAS */

  /* USUARIOS     */
  public getAllUsuarios() {
    return this.dominio + 'user/getAll.php';
  }

  public getUsuarioById() {
    return this.dominio + 'user/getById.php';
  }

  public insertUsuario() {
    return this.dominio + 'user/insert.php';
  }

  public cambioClave() {
    return this.dominio + 'user/cambioClave.php';
  }
  /* FIN USUARIOS */

  /* USUARIO DEPARTAMENTO     */
  public getAllUsuarioDepartamento() {
    return this.dominio + 'userDpto/getAll.php';
  }

  public insertUsuarioDepartamento() {
    return this.dominio + 'userDpto/insert.php';
  }

  public updateUsuarioDepartamento() {
    return this.dominio + 'userDpto/update.php';
  }
  /* FIN USUARIO DEPARTAMENTO */

  /* FORMULARIO     */
  public getAllFormularios() {
    return this.dominio + 'formulario/getAll.php';
  }

  public getFormularioById() {
    return this.dominio + 'formulario/getById.php';
  }

  public getFormularioIdMax() {
    return this.dominio + 'formulario/getIdMax.php';
  }

  public getFormulariosByUsuario() {
    return this.dominio + 'formulario/getByIdUser.php';
  }

  public insertFormulario() {
    return this.dominio + 'formulario/insert.php';
  }

  public insertFormularioAll() {
    return this.dominio + 'formulario/insertAll.php';
  }

  public updateFormulario() {
    return this.dominio + 'formulario/update.php';
  }
  /* FIN FORMULARIO */

  /* DETALLE FORMULARIO     */
  public insertDetalleFormulario() {
    return this.dominio + 'detalleFormulario/insert.php';
  }

  public moveImage() {
    return this.dominio + 'upload/move.php';
  }
  /* FIN DETALLE FORMULARIO */

  /* LOGIN     */
  public ingresar() {
    return this.dominio + 'login/getByUser.php';
  }

  public insertLogLogin() {
    return this.dominio + 'logLogin/insert.php';
  }
  /* FIN LOGIN */

}
