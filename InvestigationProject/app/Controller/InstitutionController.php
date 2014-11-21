<?php

/*
 * Control para la administración de instituciones
 */

class InstitutionController extends AppController {

    /**
     * Función para obtener las instituciones
     */
    public function getexperiences() {
        $name = isset($_GET["name"]) ? $_GET["name"] : '';
        $this->autoRender = false;
        $this->response->type('json');
        $institutions = $this->Institution->find('list', array(
            'conditions' => array(
                'Institution.name LIKE' => '%' . $name . '%'
            ),
            'order' => array(
                'Institution.name'
            ),
            'fields' => array('Institution.id', 'Institution.name')
        ));
        $json = json_encode($institutions);
        $this->response->body($json);
    }
    
    /**
     * Indicar para qué funciones se requiere autorización
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny('getexperiences');
    }

    /**
     * Determinar qué acciones estarán disponibles por usuario
     * @param type $user
     * @return boolean
     */
    public function isAuthorized($user = null) {

        if ($user === null) {
            return false;
        }

        return parent::isAuthorized($user);
    }

}
