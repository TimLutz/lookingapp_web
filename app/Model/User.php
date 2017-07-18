<?php
App::uses('AppModel', 'Model');
//App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
class User extends Model
{
   public $name='User';
   
   
   public $hasOne = array(
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => 'user_id'
        ),
	'UserPartner' => array(
            'className' => 'UserPartner',
            'foreignKey' => 'user_id',
        )
    );
   
   public $hasMany = array(
        'BlockedUser' => array(
            'className' => 'BlockedUser',
            'foreignKey' => 'user_id'
        )
    );
   
   
   public function beforeSave($options = array())
   {
	 if (isset($this->data[$this->alias]['password']))
	 {
		 $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	 }
	 return true;
   }
  
}
