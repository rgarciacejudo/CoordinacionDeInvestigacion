<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('SectionsField', 'Model');

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
                $sections = $this->Section->find('all', array('recursive' => '-1'));
                break;

            default:
                break;
        }
        $this->set('sections', $sections);
    }

}
