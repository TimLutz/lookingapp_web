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
    
    public function beforeRender()
    {
        parent::beforeRender();
       // $this->layout='layout_default';
    }
     
    public $components = array('Session','Cookie','Paginator',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'registration'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'index',
                'home'
            ),
            'loginAction' =>array(
                'controller'=>'users',
                'action' => 'index',
                'check'
            )
        )
    );
     
     
    /**
     * Setting the pagination object with the sorting & pagination limit criteria
     */
    public $paginate = array(
        'order' => array(
            'id' => 'DESC'
        ),
        'limit' => 15
    );
    public function beforeFilter()
    {
	
	parent::beforeFilter();
         //$this->Auth->loginAction = array('controller' => 'pages', 'action' => 'login');     
        // $this->Auth->loginRedirect = array('controller' => 'product', 'action' => 'homepage');
	 if (isset($this->request->params['admin']) && $this->request->params['admin']) {
            $this->layout = 'admin';
//echo 'Mir'; die;
            AuthComponent::$sessionKey = 'Auth.Admin';
            $this->Auth->loginAction = array('controller' => 'admins', 'action' => 'login', 'admin' => TRUE);
            $this->Auth->loginRedirect = array('controller' => 'admins', 'action' => 'dashboard', 'admin' => TRUE);
            $this->Auth->logoutRedirect = array('controller' => 'admins', 'action' => 'login', 'admin' => TRUE);
            $this->Auth->authenticate = array(
                'Form' => array(
                    'fields' => array('username' => 'username'),
                    'userModel' => 'Admin',
                    'scope' => array('Admin.is_active' => 1)
                )
            );
        } else {
         if(array_key_exists('lat',$this->request->data) && array_key_exists('long',$this->request->data) && array_key_exists('userid',$this->request->data))
         {
            $data['User']['id']=$this->request->data['userid'];
            $data['User']['lat']=$this->request->data['lat'];
            $data['User']['long']=$this->request->data['long'];
            $this->User->save($data);
         }
         $this->Auth->allow();
}
    }
    
    public function generateRandomString($case = 'mixed', $quantity = 5)
    {
        if ($case == 'mixed') {
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        } elseif ($case == 'upper-alpha') {
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } elseif ($case == 'lower-alpha') {
            $str = 'abcdefghijklmnopqrstuvwxyz';
        } elseif ($case == 'upper-alphanumaric') {
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        } elseif ($case == 'lower-alphanumaric') {
            $str = 'abcdefghijklmnopqrstuvwxyz0123456789';
        } elseif ($case == 'numaric') {
            $str = '0123456789';
        }
        return substr(str_shuffle(str_repeat($str, $quantity)), 0, $quantity);
    }

public function errorMessage($type) {
        $msg = '';
        switch ($type) {
            case 'update_success':

                $msg = __('Record updated successfully.');

                break;

            case 'update_error':

                $msg = __('Error in updation.');

                break;

            case 'missing_parameter':

                $msg = __('Error! Some parameters are missing.');

                break;

            case 'record_inactive':

                $msg = __('Record is now inactive.');

                break;

            case 'record_active':

                $msg = __('Record is now active.');

                break;

            case 'record_delete':

                $msg = __('Record deleted successfully.');

                break;

            case 'old_password_mismatch':

                $msg = __('Old password is wrong. Please provide the correct password and then try again.');

                break;

            case 'nothing_updated':

                $msg = __('Nothing updated.');

                break;

            case 'eep_code_generation_success':

                $msg = __('Eep code(s) generated successfully.');

                break;
             case 'user_noteuser_not_same':

                $msg = __('User and Note User should not be same.');

                break;
             case 'already_friend':

                $msg = __('Already friend or already friend request sent');

                break;
		case 'already_profile_exists':

                $msg = __('Profile already exists');

                break;
            case 'accept':

                $msg = __('friend request accept successfully');

                break;
            case 'block':

                $msg = __('successfully block this friend');

                break;

            default:
                break;
        }

        return $msg;
    }
}
