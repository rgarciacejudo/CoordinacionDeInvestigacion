<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');

/**
 * Modelo para la tabla sections
 *
 * @author rgarcia
 */
class Section extends AppModel {

    public $hasMany = array('SectionsField' => array('dependent'=> true));
    
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El nombre de la sección es requerido.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'El nombre de la sección ingresado ya existe.'
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La descripción de la sección es requerida.'
            )
        )
    );       

}
