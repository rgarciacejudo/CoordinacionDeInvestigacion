<?php

/*
 * Control para el home
 */

class HomeController extends AppController {

    /**
     * Página de inicio una vez que el usuario ha iniciado sesión
     */
    public function index() {
      $this->set('page_name', 'Inicio');
    }

    /**
    * Página de inicio pública
    */
    public function display() {
    	$this->set('page_name', 'Inicio');
    }

    /**
     * Indicar para qué funciones se requiere autorización
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'display');
    }
    
}

?>
