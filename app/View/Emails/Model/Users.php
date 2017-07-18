<?php

class User extends Model
{
   public $hasOne = 'Profile';
   public $validate = array(
                            'username'=>array('required'=>array('rule'=>array('notEmpty'),'message'=>'User name required')),
                            'password'=>array('required'=>array('rule'=>array('notEmpty'),'message'=>'password is required')),
                            'role'=>array('valid'=>array('rule'=>array('inList',array('admin','author')),'message'=>'Please enter a valid role','allowEmpty'=>false))
                            );
}
