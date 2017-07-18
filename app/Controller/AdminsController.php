<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminsController extends AppController {

    /**
     * @var type => String
     *      value => Name of the controller
     */
    public $name = 'Admins';

    /**
     *
     * @var type => Array
     *      value => Loads models required for this controller
     */
    public $uses = array('Admin', 'Setting' , 'User' ,'Flag');

    /**
     * "beforeFilter" for Controller
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * Displayes Dashboard for the admin
     */
    public function admin_dashboard() {
        $totaluser = $this->User->find('count');
        $banuser = $this->User->find('count',array('conditions'=>array('User.status'=>0)));
        //$reports = $this->Flag->find('count',array('conditions'=>array('Flag.archive'=>0)));
        $reports = $this->Flag->find('count',array(
           'fields'=>array('Flag.*','UserSender.*','UserReceiver.*'),
	    'joins' => array(
		array(
		    'alias' => 'UserSender',
		    'table' => 'users',
		    'type' => 'INNER',
		    'conditions' => '`UserSender`.`id` = `Flag`.`sender_id`'
		),
		array(
		    'alias' => 'UserReceiver',
		    'table' => 'users',
		    'type' => 'INNER',
		    'conditions' => '`UserReceiver`.`id` = `Flag`.`receiver_id`'
		)
	    ),
            'conditions'=>array('Flag.archive'=>0,'UserReceiver.status'=>1),
            'order' => array(
                'Flag.creation_date' => 'ASC'
            )
        ));
        
        $photos = $this->User->find('count',array('conditions'=>array('User.photo_change'=>1)));
        $profiletext = $this->User->find('count',array('conditions'=>array('User.profiletext_change'=>1)));
        $this->set('photos',$photos);
        $this->set('profiletext',$profiletext);
        $this->set('reports',$reports);
        $this->set('totaluser',$totaluser);
        $this->set('banuser',$banuser);
        $this->set('title_for_layout', 'Dashboard');
    }

    /**
     *  Login for admin
     */
    public function admin_login() {
        $this->set('title_for_layout', 'Login');
		 if ($this->Auth->user()){
           $this->redirect(array('action' => 'dashboard', 'admin' => TRUE));
         }
        //echo Security::hash('admin', null, true);exit;
        if ($this->request->is('post') || $this->request->is('put')) {
             
            //pr($this->request->data);exit;
            //pr($this->Auth);exit;
            if ($this->Auth->login()) {
                //echo 1;exit;
                if (isset($this->request->data['remember_me']) && $this->request->data['remember_me']) {
                    $this->Cookie->write('Admin.email', $this->request->data['Admin']['username']);
                    $this->Cookie->write('Admin.password', $this->request->data['Admin']['password']);
                    //echo 1;
                } else {
                    //$this->Cookie->delete('Admin.email');
                   // $this->Cookie->delete('Admin.password');
                    //echo 2;die;
                    $this->Cookie->delete('Admin');

                }
                //pr($this->Admin->getDataSource()->getLog(true));exit;
                //echo $this->Cookie->read('Admin.email');exit;
                $this->redirect($this->Auth->redirect());
            } else {
                //echo 2;exit;
                //$log = $this->Admin->getDataSource()->getLog(false, false); debug($log);exit;
                $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
            }
        } else {
            
        }
       // echo $this->Cookie->read('Admin.email');
        $this->set('cookieEmail', $this->Cookie->read('Admin.email'));
        $this->set('cookiePassword', $this->Cookie->read('Admin.password'));
    }

    /**
     *  Logout method for administrator
     */
    public function admin_logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
     *  Profile update for administrator
     */
    public function admin_profile() {
        //$this->autoRender = FALSE;

        if ($this->request->is('post') || $this->request->is('put')) {
            $hasUpdated = 0;
            //pr($this->request->data);exit;
            if ($this->request->data['Admin']['action'] == 'profile') {
                if ($this->request->data['Admin']['display_name'] != $this->Session->read('Auth.Admin.display_name') && $this->request->data['Admin']['display_name'] != "") {
                    $this->request->data['Admin']['id'] = $this->Session->read('Auth.Admin.id');
                    if ($this->Admin->save($this->request->data)) {
                        $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                        $hasUpdated = 1;
                    } else {
                        $this->Session->setFlash($this->errorMessage('update_error'), 'admin/notifications/message-error', array(), 'notification');
                    }
                } else {
                    $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-error', array(), 'notification');
                }
            } elseif ($this->request->data['Admin']['action'] == 'password') {
                if ($this->request->data['Admin']['old_password'] != "" && $this->request->data['Admin']['password'] != "") {
                    $profile = $this->Admin->find('first', array(
                        'fields' => array('Admin.password')
                    ));
                    //pr($profile);
                    $hash = Security::hash($this->request->data['Admin']['old_password'], null, true);
                    if ($profile['Admin']['password'] == $hash) {
                        $this->request->data['Admin']['id'] = $this->Session->read('Auth.Admin.id');
                        $this->request->data['Admin']['password'] = Security::hash($this->request->data['Admin']['password'], null, true);
                        if ($this->Admin->save($this->request->data)) {
                            $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                            $hasUpdated = 1;
                        } else {
                            $this->Session->setFlash($this->errorMessage('update_error'), 'admin/notifications/message-error', array(), 'notification');
                        }
                    } else {
                        $this->Session->setFlash($this->errorMessage('old_password_mismatch'), 'admin/notifications/message-error', array(), 'notification');
                    }
                } else {
                    $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-error', array(), 'notification');
                }
            }

            if ($hasUpdated) {
                $profile = $this->Admin->find('first');
                unset($profile['Admin']['password']);
                $this->Session->write('Auth.Admin', $profile['Admin']);
            }
            //pr($this->_getViewObject());exit;
            $this->redirect(array('action' => 'profile', 'admin' => TRUE));
        }
    }

    /**
     *  Websites general Settings update for administrator
     */
    public function admin_settings() {
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = array();
            foreach ($this->request->data['Admin'] as $key => $value) {
                $this->Setting->updateAll(array('Setting.option_value' => '\''.$value.'\''), array('Setting.option_name' => $key));
            }
            $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array('class' => 'alert-success'), 'notification');
        }

        $settings = $this->Setting->find('all');
        $settings = Hash::combine($settings, '{n}.Setting.option_name', '{n}.Setting.option_value');
        $this->set('settings', $settings);
    }

}



