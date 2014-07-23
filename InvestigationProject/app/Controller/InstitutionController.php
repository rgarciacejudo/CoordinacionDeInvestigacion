<?php

/*
 * Control para la administración de instituciones
 */

class InstitutionController extends AppController {

    /**
     * Función para obtener las instituciones
     */
    public function getexperiences(){   
        $name = isset($_GET["name"]) ? $_GET["name"] : ''; 
    	$this->autoRender = false;
    	$this->response->type('json');
    	$institutions = $this->Institution->find('all', array(
    		'conditions' => array(
    			'Institution.name LIKE' => '%'.$name.'%'
    			),
            'order' => array(
                'Institution.name'
                )
    		)
    	);    	
        $options = array();
        foreach ($institutions as $key => $u) {            
            $options[$key]['id'] = $u['Institution']['id'];            
            $options[$key]['value'] = $u['Institution']['name'];            
        }
    	$json = json_encode($options);
    	$this->response->body($json);
    }
  }