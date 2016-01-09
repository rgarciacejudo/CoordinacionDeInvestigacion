<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');
/**
 * Modelo para la tabla advertisements
 *
 * @author rgarcia
 */
class Advertisement extends AppModel {
	
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El nombre del link es requerido.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'El nombre del link ingresado ya existe.'
            )
        ),        
        'expiration_date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La fecha de visulación es requerida.'
            )
        ),
        'file_path' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La imagen del anuncio es requerido.'
            )
        )        
    );
}

?>