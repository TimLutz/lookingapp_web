<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');

class TrialsController extends AppController {

    public $components = array('Qimage', 'GCM');
    //public $uses = array('Subscription');

    /**
     * Displayes list of Restriction
     */
    public function admin_trial_list() {
        $this->set('title_for_layout', ' - Trial Management');
       
      $this->paginate['Trial'] = array(
            'limit' => 10,
            //'conditions'=>array('member_type'=>$member_type)
            //'order' => array(
            //    'Subscription.month' => 'ASC'
            //)
        );
        //$this->set('type', $member_type);

        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['Trial'];
        } else {
            $this->request->data['Trial'] = $this->request->query;
        }
        ############################################################################################

        $this->Paginator->settings = $this->paginate['Trial'];
        $results = $this->paginate('Trial');
        $this->set('results', $results);
        $this->set('count', count($results));
    }
    
    public function admin_edit_trial($id = null) {
        if (!$id) {
            $this->redirect($this->referer());
        }
        $this->Trial->id = $id;
        //$users = $this->User->findById($this->User->id);
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Trial->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                 $this->redirect(array('controller' => 'Trials', 'action' => 'trial_list', 'admin' => TRUE));
               // $this->redirect($this->referer());
            }else{
                $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-success', array(), 'notification');
            }
        }else{
           $this->request->data = $this->Trial->read(); 
        }
        //$this->set('user_details', $users);
        
    }
}
