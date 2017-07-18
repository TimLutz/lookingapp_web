<?php

/* 
 * Model ::  Admin
 * Table ::  admins
 */

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Admin extends AppModel{
    
    public $name = 'Admin';
    
    
    /**
     * 
     * @param type $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        /*if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }*/
        return true;
    }
    
}

