<?php

App::uses('Institution', 'Model');
/*
 * Control para la administración de proyectos
 */

class ProjectController extends AppController {
	
	/**
  * Función para registrar proyectos
  */
	public function register() {
		$this->set('page_name', 'Registrar proyecto');			
		if ($this->request->is('post')) {
			if (!empty($this->data)) {
				if($this->data['institution_id'] === null or $this->data['institution_id'] === ''){
					$Institution_db = new Institution();
					$data = array();
					$data['Institution']['name'] = $this->data['institution'];
					if(!$Institution_db->save($data)){
						$this->Session->setFlash('Ocurrió un error al salvar el proyecto.', 'alert-message');
						return;
					}
					$this->request->data['institution_id'] = $Institution_db->getInsertID(); 
				}	
				//$this->request->data['user_id'] = $this->Auth->user('id'); 			
				if ($this->Project->save($this->request->data)) {
					$this->Session->setFlash('Se ha registrado un nuevo proyecto.', 'success-message');
					return $this->redirect('index');
				}
				$this->Session->setFlash('Ocurrió un error al crear el proyecto.', 'alert-message');
			} else {
				$this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
			}
		} 
	}
}

?>