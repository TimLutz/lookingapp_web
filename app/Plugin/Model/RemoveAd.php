<?php
App::uses('AppModel', 'Model');
//App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
class RemoveAd extends Model
{
   public $name='RemoveAd';
   public $validate = array(
	  
        'month' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field is required'
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Month should be numeric'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This month is already added'
            )
        ),
		'price' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field is required'
            ),
            'price' => array(
                'rule' => 'numeric',
                'message' => 'Price should be numeric'
            ),
        ),
    );  
  
}
