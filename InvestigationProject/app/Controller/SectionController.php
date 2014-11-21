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
        $section_field_db = new SectionsField();
        $type = $section_field_db->getColumnType('type');
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        foreach (explode(',', $matches[1]) as $value) {
            $enum_types[trim($value, "'")] = trim($value, "'");
        }
        $this->set('field_types', $enum_types);
        if ($this->request->is('post')) {
            if (!empty($this->data)) {
                if ($this->Section->saveAll($this->request->data)) {
                    $this->Session->setFlash('Se ha creado la sección ' . $this->data['Section']['name'], 'success-message');
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
        }
        $json = json_encode($options);
        $this->response->body($json);
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
