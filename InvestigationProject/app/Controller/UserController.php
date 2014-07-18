<?php

/*
 * Control para la administración de cuentas
 */

class UserController extends Controller {

    /**
     * Función principal para el inicio de sesión
     */
    public function login() {
        $this->set('page_name', 'Iniciar sesión');
        if (!empty($this->data)) {
            if ($this->data['Login']['username'] == null or $this->data['Login']['password'] == null) {
                $this->Session->setFlash('Debe ingresar todos los datos.', 'default', array('class' => 'alert radius label'));
            }
            //TODO: Lógica de inicio de sesión
        }
    }
    
    public function register(){
        $this->set('page_name', 'Registrar usuario');
    }

}

?>