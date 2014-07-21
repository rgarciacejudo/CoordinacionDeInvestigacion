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
        'username' => 'rgarcia.cejudo@gmail.com',
        'password' => ',.R1c4rd0GC.,',
        'transport' => 'Smtp',
        'from' => array('rgarcia.cejudo@gmail.com' => 'Soporte'),
        'tls' => true
    );
    
    public $default = array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'rgarcia.cejudo@gmail.com',
        'password' => ',.R1c4rd0GC.,',
        'transport' => 'Smtp',
        'from' => array('rgarcia.cejudo@gmail.com' => 'Soporte'),
        'log' => true
    );

}
