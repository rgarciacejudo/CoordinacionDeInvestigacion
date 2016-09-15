<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');
/**
 * Modelo para la tabla academic_groups
 *
 * @author rgarcia
 */
class AcademicGroup extends AppModel {
    
    public $belongsTo = array(
        'Leader' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
    
    public $hasAndBelongsToMany = array(
        'Members' =>
            array(
                'className' => 'Member',
                'joinTable' => 'members_academic_groups',
                'foreignKey' => 'academic_group_id',
                'associationForeignKey' => 'member_id',
                'unique' => true,
                //'fields' => 'Members.user_id'
            )
    );

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