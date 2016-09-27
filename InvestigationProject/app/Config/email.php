<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author rgarcia
 */
class EmailConfig {

    public $gmail = array(
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'username' => 'info.obifi@gmail.com',
        'password' => ',.Ob1f1.,',
        'transport' => 'Smtp',
        'from' => array('info.obifi@gmail.com' => 'Observatorio de Investigación'),
        'tls' => true
    );
    
    public $default = array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'info.obifi@gmail.com',
        'password' => ',.Ob1f1.,',
        'transport' => 'Smtp',
        'from' => array('info.obifi@gmail.com' => 'Observatorio de Investigación'),
        'log' => true
    );

}
