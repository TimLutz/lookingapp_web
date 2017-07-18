<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');

class ReportsController extends AppController {

    public $components = array('Qimage', 'GCM');
    public $uses = array('Flag','User');
    /**
     * Displayes list of Roprsts
     */
    public function admin_index() {
        $this->set('title_for_layout', ' - Reports Management');
        /*$this->Flag->bindModel(
           array( 
          'belongsTo' => array(
            'UserSender' => array(
               'className' => 'User',
                'foreignKey' => false,
                'conditions' => array('UserSender.id=Flag.sender_id'),
            )
          )
          )
          );
        $this->Flag->bindModel(
         array(
         'belongsTo' => array(
           'UserReceiver' => array(
              'className' => 'User',
               'foreignKey' => false,
               'conditions' => array('UserReceiver.id=Flag.receiver_id'),
           )
         )
         )
         );*/
      
      
      if(!isset($this->params['pass']['0'])) {
				$limit=10;
		}else {
			$limit=$this->params['pass']['0'];
		}
        $this->paginate['Flag'] = array(
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
            'limit' => $limit,
            'order' => array(
                'Flag.creation_date' => 'Desc'
            )
        );
        //$this->set('type', $member_type);

        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['Flag'];
        } else {
            $this->request->data['Flag'] = $this->request->query;
        }
        $search = isset($this->request->data['Flag']['search']) ? $this->request->data['Flag']['search'] : isset($this->request->query['search']) ? $this->request->query['search'] : '';

        if ($search) {
            $this->paginate['Flag']['conditions']['OR'] = array(
                "Flag.flag LIKE" => "%" . $search . "%",
                "UserSender.email LIKE" => "%" . $search . "%",
                 "UserReceiver.email LIKE" => "%" . $search . "%",
                    //"User.last_name LIKE" => "%" . $search . "%"
            );
        }
        ############################################################################################

        $this->Paginator->settings = $this->paginate['Flag'];
        $results = $this->paginate('Flag');
        //pr($this->Flag->getDataSource()->getLog());die;
       // pr($results);die;
        $this->set('results', $results);
        $this->set('count', count($results));
    }
    
    public function admin_archive() {
        $this->set('title_for_layout', ' - Reports Management');
    /*    $this->Flag->bindModel(
           array( 
          'belongsTo' => array(
            'UserSender' => array(
               'className' => 'User',
                'foreignKey' => false,
                'conditions' => array('UserSender.id=Flag.sender_id'),
            )
          )
          )
          );
        $this->Flag->bindModel(
         array(
         'belongsTo' => array(
           'UserReceiver' => array(
              'className' => 'User',
               'foreignKey' => false,
               'conditions' => array('UserReceiver.id=Flag.receiver_id'),
           )
         )
         )
         );*/
        
        if(!isset($this->params['pass']['0'])) {
				$limit=10;
		}else {
			$limit=$this->params['pass']['0'];
		}
        
      $this->paginate['Flag'] = array(
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
            'conditions'=>array('Flag.archive'=>1,'UserReceiver.status'=>1),
            'limit' => $limit,
            'order' => array(
                'Flag.creation_date' => 'ASC'
            )
        );
        //$this->set('type', $member_type);

        ############################################################################################
       // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['Flag'];
        } else {
            $this->request->data['Flag'] = $this->request->query;
        }
        $search = isset($this->request->data['Flag']['search']) ? $this->request->data['Flag']['search'] : isset($this->request->query['search']) ? $this->request->query['search'] : '';

        if ($search) {
            $this->paginate['Flag']['conditions']['OR'] = array(
                "Flag.flag LIKE" => "%" . $search . "%",
                "UserSender.email LIKE" => "%" . $search . "%",
                 "UserReceiver.email LIKE" => "%" . $search . "%",
                    //"User.last_name LIKE" => "%" . $search . "%"
            );
        }
        ############################################################################################

        $this->Paginator->settings = $this->paginate['Flag'];
        $results = $this->paginate('Flag');
       // pr($this->Flag->getDataSource()->getLog());
       // pr($results);die;
        $this->set('results', $results);
        $this->set('count', count($results));
    }
    //=======change user status ban unban=========//
    public function admin_change_status($id, $status) {
        if (!$id || !isset($status)) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->User->updateAll(
                array('User.status' => $status), array('User.id' => $id)
        );

        if ($status == 0)
            $msg = 'record_inactive';
        elseif ($status == 1)
            $msg = 'record_active';

        $this->Session->setFlash($this->errorMessage($msg), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect($this->referer());
    }
    
     //=======move_archive report=========//
    public function admin_move_archive($id) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->Flag->updateAll(
                array('Flag.archive' => 1), array('Flag.id' => $id)
        );
            
            //$msg = 'record_active';

       // $this->Session->setFlash($this->errorMessage($msg), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect($this->referer());
    }
}
