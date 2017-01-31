<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');

/**
 * Modelo para la tabla sections_fields
 *
 * @author rgarcia
 */
class PublicationsAuthor extends AppModel {

    public $validate = array(        
        'autor' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El autor es requerido.'
            )
        )
    );

}
