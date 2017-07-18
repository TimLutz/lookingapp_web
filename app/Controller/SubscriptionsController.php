<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');

class SubscriptionsController extends AppController {

    public $components = array('Qimage', 'GCM');
    //public $uses = array('Subscription');

    /**
     * Displayes list of subscription
     */
    public function admin_subscription() {
        $this->set('title_for_layout', ' - Subscriptions Management');

        $this->paginate['Subscription'] = array(
            'limit' => 10,
            'order' => array(
                'Subscription.month' => 'ASC'
            )
        );

        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['Subscription'];
        } else {
            $this->request->data['Subscription'] = $this->request->query;
        }
        ############################################################################################

        $this->Paginator->settings = $this->paginate['Subscription'];
        $results = $this->paginate('Subscription');
        $this->set('results', $results);
        $this->set('count', count($results));
    }
    public function admin_add_subscription() {
        if ($this->request->is('post')) {
            $this->request->data['Subscription']['creation_date']=date('Y-m-d');
            if ($this->Subscription->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                $this->redirect(array('controller' => 'subscriptions', 'action' => 'subscription', 'admin' => TRUE));
            } else {
                $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-success', array(), 'notification');
            }
            //pr($this->request->data);
        }
    }
    public function admin_edit_subscription($id = null) {
        if (!$id) {
            $this->redirect($this->referer());
        }

        $this->Subscription->id = $id;
        //$users = $this->User->findById($this->User->id);
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Subscription->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                 $this->redirect(array('controller' => 'subscriptions', 'action' => 'subscription', 'admin' => TRUE));
               // $this->redirect($this->referer());
            }else{
                $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-success', array(), 'notification');
            }
        }else{
           $this->request->data = $this->Subscription->read(); 
        }
        //$this->set('user_details', $users);
        
    }
    public function admin_delete_subscription($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $this->Subscription->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        //$this->redirect(array('controller' => 'users', 'action' => 'phrases', $user_id, 'admin' => TRUE));
        $this->redirect($this->referer());
    }
}
