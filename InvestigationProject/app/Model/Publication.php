<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Modelo para la tabla publications
 *
 * @author rgarcia
 */
class Publication extends AppModel {

    public $belongsTo = array('Member', 'Section');

    public $hasMany = array(
        'Authors' => array(
            'className' => 'PublicationsAuthor',
            'joinTable' => 'publications_authors',
            'foreignKey' => 'publication_id',
            'unique' => true
        )
    );

    public $hasAndBelongsToMany = array(
        'Fields' => array(
            'className' => 'SectionsField',
            'joinTable' => 'publications_section_fields',
            'foreignKey' => 'publication_id',
            'associationForeignKey' => 'section_field_id',
            'unique' => true,
        ),
		'Members' => array(
			'className' => 'Member',
            'joinTable' => 'publications_members',
            'foreignKey' => 'publication_id',
            'associationForeignKey' => 'member_id',
            'unique' => true,
		)
    );

    /*public $validate = array(
        'title' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El título es requerido.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'El título ingresado ya existe.'
            )
        ),
        'publish_date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La fecha de publicación es requerida.'
            )
        )
    );*/

}
