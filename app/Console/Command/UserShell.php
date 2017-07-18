<?php
/**
 * AppShell file
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
 * @since         CakePHP(tm) v 2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Shell', 'Console');

/**
 * Application Shell
 *
 * Add your application-wide methods in the class below, your shells
 * will inherit them.
 *
 * @package       app.Console.Command
 */
class UserShell extends Shell {
public $uses = array('UserLooksex'); 
 public function check_is_active(){
        $this->autoRender = false;
        $current_date = date('Y-m-d H:i:s');
        $looks_data = $this->UserLooksex->find('all',array('conditions'=>array('end_time >'=>$current_date)));
        if(count($looks_data)>0)
        {
        foreach($looks_data as $data)
        {
            $this->UserLooksex->id = $data['UserLooksex']['id'];
            $this->UserLooksex->saveField('is_active', 0);
        }
        }
        exit;
    }
}
