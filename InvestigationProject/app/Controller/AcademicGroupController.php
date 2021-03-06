<?php

App::uses('User', 'Model');
App::uses('MembersAcademicGroup', 'Model');
App::uses('CakeEmail', 'Network/Email');

/*
 * Control para la administración de cuerpos académicos
 */

class AcademicGroupController extends AppController {

    public $components = array('Paginator', 'RequestHandler');
    public $paginate = array(
        'fields' => array(
            'AcademicGroup.id',
            'AcademicGroup.name',
            'AcademicGroup.level',
            'AcademicGroup.description',
            'AcademicGroup.created',
            'Leader.id',
            'Leader.username'
        ),
        'limit' => 5
    );

    /**
     * Función para registrar grupos académicos
     */
    public function register() {
        $this->set('page_name', 'Registrar cuerpo académico');
        $this->set('page_description', 'Registrar cuerpo académico');
        $this->set('page_keywords', 'Registro,Cuerpo académico,Observatorio de Investigación');

        $user_db = new User();
        $users = $user_db->find('all', array(
            'order' => array(
                'Member.name' => 'asc',
                'Member.last_name' => 'asc',
                'User.username' => 'asc'
            ),
            'joins' => array(
                array(
                    'table' => 'academic_groups',
                    'alias' => 'AcademicGroup',
                    'type' => 'LEFT',
                    'conditions' => array('AcademicGroup.user_id = User.id'))),
            'conditions' => array('User.role' => 'ca_admin', 'AcademicGroup.id IS NULL'),
            'fields' => array('User.id', 'User.username', 'Member.name', 'Member.last_name', 'Member.img_profile_path')));
        $this->set('users', $users);
        $type = $this->AcademicGroup->getColumnType('level');
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        foreach (explode(',', $matches[1]) as $value) {
            $enum[trim($value, "'")] = trim($value, "'");
        }
        $this->set('level_options', $enum);
        if ($this->request->is('post')) {
            if (!empty($this->data)) {
                if ($this->AcademicGroup->save($this->request->data)) {
                    //Obtener nombre de usuario
                    $user_db->recursive = 1;
                    $leader = $user_db->find('first', array(
                        'conditions' => array('User.id' => $this->request->data['AcademicGroup']['user_id'])
                    ));

                    //Agregar también como miembro del grupo
                    $academic_group_id = $this->AcademicGroup->getLastInsertID();
                    $member_academic_group_db = new MembersAcademicGroup();
                    $data = array();
                    $data['MembersAcademicGroup']['member_id'] = $leader['Member']['id'];
                    $data['MembersAcademicGroup']['academic_group_id'] = $academic_group_id;
                    $member_academic_group_db->save($data);

                    $Email = new CakeEmail('gmail');
                    $Email->template('academic_group_leader')
                            ->viewVars(array(
                                'from_username' => $this->Auth->user('username'),
                                'academic_group' => $this->data['AcademicGroup']['name'],
                                'description' => $this->data['AcademicGroup']['description'],
                                'view_id' => $this->AcademicGroup->getInsertID(),
                            ))
                            ->to($leader['User']['username'])
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
        $this->Session->setFlash('Recuerda que debes registrar un líder antes de crear un cuerpo académico.', 'info-message');
    }

    /**
     * Función para listar los cuerpos académicos
     * @param type $filter
     */
    public function index($filter = 'all') {
        $this->set('page_name', 'Cuerpos académicos');
        $this->set('page_description', 'Listado de cuerpos académicos');
        $this->set('page_keywords', 'Listado,Cuerpo académico,Observatorio de Investigación');

        $academic_groups = null;
        $this->Paginator->settings = $this->paginate;
        if(is_numeric($filter)){
            $this->Paginator->settings['conditions'] = array('AcademicGroup.id' => $filter);
        } else{
            switch ($filter) {
                case 'admin':
                    $this->Paginator->settings['conditions'] = array('AcademicGroup.user_id' => $this->Auth->user('id'));
                    break;
                case 'members':
                    $this->set('isMembersDetail', true);
                    $this->Paginator->settings['group'] = array('AcademicGroup.id');
                    break;
            }
        }
        $academic_groups = $this->Paginator->paginate('AcademicGroup');
        $this->set('academic_groups', $academic_groups);
        $this->set('authUser', $this->Auth->user());
    }

    /**
     * Función para administrar cuerpos académicos
     */
    public function admin($id = null) {
        $this->set('page_name', 'Administrar cuerpo académico');
        $this->set('page_description', 'Administrar cuerpo académico');
        $this->set('page_keywords', 'Administrar,Cuerpo académico,Observatorio de Investigación');

        if($this->Session->read('Auth.User.role') === 'ca_admin'){
            $academic_group = $this->AcademicGroup->find('first', array(
            'conditions' => array('AcademicGroup.user_id' => $this->Session->read('Auth.User.id')),
            'fields' => array('AcademicGroup.*', 'Leader.*'),
            'recursive' => 1));
        } else if (!$id) {
            throw new NotFoundException(__('Invalid academic group'));
        } else {
            $academic_group = $this->AcademicGroup->find('first', array(
                'conditions' => array('AcademicGroup.id' => $id),
                'fields' => array('AcademicGroup.*', 'Leader.*'),
                'recursive' => 1));
        }

        if (!$academic_group) {
            throw new NotFoundException(__('Invalid academic group'));
        }

        $this->set('academic_group', $academic_group);

        $user_db = new User();
            $users = $user_db->find('all', array(
                'order' => array(
                    'Member.name' => 'asc',
                    'Member.last_name' => 'asc',
                    'User.username' => 'asc'
                ),
                'joins' => array(
                    array(
                        'table' => 'academic_groups',
                        'alias' => 'AcademicGroup',
                        'type' => 'LEFT',
                        'conditions' => array('AcademicGroup.user_id = User.id'))),
                'conditions' => array('User.role' => 'ca_admin',
                    '(AcademicGroup.id IS NULL OR AcademicGroup.user_id = ' . $this->Session->read('Auth.User.id') . ')'),
                'fields' => array('User.id', 'User.username', 'Member.name', 'Member.last_name', 'Member.img_profile_path')));
            $this->set('users', $users);

        $members = $user_db->find('all', array(
            'order' => array(
                'Member.name' => 'asc',
                'Member.last_name' => 'asc',
                'User.username' => 'asc'
            ),
            'recursive' => 1,
            'joins' => array(
                    array(
                        'table' => 'members_academic_groups',
                        'alias' => 'AcademicGroup',
                        'type' => 'LEFT',
                        'conditions' => array('AcademicGroup.member_id = Member.id'))),
            'conditions' => array('User.role' => 'member',
                '(AcademicGroup.academic_group_id = ' . $academic_group['AcademicGroup']['id'] . ' or  AcademicGroup.id is null)'),
            'fields' => array('User.username', 'Member.name', 'Member.last_name', 'Member.img_profile_path',
                'Member.id', 'AcademicGroup.academic_group_id')));

        $this->set('members', $members);

        $type = $this->AcademicGroup->getColumnType('level');
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        foreach (explode(',', $matches[1]) as $value) {
            $enum[trim($value, "'")] = trim($value, "'");
        }
        $this->set('level_options', $enum);

        if ($this->request->is(array('post', 'put'))) {
            $this->AcademicGroup->id = $id;
            if ($this->AcademicGroup->save($this->request->data)) {
                $this->Session->setFlash('Grupo académico actualizado.', 'success-message');
                return $this->redirect(array(
                            'controller' => 'academic_group',
                            'action' => 'admin', $id));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $academic_group;
        }
    }

    /**
     * Función que agrega o elimina un miembro de un cuerpo académico
     * @param type $academic_group_id
     * @param type $member_id
     * @param type $value
     * @throws NotFoundException
     */
    public function memberadmin($academic_group_id, $member_id, $value, $html = false) {
        try {
            if (isset($academic_group_id) && isset($member_id) && isset($value)) {
                switch ($value) {
                    case 'true':
                        //Add member
                        $member_academic_group_db = new MembersAcademicGroup();
                        $data = array();
                        $data['MembersAcademicGroup']['member_id'] = $member_id;
                        $data['MembersAcademicGroup']['academic_group_id'] = $academic_group_id;
                        echo json_encode($member_academic_group_db->save($data));
                        break;
                    case 'false':
                        //Delete member
                        $member_academic_group_db = new MembersAcademicGroup();
						$response = $member_academic_group_db->deleteAll(array(
                                    'MembersAcademicGroup.member_id' => $member_id,
                                    'MembersAcademicGroup.academic_group_id' => $academic_group_id
                        ));
						if($html === false){
							echo json_encode($response);
						}
						else{
							$this->Session->setFlash('Se ha borrado el miembro del cuerpo académico', 'success-message');
							return $this->redirect(array(
								'controller' => 'user',
								'action' => 'academicgroupmembers',
								$academic_group_id));
						}
                        break;
                    default:
                        throw new NotFoundException(__('Invalid member value'));
                }
            } else {
                throw new NotFoundException(__('Invalid member value'));
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Función para eliminar un anuncio
     * @param type $id
     */
    public function delete($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid academic group'));
        }
        try {
          if ($this->AcademicGroup->delete($id)) {
              $this->Session->setFlash('Se ha eliminado el cuerpo académico.', 'success-message');
          }
        } catch (Exception $e) {
          $this->Session->setFlash('No se puede eliminar el CA ya que cuenta con información', 'info-message');
        }
        return $this->redirect('index');
    }

    /**
     * Indicar para qué funciones se requiere autorización
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny('admin', 'memberadmin', 'delete');
        $this->Auth->allow('members');
    }

    /**
     * Determinar qué acciones estarán disponibles por usuario
     * @param type $user
     * @return boolean
     */
    public function isAuthorized($user = null) {

        if (in_array($this->request->params, array('register', 'admin', 'memberadmin')) &&
                $user['role'] !== 'ca_admin') {
            return false;
        }

        if (in_array($this->request->params, array('delete')) &&
                $user['role'] !== 'super_admin') {
            return false;
        }

        return parent::isAuthorized($user);
    }

}

?>
