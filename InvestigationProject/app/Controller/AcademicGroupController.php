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
        $user_db = new User();
        $users = $user_db->find('list', array(
            'conditions' => array('User.role' => 'ca_admin'),
            'fields' => array('User.id', 'User.username')));
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
                    $user_db->recursive = -1;
                    $leader = $user_db->find('first', array(
                        'conditions' => array('User.id' => $this->request->data['AcademicGroup']['user_id'])
                    ));
                    $Email = new CakeEmail('gmail');
                    $Email->template('academic_group_leader')
                            ->viewVars(array(
                                'from_username' => $this->Auth->user('username'),
                                'academic_group' => $this->data['AcademicGroup']['name'],
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
    }

    /**
     * Función para listar los cuerpos académicos
     * @param type $filter
     */
    public function index($filter = 'all') {
        $this->set('page_name', 'Cuerpos académicos');
        $academic_groups = null;
        $this->Paginator->settings = $this->paginate;
        switch ($filter) {
            case 'all':
                $academic_groups = $this->Paginator->paginate('AcademicGroup');
                break;
            case 'admin':
                $this->Paginator->settings['conditions'] = array('AcademicGroup.user_id' => $this->Auth->user('id'));
                $academic_groups = $this->Paginator->paginate('AcademicGroup');
                break;
        }
        $this->set('academic_groups', $academic_groups);
    }

    /**
     * Función para administrar cuerpos académicos
     */
    public function admin($id = null) {
        $this->set('page_name', 'Administrar cuerpo académico');

        if (!$id) {
            throw new NotFoundException(__('Invalid academic group'));
        }

        $academic_group = $this->AcademicGroup->find('first', array(
            'conditions' => array('AcademicGroup.id' => $id),
            'fields' => array('AcademicGroup.*', 'Leader.*'),
            'recursive' => 1));
        if (!$academic_group) {
            throw new NotFoundException(__('Invalid academic group'));
        }

        $this->set('academic_group', $academic_group);

        $user_db = new User();
        $users = $user_db->find('list', array(
            'conditions' => array('User.role' => 'ca_admin'),
            'fields' => array('User.id', 'User.username')));
        $this->set('users', $users);

        $members = $user_db->find('list', array(
            'conditions' => array('User.role' => 'member'),
            'fields' => array('User.id', 'User.username')));

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
    public function memberadmin($academic_group_id, $member_id, $value) {
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
                        echo json_encode($member_academic_group_db->deleteAll(array(
                            'MembersAcademicGroup.member_id' => $member_id,
                            'MembersAcademicGroup.academic_group_id' => $academic_group_id
                        )));
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

}

?>