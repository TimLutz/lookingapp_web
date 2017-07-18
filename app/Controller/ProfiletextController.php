<?php
define("ENCRYPTION_KEY", "wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA");
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
//include braintree payment gateway//
App::import('Vendor', 'Braintree', array('file' => 'braintree' . DS . 'lib' . DS . 'Braintree.php'));
class ProfiletextController extends AppController {
    public $components = array('Qimage', 'GCM');
    public $uses = array('User', 'Profile', 'User_partner', 'User_album', 'BlockedUser', 'UserLookdate', 'UserLooksex', 'Archive', 'ShareAlbum', 'ReceiveAlbum', 'Favourite', 'Note', 'Viewer', 'ProfileLock', 'RecentImage', 'Phrase', 'ChatUser','Admin','Flag','BlockChatUser','ChatCountMessage','MatchesFilterValue','Subscription','RemoveAd','Transaction','UserRestriction','Trial','VerifyLog','Banner');
    /*--------------------------------------Snehadeep-------------------------------------------------------------------*/
	public function admin_change_status($id, $status) {
        if (!$id || !isset($status)) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->User->updateAll(
                array('User.status' => $status,'User.profiletext_change' => 0), array('User.id' => $id)
        );

        if ($status == 0)
            $msg = 'record_inactive';
        elseif ($status == 1)
            $msg = 'record_active';

        $this->Session->setFlash($this->errorMessage($msg), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect($this->referer());
    }
	
	public function admin_change_profiletext($id, $text_status) {
		//echo $id."=".$status;die;
        if (!$id || !isset($text_status)) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->User->updateAll(
                array('User.profiletext_change' => $text_status), array('User.id' => $id)
        );

        if ($text_status == 0)
            $msg = 'approve';
        elseif ($text_status == 1)
            $msg = 'text change';

        //$this->Session->setFlash($this->errorMessage($msg), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect($this->referer());
    }
	
	public function admin_profiletext() {
		$this->set('title_for_layout', ' - Users Management');
		
		if(!isset($this->params['pass']['0'])) {
				$limit=10;
		}else {
			$limit=$this->params['pass']['0'];
		}
		
		$this->paginate['User'] = array(
				'conditions' => array('User.profiletext_change'=>1),
				'limit' => $limit,
				'order' => array(
				   'User.id' => 'DESC'
				),
			);

        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }

        $search = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : isset($this->request->query['search']) ? $this->request->query['search'] : '';

        if ($search) {
            $this->paginate['User']['conditions']['OR'] = array(
                "User.screen_name LIKE" => "%" . $search . "%",
                "User.email LIKE" => "%" . $search . "%",
                    //"User.last_name LIKE" => "%" . $search . "%"
            );
        }
        ############################################################################################

        $this->Paginator->settings = $this->paginate['User'];
        $results = $this->paginate('User');
		//pr($this->User->getDataSource()->getLog());
        $this->set('results', $results);
        $this->set('count', count($results));
	}
	
	/* ------------------------------------------------------------------------------------------------------------------ */
    
}
?>