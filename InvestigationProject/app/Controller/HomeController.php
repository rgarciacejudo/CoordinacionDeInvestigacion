<?php

App::uses('Advertisement', 'Model');

/*
 * Control para el home
 */

class HomeController extends AppController {

    /**
     * Página de inicio una vez que el usuario ha iniciado sesión
     */
    public function index() {
      $this->set('page_name', 'Bienvenido');
      return $this->redirect('display');
    }

    /**
    * Página de inicio pública
    */
    public function display() {
    	$this->set('page_name', 'Inicio');
        $adv_db = new Advertisement();
        $advertisements = $adv_db->find('all', array(
            'conditions' => array('OR' => array(
                'expiration_date >= ' => date('Y-m-d'),
                'is_permanent' => true))
            )
        );
        $this->set('advertisements', $advertisements);
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
