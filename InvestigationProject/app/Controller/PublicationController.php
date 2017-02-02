<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('Section', 'Model');
App::uses('MembersAcademicGroup', 'Model');
App::uses('PublicationsSectionField', 'Model');
App::uses('User', 'Model');

/**
 * Description of PublicationController
 *
 * @author rgarcia
 */
class PublicationController extends AppController {

    public $components = array('Paginator');
    public $paginate = array(
        'limit' => 16
    );

    public function index($filter = 'all', $identifier = null) {
        $this->set('page_name', 'Producción');
        $publications = null;
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['order'] = array('Section.name' => 'ASC', 'Publication.publication_date' => 'DESC');
        switch ($filter) {
            case 'all':
            default:
                $publications = $this->Paginator->paginate('Publication');
                break;
            case 'mine':
                $this->set('page_name', 'Mi Producción');
                $this->set('mine', true);
                $this->Paginator->settings['conditions'] = array('Publication.member_id' => $this->Session->read('User.member_id'));
                $publications = $this->Paginator->paginate('Publication');
                break;
            case 'section':
                $this->Paginator->settings['conditions'] = array('Publication.section_id' => $identifier);
                $publications = $this->Paginator->paginate('Publication');
                break;
            case 'ca':
                $this->set('page_name', 'Producción de CA');
                $joins = array(
                    array('table' => 'members_academic_groups',
                        'alias' => 'MemberAcademicGroup',
                        'type' => 'INNER',                        
                        'conditions' => array('MemberAcademicGroup.member_id = Publication.member_id',
                            'MemberAcademicGroup.academic_group_id' => $identifier)));                
                $this->Paginator->settings['joins'] = $joins;
                $publications = $this->Paginator->paginate('Publication');
                break;
        }
        $this->set('publications', $publications);
    }

    public function register() {
        $this->set('page_name', 'Registrar producto');
        $section_db = new Section();
        $section_options = $section_db->find('all', array(
            'fields' => array('Section.id', 'Section.name', 'Section.icon'),
            'recursive' => 1
        ));


		$members_db = new MembersAcademicGroup();
		$academic_group = $members_db->find('first', array(
			'fields' => array('MembersAcademicGroup.academic_group_id'),
			'conditions' => array('MembersAcademicGroup.member_id' => $this->Session->read('User.member_id')),
			'recursive' => -1
		));

		$members_ca = $members_db->find('all', array(
			'joins' => array(
				array('table' => 'members',
					'alias' => 'Member',
					'type' => 'INNER',
					'conditions' => array('MembersAcademicGroup.member_id = Member.id')),
				array('table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => array('User.id = Member.user_id')),
				array('table' => 'academic_groups',
					'alias' => 'AcademicGroup',
					'type' => 'INNER',
					'conditions' => array('AcademicGroup.id = MembersAcademicGroup.academic_group_id'))),
			'fields' => array('Member.id', 'User.username', 'Member.img_profile_path', 'Member.name', 'Member.last_name'),
			'conditions' => array(
				'MembersAcademicGroup.academic_group_id' => $academic_group['MembersAcademicGroup']['academic_group_id'],
				'Member.id <> ' . $this->Session->read('User.member_id')),
			'recursive' => -1
		));

		$members_other = $members_db->find('all', array(
			'joins' => array(
				array('table' => 'members',
					'alias' => 'Member',
					'type' => 'INNER',
					'conditions' => array('MembersAcademicGroup.member_id = Member.id')),
				array('table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => array('User.id = Member.user_id')),
				array('table' => 'academic_groups',
					'alias' => 'AcademicGroup',
					'type' => 'INNER',
					'conditions' => array('AcademicGroup.id = MembersAcademicGroup.academic_group_id'))),
			'fields' => array('Member.id', 'User.username', 'Member.img_profile_path', 'Member.name', 'Member.last_name'),
			'conditions' => array('MembersAcademicGroup.academic_group_id <> ' . $academic_group['MembersAcademicGroup']['academic_group_id']),
			'recursive' => -1
		));

		$this->set('members_ca', $members_ca);
		$this->set('members_other', $members_other);
        $this->set('section_options', $section_options);

        if ($this->request->is('post')) {
            if (!empty($this->data)) {
                $this->request->data['Publication']['member_id'] = $this->Session->read('User.member_id');
                if (is_uploaded_file($this->request->data['Publication']['file_path']['tmp_name'])) {
                    $filename = basename($this->request->data['Publication']['file_path']['name']);
                    $path = WWW_ROOT . DS . 'files' . DS . 'publications' . DS . 'member_' . $this->Session->read('User.member_id') . DS;
                    if (!is_dir($path)) {
                        mkdir($path);
                    }
                    move_uploaded_file(
                            $this->data['Publication']['file_path']['tmp_name'], $path . $filename
                    );
                    $this->request->data['Publication']['file_path'] = $path . $filename;
                } else {
                    $this->request->data['Publication']['file_path'] = '';
                }

                if ($this->Publication->saveAll($this->request->data)) {
                    $this->Session->setFlash('Se ha creado la publicación', 'success-message');
                    return $this->redirect(array(
                                'controller' => 'publication',
                                'action' => 'index',
                                'mine'));
                } else {
                    $this->Session->setFlash('Ocurrió un error al guardar la publicación ' . $this->data['Publication']['title'], 'alert-message');
                    if(isset($path)) {
                        unlink($path . $filename);
                    }
                }
            }
        }
    }

    public function detail($id = null) {
        $this->set('page_name', 'Detalle de producto');

        if (!$id) {
            throw new NotFoundException(__('Invalid publication'));
        }

        $this->Publication->recursive = 2;
        $publication = $this->Publication->findById($id);


        if (!$publication) {
            throw new NotFoundException(__('Invalid publication'));
        }

        $this->set('publication', $publication);
    }

    public function download($id) {
        $this->set('page_name', 'Descargar publicación');

        if (!$id) {
            throw new NotFoundException(__('Invalid publication'));
        }

        $this->Publication->recursive = -1;
        $publication = $this->Publication->findById($id);
        if (!$publication) {
            throw new NotFoundException(__('Invalid publication'));
        }

        $download = $publication['Publication']['file_path'];
        $this->response->file($download);
        return $this->response;
    }

    /**
     * Edita un producto
     * @param type $id
     */
    public function edit($id = null){
        $this->set('page_name', 'Editar producto');

        if (!$id) {
            throw new NotFoundException(__('Invalid product'));
        }

        $section_db = new Section();
        $members_db = new MembersAcademicGroup();        

        $academic_group = $members_db->find('first', array(
            'fields' => array('MembersAcademicGroup.academic_group_id'),
            'conditions' => array('MembersAcademicGroup.member_id' => $this->Session->read('User.member_id')),
            'recursive' => -1
        ));

        $members_ca = $members_db->find('all', array(
            'joins' => array(
                array('table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'conditions' => array('MembersAcademicGroup.member_id = Member.id')),
                array('table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array('User.id = Member.user_id')),
                array('table' => 'publications_members',
                    'alias' => 'PublicationMembers',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'PublicationMembers.member_id = Member.id',
                        'PublicationMembers.type = "ca"',
                        'PublicationMembers.publication_id' => $id)),
                array('table' => 'academic_groups',
                    'alias' => 'AcademicGroup',
                    'type' => 'INNER',
                    'conditions' => array('AcademicGroup.id = MembersAcademicGroup.academic_group_id'))),
            'fields' => array('Member.id', 'User.username', 'Member.img_profile_path',
                'Member.name', 'Member.last_name', 'PublicationMembers.id'),
            'conditions' => array(
                'MembersAcademicGroup.academic_group_id' => $academic_group['MembersAcademicGroup']['academic_group_id'],
                'Member.id <> ' . $this->Session->read('User.member_id')),
            'recursive' => -1
        ));

        $members_other = $members_db->find('all', array(
            'joins' => array(
                array('table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'conditions' => array('MembersAcademicGroup.member_id = Member.id')),
                array('table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array('User.id = Member.user_id')),
                array('table' => 'publications_members',
                    'alias' => 'PublicationMembers',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'PublicationMembers.member_id = Member.id',
                        'PublicationMembers.type = "otro"',
                        'PublicationMembers.publication_id' => $id)),
                array('table' => 'academic_groups',
                    'alias' => 'AcademicGroup',
                    'type' => 'INNER',
                    'conditions' => array('AcademicGroup.id = MembersAcademicGroup.academic_group_id'))),
            'fields' => array('Member.id', 'User.username', 'Member.img_profile_path',
                'Member.name', 'Member.last_name', 'PublicationMembers.id'),
            'conditions' => array(
                'MembersAcademicGroup.academic_group_id <> ' . $academic_group['MembersAcademicGroup']['academic_group_id'],
                'Member.id <> ' . $this->Session->read('User.member_id')),
            'recursive' => -1
        ));

        if ($this->request->is('put')) {
            if (!empty($this->data)) {
                if (is_uploaded_file($this->request->data['Publication']['file_path']['tmp_name'])) {
                    $filename = basename($this->request->data['Publication']['file_path']['name']);
                    $path = WWW_ROOT . DS . 'files' . DS . 'publications' . DS . 'member_' . $this->Session->read('User.member_id') . DS;
                    if (!is_dir($path)) {
                        mkdir($path);
                    }
                    move_uploaded_file(
                            $this->data['Publication']['file_path']['tmp_name'], $path . $filename
                    );
                    $this->request->data['Publication']['file_path'] = $path . $filename;
                } else {
                    unset($this->request->data['Publication']['file_path']);
                }
                if ($this->Publication->save($this->request->data)) {
                    $this->Session->setFlash('Se ha actualizado el producto', 'success-message');
                    return $this->redirect(array('controller' => 'publication', 'action' => 'index', 'mine'));
                } else {
                    $this->Session->setFlash('Ocurrió un error al guardar el producto', 'error-message');
                }                
            } else {
                $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
            }
            return $this->redirect(array('controller' => 'publication', 'action' => 'index', 'mine'));
        }

        $publication = $this->Publication->find('first', array(
            'conditions' => array('Publication.id' => $id),
            'fields' => array('Publication.*'),
            'recursive' => 1));

        $section_options = $section_db->find('first', array(
            'fields' => array('Section.id', 'Section.name', 'Section.icon', 'Section.with_authors', 'Section.with_members'),
            'conditions' => array('Section.id' => $publication['Publication']['section_id']),
            'recursive' => -1
        ));

        $this->set('section_options', $section_options);
        $this->set('members_ca', $members_ca);
        $this->set('members_other', $members_other);
        $this->set('publication', $publication);

        if (!$this->request->data) {
            $this->request->data = $publication;
        }
    }

    /**
     * Función para eliminar un anuncio
     * @param type $id
     */
    public function delete($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid product'));
        }
        try {
            if ($this->Publication->delete($id)) {
                $this->Session->setFlash('Se ha eliminado el producto.', 'success-message');
                return $this->redirect(array('controller' => 'publication', 'action' => 'index', 'mine'));
            }
        } catch (Exception $e){
            $this->Session->setFlash('La publicación no se puede ser eliminada.', 'info-message');
            $this->redirect(array('action' => 'index'));
        }        
    }

    /**
    * Función para la generación de reportes
    *
    */
    public function report() {
        $this->set('page_name', 'Reportes');        

        if ($this->request->is('post')) {
            if (!empty($this->data)) {                

                $this->Paginator->settings = $this->paginate;
                $this->Paginator->settings['order'] = array('Section.name' => 'ASC', 'Publication.publication_date' => 'DESC');

                $conditions = array(
                    'Publication.publication_date >=' => $this->data['Report']['from'],
                    'Publication.publication_date <=' => $this->data['Report']['to'],
                );

                if(isset($this->data['Members'])) {
                    $member_ids = array();
                    foreach($this->data['Members'] as $key => $value) {
                        array_push($member_ids, $value['member_id']);
                    }
                    $conditions['Member.id'] = $member_ids;
                }

                if(isset($this->data['Sections'])) {
                    $section_ids = array();
                    foreach($this->data['Sections'] as $key => $value) {
                        array_push($section_ids, $value['id']);
                    }
                    $conditions['Section.id'] = $section_ids;
                }
                
                if($this->data['Report']['print'] === '1') {
                    $this->layout = 'print_layout';
                    $this->set('print', true);
                }
                
                $this->Paginator->settings['conditions'] = $conditions;
                $publications = $this->Paginator->paginate('Publication');
                $this->set('publications', $publications);
         
                if (!$this->request->data) {
                    $this->request->data = $this->data;
                }
            }
        }

        $members_db = new MembersAcademicGroup();

        $members = $members_db->find('all', array(
			'joins' => array(
				array('table' => 'members',
					'alias' => 'Member',
					'type' => 'INNER',
					'conditions' => array('MembersAcademicGroup.member_id = Member.id')),
				array('table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => array('User.id = Member.user_id')),
				array('table' => 'academic_groups',
					'alias' => 'AcademicGroup',
					'type' => 'INNER',
					'conditions' => array('AcademicGroup.id = MembersAcademicGroup.academic_group_id'))),
			'fields' => array('Member.id', 'User.username', 'Member.name', 'Member.last_name'),
            'order' => array('Member.name' => 'ASC', 'Member.last_name' => 'ASC'),
			'recursive' => -1
		));

        $section_db = new Section();
        $sections = $section_db->find('all', array(
            'fields' => array('Section.id', 'Section.name'),
            'recursive' => -1
        ));
	
        $this->set('sections', $sections);
		$this->set('members', $members);        
    }

    /**
     * Indicar para qué funciones se requiere autorización
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('detail', 'download', 'report');
        $this->Auth->deny('register', 'delete', 'edit');
    }

    /**
     * Determinar qué acciones estarán disponibles por usuario
     * @param type $user
     * @return boolean
     */
    public function isAuthorized($user = null) {

        if (in_array($this->request->params, array('register')) &&
                $user['role'] !== 'member') {
            return false;
        }

        return parent::isAuthorized($user);
    }

}
