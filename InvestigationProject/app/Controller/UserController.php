<?php

App::uses('Member', 'Model');
App::uses('AcademicGroup', 'Model');
App::uses('Experience', 'Model');
App::uses('MembersAcademicGroup', 'Model');
App::uses('CakeEmail', 'Network/Email');
/*
 * Control para la administración de cuentas
 */

class UserController extends AppController {

    public $components = array('Paginator', 'RequestHandler');
    public $paginate = array(
        'limit' => 5,
        'order' => array(
            'Member.name' => 'asc',
            'Member.last_name' => 'asc',
            'User.username' => 'asc'
        )
        //array('Member.name', 'Member.last_name', 'User.username')

//        'group' => array('role')
    );

    /**
     * Función principal para el inicio de sesión
     */
    public function login() {
        $this->set('page_name', 'Iniciar sesión');
        $this->set('page_description', 'Inicio de sesión');
        $this->set('page_keywords', 'Inicio de sesión,Usuario,Observatorio de Investigación');

        if ($this->request->is('post')) {
            if (!empty($this->data)) {
                if ($this->data['User']['username'] === null or $this->data['User']['password'] === null) {
                    $this->Session->setFlash('Debe ingresar todos los datos.', 'alert-message');
                    return;
                }
                if ($this->Auth->login()) {
                    $member_db = new Member();
                    $member_id = $member_db->find('first', array(
                        'fields' => array('Member.id', 'Member.name', 'Member.last_name'),
                        'conditions' => array('Member.user_id' => $this->Auth->user('id'))
                    ));
                    $this->Session->write('User.member_id', $member_id['Member']['id']);
                    $this->Session->write('User.name', $member_id['Member']['name']);
                    $this->Session->write('User.last_name', $member_id['Member']['last_name']);
                    return $this->redirect($this->Auth->redirect());
                }
                $this->Session->setFlash('Usuario o contraseña incorrectos, favor de verificar.', 'info-message');
            } else {
                $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
            }
        }
    }

    /**
     * Función para registrar usuarios
     */
    public function register() {
        $this->set('page_description', 'Registro de usuarios');        
        $this->set('page_keywords', 'Registro,Usuario,Observatorio de Investigación');

        switch ($this->Session->read('Auth.User.role')) {
            case 'super_admin':
                $this->set('page_name', 'Registar líder cuerpo académico');
            break;
            case 'ca_admin':
                $this->set('page_name', 'Registar miembro de cuerpo académico');
            break;
        }

        if ($this->request->is('post')) {
            if (!empty($this->data)) {
                $this->request->data['Member']['name'] = 'Usuario';
                $this->request->data['User']['password'] = $this->_generateRandomString();
                $this->request->data['User']['role'] = ($this->Auth->user('role') === 'super_admin' ?
                                'ca_admin' : ($this->Auth->user('role') === 'ca_admin' ? 'member' : 'super_admin'));

                if ($this->User->saveAll($this->request->data)) {

                    if($this->request->data['User']['role'] === 'member'){
                        $member_id = $this->User->Member->getLastInsertID();
                        $academic_db = new AcademicGroup();
                        $academic = $academic_db->find('first', array(
                            'fields' => array('AcademicGroup.id'),
                            'conditions' => array('user_id' => $this->Session->read('Auth.User.id')),
                            'recursive' => -1
                        ));

                        if(isset($academic) && isset($academic['AcademicGroup']['id'])){
                            $data = array();
                            $data['MembersAcademicGroup']['member_id'] = $member_id;
                            $data['MembersAcademicGroup']['academic_group_id'] = $academic['AcademicGroup']['id'];
                            $academicgroupmembers_db = new MembersAcademicGroup();
                            $academicgroupmembers_db->save($data);
                        }
                    }

                    $Email = new CakeEmail('gmail');
                    $Email->template('welcome')
                            ->viewVars(array(
                                'username' => $this->data['User']['username'],
                                'password' => $this->data['User']['password']
                            ))
                            ->to($this->data['User']['username'])
                            ->subject('Bienvenida!')
                            ->emailFormat('html')
                            ->send();
                    $this->Session->setFlash('Se ha enviado un correo con los accesos para la cuenta ' . $this->data['User']['username'], 'success-message');
                    return $this->redirect('register');
                }
                $this->Session->setFlash('Verifique los datos.', 'alert-message');
            } else {
                $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
            }
        }
    }
    
    /**
    * Función para eliminar un usuario
    */
    public function delete($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid user'));
        }
        
        $user = $this->User->findById($id);
        
        if (!$user) {
            throw new NotFoundException(__('Invalid user'));
        }                               
        
        try {
            $member_db = new Member();
            if($member_db->delete($user["Member"]["id"])){
                if ($this->User->delete($id)) {
                    $this->Session->setFlash('Se ha eliminado el líder de CA.', 'success-message');
                    return $this->redirect(array('controller' => 'user', 'action' => 'index', 'leaders'));
                }   
            }            
        } catch (Exception $e){
            $this->Session->setFlash('El usaurio no se puede ser eliminado ya que tiene asignado un cuerpo académico.', 'info-message');
            $this->redirect(array('action' => 'index', 'action' => 'index', 'leaders'));
        }    
    }

    /**
     * Función que genera una cadena aleatoria con longitud mínima de 10 char.
     * @param type $length
     * @return string
     */
    function _generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * Función para cerrar sesión
     */
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Función para administrar la cuenta de usuario.
     */
    public function manage() {
        $this->set('page_name', 'Administrar cuenta');
        $this->set('page_description', 'Administrar cuenta');
        $this->set('page_keywords', 'Administrar,Usuario,Observatorio de Investigación');

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data)) {
                if ($this->data['User']['password'] === null or
                        $this->data['User']['newpassword'] == null or
                        $this->data['User']['confirm_newpassword'] == null) {
                    $this->Session->setFlash('Debe ingresar todos los datos.', 'alert-message');
                    return;
                } else if ($this->data['User']['newpassword'] !==
                        $this->data['User']['confirm_newpassword']) {
                    $this->Session->setFlash('Las nuevas contraseñas deben concidir.', 'alert-message');
                    return;
                }

                $this->User->id = $this->Auth->user('id');
                $user = $this->User->read('password', $this->User->id);

                if ($user['User']['password'] !== AuthComponent::password($this->data['User']['password'])) {
                    $this->Session->setFlash('La contraseña actual no coincide, favor de verificar.', 'info-message');
                    return;
                }
                $this->User->set('password', $this->data['User']['newpassword']);
                if ($this->User->save()) {
                    $this->Session->setFlash('La contraseña se ha actualizado.', 'success-message');
                    return $this->redirect('edit');
                }
                $this->Session->setFlash('La contraseña no se ha actualizado correctamente.', 'alert-message');
            }
        }
    }

    /**
     * Función para editar el perfil del usuario.
     */
    public function edit() {
        $this->set('page_name', 'Mi perfil');
        $this->set('page_description', 'Mi perfil');
        $this->set('page_keywords', 'Perfil,Usuario,Observatorio de Investigación');

        $user_member = $this->User->find('first', array(
            'conditions' => array(
                'Member.user_id' => $this->Auth->user('id')),
            'recursive' => 0));
        $member_db = new Member();
        $type = $member_db->getColumnType('SNI');
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        foreach (explode(',', $matches[1]) as $value) {
            $enum_sni[trim($value, "'")] = trim($value, "'");
        }
        $grade = $member_db->getColumnType('grade');
        preg_match('/^enum\((.*)\)$/', $grade, $matches);
        foreach (explode(',', $matches[1]) as $value) {
            $enum_grade[trim($value, "'")] = trim($value, "'");
        }
        $experience_db = new Experience();
        $experiences = $experience_db->find('all', array(
            'order' => array('Institution.name' => 'asc'),
            'conditions' => array('Experience.member_id' => $this->Session->read('User.member_id'))
        ));
        $this->set('experiences', $experiences);
        $this->set('SNI_options', $enum_sni);
        $this->set('grade_options', $enum_grade);
        $this->set('img_profile', $user_member['Member']['img_profile_path']);
        if (!$this->request->data) {
            $this->request->data = $user_member;
            $this->set('user_member', $user_member);
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['User']['id'] = $user_member['User']['id'];
            $this->request->data['User']['username'] = $user_member['User']['username'];
            $this->request->data['Member']['id'] = $user_member['Member']['id'];
            if (isset($this->request->data['Member']['PROMEP']) && $this->request->data['Member']['PROMEP'] !== '1') {
                $this->request->data['Member']['PROMEP_validity_date'] = null;
            }
            if (isset($this->request->data['Member']['PROMEP']) && $this->request->data['Member']['SNI'] === '') {
                $this->request->data['Member']['SNI_validity_date'] = null;
            }
            if (!$this->User->saveAll($this->data)) {
                $this->Session->setFlash('Ocurrió un error al guardar tu infromación.', 'error-message');
            } else {
                $this->Session->write('User.name', $this->request->data['Member']['name']);
                $this->Session->write('User.last_name', $this->request->data['Member']['last_name']);
                $this->Session->setFlash('Se ha actualizado tu información.', 'success-message');
            }
        }
    }

    /**
     * Función para actualizar la imagen de perfil.
     * @return type
     */
    public function img_change() {
        if ($this->request->is('post') || $this->request->is('put')) {
            if (empty($this->data['UserImage']['img']['tmp_name']) or ! is_uploaded_file($this->data['UserImage']['img']['tmp_name'])) {
                $this->Session->setFlash('Debe seleccionar una imagen.', 'info-message');
            } else {
                $path = WWW_ROOT . 'files' . DS . 'profile_images' . DS;
                $ext = '.' . pathinfo($this->data['UserImage']['img']['name'], PATHINFO_EXTENSION);
                $filename = 'img_profile_' . $this->Auth->user('id') . $ext;
                move_uploaded_file(
                        $this->data['UserImage']['img']['tmp_name'], $path . $filename
                );
                $user_member = $this->User->find('first', array(
                    'conditions' => array(
                        'Member.user_id' => $this->Auth->user('id')),
                    'recursive' => 0));
                $user_member['Member']['img_profile_path'] = DS . 'files' . DS .
                        'profile_images' . DS . $filename;
                if (!$this->User->saveAll($user_member)) {
                    $this->Session->setFlash('Hubo un error al actualizar la imagen '
                            . 'del perfil.', 'error-message');
                }
            }
            return $this->redirect('edit');
        }
    }

    /**
     * Función para ver perfiles  de usuario.
     * @param type $id
     */
    public function view($id = null) {
        $this->set('page_name', 'Perfil de usuario');
        $this->set('page_description', 'Perfil de usuario');  
        $this->set('page_keywords', 'Ver información,Usuario,Observatorio de Investigación');      

        $user_member = null;
        //Si el parámetro id es nulo intenta mostrar el perfil del usuario que inició sesión
        if (!$id) {
            $user_member = $this->User->find('first', array(
                'conditions' => array(
                    'Member.user_id' => $this->Auth->user('id')),
                'recursive' => 0));
        } else {
            $user_member = $this->User->find('first', array(
                'conditions' => array(
                    'Member.user_id' => $id),
                'recursive' => 0));
        }
        $this->set('user_profile', $user_member);
    }

    public function index($filter = 'all') {
        $this->Paginator->settings = $this->paginate;
        $users = null;
        switch ($filter) {
            case 'all':
                $this->set('page_name', 'Investigadores');
                $this->set('page_description', 'Listado de investigadores');  
                $this->set('page_keywords', 'Ver información,Usuario,Observatorio de Investigación');  
                $users = $this->Paginator->paginate('User');
                break;
            case 'leaders':
                $this->Paginator->settings['conditions'] = array('User.role' => 'ca_admin');
                $this->set('page_name', 'Líderes de cuerpos académicos');
                $this->set('page_description', 'Listado de líderes de cuerpos académicos');  
                $this->set('page_keywords', 'Ver información,Usuario,Observatorio de Investigación');
                $users = $this->Paginator->paginate('User');
                break;
            case 'members':
                $this->Paginator->settings['conditions'] = array('User.role' => 'member');
                $this->set('page_name', 'Investigadores');
                $this->set('page_description', 'Listado de investigadores');  
                $this->set('page_keywords', 'Ver información,Usuario,Observatorio de Investigación');
                $users = $this->Paginator->paginate('User');
                break;
            default:
                break;
        }
        $this->set('users', $users);
    }

    /**
     * Muestra el perfil del usuario
     * @param type $id
     * @throws NotFoundException
     */
    public function detail($id = null, $print = null) {
        $this->set('page_name', 'Perfil de usuario');
        $this->set('page_description', 'Detalle de perfil de usuario');
        $this->set('page_keywords', 'Detalle información,Usuario,Observatorio de Investigación');

        if (!$id) {
            throw new NotFoundException(__('Invalid user'));
        }

        if($print !== null){
            $this->layout = 'print_layout';
            $this->set('print', true);
        }

        $this->User->recursive = 3;
        $user = $this->User->findById($id);
        $this->User->recursive = 1;
        $this->set('user', $user);
    }

    /**
     * Función para restablecer la contraseña de un usuario
     */
    public function recover() {
        $this->set('page_name', 'Recuperar contraseña');
        $this->set('page_description', 'Recuperar contraseña');
        $this->set('page_keywords', 'Recuperar,Usuario,Observatorio de Investigación');

        if ($this->request->is('post')) {
            if (!empty($this->data)) {
                $user_id = $this->User->find('first', array(
                    'conditions' => array('User.username' => $this->data['User']['username']),
                    'fields' => array('User.id', 'User.username')
                ));
                if (!$user_id) {
                    $this->Session->setFlash('No se encontró el usuario en el sistema.', 'alert-message');
                    return;
                }
                $this->User->id = $user_id['User']['id'];
                $newPassword = $this->_generateRandomString();
                $this->User->saveField('password', $newPassword);
                $Email = new CakeEmail('gmail');
                $Email->template('recover')
                        ->viewVars(array(
                            'username' => $user_id['User']['username'],
                            'password' => $newPassword
                        ))
                        ->to($user_id['User']['username'])
                        ->subject('Recuperación de contraseña!')
                        ->emailFormat('html')
                        ->send();
                $this->Session->setFlash('Sus accesos han sido restablecidos con éxito, verifique su cuenta de correo.', 'info-message');
                return $this->redirect('recover');
            }
        }
    }

    /**
     * Función para obtener usuarios por tipo
     */
    public function getusers() {
        $role = isset($_GET["role"]) ? $_GET["role"] : '';
        $name = isset($_GET["name"]) ? $_GET["name"] : '';
        $this->autoRender = false;
        $this->response->type('json');
        $users = $this->User->find('all', array(
            'conditions' => array(
                'OR' => array(
                    'User.username LIKE' => '%' . $name . '%',
                    'Member.name LIKE' => '%' . $name . '%',
                    'Member.last_name LIKE' => '%' . $name . '%',
                ),
                'User.role LIKE' => '%' . $role . '%'
            ),
            'order' => array(
                'User.username' => 'asc'
            ),
            'fields' => array('User.id', 'User.username', 'Member.id',
                'Member.name', 'Member.last_name', 'Member.img_profile_path')
        ));
        $options = array();
        foreach ($users as $key => $u) {
            $options[$key]['id'] = $u['User']['id'];
            $options[$key]['label'] = $u['User']['username'];
            $options[$key]['value'] = $u['User']['username'];
            $options[$key]['name'] = $u['Member']['name'] . ' ' . $u['Member']['last_name'];
            $options[$key]['image'] = $u['Member']['img_profile_path'];
        }
        $json = json_encode($options);
        $this->response->body($json);
    }

    /**
    * Muestra los miembros de un cuerpo
    */
    public function academicgroupmembers($id = null, $print = null){
        $this->set('page_name', 'Miembros de cuerpo académico');
        $this->set('page_description', 'Miembros de cuerpo académico');
        $this->set('page_keywords', 'Usuario,Cuerpo académico,Observatorio de Investigación');

        if (!$id) {
            throw new NotFoundException(__('Invalid academic group'));
        }

        $conditions = array('AcademicGroup.id' => $id);
        $fields = array('User.*', 'Member.*');
        $joins = array(
            array('table' => 'members_academic_groups',
                'alias' => 'MembersAcademicGroup',
                'type' => 'INNER',
                'conditions' => array('MembersAcademicGroup.member_id = Member.id')),
            array('table' => 'academic_groups',
                'alias' => 'AcademicGroup',
                'type' => 'INNER',
                'conditions' => array('AcademicGroup.id = MembersAcademicGroup.academic_group_id'))
        );
        $order = array(
            'Member.name' => 'asc',
            'Member.last_name' => 'asc',
            'User.username' => 'asc'
        );

        if($print !== null){
            $this->layout = 'print_layout';
            $this->set('print', true);
            $academic_group = $this->User->find('all', array(
                'order' => $order,
                'conditions' => $conditions,
                'fields' => $fields,
                'recursive' => 1,
                'joins' => $joins
            ));
        }
        else{
            $this->paginate = array(
                'order' => $order,
                'limit' => 5,
                'conditions' => $conditions,
                'fields' => $fields,
                'recursive' => 1,
                'joins' => $joins
            );

            $this->Paginator->settings = $this->paginate;
            $academic_group = $this->paginate('User');
        }

        $academic_db = new AcademicGroup();
        $academic = $academic_db->find('first', array(
            'fields' => array('AcademicGroup.name'),
            'conditions' => array('AcademicGroup.id' => $id),
            'recursive' => -1
        ));

		if($this->Session->read('Auth.User.role') === 'ca_admin'){
			$isLeader = $academic_db->find('first', array(
				'fields' => array('AcademicGroup.name', 'AcademicGroup.id'),
				'conditions' => array('AcademicGroup.user_id' => $this->Session->read('Auth.User.id')),
				'recursive' => -1
			));
			if(isset($isLeader) && $isLeader['AcademicGroup']['id'] === $id){
				$this->set('is_leader', true);
			}
		}

        $this->set('academic_group_id', $id);
        $this->set('academic_group', $academic);
        $this->set('members', $academic_group);
    }

    /**
    * Listar miembros de CA
    */
    public function adminca() {   
        $this->set('page_description', 'Administrar usuarios de cuerpos académicos');   
        $this->set('page_keywords', 'Cuerpos académicos,Usuarios,Observatorio de Investigación');  

        if($this->Session->read('Auth.User.role') === 'ca_admin'){
            $this->set('page_name', 'Administrar datos de miembros de cuerpo académico');
            $AcademicGroup = new AcademicGroup();
            $members = $AcademicGroup->find('all', array(
            'conditions' => array('AcademicGroup.user_id' => $this->Session->read('Auth.User.id')),
            'fields' => array('Member.*','User.*'),
            'joins' => array(                
                array('table' => 'members_academic_groups',
                    'alias' => 'MembersAcademicGroup',
                    'type' => 'INNER',
                    'conditions' => array('MembersAcademicGroup.academic_group_id = AcademicGroup.id')
                ),
                array('table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'conditions' => array('MembersAcademicGroup.member_id = Member.id')
                ),
                array('table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array('User.id = Member.user_id')
                )
            ),
            'recursive' => 1));

            $this->set('members', $members);
        } else if($this->Session->read('Auth.User.role') === 'super_admin') {
            $this->set('page_name', 'Administrar datos de líderes de cuerpo académico');
            $members = $this->User->find('all', array(
                'conditions' => array('User.role' => 'ca_admin'),
                'fields' => array('Member.*', 'User.*')
            ));

            $this->set('members', $members);
        }
    }

    /**
    * Administrar nombre de miebros de CA
    */
    public function edituser($id = null) {
        $this->set('page_name', 'Editar Usuario');
        $this->set('page_description', 'Editar usuario');
        $this->set('page_keywords', 'Editar,Usuario,Observatorio de Investigación');

        if (!$id) {
            throw new NotFoundException(__('Invalid user'));
        }
        
        $user = $this->User->findById($id);
        
        if (!$user) {
            throw new NotFoundException(__('Invalid user'));
        } 

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data)) {
                $Member = new Member();                
                $Member->id = $id;
                $Member->set('name', $this->data['Member']['name']);
                $Member->set('last_name', $this->data['Member']['last_name']);                
                if ($Member->save()) {
                    $this->Session->setFlash('Se han actualizado los datos.', 'success-message');
                    return $this->redirect('adminca');
                }
                $this->Session->setFlash('No se ha podido realizar el cambio.', 'alert-message');
            }
        }

        $this->set('user', $user);                              
    }

    /**
     * Indicar para qué funciones se requiere autorización
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'recover', 'view', 'detail', 'academicgroupmembers');
        $this->Auth->deny('edit', 'getusers', 'img_change', 'manage', 'register');
    }

    /**
     * Determinar qué acciones estarán disponibles por usuario
     * @param type $user
     * @return boolean
     */
    public function isAuthorized($user = null) {

        if ((in_array($this->request->params, array('register', 'admin', 'adminca', 'edituser')) &&
                $user['role'] !== 'ca_admin') || in_array($this->request->params, array('delete', 'adminca')) &&
                $user['role'] !== 'super_admin') {
            return false;
        }

        return parent::isAuthorized($user);
    }

}

?>
