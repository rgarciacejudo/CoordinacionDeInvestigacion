<?php

/*
 * Control para la administración de cuerpos académicos
 */

class LinkController extends AppController {

	public $components = array('Paginator');
	public $paginate = array(
        'fields' => array(
            'Link.id',
            'Link.name',
            'Link.display_name',
            'Link.url'
        ),
        'limit' => 15
    );

	/**
   * Función para crear un link   
   */
	public function register() {
    $this->set('page_name', 'Registrar link');
    if ($this->request->is('post')) {
      if (!empty($this->data)) {
        if ($this->Link->save($this->request->data)) {
					$this->Session->setFlash('Se ha creado el link ' . 
						$this->data['Link']['name'], 'success-message');
          return $this->redirect('register');
        }        
        $this->Session->setFlash('Ocurrió un error al crear el cuerpo académico.', 'alert-message');
      } else {
          $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
      }      
    }
  }

  /**
	 * Función para eliminar un link
	 * @param type $id
	 */
  public function delete($id = null) {    
    if (!$id) {
        throw new NotFoundException(__('Invalid link'));
    }
    if($this->Link->delete($id)){
      $this->Session->setFlash('Se ha eliminado el link.', 'success-message');
      return $this->redirect('index');
    }
  }

  /**
   * Función para listar los links   
   */
  public function index() {
		$this->set('page_name', 'Links');
		$this->Paginator->settings = $this->paginate;
		$links = $this->Paginator->paginate('Link');
		$this->set('links', $links);
  }

  /**
   * Indicar para qué funciones se requiere autorización
   */
  public function beforeFilter() {
      parent::beforeFilter();
      $this->Auth->deny('delete', 'register');
      $this->Auth->allow('index');
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