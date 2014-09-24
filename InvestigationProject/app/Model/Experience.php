<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');

/**
 * Modelo para la tabla experiences
 *
 * @author rgarcia
 */
class Experience extends AppModel {
    
    public $belongsTo = 'Institution';
    
    public $validate = array(
        'institution' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La institución es requerida.'
            )
        ),
        'activities' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Las actividades son requeridas.'
            )
        )
    );

}
