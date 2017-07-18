<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');

class RemoveAdsController extends AppController {

    public $components = array('Qimage', 'GCM');
    //public $uses = array('Subscription');

    /**
     * Displayes list of subscription
     */
    public function admin_removead() {
        $this->set('title_for_layout', ' - Remove Ads Management');

        $this->paginate['RemoveAd'] = array(
            'limit' => 10,
            'order' => array(
                'RemoveAd.month' => 'ASC'
            )
        );

        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['RemoveAd'];
        } else {
            $this->request->data['RemoveAd'] = $this->request->query;
        }
        ############################################################################################

        $this->Paginator->settings = $this->paginate['RemoveAd'];
        $results = $this->paginate('RemoveAd');
        $this->set('results', $results);
        $this->set('count', count($results));
    }
    public function admin_add_removead() {
        if ($this->request->is('post')) {
            $this->request->data['RemoveAd']['creation_date']=date('Y-m-d');
            if ($this->RemoveAd->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                $this->redirect(array('controller' => 'removeAds', 'action' => 'removead', 'admin' => TRUE));
            } else {
                $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-success', array(), 'notification');
            }
            //pr($this->request->data);
        }
    }
    public function admin_edit_removead($id = null) {
        if (!$id) {
            $this->redirect($this->referer());
        }

        $this->RemoveAd->id = $id;
        //$users = $this->User->findById($this->User->id);
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->RemoveAd->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                 $this->redirect(array('controller' => 'removeAds', 'action' => 'removead', 'admin' => TRUE));
               // $this->redirect($this->referer());
            }else{
                $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-success', array(), 'notification');
            }
        }else{
            $this->request->data = $this->RemoveAd->read();
        }
        //$this->set('user_details', $users);
       // $this->request->data = $this->RemoveAd->read();
    }
    public function admin_delete_removead($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $this->RemoveAd->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        //$this->redirect(array('controller' => 'users', 'action' => 'phrases', $user_id, 'admin' => TRUE));
        $this->redirect($this->referer());
    }
}
