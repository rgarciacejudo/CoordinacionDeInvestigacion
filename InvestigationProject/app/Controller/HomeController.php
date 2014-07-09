<?php

/*
 * Control para el home
 */

class HomeController extends Controller {

    /**
     * Página de inicio una vez que el usuario ha iniciado sesión
     */
    public function index() {
        $this->set('page_name', 'Inicio');
    }

}

?>
