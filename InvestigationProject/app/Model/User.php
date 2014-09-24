<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');
/**
 * Modelo para la tabla users
 *
 * @author rgarcia (bjsI13e8td) soulost (CCzSaH4leb)
 */
class User extends AppModel {

    public $hasOne = 'Member';

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El nombre de usuario es requerido.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'El nombre de usuario ingresado ya existe.'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La contraseña es requerida.'
            )
        )
    );

    /**
     * Función para cifrar la contraseña antes de guardar el registro.
     * @param type $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            //var_dump($this->data[$this->alias]['password']);
            $this->data[$this->alias]['password'] = AuthComponent::password(
                            $this->data[$this->alias]['password']
            );
        }
        return true;
    }

}

?>