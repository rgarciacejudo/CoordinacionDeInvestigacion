<?php

App::uses('Institution', 'Model');
/*
 * Control para la administración de experiencias del perfil de usuario
 */

class ExperienceController extends AppController {

    /**
     * Función para registrar experiencias en perfil
     */
    public function register() {
        $this->set('page_name', 'Registrar experiencia');
        $this->set('page_description', 'Registro de experiencias');
        $this->set('page_keywords', 'Registro,Experiencia,Observatorio de Investigación');

        if ($this->request->is('post')) {
            if (!empty($this->data)) {
                if ($this->data['Experience']['institution_id'] === null or $this->data['Experience']['institution_id'] === '') {
                    $Institution_db = new Institution();
                    $data = array();
                    $data['Institution']['name'] = $this->data['Experience']['institution'];
                    if (!$Institution_db->save($data)) {
                        if(count($Institution_db->validationErrors) > 0){
                            $this->Session->setFlash(implode(', ', $Institution_db->validationErrors["name"]), 'alert-message');
                            return;
                        }
                        $this->Session->setFlash('Ocurrió un error al salvar la experiencia.', 'alert-message');
                        return;
                    }
                    $this->request->data['Experience']['institution_id'] = $Institution_db->getInsertID();
                }
                $this->request->data['Experience']['member_id'] = $this->Session->read("User.member_id");
                if ($this->Experience->save($this->request->data)) {
                    $this->Session->setFlash('Se ha registrado una nueva experiencia.', 'success-message');
                    return $this->redirect(array(
                        'controller' => 'user',
                        'action' => 'edit'
                        )
                    );
                }
                $this->Session->setFlash('Ocurrió un error al registrar la experiencia.', 'alert-message');
            } else {
                $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
            }
        }
    }

    /**
     * Función para actualizar una experiencia
     */
    public function edit($id = null) {
        $this->set('page_name', 'Editar experiencia');
        $this->set('page_description', 'Editar experiencia');
        $this->set('page_keywords', 'Editar,Experiencia,Observatorio de Investigación');

        if (!$id) {
            throw new NotFoundException(__('Invalid experience'));
        }

        $experience = $this->Experience->findById($id);
        if (!$experience) {
            throw new NotFoundException(__('Invalid experience'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Experience->id = $id;
            if ($this->Experience->save($this->request->data)) {
                $this->Session->setFlash('Experiencia editada.', 'success-message');
                return $this->redirect(array(
                    'controller' => 'user',
                    'action' => 'edit'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $experience;
        }
    }

    /**
     * Función para eliminar una experiencia
     */
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Experience->delete($id)) {
            $this->Session->setFlash('Experiencia eliminada.', 'success-message');
            return $this->redirect(array('controller' => 'user', 'action' => 'edit'));
        }
    }

    /**
     * Indicar para qué funciones se requiere autorización
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny('delete', 'edit', 'register');
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

?>