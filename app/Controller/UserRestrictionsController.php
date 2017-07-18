<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');

class UserRestrictionsController extends AppController {

    public $components = array('Qimage', 'GCM');
    //public $uses = array('Subscription');

    /**
     * Displayes list of Restriction
     */
    public function admin_restriction_list() {
        $this->set('title_for_layout', ' - Restriction Management');
       // pr($this->request->params['pass'][0]);die;
       if($this->request->params['pass'][0]=='paid'){
        $member_type=1;
       }else{
        $member_type=0;
       }
       
        $this->paginate['UserRestriction'] = array(
            'limit' => 20,
            'conditions'=>array('member_type'=>$member_type),
            'order' => array(
                'id' => 'ASC'
            )
        );
        $this->set('type', $member_type);

        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['UserRestriction'];
        } else {
            $this->request->data['UserRestriction'] = $this->request->query;
        }
        ############################################################################################

        $this->Paginator->settings = $this->paginate['UserRestriction'];
        $results = $this->paginate('UserRestriction');
        $this->set('results', $results);
        $this->set('count', count($results));
    }
    
    public function admin_edit_restriction($id = null,$member_type=null) {
        if (!$id) {
            $this->redirect($this->referer());
        }
        if (!$member_type) {
            $this->redirect($this->referer());
        }
        $this->UserRestriction->id = $id;
        //$users = $this->User->findById($this->User->id);
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->UserRestriction->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                 $this->redirect(array('controller' => 'UserRestrictions', 'action' => 'restriction_list', 'admin' => TRUE,$member_type));
               // $this->redirect($this->referer());
            }else{
                $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-success', array(), 'notification');
            }
        }else{
           $this->request->data = $this->UserRestriction->read(); 
        }
        //$this->set('user_details', $users);
        
    }
}
