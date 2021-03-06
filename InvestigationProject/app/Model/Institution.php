<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');

/**
 * Modelo para la tabla institutions
 *
 * @author rgarcia
 */
class Institution extends AppModel {

    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El nombre de la institución es requerido.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'El nombre de la institución ingresado ya existe.'
            )
    ));

}
