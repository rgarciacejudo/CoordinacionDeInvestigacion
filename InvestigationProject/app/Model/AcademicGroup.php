<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Modelo para la tabla academic_groups
 *
 * @author rgarcia
 */
class AcademicGroup extends AppModel{

	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'El nombre del cuerpo académico es requerido.'
				),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'El nombre del cuerpo académico ingresado ya existe.'
				)
			),
		'member_id' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe elegir un líder para el cuerpo académico.'
				)
			),
		'level' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'El nivel del cuerpo académico es requerido.'
				)
			)
		);
}

?>