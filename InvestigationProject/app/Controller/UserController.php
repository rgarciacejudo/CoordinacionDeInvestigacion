<?php

App::uses('Member', 'Model');
App::uses('CakeEmail', 'Network/Email');
/*
 * Control para la administración de cuentas
 */

class UserController extends AppController {

    /**
     * Función principal para el inicio de sesión
     */
    public function login() {    
        $this->set('page_name', 'Iniciar sesión');        
        if ($this->request->is('post')) {
            if (!empty($this->data)) {
                if ($this->data['User']['username'] === null or $this->data['User']['password'] === null) {
                    $this->Session->setFlash('Debe ingresar todos los datos.', 'alert-message');
                    return;
                }
                if ($this->Auth->login()) {
                    $member_db = new Member();
                    $member_id = $member_db->find('first', array(
                        'fields' => array('Member.id'),
                        'conditions' => array('Member.user_id' => $this->Auth->user('id'))
                    ));
                    $this->Session->write('User.member_id', $member_id['Member']['id']);
                    return $this->redirect($this->Auth->redirect());
                }
                $this->Session->setFlash('Usuario o contraseña incorrectos, favor de verificar.', 'info-message');
            } else {
                $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
            }
        }
    }

    /**
     * Función para registrar usuarios
     */
    public function register() {
        $this->set('page_name', 'Registrar usuario');
        if ($this->request->is('post')) {
            if (!empty($this->data)) {                
                $this->request->data['User']['password'] = $this->_generateRandomString();
                $this->request->data['User']['role'] = ($this->Auth->user('role') === 'super_admin' ?
                    'ca_admin' : ($this->Auth->user('role') === 'ca_admin' ? 'member' : 'super_admin'));
                
                if ($this->User->save($this->request->data)) {
                    $Email = new CakeEmail('gmail');
                    $Email->template('welcome')
                    ->viewVars(array(
                        'username' => $this->data['User']['username'],
                        'password' => $this->data['User']['password']
                        ))
                    ->to($this->data['User']['username'])
                    ->subject('Bienvenida!')
                    ->emailFormat('html')
                    ->send();
                    $this->Session->setFlash('Se ha enviado un correo con los accesos para la cuenta ' . $this->data['User']['username'], 'success-message');
                    return $this->redirect('register');
                }
                $this->Session->setFlash('Verifique los datos.', 'alert-message');
                
            } else {
                $this->Session->setFlash('Debes proporcionar los datos solicitados.', 'info-message');
            }
        }
    }

    /**
     * Función que genera una cadena aleatoria con longitud mínima de 10 char.
     * @param type $length
     * @return string
     */
    function _generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * Función para cerrar sesión
     */
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Función para administrar la cuenta de usuario.
     */
    public function manage() {
        $this->set('page_name', 'Administrar cuenta');
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data)) {
                if ($this->data['User']['password'] === null or
                    $this->data['User']['newpassword'] == null or
                    $this->data['User']['confirm_newpassword'] == null) {
                    $this->Session->setFlash('Debe ingresar todos los datos.', 'alert-message');
                return;
            } else if ($this->data['User']['newpassword'] !==
                $this->data['User']['confirm_newpassword']) {
                $this->Session->setFlash('Las nuevas contraseñas deben concidir.', 'alert-message');
                return;
            }

            $this->User->id = $this->Auth->user('id');
            $user = $this->User->read('password', $this->User->id);

            if ($user['User']['password'] !== AuthComponent::password($this->data['User']['password'])) {
                $this->Session->setFlash('La contraseña actual no coincide, favor de verificar.', 'info-message');
                return;
            }
            $this->User->set('password', $this->data['User']['newpassword']);
            if ($this->User->save()) {
                $this->Session->setFlash('La contraseña se ha actualizado.', 'success-message');
                return $this->redirect('edit');
            }
            $this->Session->setFlash('La contraseña no se ha actualizado correctamente.', 'alert-message');
        }
    }
}

    /**
     * Función para editar el perfil del usuario.
     */
    public function edit() {
        $this->set('page_name', 'Mi perfil');
        $user_member = $this->User->find('first', array(
            'conditions' => array(
                'Member.user_id' => $this->Auth->user('id')),
            'recursive' => 0));
        $member_db = new Member();
        $type = $member_db->getColumnType('SNI');
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        foreach (explode(',', $matches[1]) as $value) {
            $enum_sni[] = trim($value, "'");
        }
        $this->set('SNI_options', $enum_sni);
        $this->set('img_profile', $user_member['Member']['img_profile_path']);
        if (!$this->request->data) {
            $this->request->data = $user_member;
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['User']['id'] = $user_member['User']['id'];
            $this->request->data['User']['username'] = $user_member['User']['username'];
            $this->request->data['Member']['id'] = $user_member['Member']['id'];
            if (!$this->User->saveAll($this->data)) {
                $this->Session->setFlash('Ocurrió un error al guardar tu infromación.', 'error-message');
            } else {
                $this->Session->setFlash('Se ha actualizado tu información.', 'success-message');
            }
        }
    }

    /**
     * Funicón para actualizar la imagen de perfil
     * @return type
     */
    public function img_change() {
        if ($this->request->is('post') || $this->request->is('put')) {
            if (empty($this->data['User']['img']['tmp_name']) or ! is_uploaded_file($this->data['User']['img']['tmp_name'])) {
                $this->Session->setFlash('Debe seleccionar una imagen.', 'info-message');
            } else {
                $path = WWW_ROOT . 'files' . DS . 'profile_images' . DS;
                $ext = '.' . pathinfo($this->data['User']['img']['name'], PATHINFO_EXTENSION);
                $filename = 'img_profile_' . $this->Auth->user('id') . $ext;
                move_uploaded_file(
                    $this->data['User']['img']['tmp_name'], $path . $filename
                    );
                $user_member = $this->User->find('first', array(
                    'conditions' => array(
                        'Member.user_id' => $this->Auth->user('id')),
                    'recursive' => 0));
                $user_member['Member']['img_profile_path'] = DS . 'files' . DS .
                'profile_images' . DS . $filename;
                if (!$this->User->saveAll($user_member)) {
                    $this->Session->setFlash('Hubo un error al actualizar la imagen '
                        . 'del perfil.', 'erro-message');
                }
            }
            return $this->redirect('edit');
        }
    }

}

?>