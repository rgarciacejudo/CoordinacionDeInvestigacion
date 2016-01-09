<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');
/**
 * Modelo para la tabla members
 *
 * @author rgarcia
 */
class Member extends AppModel {
	
		public $belongsTo = array(
    	'User' => array(
        'className' => 'User',
        'foreignKey' => 'user_id'
      )
    );

    public $hasMany = array('Experience', 'Publication');

}
