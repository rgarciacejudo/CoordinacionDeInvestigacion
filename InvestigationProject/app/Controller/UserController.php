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
        if ($this->request->is('post')) {
            if (!empty($this->data)) {
                if ($this->data['Login']['username'] == null or $this->data['Login']['password'] == null) {
                    $this->Session->setFlash('Debe ingresar todos los datos.', 'alert-message');
                    return;
                }
                if ($this->Auth->login()) {
                    return $this->redirect($this->Auth->redirect());
                }
                $this->Session->setFlash('Usuario o contraseña incorrectos, favor de verificar.', 'info-message');                        
            }
        }
    }
    
    /**
     * Función para registrar usuarios
     */
    public function register(){
        $this->set('page_name', 'Registrar usuario');
    }

    /**
    * Función para cerrar sesión
    */
    public function logout(){                
        return $this->redirect($this->Auth->logout());
    }  

}

?>