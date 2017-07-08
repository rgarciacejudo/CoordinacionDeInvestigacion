<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('SectionsField', 'Model');
App::uses('MembersSection', 'Model');

/**
 * Description of SectionController
 *
 * @author rgarcia
 */
class SectionController extends AppController {

    /**
     * Función para registrar una sección con la estructura de sus campos
     */
    public function register() {
        $this->set('page_name', 'Registrar sección');
        $this->set('page_description', 'Registro de secciones');
        $this->set('page_keywords', 'Registro,Sección,Observatorio de Investigación');

        $section_field_db = new SectionsField();
        $type = $section_field_db->getColumnType('type');
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        foreach (explode(',', $matches[1]) as $value) {
            $enum_types[trim($value, "'")] = trim($value, "'");
        }
        $this->set('field_types', $enum_types);
        if ($this->request->is('post')) {
            if (!empty($this->data)) {
                if(is_uploaded_file($this->data['Section']['icon']['tmp_name'])){
                    $path = WWW_ROOT . 'files' . DS . 'sections' . DS;
                    $ext = '.' . pathinfo($this->data['Section']['icon']['name'], PATHINFO_EXTENSION);
                    $filename = 'section_' . $this->data['Section']['name'] . $ext;
                    if(!move_uploaded_file($this->data['Section']['icon']['tmp_name'], $path . $filename)){
                        $this->Session->setFlash('Ocurrió un error al guardar la imagen de la sección', 'error-message');
                    }else{
                        $this->request->data['Section']['icon'] = DS . 'files' . DS . 'sections' . DS . $filename;
                    }
                }else{
                  $this->request->data['Section']['icon'] = NULL;
                }
                if ($this->Section->saveAll($this->request->data)) {
                    $this->Session->setFlash('Se ha creado la sección ' . $this->data['Section']['name'], 'success-message');
                    return $this->redirect(array('controller' => 'section', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('Ocurrió un error al guardar la sección ' . $this->data['Section']['name'], 'error-message');
                }
            } else {
                $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
            }
        }
    }

    public function index($filter = 'all') {
        $this->set('page_name', 'Secciones');
        $this->set('page_description', 'Listado de secciones');
        $this->set('page_keywords', 'Listado,Sección,Observatorio de Investigación');

        $sections = null;
        switch ($filter) {
            case 'all':
            default:
                $sections = $this->Section->find('all', array('recursive' => '-1'));
                break;
            case 'mine':
                $member_section_db = new MembersSection();
                $sections = $member_section_db->find('all', array(
                    'conditions' => array('MembersSection.member_id' => $this->Session->read('User.member_id')),
                    'fields' => array('Section.*')
                ));
                break;
            default:
                break;
        }
        $this->set('sections', $sections);
    }

    /**
     * Función que retorna los campos de una sección
     */
    public function getfields() {
        $id = isset($_GET["id"]) ? $_GET["id"] : '';
        $this->autoRender = false;
        $this->response->type('json');
        $fields = $this->Section->find('first', array(
            'conditions' => array('Section.id' => $id),
        ));
        $options = array();
        foreach ($fields['SectionsField'] as $key => $u) {
            $options[$key]['id'] = $u['id'];
            $options[$key]['name'] = $u['name'];
            $options[$key]['type'] = $u['type'];
			if(isset($u['values'])){
				$options[$key]['values'] = $u['values'];
			}else{
				$options[$key]['values'] = '';
			}
        }
        $json = json_encode(array(
            'fields' => $options, 
            'authors' => $fields['Section']['with_authors'], 
            'members' => $fields['Section']['with_members']));
        $this->response->body($json);
    }

    /**
    * Muestra el detalle de la sección
    */
    public function detail($id = null){
        $this->set('page_name', 'Detale de sección');
        $this->set('page_description', 'Detalle de secciones');
        $this->set('page_keywords', 'Detalle,Sección,Observatorio de Investigación');

        if (!$id) {
            throw new NotFoundException(__('Invalid section'));
        }

        $detail = $this->Section->find('first', array(
            'conditions' => array('Section.id' => $id),
            'fields' => array('Section.*'),
            'recursive' => 1));

        $this->set('detail', $detail);
    }

    public function img_change() {  
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data)) {
                if(is_uploaded_file($this->data['Section']['icon']['tmp_name'])){
                    $path = WWW_ROOT . 'files' . DS . 'sections' . DS;
                    $ext = '.' . pathinfo($this->data['Section']['icon']['name'], PATHINFO_EXTENSION);
                    $filename = 'section_' . $this->data['Section']['name'] . $ext;
                    if(!move_uploaded_file($this->data['Section']['icon']['tmp_name'], $path . $filename)){
                        $this->Session->setFlash('Ocurrió un error al guardar la imagen de la sección', 'error-message');
                        return;
                    } else {
                        $this->request->data['Section']['icon'] = DS . 'files' . DS . 'sections' . DS . $filename;
                    }
                    $this->Section->id = $this->request->data['Section']['id'];
                    $this->Section->saveField('icon', $this->request->data['Section']['icon']);
                } else {
                  $this->request->data['Section']['icon'] = NULL;
                  $this->Session->setFlash('Ocurrió un error al guardar la imagen de la sección', 'error-message');
                  return;
                }
            }
        }
        $this->Session->setFlash('Cambio realizado', 'success-message');
        return $this->redirect(array('action' => 'admin', $this->data['Section']['id']));
    }

    public function admin($id = null){
        $this->set('page_name', 'Administrar sección');
        $this->set('page_description', 'Administrar secciones');
        $this->set('page_keywords', 'Administrar,Sección,Observatorio de Investigación');

        if (!$id) {
            throw new NotFoundException(__('Invalid section'));
        }

        $section = $this->Section->find('first', array(
            'conditions' => array('Section.id' => $id),
            'fields' => array('Section.*'),
            'recursive' => 1));
        $this->set('section', $section);

        $section_field_db = new SectionsField();
        $type = $section_field_db->getColumnType('type');
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        foreach (explode(',', $matches[1]) as $value) {
            $enum_types[trim($value, "'")] = trim($value, "'");
        }
        $this->set('field_types', $enum_types);

        if ($this->request->is('put')) {
            if (!empty($this->data)) {
                try {
                    if(!$section_field_db->deleteAll(array('SectionsField.section_id' => $id))){
                        $this->Session->setFlash('La sección no se puede ser eliminada ya que hay publicaciones creadas para ésta.', 'info-message');
                    }
                    if ($this->Section->saveAll($this->request->data)) {
                        $this->Session->setFlash('Se ha actualizado la sección ' . $this->data['Section']['name'], 'success-message');
                        return $this->redirect(array('controller' => 'section', 'action' => 'index'));
                    } else {
                        $this->Session->setFlash('Ocurrió un error al guardar la sección ' . $this->data['Section']['name'], 'error-message');
                    }
                } catch (Exception $e){
                    if ($this->Section->saveAll($this->request->data)) {
                        $this->Session->setFlash('Se ha actualizado la sección ' . $this->data['Section']['name'], 'success-message');
                        return $this->redirect(array('controller' => 'section', 'action' => 'index'));
                    }
                    $this->Session->setFlash('La sección no se puede ser modificada ya que hay publicaciones creadas para ésta.', 'info-message');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $section;
        }
    }

    public function delete($id = null){
        if (!$id) {
            throw new NotFoundException(__('Invalid section'));
        }
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        try{
            if ($this->Section->delete($id)) {
                $this->Session->setFlash('La sección fue eliminada satisfactoriamente.', 'success-message');
                $this->redirect(array('action' => 'index'));
            }
        } catch (Exception $e){
            $this->Session->setFlash('La sección no se puede ser eliminada ya que hay publicaciones creadas para ésta.', 'info-message');
            $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * Indicar para qué funciones se requiere autorización
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny('register', 'getfields');
    }

    /**
     * Determinar qué acciones estarán disponibles por usuario
     * @param type $user
     * @return boolean
     */
    public function isAuthorized($user = null) {

        if (in_array($this->request->params, array('register', 'getfields')) &&
                $user['role'] !== 'ca_admin') {
            return false;
        }

        return parent::isAuthorized($user);
    }

}
