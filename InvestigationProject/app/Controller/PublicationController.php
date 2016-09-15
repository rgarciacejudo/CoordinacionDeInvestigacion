<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('Section', 'Model');
App::uses('PublicationsSectionField', 'Model');

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

    public function index($filter = 'all', $section_id = null) {
        $this->set('page_name', 'Publicaciones');
        $publications = null;
        $this->Paginator->settings = $this->paginate;
        switch ($filter) {
            case 'all':
            default:
                $publications = $this->Paginator->paginate('Publication');
                break;
            case 'mine':
                $this->Paginator->settings['conditions'] = array('Publication.member_id' => $this->Session->read('User.member_id'));
                $publications = $this->Paginator->paginate('Publication');
                break;
            case 'section':
                $this->Paginator->settings['conditions'] = array('Publication.section_id' => $section_id);
                $publications = $this->Paginator->paginate('Publication');
                break;
        }
        $this->set('publications', $publications);
    }

    public function register() {
        $this->set('page_name', 'Registrar publicación');
        $section_db = new Section();
        $section_options = $section_db->find('list', array(
            'fields' => array('Section.id', 'Section.name'),            
            'recursive' => 1
        ));
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
                    $this->Session->setFlash('Se ha creado la publicación ' . $this->data['Publication']['title'], 'success-message');
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
        $this->set('page_name', 'Detalle de publicación');

        if (!$id) {
            throw new NotFoundException(__('Invalid publication'));
        }

        $this->Publication->recursive = 1;
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
     * Indicar para qué funciones se requiere autorización
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny('register');
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
