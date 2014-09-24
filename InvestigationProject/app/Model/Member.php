<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Modelo para la tabla members
 *
 * @author rgarcia
 */
class Member extends AppModel {

    public $hasMany = 'Experience';

}
