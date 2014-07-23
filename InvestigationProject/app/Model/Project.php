<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Modelo para la tabla projects
 *
 * @author rgarcia
 */
class Project extends AppModel {

  public $validate = array(
		'pkey' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'La clave del proyecto es requerida.'
				),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'La clave del proyecto ingresada ya existe.'
				)
			),
		'institution_id' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'La institución del proyecto es requerida.'
				)
			),
		'resume' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'El resumen del proyecto es requerido.'
				)
			),
		'mount' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'El monto del proyecto es requerido.'
				),
			'money' => array(
				'rule' => array('decimal', 2),
				'message' => 'El monto del proyecto debe ser un valor decimal a dos decimales.'
				)
			),
		'file_path' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'El archivo del proyecto es requerido.'
				)
			),
		'from_date' =>array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'La fecha del proyecto es requerida.'
				),
			'date' => array(
				'rule' => 'date',
				'message' => 'Debe ingresar un formato correcto.'
				),
			),
		'to_date' =>array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'La fecha del proyecto es requerida.'
				),
			'date' => array(
				'rule' => 'date',
				'message' => 'Debe ingresar un formato correcto.'
				)
			)
		);
}
