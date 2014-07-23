<?php

App::uses('User', 'Model');
App::uses('CakeEmail', 'Network/Email');

/*
 * Control para la administración de cuerpos académicos
 */

class AcademicGroupController extends AppController {

	/**
	 * Función para registrar grupos académicos
	 */
	public function register(){
		$this->set('page_name', 'Registrar cuerpo académico');
		$user_db = new User();
		$users = $user_db->find('list', array(
			'fields' => array('User.id', 'User.username')));
		$this->set('users', $users);
		$type = $this->AcademicGroup->getColumnType('level');
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    foreach (explode(',', $matches[1]) as $value) {
      $enum[] = trim($value, "'");
    }
    $this->set('level_options', $enum);
		if ($this->request->is('post')) {
			if (!empty($this->data)) {				
				if ($this->AcademicGroup->save($this->request->data)) {
					$Email = new CakeEmail('gmail');
					$Email->template('welcome')
					->viewVars(array(
						'from_username' => $this->Auth->user('username'),
						'academic_group' => $this->data['AcademicGroup']['name'],
						'view_id' => $this->AcademicGroup->getInsertID(),
						))
					->to($this->data['User']['username'])
					->subject('Te han elegido líder de un cuerpo académico!')
					->emailFormat('html')
					->send();
					$this->Session->setFlash('Se ha creado el cuerpo académico ' . $this->data['AcademicGroup']['name'], 'success-message');
					return $this->redirect('register');
				}
				$this->Session->setFlash('Ocurrió un error al crear el cuerpo académico.', 'alert-message');
			} else {
				$this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
			}
		}
	}
}

?>