<?php


class Value extends AppModel {

  public $validate = array(
      'name' => array(
          'required' => array(
              'rule' => array('notEmpty'),
              'message' => 'El nombre de la infomación es requerido.'
          ),
          'unique' => array(
              'rule' => 'isUnique',
              'message' => 'El nombre de la infomación ingresado ya existe.'
          )
      ),
      'value' => array(
          'required' => array(
              'rule' => array('notEmpty'),
              'message' => 'El valor de la infomación es requerido.'
          )
      )
  );

}

?>
