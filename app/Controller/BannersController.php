<?php
class BannersController extends AppController {

    public $components = array('Qimage', 'GCM');
    public $uses = array('Banner'); 
    public function admin_index() {
        $this->set('title_for_layout', ' - Banners Management');

        $this->paginate['Banner'] = array(
            'limit' => 10,
            //'order' => array(
            //    'Banner.id' => 'DESC'
            //)
        );

        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['Banner'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }

        $search = isset($this->request->data['Banner']['search']) ? $this->request->data['Banner']['search'] : isset($this->request->query['search']) ? $this->request->query['search'] : '';

        if ($search) {
            $this->paginate['Banner']['conditions']['OR'] = array(
                "User.screen_name LIKE" => "%" . $search . "%",
                "User.email LIKE" => "%" . $search . "%",
                    //"User.last_name LIKE" => "%" . $search . "%"
            );
        }
        ############################################################################################

        $this->Paginator->settings = $this->paginate['Banner'];
        $results = $this->paginate('Banner');
        $this->set('results', $results);
        $this->set('count', count($results));
    }
	public function admin_edit($id = null) {
        if (!$id) {
            $this->redirect($this->referer());
        }

        $this->Banner->id = $id;
        $banners= $this->Banner->findById($this->Banner->id);
        if ($this->request->is('post') || $this->request->is('put')) {
            $file = $this->request->data['Banner']['banner_image']['name'];
            //pr($file);
            if ($file) {
                $resize = true;
                $resizeOptions = array('width' => '640', 'height' => '100', 'destination' => 'banners/thumb/');
                $rootPath = WWW_ROOT;
                $destination = 'banners/';
                if (!empty($banners['Banner']['banner_image'])) {
                    @unlink($rootPath . 'banners/' . $banners['Banner']['banner_image']);
                    @unlink($rootPath . 'banners/thumb/' . $banners['Banner']['banner_image']);
                }
                $data = array();
                $data['file'] = $this->request->data['Banner']['banner_image'];
                $data['path'] = $rootPath . $destination;
                $imageName = $this->Qimage->copy($data);

                if ($resize && count($resizeOptions) > 0) {
                    $data = array();
                    $data['file'] = $rootPath . $destination . $imageName;
                    $data['width'] = ($resizeOptions['width']) ? $resizeOptions['width'] : 60;
                    $data['height'] = ($resizeOptions['height']) ? $resizeOptions['height'] : 60;
                    $destinationThumb = ($resizeOptions['destination']) ? $resizeOptions['destination'] : $destination;
                    $data['output'] = $rootPath . $destinationThumb;
                    $data['proportional'] = TRUE;
                    $this->Qimage->resize($data);
                }

                if ($imageName) {
                    //echo $imageName;
                    $this->request->data['Banner']['banner_image'] = $imageName;
                }
            } else {
                unset($this->request->data['Banner']['banner_image']);
            }
            $this->Banner->create();
            if ($this->Banner->saveAll($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
				$this->redirect(array('controller' => 'Banners', 'action' => 'index', 'admin' => TRUE));
            }
        }
        $this->set('banner_details', $banners);
        $this->request->data = $this->Banner->read();
    }
}
