<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Cookie',
        'Auth' => array(
            'loginAction' => array('controller' => 'user', 'action' => 'login'),
            'loginRedirect' => array('controller' => 'home', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'home', 'action' => 'display'),
            'authError' => 'No tiene los permisos necesarios para acceder a esta acción.',
            'loginError' => 'Usuario o contraseña inválidos.',
            'authorize' => array('Controller'),
            'unauthorizedRedirect' => array('controller' => 'home', 'action' => 'index'),
            'flash' => array('element' => 'alert-message', 'key' => 'auth', 'params' => array())

    ));

    public function beforeFilter(){
        $this->Auth->allow('index');
        //Obtener los links del pie de página
        if(!$this->Cookie->check('footerLinks')){
            $this->loadModel('Link');
            $links = $this->Link->find('all');
            $this->Cookie->write('footerLinks', $links);
            $this->set('footer_links', $links);
        } else {
            $this->set('footer_links', $this->Cookie->read('footerLinks'));
        }

        if(!$this->Cookie->check('addressInfo')){
          $this->loadModel('Value');
          $address = $this->Value->find('first', array('conditions' => array('name' => 'address')));
          $this->Cookie->write('addressInfo', $address);
          $this->set('address_info', $address);
        } else {
            $this->set('address_info', $this->Cookie->read('addressInfo'));
        }

        if($this->request->params['action'] !== 'report') {
            $this->Session->delete('Report.criteria');
        }
    }

    public function isAuthorized($user = null) {
        // Default allow
        return true;
    }
}
