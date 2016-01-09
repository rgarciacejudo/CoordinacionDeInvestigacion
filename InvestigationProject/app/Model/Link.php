<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Modelo para la tabla links
 *
 * @author rgarcia
 */
class Link extends AppModel {
	
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
        'display_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El texto del link es requerido.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'El texto del link ingresado ya existe.'
            )
        ),
        'url' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Debe elegir un líder para el cuerpo académico.'
            )
        )        
    );
}

?>