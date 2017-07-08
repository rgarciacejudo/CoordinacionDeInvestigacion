<?php

/*
 * Control para la administración de información extra
 */

class ValueController extends AppController {

  /**
   * Función para crear un link
   */
  public function register($type = 'address') {
      $this->set('page_description', 'Registro de información');
      $this->set('page_keywords', 'Registro,Dirección,Información,Observatorio de Investigación');

      switch ($type) {
        case 'address':
          $this->set('page_name', 'Registrar dirección');
          break;
        default:
          $this->set('page_name', 'Registrar información');
          break;
      }
      $this->set('type', $type);
      if ($this->request->is('post')) {
          if (!empty($this->data)) {
              if ($this->Value->save($this->request->data)) {
                  $this->Cookie->delete('addressInfo');
                  $this->Session->setFlash('Se ha registrado la información de contacto.', 'success-message');
                  return $this->redirect(array('controller' => 'home', 'action' => 'display'));
              }
              $this->Session->setFlash('Ocurrió un error al crear la información de contacto.', 'alert-message');
          } else {
              $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
          }
      }
  }

  /**
   * Administra un link
   * @param type $id
   */
  public function admin($id = null, $type = 'address'){
      $this->set('page_name', 'Administrar información');
      $this->set('page_description', 'Administrar información');
      $this->set('page_keywords', 'Administrar,Dirección,Información,Observatorio de Investigación');

      if (!$id) {
          throw new NotFoundException(__('Invalid information'));
      }

      $this->set('type', $type);

      if ($this->request->is('put')) {
          if (!empty($this->data)) {
              if ($this->Value->save($this->request->data)) {
                  $this->Cookie->delete('addressInfo');
                  $this->Session->setFlash('Se ha actualizado la información.', 'success-message');
                  return $this->redirect(array('controller' => 'home', 'action' => 'display'));
              } else {
                  $this->Session->setFlash('Ocurrió un error al guardar la información.', 'error-message');
              }
          } else {
              $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
          }
      }

      $information = $this->Value->find('first', array(
          'conditions' => array('Value.id' => $id),
          'fields' => array('Value.*'),
          'recursive' => -1));
      $this->set('information', $information);

      if (!$this->request->data) {
          $this->request->data = $information;
      }
  }


  /**
   * Indicar para qué funciones se requiere autorización
   */
  public function beforeFilter() {
      parent::beforeFilter();
      $this->Auth->deny('delete', 'register');
  }

  /**
   * Determinar qué acciones estarán disponibles por usuario
   * @param type $user
   * @return boolean
   */
  public function isAuthorized($user = null) {

      if (in_array($this->request->params, array('delete', 'register')) &&
              $user['role'] !== 'super_admin') {
          return false;
      }

      return parent::isAuthorized($user);
  }

}

?>
