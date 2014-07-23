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
		if ($this->request->is('post')) {
			if (!empty($this->data)) {
				if($this->data['institution_id'] === null or $this->data['institution_id'] === ''){
					$Institution_db = new Institution();
					$data = array();
					$data['Institution']['name'] = $this->data['institution'];
					if(!$Institution_db->save($data)){
						$this->Session->setFlash('Ocurrió un error al salvar la experiencia.', 'alert-message');
						return;
					}
					$this->request->data['institution_id'] = $Institution_db->getInsertID(); 
				}	
				$this->request->data['user_id'] = $this->Auth->user('id'); 			
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
}

?>