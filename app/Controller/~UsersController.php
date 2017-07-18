<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {

    public $components = array('Qimage', 'GCM');
    public $uses = array('User', 'Profile', 'User_partner', 'User_album', 'Blocked_user', 'UserLookdate', 'UserLooksex', 'Archive', 'ShareAlbum', 'ReceiveAlbum', 'Favourite', 'Note', 'Viewer');

    public function index() {
        $this->autoRender = false;
        echo 'Index Page';
        //$id=$this->Session->read('Auth.User.id');  	
        //$data=$this->User->findAllByUsernameAndPassword('ramesh','65cea807eef6b9a9b8816955da0e313761d88a85');
        //pr($data);
        //pr($this->User->getDataSource()->getLog());
    }

    /*     * *********** get user id by token ************ */

    public function get_userId($user_id) {
        $this->autoRender = false;
        if ($user_id) {
            $userid = $this->User->find('first', array('conditions' => array('User.token' => $user_id)));
            //pr($userid);
            return $userid['User']['id'];
        }
    }

    /*     * ******* END **************** */

    public function profile() {
        $this->autoRender = false;
        // * START This block for profile upadte and profile create of particular memeber ===========
        if ($this->request->is('post')) {
            if (isset($this->request->data['userid'])) {
                //pr($this->request->data);//die;
                $start_time = isset($this->request->data['start_time']) ? $this->request->data['start_time'] : '0000-00-00 00:00:00';
                $end_time = isset($this->request->data['end_time']) ? $this->request->data['end_time'] : '0000-00-00 00:00:00';
                $bith_day = isset($this->request->data['birthday']) ? $this->request->data['birthday'] : '0000-00-00 00:00:00';

                $userdata['Profile']['user_id'] = isset($this->request->data['userid']) ? $this->request->data['userid'] : '';
                $userdata['Profile']['screen_name'] = isset($this->request->data['screen_name']) ? $this->request->data['screen_name'] : '';
                $userdata['Profile']['start_time'] = isset($this->request->data['start_time']) ? $this->request->data['start_time'] : '0000-00-00 00:00:00';
                $userdata['Profile']['end_time'] = isset($this->request->data['end_time']) ? $this->request->data['end_time'] : '0000-00-00 00:00:00';
                $userdata['Profile']['profile_name'] = isset($this->request->data['profile_name']) ? $this->request->data['profile_name'] : '';
                $userdata['Profile']['position'] = isset($this->request->data['position']) ? $this->request->data['position'] : '';
                $userdata['Profile']['location'] = isset($this->request->data['location']) ? $this->request->data['location'] : '';
                $userdata['Profile']['identity'] = isset($this->request->data['identity']) ? $this->request->data['identity'] : '';
                $userdata['Profile']['ethnicity'] = isset($this->request->data['ethnicity']) ? $this->request->data['ethnicity'] : '';
                $userdata['Profile']['behaviour'] = isset($this->request->data['behaviour']) ? $this->request->data['behaviour'] : '';
                $userdata['Profile']['latitude'] = isset($this->request->data['latitude']) ? $this->request->data['latitude'] : '';
                $userdata['Profile']['longitude'] = isset($this->request->data['longitude']) ? $this->request->data['longitude'] : '';
                $userdata['Profile']['travel_plans'] = isset($this->request->data['travel_plans']) ? $this->request->data['travel_plans'] : '';
                $userdata['Profile']['orientation'] = isset($this->request->data['orientation']) ? $this->request->data['orientation'] : '';
                $userdata['Profile']['safe_sex'] = isset($this->request->data['safe_sex']) ? $this->request->data['safe_sex'] : '';
                $userdata['Profile']['HIV_status'] = isset($this->request->data['HIV_status']) ? $this->request->data['HIV_status'] : '';
                $userdata['Profile']['cock_size'] = isset($this->request->data['cock_size']) ? $this->request->data['cock_size'] : '';
                $userdata['Profile']['cock_type'] = isset($this->request->data['cock_type']) ? $this->request->data['cock_type'] : '';
                $userdata['Profile']['kinks_and_fetishes'] = isset($this->request->data['kinks_and_fetishes']) ? $this->request->data['kinks_and_fetishes'] : '';
                $userdata['Profile']['birthday'] = isset($this->request->data['birthday']) ? $this->request->data['birthday'] : '';
                $userdata['Profile']['race'] = isset($this->request->data['race']) ? $this->request->data['race'] : '';
                $userdata['Profile']['height'] = isset($this->request->data['height']) ? $this->request->data['height'] : '';
                $userdata['Profile']['weight'] = isset($this->request->data['weight']) ? $this->request->data['weight'] : '';
                $userdata['Profile']['hair_color'] = isset($this->request->data['hair_color']) ? $this->request->data['hair_color'] : '';
                $userdata['Profile']['body_hair'] = isset($this->request->data['body_hair']) ? $this->request->data['body_hair'] : '';
                $userdata['Profile']['facial_hair'] = isset($this->request->data['facial_hair']) ? $this->request->data['facial_hair'] : '';
                $userdata['Profile']['eye_color'] = isset($this->request->data['eye_color']) ? $this->request->data['eye_color'] : '';
                $userdata['Profile']['body_type'] = isset($this->request->data['body_type']) ? $this->request->data['body_type'] : '';
                $userdata['Profile']['drugs'] = isset($this->request->data['drugs']) ? $this->request->data['drugs'] : '';
                $userdata['Profile']['drinking'] = isset($this->request->data['drinking']) ? $this->request->data['drinking'] : '';
                $userdata['Profile']['smoking'] = isset($this->request->data['smoking']) ? $this->request->data['smoking'] : '';
                $userdata['Profile']['about_me'] = isset($this->request->data['about_me']) ? $this->request->data['about_me'] : '';
                $userdata['Profile']['his_identitie'] = isset($this->request->data['his_identitie']) ? $this->request->data['his_identitie'] : '';
                $userdata['Profile']['relationship_status'] = isset($this->request->data['relationship_status']) ? $this->request->data['relationship_status'] : '';
                $userdata['Profile']['where_I_leave'] = isset($this->request->data['where_I_leave']) ? $this->request->data['where_I_leave'] : '';
                $userdata['Profile']['facebook_link'] = isset($this->request->data['facebook_link']) ? $this->request->data['facebook_link'] : '';
                $userdata['Profile']['twitter_link'] = isset($this->request->data['twitter_link']) ? $this->request->data['twitter_link'] : '';
                $userdata['Profile']['linkedin_link'] = isset($this->request->data['linkedin_link']) ? $this->request->data['linkedin_link'] : '';

                //Start checking profile is completed============
                $is_completed = 0;
                foreach ($userdata['Profile'] as $key => $val):
                    if (trim($val) == '') {
                        $is_completed = 1;
                    }
                endforeach;
                $finish = ($is_completed == 0) ? 1 : 0;
                $ret = $this->User->updateAll(array(' User.is_completed ' => $finish), array(' User.id ' => $this->request->data['userid']));
                //end checking profile is completed============

                $userdata['Profile']['start_time'] = $start_time;
                $userdata['Profile']['end_time'] = $end_time;
                $userdata['Profile']['birthday'] = $bith_day;

                $chk = $this->Profile->find('first', array('conditions' => array('Profile.user_id' => $userdata['Profile']['user_id'])));
                if (empty($chk)) {
                    $this->Profile->save($userdata);
                    echo json_encode(array('success' => 1, 'msg' => 'Data has been successfully saved'));
                    exit;
                } else {

                    $userdata['Profile']['id'] = $chk['Profile']['id'];
                    $this->Profile->save($userdata);
                    echo json_encode(array('success' => 1, 'msg' => 'Data has been successfully updated'));
                    exit;
                }
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'error in update'));
            }
        }
        // * END This block for profile upadte and profile create of particular memeber ===========
    }

    // * START Here This block for profile deatails of particular memeber ========================
    public function profile_details() {
        $this->autoRender = false;
        if (isset($this->request->data['userid'])) {
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $user_data = $this->User->find('first', array('conditions' => array('User.id' => $this->request->data['userid'])));
            echo json_encode(array('success' => 1, 'data' => $user_data, 'path' => PIC_PATH));
        } else {
            echo json_encode(array('success' => 0));
        }
        die;
    }

    // * END Here This block for profile deatails of particular memeber ===========================


    public function find_members() {
        $this->autoRender = false;
        // $id = $this->request->data['userid'];
        $con = array();
        if (isset($this->request->data['lat']) && isset($this->request->data['long']) && isset($this->request->data['userid'])) {
            $latitude = $this->request->data['lat'];
            $longitude = $this->request->data['long'];
            $id = $this->request->data['userid'];
            $con = array('conditions' => array('(3958*3.1415926*sqrt((`User.lat` - ' . $latitude . ')*(`User.lat` - ' . $latitude . ') + cos(`User.lat`/57.29578)*cos(' . $latitude . '/57.29578)*(`User.long` - ' . $longitude . ')*(`User.long` - ' . $longitude . '))/180) <= 200',
                    'AND' => array(
                        array('User.id !=' => $id),
                    //array('Like.is_notified' => )
                    )
                ),
                'limit' => 0, 'offset' => 25);
        } else if (isset($this->request->data['userid'])) {
            $id = $this->request->data['userid'];
            $con = array('conditions' => array('User.id !=' => $id
                ),
            );
        }
        $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
        $user_data = $this->User->find('all', $con);
        echo json_encode(array('success' => 1, 'data' => $user_data, 'path' => PIC_PATH));
        die;
    }

    public function partner_profile() {
        $this->autoRender = false;

        if ($this->request->is('post')) {
            if (isset($this->request->data['userid'])) {
                $userdata['User_partner']['user_id'] = isset($this->request->data['userid']) ? $this->request->data['userid'] : '';
                $userdata['User_partner']['sexual_role'] = isset($this->request->data['sexual_role']) ? $this->request->data['sexual_role'] : '';
                $userdata['User_partner']['orientation'] = isset($this->request->data['orientation']) ? $this->request->data['orientation'] : '';
                $userdata['User_partner']['safe_sex'] = isset($this->request->data['safe_sex']) ? $this->request->data['safe_sex'] : '';
                $userdata['User_partner']['HIV_status'] = isset($this->request->data['HIV_status']) ? $this->request->data['HIV_status'] : '';
                $userdata['User_partner']['cock_size'] = isset($this->request->data['cock_size']) ? $this->request->data['cock_size'] : '';
                $userdata['User_partner']['cock_type'] = isset($this->request->data['cock_type']) ? $this->request->data['cock_type'] : '';
                $userdata['User_partner']['kinks_and_fetishes'] = isset($this->request->data['kinks_and_fetishes']) ? $this->request->data['kinks_and_fetishes'] : '';
                $userdata['User_partner']['age_range'] = isset($this->request->data['age_range']) ? $this->request->data['age_range'] : '';
                $userdata['User_partner']['race'] = isset($this->request->data['race']) ? $this->request->data['race'] : '';
                $userdata['User_partner']['height'] = isset($this->request->data['height']) ? $this->request->data['height'] : '';
                $userdata['User_partner']['weight'] = isset($this->request->data['weight']) ? $this->request->data['weight'] : '';
                $userdata['User_partner']['hair_color'] = isset($this->request->data['hair_color']) ? $this->request->data['hair_color'] : '';
                $userdata['User_partner']['body_hair'] = isset($this->request->data['body_hair']) ? $this->request->data['body_hair'] : '';
                $userdata['User_partner']['facial_hair'] = isset($this->request->data['facial_hair']) ? $this->request->data['facial_hair'] : '';
                $userdata['User_partner']['eye_color'] = isset($this->request->data['eye_color']) ? $this->request->data['eye_color'] : '';
                $userdata['User_partner']['body_type'] = isset($this->request->data['body_type']) ? $this->request->data['body_type'] : '';
                $userdata['User_partner']['drugs'] = isset($this->request->data['drugs']) ? $this->request->data['drugs'] : '';
                $userdata['User_partner']['drinking'] = isset($this->request->data['drinking']) ? $this->request->data['drinking'] : '';
                $userdata['User_partner']['smoking'] = isset($this->request->data['smoking']) ? $this->request->data['smoking'] : '';
                $userdata['User_partner']['ethinicity'] = isset($this->request->data['ethinicity']) ? $this->request->data['ethinicity'] : '';
                $userdata['User_partner']['identities'] = isset($this->request->data['identities']) ? $this->request->data['identities'] : '';
                $userdata['User_partner']['position'] = isset($this->request->data['position']) ? $this->request->data['position'] : '';
                $userdata['User_partner']['behaviour'] = isset($this->request->data['behaviour']) ? $this->request->data['behaviour'] : '';
                $userdata['User_partner']['location'] = isset($this->request->data['location']) ? $this->request->data['location'] : '';


                $chk = $this->User_partner->find('first', array('conditions' => array('User_partner.user_id' => $userdata['User_partner']['user_id'])));
                if (empty($chk)) {
                    $this->User_partner->save($userdata);
                    echo json_encode(array('success' => 1, 'msg' => 'Data has been successfully saved'));
                    exit;
                } else {

                    $userdata['User_partner']['id'] = $chk['User_partner']['id'];
                    $this->User_partner->save($userdata);
                    echo json_encode(array('success' => 1, 'msg' => 'Data has been successfully updated'));
                    exit;
                }
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'error in update'));
            }
        }
    }

    // START here,  this function will be work for member profile picture upload/update and album picture upload ============
    public function profile_picture($type = 'profile_pic') {
        $this->autoRender = false;
        //pr($this->request->form['pic']['tmp_name']);
        //die;
        $resize = true;
        $resizeOptions = array('width' => '250', 'height' => '200', 'destination' => 'profile_pic/thumb/');
        $file = $this->request->form['pic'];
        $rootPath = WWW_ROOT;
        $destination = 'profile_pic/';

        if (!$file || !is_array($file)) {
            return false;
        }

        $userId = $this->request->data['userid'];

        if ($type == 'profile_pic') {  // this block for profile picture when user will be upload his profile picture.
            $profileData = $this->User->find('first', array('conditions' => array('User.id' => $userId), 'fields' => array('id', 'profile_pic')));
            if (!empty($profileData['User']['profile_pic'])) {
                @unlink($rootPath . 'profile_pic/' . $profileData['User']['profile_pic']);
                @unlink($rootPath . 'profile_pic/thumb/' . $profileData['User']['profile_pic']);
            }
        }


        $data = array();
        $data['file'] = $file;
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
            if ($type == 'profile_pic') {
                $ret = $this->User->updateAll(array(' User.profile_pic ' => "'$imageName'"), array(' User.id ' => $userId));
                echo json_encode(array('success' => 1, 'msg' => 'profile picture has been successfully uploaded', 'path' => PIC_PATH));
                exit;
            } else {
                $caption = isset($this->request->data['caption']) ? $this->request->data['caption'] : '';
                $album_data['User_album']['user_id'] = $userId;
                $album_data['User_album']['photo_name'] = $imageName;
                $album_data['User_album']['caption'] = $caption;
                // $album_data['User_album']['album_id'] = $this->request->data['album_id'];
                ;
                $ret = $this->User_album->save($album_data);
                echo json_encode(array('success' => 1, 'msg' => 'picture has been successfully uploaded', 'path' => PIC_PATH));
                exit;
            }
        }
    }

    // End here,  this function will be work for member profile picture upload/update and album picture upload ============


    public function member_album() {
        $this->autoRender = false;
        if (isset($this->request->data['userid'])) {
            $arr = array();
            $album = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $this->request->data['userid'])));
            foreach ($album as $data) {
                $arr[] = $data['User_album'];
            }
            echo json_encode(array('success' => 1, 'data' => $arr, 'path' => PIC_PATH));
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'user id not found'));
        }
        exit;
    }

    /*     * ******** rename caption album images **************** */

    public function rename_caption_album_image() {
        $this->autoRender = false;
        if (isset($this->request->data['pic_id'])) {
            $arr = array();
            $album = $this->User_album->findById($this->request->data['pic_id']);
            if ($album) {
                $album_data['User_album']['id'] = $this->request->data['pic_id'];
                $album_data['User_album']['caption'] = $this->request->data['caption'];
                $ret = $this->User_album->save($album_data);
                echo json_encode(array('success' => 1, 'msg' => 'successfully rename caption'));
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'id not found in database'));
            }
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'user id not found'));
        }
        exit;
    }

    public function user_block($type = null) {
        $this->autoRender = false;
        if (isset($this->request->data['userid']) && isset($this->request->data['blockid'])) {
            if ($type == 'unblock') {
                $this->Blocked_user->deleteAll(array('Blocked_user.user_id' => $this->request->data['userid'], 'Blocked_user.blocked_id' => $this->request->data['blockid']));
                pr($this->Blocked_user->getDataSource()->getLog());
                echo json_encode(array('success' => 1, 'msg' => 'user has been successfully un-blocked'));
                exit;
            }

            $chk = $this->Blocked_user->find('all', array('conditions' => array('Blocked_user.user_id' => $this->request->data['userid'], 'AND ' => array('Blocked_user.blocked_id' => $this->request->data['blockid']))));
            if (empty($chk)) {
                $data['Blocked_user']['user_id'] = $this->request->data['userid'];
                $data['Blocked_user']['blocked_id'] = $this->request->data['blockid'];
                $this->Blocked_user->save($data);
                echo json_encode(array('success' => 1, 'msg' => 'user has been successfully blocked'));
                exit;
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'already blocked'));
                exit;
            }
        }
    }

    public function delete_album_picture() {
        $this->autoRender = false;
        $picid = $this->request->data['pic_id'];
        if (isset($picid)) {
            /*             * ****** for multiple delete picture ******* */
            $arrid = explode(',', $picid);
            ///pr($arrid);
            foreach ($arrid as $key => $value) {
                $chk = $this->User_album->findAllById($value);
                if ($chk) {
                    if (!empty($chk[0]['User_album']['photo_name'])) {
                        @unlink($rootPath . 'profile_pic/' . $chk[0]['User_album']['photo_name']);
                        @unlink($rootPath . 'profile_pic/thumb/' . $chk[0]['User_album']['photo_name']);
                    }
                    $this->User_album->delete($value);
                    echo json_encode(array('success' => 1, 'msg' => 'picture has been successful deleted'));
                    //exit;
                } else {
                    echo json_encode(array('success' => 0, 'msg' => 'no data found in this id'));
                }
            }
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'picture id not found'));
        }
    }

    public function matches_members() {
        $this->autoRender = false;

        $con = array();
        if (isset($this->request->data['userid']) && $this->request->data['userid'] != '') {

            $user_data = $this->User->find('all', array('conditions' => array('User.id' => $this->request->data['userid'])));
            $block_id = $this->user_blockedId($user_data[0]['BlockedUser']);
            array_push($block_id, $this->request->data['userid']);

            $matches_data = $this->User->find('all', array('conditions' => array(
                    'NOT' => array('User.id' => $block_id),
                    'OR' => array(
                        array('UserPartner.sexual_role' => $user_data[0]['UserPartner']['sexual_role'])
                    )
            )));


            //pr($this->User->getDataSource()->getLog());
            //die;
            //pr($matches_data);
            echo json_encode(array('success' => 1, 'data' => $matches_data, 'path' => PIC_PATH));
            die;
        }
    }

    public function user_blockedId($arr) {
        $this->autoRender = false;

        $block_id = array();
        foreach ($arr as $blockedId) {
            array_push($block_id, $blockedId['blocked_id']);
        }
        return $block_id;
    }

    public function registration() {
        $this->autoRender = false;
//        $r = fopen('../../app/webroot/tracker3.txt', 'a+');
//
//        fwrite($r, 'Time: ' . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL . 'ip address:' . $_SERVER['REMOTE_ADDR']);
//        foreach ($this->request->data as $k => $v) {
//
//            fwrite($r, $k . ' : ' . $v . PHP_EOL . PHP_EOL);
//        }

        if ($this->request->is('post')) {

            $name = isset($this->request->data['username']) ? $this->request->data['username'] : '';
            $email = isset($this->request->data['email']) ? $this->request->data['email'] : '';
            $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
            $country = isset($this->request->data['country']) ? $this->request->data['country'] : '';
            $city = isset($this->request->data['city']) ? $this->request->data['city'] : '';
            $lat = isset($this->request->data['lat']) ? $this->request->data['lat'] : '';
            $long = isset($this->request->data['long']) ? $this->request->data['long'] : '';
            $device_token = isset($this->request->data['device_token']) ? $this->request->data['device_token'] : '';
            $device_type = isset($this->request->data['device_type']) ? $this->request->data['device_type'] : '';

            $chk = $this->User->find('first', array('conditions' => array('User.email' => $email)));
            if (empty($chk)) {
                $userdata['User']['token'] = $this->generateRandomString('upper-alphanumaric', 5);
                $userdata['User']['username'] = $name;
                $userdata['User']['email'] = $email;
                $userdata['User']['password'] = $password;
                $userdata['User']['country'] = $country;
                $userdata['User']['lat'] = $lat;
                $userdata['User']['long'] = $long;
                $userdata['User']['status'] = 1;
                $userdata['User']['profile_status'] = 1;
                $userdata['User']['device_token'] = $device_token;
                $userdata['User']['device_type'] = $device_type;
                $userdata['User']['creation_date'] = date('Y-m-d H:i:s');

                $this->User->save($userdata);
                /*                 * **** send user id after registration ******** */
                $userdata['User']['id'] = $this->User->getLastInsertId();
                /*                 * ******** end ************* */
                $user['Profile']['user_id'] = $this->User->getLastInsertId();
                $user['User_partner']['user_id'] = $this->User->getLastInsertId();
                $user['User_album']['user_id'] = $this->User->getLastInsertId();
                $this->Profile->create();
                $this->Profile->save($user);
                $this->User_partner->create();
                $this->User_partner->save($user);
                //$this->User_album->create();
                //$this->User_album->save($user);
                echo json_encode(array('success' => 1, 'msg' => 'regtration successful', 'response_data' => $userdata));
                exit;
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'email id already exist'));
                exit;
            }
        }
    }

    public function login() {
        //pr(PIC_PATH);
        //pr($_SERVER);

        $this->autoRender = false;
        //$passwordHasher = new SimplePasswordHasher();
        //echo $passwordHasher->hash('ramesh');	             
        $this->Auth->authenticate = array(
            AuthComponent::ALL => array('userModel' => 'User'),
            'Form' => array('fields' => array('username' => 'email'), 'scope' => array('User.status' => 1)),
            'Basic'
        );

        if ($this->request->is('post')) {
            $userdata = $this->request->data;
            unset($this->request->data['email']);
            unset($this->request->data['password']);
            $this->request->data['User']['email'] = $userdata['email'];
            $this->request->data['User']['password'] = $userdata['password'];

            if ($this->Auth->login()) {
                echo json_encode(array('success' => 1, 'msg' => 'succefully logged in', 'user_data' => $this->Session->read('Auth.User'), 'path' => PIC_PATH));
                $this->Auth->logout();
                exit;
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'username or password is invalid'));
                exit;
            }
        }
    }

    public function logout() {
        $this->Session->setFlash('You have successfully logout !!!', 'default', array('class' => 'success'), 'msg');
        return $this->redirect($this->Auth->logout());
    }

    /*     * ****** this service use for create album --- Mir ---********* */

    /*    public function create_album() {
      $this->autoRender = false;
      if (isset($this->request->data['user_id']) && isset($this->request->data['album_name'])) {
      $userid = $this->request->data['user_id'];
      $album_name = $this->request->data['album_name'];
      $user['UserCreatealbum']['user_id'] = $userid;
      $user['UserCreatealbum']['album_name'] = $album_name;
      $user['UserCreatealbum']['creation_date'] = date('Y-m-d h:i:s');
      $this->UserCreatealbum->create();
      $this->UserCreatealbum->save($user);
      echo json_encode(array('success' => 1, 'msg' => 'successfully create album'));
      exit;
      } else {
      echo json_encode(array('success' => 0, 'msg' => 'fail to create album'));
      exit;
      }
      }

      /*     * ****** this service use for show album --- Mir ---******** */

    /*  public function show_album() {
      $this->autoRender = false;
      if (isset($this->request->data['user_id'])) {
      $userid = $this->request->data['user_id'];
      // echo 1;die;
      $this->UserCreatealbum->bindModel(
      array(
      'hasMany' => array(
      'User_album' => array(
      'className' => 'User_album',
      'foreignKey' => 'album_id',
      //'conditions' => array('NpoMember.status' => 'Active'),
      )
      )
      )
      );
      $data = $this->UserCreatealbum->find('all', array('conditions' => array('UserCreatealbum.user_id' => $userid)));
      echo json_encode(array('success' => 1, 'msg' => 'successfully show album', 'data' => $data, 'path' => PIC_PATH));
      exit;
      } else {
      echo json_encode(array('success' => 0, 'msg' => 'fail to show album'));
      exit;
      }
      }
      /* * ****** this service use for delete album  13022015 --- Mir ---******** */
    /* public function delete_album() {
      $this->autoRender = false;
      $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
      $album_id = isset($this->request->data['album_id']) ? $this->request->data['album_id'] : '';
      if (isset($user_id) && isset($album_id)) {
      $chk = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $user_id, 'User_album.album_id' => $album_id)));
      //pr($chk);die;
      foreach($chk as $useralbum) {
      // pr($useralbum['User_album']['photo_name']);

      if (!empty($useralbum['User_album']['photo_name'])) {
      @unlink($rootPath . 'profile_pic/' . $useralbum['User_album']['photo_name']);
      @unlink($rootPath . 'profile_pic/thumb/' . $useralbum['User_album']['photo_name']);
      $this->User_album->delete($useralbum['User_album']['id']);
      }
      }
      $this->UserCreatealbum->delete($album_id);
      echo json_encode(array('success' => 1, 'msg' => 'album has been successful deleted'));

      }
      else {
      echo json_encode(array('success' => 0, 'msg' => 'unable to deleted '));
      }
      }

      /*     * ****** this service use for add looking sex data 11022015 --- Mir ---******** */

    public function add_looking_sex() {

        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $start_time = isset($this->request->data['start_time']) ? $this->request->data['start_time'] : '0000-00-00 00:00:00';
        $end_time = isset($this->request->data['end_time']) ? $this->request->data['end_time'] : '0000-00-00 00:00:00';
        $profile_name = isset($this->request->data['profile_name']) ? $this->request->data['profile_name'] : '';
        $my_physical_appearance = isset($this->request->data['my_physical_appearance']) ? $this->request->data['my_physical_appearance'] : '';
        $his_physical_appearance = isset($this->request->data['his_physical_appearance']) ? $this->request->data['his_physical_appearance'] : '';
        $my_sextual_preferences = isset($this->request->data['my_sextual_preferences']) ? $this->request->data['my_sextual_preferences'] : '';
        $his_sextual_preferences = isset($this->request->data['his_sextual_preferences']) ? $this->request->data['his_sextual_preferences'] : '';
        $my_social_habits = isset($this->request->data['my_social_habits']) ? $this->request->data['my_social_habits'] : '';
        $his_social_habits = isset($this->request->data['his_social_habits']) ? $this->request->data['his_social_habits'] : '';
        $type = isset($this->request->data['type']) ? $this->request->data['type'] : '';
        if ($user_id && $profile_name) {
            /* check if profile name already exists then update sex profile  else in sert sex profile */
            $looksex = $this->UserLooksex->find('all', array('conditions' => array('UserLooksex.user_id' => $user_id, 'UserLooksex.profile_name' => $profile_name)));
            //pr($looksex[0]['UserLooksex']);die;
            if ($looksex) {
                if ($type == '') {
                    $data['success'] = 2;
                    $data['msg'] = 'profile name already exists';
                } else {
                    $update_userlooks = $this->UserLooksex->updateAll(array(' UserLooksex.is_active ' => 0), array(' UserLooksex.user_id ' => $user_id));
                    $user['UserLooksex'] = array(
                        'id' => $looksex[0]['UserLooksex']['id'],
                        'user_id' => $user_id,
                        'profile_name' => $profile_name,
                        'my_physical_appearance' => addslashes($my_physical_appearance),
                        'his_physical_appearance' => addslashes($his_physical_appearance),
                        'my_sextual_preferences' => addslashes($my_sextual_preferences),
                        'his_sextual_preferences' => addslashes($his_sextual_preferences),
                        'my_social_habits' => addslashes($my_social_habits),
                        'his_social_habits' => addslashes($his_social_habits),
                        'start_time' => date('Y-m-d H:i:s', strtotime($start_time)),
                        'end_time' => date('Y-m-d H:i:s', strtotime($end_time)),
                        'is_active' => 1,
                        'modification_date' => date('Y-m-d H:i:s')
                    );
                    if ($this->UserLooksex->save($user)) {
                        $data['success'] = 1;
                        $data['msg'] = 'success';
                        $data['id'] = $user['UserLooksex']['id'];
                    } else {
                        $data['success'] = 0;
                        $data['msg'] = 'failure';
                    }
                }
            } else {
                //pr($this->UserLooksex->getDataSource()->getLog(true));die;
                $update_userlooks = $this->UserLooksex->updateAll(array(' UserLooksex.is_active ' => 0), array(' UserLooksex.user_id ' => $user_id));
                $user['UserLooksex'] = array(
                    'user_id' => $user_id,
                    'profile_name' => $profile_name,
                    'my_physical_appearance' => addslashes($my_physical_appearance),
                    'his_physical_appearance' => addslashes($his_physical_appearance),
                    'my_sextual_preferences' => addslashes($my_sextual_preferences),
                    'his_sextual_preferences' => addslashes($his_sextual_preferences),
                    'my_social_habits' => addslashes($my_social_habits),
                    'his_social_habits' => addslashes($his_social_habits),
                    'start_time' => date('Y-m-d H:i:s', strtotime($start_time)),
                    'end_time' => date('Y-m-d H:i:s', strtotime($end_time)),
                    'is_active' => 1,
                    'creation_date' => date('Y-m-d H:i:s')
                );
                if ($this->UserLooksex->save($user)) {
                    $UserLooksexId = $this->UserLooksex->getLastInsertId();
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                    $data['id'] = $UserLooksexId;
                } else {
                    $data['success'] = 0;
                    $data['msg'] = 'failure';
                }
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id and profile name should not be blank';
        }
        echo json_encode($data);
    }

    /*     * *****************End**************************** */

    /*     * ****** this service use for view looking sex data 11022015 --- Mir ---******** */

    public function view_looking_sex() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id) {
            $userlooksex = $this->UserLooksex->find('all', array('conditions' => array('UserLooksex.user_id' => $user_id)));
            // pr($userlooksex);
            foreach ($userlooksex as $key => $value) {
                $userlooksex[$key]['UserLooksex']['my_physical_appearance'] = stripslashes($value['UserLooksex']['my_physical_appearance']);
                $userlooksex[$key]['UserLooksex']['his_physical_appearance'] = stripslashes($value['UserLooksex']['his_physical_appearance']);
                $userlooksex[$key]['UserLooksex']['my_sextual_preferences'] = stripslashes($value['UserLooksex']['my_sextual_preferences']);
                $userlooksex[$key]['UserLooksex']['his_sextual_preferences'] = stripslashes($value['UserLooksex']['his_sextual_preferences']);
                $userlooksex[$key]['UserLooksex']['my_social_habits'] = stripslashes($value['UserLooksex']['my_social_habits']);
                $userlooksex[$key]['UserLooksex']['his_social_habits'] = stripslashes($value['UserLooksex']['his_social_habits']);
            }
            if ($userlooksex) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['data'] = Hash::extract($userlooksex, '{n}.UserLooksex');
            } else {
                $data['success'] = 0;
                $data['msg'] = 'failure';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id not found';
        }
        echo json_encode($data);
    }

    /*     * *****************End**************************** */
    /*     * ****** this service use for view looking date data 11022015 --- Mir ---******** */

    public function view_looking_date() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id) {
            $UserLookdate = $this->UserLookdate->find('all', array('conditions' => array('UserLookdate.user_id' => $user_id)));
            foreach ($UserLookdate as $key => $value) {
                $UserLookdate[$key]['UserLookdate']['my_traits'] = stripslashes($value['UserLookdate']['my_traits']);
                $UserLookdate[$key]['UserLookdate']['his_traits'] = stripslashes($value['UserLookdate']['his_traits']);
                $UserLookdate[$key]['UserLookdate']['my_interest'] = stripslashes($value['UserLookdate']['my_interest']);
                $UserLookdate[$key]['UserLookdate']['my_physical_appearance'] = stripslashes($value['UserLookdate']['my_physical_appearance']);
                $UserLookdate[$key]['UserLookdate']['his_physical_appearance'] = stripslashes($value['UserLookdate']['his_physical_appearance']);
                $UserLookdate[$key]['UserLookdate']['my_sextual_preferences'] = stripslashes($value['UserLookdate']['my_sextual_preferences']);
                $UserLookdate[$key]['UserLookdate']['his_sextual_preferences'] = stripslashes($value['UserLookdate']['his_sextual_preferences']);
                $UserLookdate[$key]['UserLookdate']['my_social_habits'] = stripslashes($value['UserLookdate']['my_social_habits']);
                $UserLookdate[$key]['UserLookdate']['his_social_habits'] = stripslashes($value['UserLookdate']['his_social_habits']);
            }
            if ($UserLookdate) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['data'] = Hash::extract($UserLookdate, '{n}.UserLookdate');
            } else {
                $data['success'] = 0;
                $data['msg'] = 'failure';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id not found';
        }
        echo json_encode($data);
    }

    /*     * *****************End**************************** */
    /*     * ****** this service use for add looking date data 11022015 --- Mir ---******** */

    public function add_looking_date() {

        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $my_traits = isset($this->request->data['my_traits']) ? $this->request->data['my_traits'] : '';
        $his_traits = isset($this->request->data['his_traits']) ? $this->request->data['his_traits'] : '';
        $profile_name = isset($this->request->data['profile_name']) ? $this->request->data['profile_name'] : '';
        $my_interest = isset($this->request->data['my_interest']) ? $this->request->data['my_interest'] : '';
        $my_physical_appearance = isset($this->request->data['my_physical_appearance']) ? $this->request->data['my_physical_appearance'] : '';
        $his_physical_appearance = isset($this->request->data['his_physical_appearance']) ? $this->request->data['his_physical_appearance'] : '';
        $my_sextual_preferences = isset($this->request->data['my_sextual_preferences']) ? $this->request->data['my_sextual_preferences'] : '';
        $his_sextual_preferences = isset($this->request->data['his_sextual_preferences']) ? $this->request->data['his_sextual_preferences'] : '';
        $my_social_habits = isset($this->request->data['my_social_habits']) ? $this->request->data['my_social_habits'] : '';
        $his_social_habits = isset($this->request->data['his_social_habits']) ? $this->request->data['his_social_habits'] : '';
        $type = isset($this->request->data['type']) ? $this->request->data['type'] : '';
        if ($user_id) {
            /* check if profile name already exists then update sex profile  else in sert sex profile */
            $lookdate = $this->UserLookdate->find('all', array('conditions' => array('UserLookdate.user_id' => $user_id)));
            //pr($looksex[0]['UserLooksex']);die;
            if ($lookdate) {
                if ($type == '') {
                    $data['success'] = 2;
                    $data['msg'] = 'profile already exists';
                } else {
                    $user['UserLookdate'] = array(
                        'id' => $lookdate[0]['UserLookdate']['id'],
                        'user_id' => $user_id,
                        'profile_name' => $profile_name,
                        'my_traits' => addslashes($my_traits),
                        'his_traits' => addslashes($his_traits),
                        'my_interest' => addslashes($my_interest),
                        'my_physical_appearance' => addslashes($my_physical_appearance),
                        'his_physical_appearance' => addslashes($his_physical_appearance),
                        'my_sextual_preferences' => addslashes($my_sextual_preferences),
                        'his_sextual_preferences' => addslashes($his_sextual_preferences),
                        'my_social_habits' => addslashes($my_social_habits),
                        'his_social_habits' => addslashes($his_social_habits),
                        'is_active' => 1,
                        'modification_date' => date('Y-m-d H:i:s')
                    );
                    if ($this->UserLookdate->save($user)) {
                        $data['success'] = 1;
                        $data['msg'] = 'success';
                        $data['id'] = $user['UserLookdate']['id'];
                    } else {
                        $data['success'] = 0;
                        $data['msg'] = 'failure';
                    }
                }
                //echo $my_physical_appearance;die;
            } else {
                //pr($this->UserLooksex->getDataSource()->getLog(true));die;
                $user['UserLookdate'] = array(
                    'user_id' => $user_id,
                    'profile_name' => $profile_name,
                    'my_traits' => addslashes($my_traits),
                    'his_traits' => addslashes($his_traits),
                    'my_interest' => addslashes($my_interest),
                    'my_physical_appearance' => addslashes($my_physical_appearance),
                    'his_physical_appearance' => addslashes($his_physical_appearance),
                    'my_sextual_preferences' => addslashes($my_sextual_preferences),
                    'his_sextual_preferences' => addslashes($his_sextual_preferences),
                    'my_social_habits' => addslashes($my_social_habits),
                    'his_social_habits' => addslashes($his_social_habits),
                    'is_active' => 1,
                    'creation_date' => date('Y-m-d H:i:s')
                );
                // pr($user);die;
                if ($this->UserLookdate->save($user)) {
                    $UserLookdateId = $this->UserLookdate->getLastInsertId();
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                    $data['id'] = $UserLookdateId;
                } else {
                    $data['success'] = 0;
                    $data['msg'] = 'failure';
                }
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id not found';
        }
        echo json_encode($data);
    }

    /*     * *****************End**************************** */
    /*     * ****** this service use for move image to archive 13022015 --- Mir ---******** */

    public function move_archive() {

        $this->autoRender = false;
        $picid = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id && $picid) {
            $arrpicid = explode(',', $picid);
            foreach ($arrpicid as $key => $value) {
                $UserArchive = $this->User_album->findById($value);
                if ($UserArchive) {
                    $photoname = $UserArchive['User_album']['photo_name'];
                    $caption = $UserArchive['User_album']['caption'];
                    $user['Archive'] = array(
                        'user_id' => $user_id,
                        'photo_name' => $photoname,
                        'caption' => $caption,
                        'creation_date' => date('Y-m-d H:i:s')
                    );
                    $this->Archive->create();
                    if ($this->Archive->save($user)) {
                        $this->User_album->delete($value);
                        $data['success'] = 1;
                        $data['msg'] = 'success';
                    } else {
                        $data['success'] = 0;
                        $data['msg'] = 'failure';
                    }
                }
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id and pic id not found';
        }
        echo json_encode($data);
    }

    /*     * ********************* END************************************ */
    /*     * ****** this service use for view archive  data 13022015 --- Mir ---******** */

    public function view_archive() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id) {
            $archive = $this->Archive->find('all', array('conditions' => array('Archive.user_id' => $user_id)));
            if ($archive) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['data'] = Hash::extract($archive, '{n}.Archive');
                $data['path'] = PIC_PATH;
            } else {
                $data['success'] = 0;
                $data['msg'] = 'no data found';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id not found';
        }
        echo json_encode($data);
    }

    /*     * *****************End**************************** */
    /*     * ****** this service use for delete archive  data 13022015 --- Mir ---******** */

    public function delete_archive() {
        $this->autoRender = false;
        $id = $this->request->data['id']; //'1,2,3,4';

        if (isset($id)) {
            $arrid = explode(',', $id);
            //pr($arrid);die;
            foreach ($arrid as $key => $value) {
                //echo $value;

                $chk = $this->Archive->findAllById($value);
                if ($chk) {
                    if (!empty($chk[0]['Archive']['photo_name'])) {
                        @unlink($rootPath . 'profile_pic/' . $chk[0]['Archive']['photo_name']);
                        @unlink($rootPath . 'profile_pic/thumb/' . $chk[0]['Archive']['photo_name']);
                    }
                    $this->Archive->delete($value);
                }
            }
            echo json_encode(array('success' => 1, 'msg' => 'picture has been successful deleted'));
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'id not found'));
        }
    }

    /*     * *****************End**************************** */
    /*     * ****** this service use for share album  data 13022015 --- Mir ---******** */

    public function share_album() {
        $this->autoRender = false;
        $sender_id = isset($this->request->data['sender_id']) ? $this->request->data['sender_id'] : ''; //this is current user
        $receiver_id = isset($this->request->data['receiver_id']) ? $this->request->data['receiver_id'] : ''; // who receive album
        if ($sender_id && $receiver_id) {
            $sharealbum = $this->ShareAlbum->find('first', array('conditions' => array('ShareAlbum.sender_id' => $sender_id, 'ShareAlbum.receiver_id' => $receiver_id)));
            if ($sharealbum) {
                /*                 * ***** if is_received=1 then set is_received=2 means unshare and if  is_received=2 then set is_received=1 means share*** */
                if ($sharealbum['ShareAlbum']['is_received'] == 1) {
                    $is_received = 2;
                } else {
                    $is_received = 1;
                }
                /*                 * *********** unshare album access ************ */
                $user['ShareAlbum'] = array(
                    'id' => $sharealbum['ShareAlbum']['id'],
                    'sender_id' => $sender_id,
                    'receiver_id' => $receiver_id,
                    'is_received' => $is_received,
                    'modification_date' => date('Y-m-d H:i:s')
                );
                // pr($sharealbum);
                $data['success'] = 2;
                $data['msg'] = 'already share album';
            } else {
                $is_received = 1;
                /*                 * *********** share album access ************ */
                $user['ShareAlbum'] = array(
                    //'id' => $sharealbum[0]['ShareAlbum']['id'],
                    'sender_id' => $sender_id,
                    'receiver_id' => $receiver_id,
                    'is_received' => $is_received,
                    'creation_date' => date('Y-m-d H:i:s')
                );
            }
            if ($this->ShareAlbum->save($user)) {
                /*                 * ****** get user name for push notification ************ */

                $username = $this->User->findById($sender_id);
                /*                 * ************* END ******************** */
                /*                 * ***** for push notification **************** */
                $userdetails = $this->User->findById($receiver_id);
                if ($userdetails) {
                    $device_type = $userdetails['User']['device_type'];
                    $device_token = $userdetails['User']['device_token'];
                    // pr($device_token);
                    /*                     * ********* send notification for android ************* */
                    if ($device_type == 'android') {
                        if ($is_received == 1) {
                            $device_token = array($device_token);
                            $msg = $username['User']['username'] . ' share album with you';
                            $message = array("msg" => $msg, 'sound' => 'default');
                            $this->GCM->send_notification($device_token, $message);
                            //$result = $gcm->send_notification($device_ids, $message);
                        }
                    } else {
                        //echo $is_received;
                        if ($is_received == 1) {
                            /*                             * ********* send notification for ios ************* */
                            $pemfile = WWW_ROOT . 'files/looking.pem';
                            $passphrase = 'looking';
                            $msg = $username['User']['username'] . ' share album with you';
                            $ctx = stream_context_create();
                            stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfile);
                            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                            // Open a connection to the APNS server
                            $fp = stream_socket_client(
                                    'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                            if (!$fp)
                                exit("Failed to connect: $err $errstr" . PHP_EOL);
                            $body['aps'] = array(
                                'alert' => $msg,
                                'count_unread_msg' => 1,
                                //'post_tag' => $post_tag,
                                //'job_id' => $job_id,
                                //'msg_id' => $msg_id,
                                //'unread_msg_count' => $msg_unread_count,
                                // 'msg_sender_id' => $msg_sender_id,
                                //'msg_sender_name' => $msg_sender_name,
                                // 'group_id' => $group_id,
                                //'group_name' => $group_name,
                                'sound' => 'default'
                            );
                           // pr(json_encode($body));

                            // Encode the payload as JSON
                            $payload = json_encode($body);

                            // Build the binary notification
                            $msg = chr(0) . pack('n', 32) . pack('H*', $device_token) . pack('n', strlen($payload)) . $payload;

                            // Send it to the server
                            $result = fwrite($fp, $msg, strlen($msg));
                            //echo $result;
                            $json = array();
//                        if (!$result) {
//                            $json = array('success' => '0', 'success_message' => 'Message not delivered');
//                        } else {
//                            $json = array('success' => '1', 'success_message' => 'Message successfully delivered');
//                        }
                            // Close the connection to the server
                            fclose($fp);
                            //return json_encode($json);
                        }
                    }
                }
                $data['success'] = 1;
                $data['msg'] = 'success';
                //echo json_encode(array('success' => 1, 'msg' => 'success'));
            } else {
                $data['success'] = 3;
                $data['msg'] = 'unable to save database';
                //echo json_encode(array('success' => 2, 'msg' => 'unable to save database'));
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'sender id or receiver id not found';
            //echo json_encode(array('success' => 0, 'msg' => 'sener id and receiver id not found'));
        }
        echo json_encode($data);
    }

    /*     * *****************End**************************** */
    /*     * ****** this service use for view who share album  data 16022015 --- Mir ---******** */

//    public function view_share_album() {
//        $this->autoRender = false;
//        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; // who receive album
//        if ($user_id) {
//
//            $option['fields'] = array('User.*', 'ShareAlbum.*');
//            $option['joins'] = array(array('table' => 'users',
//                    'alias' => 'User',
//                    'type' => 'INNER',
//                    'conditions' => array('User.id = ShareAlbum.sender_id')));
//            $option['conditions'] = array('ShareAlbum.is_received' => 0, 'ShareAlbum.receiver_id' => $user_id);
//
//            $sharealbum = $this->ShareAlbum->find('all', $option);
//
//            if ($sharealbum) {
//                $data['success'] = 1;
//                $data['msg'] = 'success';
//                $data['data'] = Hash::extract($sharealbum, '{n}.User');
//                $data['path'] = PIC_PATH;
//            } else {
//                $data['success'] = 0;
//                $data['msg'] = 'no data found';
//            }
//            ///pr($sharealbum);
//            //pr($this->ShareAlbum->getDataSource()->getLog(true));
//
//            echo json_encode($data);
//        } else {
//            echo json_encode(array('success' => 0, 'msg' => 'user id not found'));
//        }
//    }

    /*     * *****************End**************************** */
    /*     * ****** this service use for receive album  data 13022015 --- Mir ---******** */

//    public function receive_album() {
//        $this->autoRender = false;
//        $sender_id = isset($this->request->data['sender_id']) ? $this->request->data['sender_id'] : ''; //who send album
//        $receiver_id = isset($this->request->data['receiver_id']) ? $this->request->data['receiver_id'] : ''; // who receive album (this is user_id)
//        $is_received = isset($this->request->data['is_received']) ? $this->request->data['is_received'] : '';
//        if ($sender_id && $receiver_id) {
//            /*             * *********** update notification is file received or not *********** */
//            $this->ShareAlbum->query("UPDATE `share_albums` SET `is_received` = '" . $is_received . "' WHERE `sender_id` ='" . $sender_id . "' and `receiver_id`='" . $receiver_id . "'");
//            /*             * *********** END update notification is file received or not *********** */
//            /*             * ***** Check if is received ==1(accept) then copy image ************* */
////            if ($is_received == 1) {
////                $sharealbum = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $sender_id)));
////                $resize = true;
////                $resizeOptions = array('width' => '250', 'height' => '200', 'destination' => 'receive_album/thumb/');
////                //$file = $this->request->form['pic'];
////
////                $rootPath = WWW_ROOT;
////                $destination = 'profile_pic/';
////
////                foreach ($sharealbum as $receivealbum) {
////                    /*                     * ******* copy image file user album to receive album ********** */
////                    $file = $rootPath . $destination . $receivealbum['User_album']['photo_name'];
////                    $newfile = $rootPath . 'receive_album/' . $receivealbum['User_album']['photo_name'];
////                    copy($file, $newfile);
////
////                    if ($resize && count($resizeOptions) > 0) {
////                        $data = array();
////                        $data['file'] = $rootPath . $destination . $receivealbum['User_album']['photo_name'];
////                        $data['width'] = ($resizeOptions['width']) ? $resizeOptions['width'] : 100;
////                        $data['height'] = ($resizeOptions['height']) ? $resizeOptions['height'] : 100;
////                        $destinationThumb = ($resizeOptions['destination']) ? $resizeOptions['destination'] : $destination;
////                        $data['output'] = $rootPath . $destinationThumb;
////                        $data['proportional'] = TRUE;
////                        $this->Qimage->resize($data);
////                    }
////                    $user['ReceiveAlbum'] = array(
////                        'sender_id' => $sender_id,
////                        'receiver_id' => $receiver_id,
////                        'photo_name' => $receivealbum['User_album']['photo_name'],
////                        'creation_date' => date('Y-m-d h:i:s')
////                    );
////
////                    $this->ReceiveAlbum->create();
////                    $this->ReceiveAlbum->save($user);
////                }
//////pr($this->ReceiveAlbum->getDataSource()->getLog());
////                // pr($sharealbum);
////            }
//            /*             * ***** END Check if is received ==1(accept) then copy image ************* */
//
//            echo json_encode(array('success' => 1, 'msg' => 'success'));
//        } else {
//            echo json_encode(array('success' => 0, 'msg' => 'sender id and receiver id not found'));
//        }
//    }

    /*     * *****************End**************************** */
    /*     * ****** this service use for view receive album  data 13022015 --- Mir ---******** */

    public function view_receive_album() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; // who receive album

        if ($user_id) {
            $option['fields'] = array('User.*', 'Profile.*', 'ShareAlbum.*');
            $option['joins'] = array(
                array('table' => 'share_albums',
                    'alias' => 'ShareAlbum',
                    'type' => 'INNER',
                    'conditions' => array('User.id = ShareAlbum.sender_id')
            ));
            $option['conditions'] = array('ShareAlbum.receiver_id' => $user_id, 'ShareAlbum.is_received' => 1);
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $receivealbum = $this->User->find('all', $option);
            /*             * *** show user with album  test purpose*********** */
//            $option1['fields'] = array('User.*', 'ShareAlbum.*','User_album.*');
//            $option1['joins'] = array(
//                array('table' => 'share_albums',
//                    'alias' => 'ShareAlbum',
//                    'type' => 'INNER',
//                    'conditions' => array('User.id = ShareAlbum.sender_id')
//            ),
//                array('table' => 'user_albums',
//                    'alias' => 'User_album',
//                    'type' => 'RIGHT',
//                    'conditions' => array('User.id = User_album.user_id')
//            )
//                
//                );
//            $option1['conditions'] = array('ShareAlbum.receiver_id' => $user_id, 'ShareAlbum.is_received' => 1);
//            $this->User->unBindModel(array('hasOne' => array('Profile','UserPartner')));
//            $this->User->unBindModel(array('hasMany' => array('BlockedUser')));
//            $receivealbum1 = $this->User->find('all',$option1);
//            pr($receivealbum1);
//            
//            $log = $this->User->getDataSource()->getLog(false, false);
//             pr($log);
//             die;
            /*             * *********** end **************** */
            //$arr = '';
            // $uids = ''; //array(1,3,5,6);
            //$arr='';
            //pr($data1);
            if ($receivealbum) {
//                foreach ($receivealbum as $key1 => $value1) {
//                    /*                     * * get user id from receive album table ** */
//                    $uids[] = $value1['ReceiveAlbum']['sender_id'];
//                }
//                /** get unique id ** */
//                $userids = array_unique($uids);
//                //pr($userids);
//                //for($i=0;$i<count($userids);$i++) {
//                /*                 * *  put image in a array which id same ********** */
//                foreach ($userids as $key2 => $value2) {
//                    $arr = '';
//                    foreach ($receivealbum as $key => $value) {
//                        //$arr[]=$value['User']['username'];
//                        if ($value2 == $value['ReceiveAlbum']['sender_id']) {
//                            $creation_date = $value['ReceiveAlbum']['creation_date'];
//                            $arr['id'] = $value['User']['id'];
//                            $arr['username'] = $value['User']['username'];
//                            $arr['creation_date'] = $value['ReceiveAlbum']['creation_date'];
//                            $arr['image'][] = $value['ReceiveAlbum']['photo_name'];
//                        }
//                    }
//                    //$arr[]=$creation_date;
//                    // pr($arr);
//                    $data1[] = $arr;
//                }
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['data'] = $receivealbum; //Hash::extract($receivealbum, '{n}.User');
                $data['path'] = PIC_PATH;
            } else {
                $data['success'] = 0;
                $data['msg'] = 'no data found';
            }
            //pr($data);
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user_id not found';
        }
        echo json_encode($data);
    }

    /*     * *****************End**************************** */
    /*     * ****** this service use for manage access list for album share  (to whom I gave access) 19032015 --- Mir ---******** */

    public function manage_album_access() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id) {
            $option['fields'] = array('User.*', 'Profile.*', 'ShareAlbum.*');
            $option['joins'] = array(
                array('table' => 'share_albums',
                    'alias' => 'ShareAlbum',
                    'type' => 'INNER',
                    'conditions' => array('User.id = ShareAlbum.receiver_id')
            ));
            $option['conditions'] = array('ShareAlbum.sender_id' => $user_id, 'ShareAlbum.is_received' => 1);
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $accesslist = $this->User->find('all', $option);
            if ($accesslist) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['data'] = $accesslist; //Hash::extract($accesslist, '{n}.User');
                $data['path'] = PIC_PATH;
            } else {
                $data['success'] = 2;
                $data['msg'] = 'no data found in this id';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'id not found';
        }
        echo json_encode($data);
    }

    /*     * ****** this service use for delete from share  album  access list data 19022015 --- Mir ---******** */

    public function delete_album_access() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; // who send album
        $receiver_id = isset($this->request->data['id']) ? $this->request->data['id'] : ''; // who receive album
        if ($user_id && $receiver_id) {
            $chk = $this->ShareAlbum->find('first', array('conditions' => array('ShareAlbum.sender_id' => $user_id, 'ShareAlbum.receiver_id' => $receiver_id)));
            if ($chk) {
                $this->ShareAlbum->delete($chk['ShareAlbum']['id']);
                echo json_encode(array('success' => 1, 'msg' => 'album access has been deleted successfully '));
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'no data found in this id'));
            }
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'id not found'));
        }
    }

    /**
     *  Count Notification  for who share album
     */
//    public function count_notifications() {
//        $this->autoRender = FALSE;
//        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
//        if ($user_id) {
//            $options['conditions'] = array(
//                'ShareAlbum.receiver_id' => $user_id,
//                'AND' => array('ShareAlbum.is_received' => 0)
//            );
//            $share_album_count = $this->ShareAlbum->find('all', $options);
//            $notification = count($share_album_count);
//            $data['success'] = 1;
//            $data['notifications'] = $notification;
//            $data['msg'] = 'success';
//            //pr($this->User->getDataSource()->getLog(true));
//        } else {
//            $data['success'] = 0;
//            $data['msg'] = 'userid not found';
//        }
//        echo json_encode($data);
//    }
    // 10 March 2015 +++++++++++++++++++++++++

    public function rename_profile_lookingdates() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $userdata['UserLookdate']['id'] = $this->request->data['id'];
            $userdata['UserLookdate']['profile_name'] = $this->request->data['profile_name'];
            $chk = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.id' => $userdata['UserLookdate']['id'], 'UserLookdate.profile_name' => $userdata['UserLookdate']['profile_name'])));
            if (empty($chk)) {
                $this->UserLookdate->save($userdata);
                echo json_encode(array('success' => 1, 'msg' => 'Data has been successfully saved'));
                exit;
            } else {
                //$userdata['Profile']['id'] = $chk['Profile']['id'];
                //$this->Profile->save($userdata);
                echo json_encode(array('success' => 2, 'msg' => 'Already exist this profile name'));
                exit;
            }
        }
    }

    public function rename_profile_lookingsex() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $userdata['UserLooksex']['id'] = $this->request->data['id'];
            $userdata['UserLooksex']['profile_name'] = $this->request->data['profile_name'];

            $chk = $this->UserLooksex->find('all', array('conditions' => array('UserLooksex.id' => $userdata['UserLooksex']['id'], 'UserLooksex.profile_name' => $userdata['UserLooksex']['profile_name'])));
            //$log = $this->UserLookdate->getDataSource()->getLog(false, false);
            //pr($log);
            //die;
            if (empty($chk)) {
                $this->UserLooksex->save($userdata);
                echo json_encode(array('success' => 1, 'msg' => 'Data has been successfully saved'));
                exit;
            } else {
                echo json_encode(array('success' => 2, 'msg' => 'Already exist this profile name'));
                exit;
            }
        }
    }

    public function use_profile_lookdates() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $userdata['UserLookdate']['id'] = $this->request->data['id'];

            $data = $this->UserLookdate->findById($userdata['UserLookdate']['id']);
            if (!empty($data)) {
                $SqlQry = "SELECT User.*,Profile.*,UserPartner.* FROM user_lookdates
                left join users as User on user_lookdates.user_id=User.id
                left join profiles as Profile on user_lookdates.user_id=Profile.user_id
                left join user_partners as UserPartner on user_lookdates.user_id=UserPartner.user_id
                WHERE
                user_lookdates.user_id != " . $this->request->data['user_id'] . "
                and (`his_traits` REGEXP REPLACE('" . $data['UserLookdate']['my_traits'] . "', ',','(\\,|$)|')
                or `his_physical_appearance` REGEXP REPLACE('" . $data['UserLookdate']['my_physical_appearance'] . "', ',','(\\,|$)|')
                or `his_sextual_preferences` REGEXP REPLACE('" . $data['UserLookdate']['my_sextual_preferences'] . "', ',','(\\,|$)|')
                or `his_social_habits` REGEXP REPLACE('" . $data['UserLookdate']['my_social_habits'] . "', ',','(\\,|$)|'))";

                $result = $this->UserLookdate->query($SqlQry);
                //pr($this->UserLookdate->getDataSource()->getLog());
                if (!empty($result)) {
                    $SearchResult = array_unique($result, SORT_REGULAR);
                    echo json_encode(array('success' => 1, 'data' => $SearchResult, 'path' => PIC_PATH));
                    die;
                } else {
                    echo json_encode(array('success' => 2, 'msg' => 'Not found'));
                    die;
                }
            } else {
                echo json_encode(array('success' => 2, 'msg' => 'Not found'));
                die;
            }
        }
    }

    public function use_profile_looksex() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            if ($this->request->data['id'] != '' && $this->request->data['user_id'] != '') {
                $userdata['UserLooksex']['id'] = $this->request->data['id'];

                $data = $this->UserLooksex->findById($userdata['UserLooksex']['id']);
                if (!empty($data)) {
                    $SqlQry = "SELECT User.*,Profile.*,UserPartner.* FROM user_looksexes
                    left join users as User on user_looksexes.user_id=User.id
                    left join profiles as Profile on user_looksexes.user_id=Profile.user_id
                    left join user_partners as UserPartner on user_looksexes.user_id=UserPartner.user_id
                    WHERE
                    user_looksexes.user_id != " . $this->request->data['user_id'] . "
                    and (`his_physical_appearance` REGEXP REPLACE('" . $data['UserLooksex']['my_physical_appearance'] . "', ',','(\\,|$)|')
                    or `his_sextual_preferences` REGEXP REPLACE('" . $data['UserLooksex']['my_sextual_preferences'] . "', ',','(\\,|$)|')
                    or `his_social_habits` REGEXP REPLACE('" . $data['UserLooksex']['my_social_habits'] . "', ',','(\\,|$)|')) group by user_looksexes.user_id";
                    $result = $this->UserLooksex->query($SqlQry);
                    if (!empty($result)) {
                        $SearchResult = array_unique($result, SORT_REGULAR);
                        echo json_encode(array('success' => 1, 'data' => $SearchResult, 'path' => PIC_PATH));
                        die;
                    } else {
                        echo json_encode(array('success' => 2, 'msg' => 'Not found'));
                        die;
                    }
                } else {
                    echo json_encode(array('success' => 2, 'msg' => 'Not found'));
                    die;
                }
            }
        }
    }

    /*     * ********* add to favourite screen and unfavourite screen ************** */

    public function add_favourite_screen() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $favourite_user_id = isset($this->request->data['favourite_user_id']) ? $this->request->data['favourite_user_id'] : ''; // which user I want to make favourite
        if ($user_id && $favourite_user_id) {
            $favourite = $this->Favourite->find('first', array('conditions' => array('Favourite.user_id' => $user_id, 'Favourite.favourite_user_id' => $favourite_user_id)));

            if ($favourite) {
                /*                 * ****** if is_favourite=1 then set is_favourite=2 means unfavourite and if  is_favourite=2 then set is_favourite=1 means favourite*** */
                if ($favourite['Favourite']['is_favourite'] == 1) {
                    $is_favourite = 2;
                } else {
                    $is_favourite = 1;
                }
                /*                 * ******** un favourite **************** */
                $favouriteuser['Favourite'] = array(
                    'id' => $favourite['Favourite']['id'],
                    'user_id' => $user_id,
                    'favourite_user_id' => $favourite_user_id,
                    'is_favourite' => $is_favourite,
                    'modification_date' => date('Y-m-d H:i:s')
                );
                // pr($sharealbum);
            } else {
                $favouriteuser['Favourite'] = array(
                    'user_id' => $user_id,
                    'favourite_user_id' => $favourite_user_id,
                    'is_favourite' => 1,
                    'creation_date' => date('Y-m-d H:i:s')
                );
            }
            if ($this->Favourite->save($favouriteuser)) {
                $data['success'] = 1;
                $data['msg'] = 'success';
            } else {
                $data['success'] = 2;
                $data['msg'] = 'unable to save into database';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id and favourite user id not found';
        }
        echo json_encode($data);
    }

    /*     * ********* add to favourite screen and unfavourite screen ************** */

    public function view_favourite_screen() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        //$favourite_user_id = isset($this->request->data['favourite_user_id']) ? $this->request->data['favourite_user_id'] : ''; // who receive album
        if ($user_id) {
            // $options['fields'] = array('User.*','Profile.*');
//            $options['joins'] = array(
//                array('table' => 'users',
//                    'alias' => 'User',
//                    'type' => 'INNER',
//                    'conditions' => array(
//                        'Favourite.favourite_user_id = User.id',
//                        'AND' => array(
//                            array('Favourite.user_id' => $user_id),
//                            array('Favourite.is_favourite' => 1)
//                        )
//                    )
//                ));
            $options['joins'] = array(
                array('table' => 'favourites',
                    'alias' => 'Favourite',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Favourite.favourite_user_id = User.id',
                        'AND' => array(
                            array('Favourite.user_id' => $user_id),
                            array('Favourite.is_favourite' => 1)
                        )
                    )
            ));
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $favourite = $this->User->find('all', $options);
            //pr($this->User->getDataSource()->getLog(true));die;
            //pr($favourite);die;
            if ($favourite) {
                $data['success'] = 1;

                $data['msg'] = 'success';
                $data['user_data'] = $favourite;
                $data['path'] = PIC_PATH;
            } else {
                $data['success'] = 2;
                $data['msg'] = 'No data found';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id  not found';
        }
        echo json_encode($data);
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        $this->autoRender = false;
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        /*         * *** M= Miles ,K=Kilometers, N = Nautical Miles ************* */
        if ($unit == "K") {
            return round(($miles * 1.609344));
        } else if ($unit == "N") {
            return round(($miles * 0.8684));
        } else {
            return round($miles);
        }
    }

    /*     * ********* this service use for who are  view my profile that save into db and view other user profile and match percentage ************** */

    public function view_profile_details() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $viewer_user_id = isset($this->request->data['viewer_user_id']) ? $this->request->data['viewer_user_id'] : ''; // whose profile view
        $type = isset($this->request->data['type']) ? $this->request->data['type'] : ''; //track which page user come  looking sex or date or search page
        if ($user_id && $viewer_user_id) {

            $viewer = $this->Viewer->find('all', array('conditions' => array('Viewer.user_id' => $user_id, 'Viewer.viewer_user_id' => $viewer_user_id)));
            if (!$viewer) {
                /*                 * ******** save viewer table **************** */
                $viewers['Viewer'] = array(
                    'user_id' => $user_id,
                    'viewer_user_id' => $viewer_user_id,
                    'creation_date' => date('Y-m-d H:i:s'),
                    'modification_date' => date('Y-m-d H:i:s')
                );
                $this->Viewer->save($viewers);
            }
            /*             * ************ get current user lat long ************** */
            $user = $this->User->findById($user_id);
            if ($user) {
                $user_lat = $user['User']['lat'];
                $user_long = $user['User']['long'];
            }
            /*             * *********** END **************** */
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $this->User->unbindModel(array('hasOne' => array('UserPartner')));
            $profile = $this->User->findById($viewer_user_id);
            if ($profile && $user) {
                $viewer_lat = $profile['User']['lat'];
                $viewer_long = $profile['User']['long'];
                /*                 * *********** get distance miles *************** */
                $distance = $this->distance($user_lat, $user_long, $viewer_lat, $viewer_long, 'M');
                /*                 * ************ END************************* */
                $Userdetails['success'] = array();
                $Userdetails['msg'] = array();
                $Userdetails['path'] = array();
                $Userdetails['Note'] = array();
                $Userdetails['User'] = array();
                $Userdetails['Profile'] = array();
                $Userdetails['Distance'] = array('miles' => $distance);
                $Userdetails['Favourite'] = array();
                $Userdetails['Viewer_Favourite'] = array();
                $Userdetails['User_Share_Album'] = array(); //user share album  or not 
                $Userdetails['Viewer_Share_Album'] = array();  //whose profile user view he share his  album to the user  or not
                $Userdetails['Match_Persent'] = array();
                /*                 * ************ check user share album or not ************ */
                $sharealbum = $this->ShareAlbum->find('first', array('conditions' => array('ShareAlbum.sender_id' => $user_id, 'ShareAlbum.receiver_id' => $viewer_user_id, 'ShareAlbum.is_received' => 1)));
                if ($sharealbum) {
                    $Userdetails['User_Share_Album'] = $sharealbum['ShareAlbum'];
                }
                /*                 * *************** END ******************* */
                /*                 * ************ check viewer share album or not  viewer  means whose profile I am visiting ************ */
                $Viewer_sharealbum = $this->ShareAlbum->find('first', array('conditions' => array('ShareAlbum.sender_id' => $viewer_user_id, 'ShareAlbum.receiver_id' => $user_id, 'ShareAlbum.is_received' => 1)));
                if ($Viewer_sharealbum) {
                    $Userdetails['Viewer_Share_Album'] = $Viewer_sharealbum['ShareAlbum'];
                }
                /*                 * *************** END ******************* */
                /*                 * ************ check user  leave any note for user ************ */
                $note = $this->Note->find('first', array('conditions' => array('Note.user_id' => $user_id, 'Note.note_user_id' => $viewer_user_id)));
                if ($note) {
                    $Userdetails['Note'] = $note['Note']['note'];
                } else {
                    $Userdetails['Note'] = '';
                }
                /*                 * *************** END ******************* */
                /*                 * ************ check user  alredy favourite the view profile user ************ */
                $favourite = $this->Favourite->find('first', array('conditions' => array('Favourite.user_id' => $user_id, 'Favourite.favourite_user_id' => $viewer_user_id, 'Favourite.is_favourite' => 1)));
                if ($favourite) {
                    $Userdetails['Favourite'] = $favourite['Favourite'];
                }
                /*                 * *************** END ******************* */
                /*                 * ************ check whose profile user view he already fafourite this user or not ************ */
                $viewer_favourite = $this->Favourite->find('first', array('conditions' => array('Favourite.user_id' => $viewer_user_id, 'Favourite.favourite_user_id' => $user_id, 'Favourite.is_favourite' => 1)));
                if ($viewer_favourite) {
                    $Userdetails['Viewer_Favourite'] = $viewer_favourite['Favourite'];
                }
                /*                 * *************** END ******************* */
                if ($type == 'looking_date') {
                    /*                     * ********* for look date percentage count *********** */
                    $lookdateuser = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id' => $user_id)));
                    if ($lookdateuser) {
                        /*                         * ********** his traits ********* */
                        $his_traits = $lookdateuser['UserLookdate']['his_traits'];
                        $his_traits = explode(',', $his_traits);
                        $traits_percent_permatch = 100 / count($his_traits);
                        $match_traits = 0;
                        /*                         * ************* my interest *********** */
                        $my_interest = $lookdateuser['UserLookdate']['my_interest'];
                        $my_interest = explode(',', $my_interest);
                        $interest_percent_permatch = 100 / count($my_interest);
                        $match_interest = 0;
                        /*                         * ********** his_physical_appearance ********** */
                        $his_physical_appearance = $lookdateuser['UserLookdate']['his_physical_appearance'];
                        $his_physical_appearance = explode(',', $his_physical_appearance);
                        $his_physical_appearance_percent_permatch = 100 / count($his_physical_appearance);
                        $match_his_physical_appearance = 0;
                        /*                         * ********** his_sextual_preferences ********** */
                        $his_sextual_preferences = $lookdateuser['UserLookdate']['his_sextual_preferences'];
                        $his_sextual_preferences = explode(',', $his_sextual_preferences);
                        $his_sextual_preferences_percent_permatch = 100 / count($his_sextual_preferences);
                        $match_his_sextual_preferences = 0;
                        /*                         * ********** his_social_habits ********** */
                        $his_social_habits = $lookdateuser['UserLookdate']['his_social_habits'];
                        $his_social_habits = explode(',', $his_social_habits);
                        $his_social_habits_percent_permatch = 100 / count($his_social_habits);
                        $match_his_social_habits = 0;
                    }
                    $lookdateviewer = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id' => $viewer_user_id)));
                    //pr($lookdateviewer);
                    if ($lookdateviewer) {
                        /*                         * ********** my_traits ********** */
                        $my_traits = $lookdateviewer['UserLookdate']['my_traits'];
                        $my_traits = explode(',', $my_traits);
                        /*                         * ************* my interest *********** */
                        $my_interest_view = $lookdateviewer['UserLookdate']['my_interest'];
                        $my_interest_view = explode(',', $my_interest_view);
                        /*                         * ************* my_physical_appearance *********** */
                        $my_physical_appearance = $lookdateviewer['UserLookdate']['my_physical_appearance'];
                        $my_physical_appearance = explode(',', $my_physical_appearance);
                        /*                         * ************* my_sextual_preferences *********** */
                        $my_sextual_preferences = $lookdateviewer['UserLookdate']['my_sextual_preferences'];
                        $my_sextual_preferences = explode(',', $my_sextual_preferences);
                        /*                         * ************* my_sextual_preferences *********** */
                        $my_social_habits = $lookdateviewer['UserLookdate']['my_social_habits'];
                        $my_social_habits = explode(',', $my_social_habits);
                    }
                    if ($lookdateviewer && $lookdateuser) {
                        /*                         * ********** count for traits *************** */
                        foreach ($his_traits as $key => $value) {
                            foreach ($my_traits as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_traits++;
                                }
                            }
                        }
                        $traits_percentage = round($traits_percent_permatch * $match_traits);
                        /*                         * ********** count for interest *************** */
                        foreach ($my_interest as $key => $value) {
                            foreach ($my_interest_view as $key1 => $value1) {
                                // echo $value.'--------'.$value1;
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    //echo 'Mir';
                                    $match_interest++;
                                }
                            }
                        }
                        //echo $match_interest;
                        $interest = round($interest_percent_permatch * $match_interest);
                        /*                         * ********** count for physical_appearance *************** */
                        foreach ($his_physical_appearance as $key => $value) {
                            foreach ($my_physical_appearance as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_physical_appearance++;
                                }
                            }
                        }
                        $physical = round($his_physical_appearance_percent_permatch * $match_his_physical_appearance);
                        /*                         * ********** count for sextual_preferences*************** */
                        foreach ($his_sextual_preferences as $key => $value) {
                            foreach ($my_sextual_preferences as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_sextual_preferences++;
                                }
                            }
                        }
                        $sextual = round($his_sextual_preferences_percent_permatch * $match_his_sextual_preferences);
                        /*                         * ********** count for social_habits*************** */
                        foreach ($his_social_habits as $key => $value) {
                            foreach ($my_social_habits as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_social_habits++;
                                }
                            }
                        }
                        $social_habits = round($his_social_habits_percent_permatch * $match_his_social_habits);
                    } else {
                        $traits_percentage = 0;
                        $interest = 0;
                        $physical = 0;
                        $sextual = 0;
                        $social_habits = 0;
                    }
                    $Userdetails['User'] = $profile['User'];
                    $Userdetails['Profile'] = $profile['Profile'];
                    $Userdetails['Match_Persent'] = array(
                        'traits' => $traits_percentage,
                        'interest' => $interest,
                        'physical' => $physical,
                        'sextual' => $sextual,
                        'social_habits' => $social_habits
                    );
                } elseif ($type == 'looking_sex') {
                    /*                     * ********* for look sex percentage count *********** */
                    $looksexuser = $this->UserLooksex->find('first', array('conditions' => array('UserLooksex.user_id' => $user_id, 'is_active' => 1)));
                    if ($looksexuser) {
                        /*                         * ********** his_physical_appearance ********** */
                        $his_physical_appearance = $looksexuser['UserLooksex']['his_physical_appearance'];
                        $his_physical_appearance = explode(',', $his_physical_appearance);
                        $his_physical_appearance_percent_permatch = 100 / count($his_physical_appearance);
                        $match_his_physical_appearance = 0;
                        /*                         * ********** his_sextual_preferences ********** */
                        $his_sextual_preferences = $looksexuser['UserLooksex']['his_sextual_preferences'];
                        $his_sextual_preferences = explode(',', $his_sextual_preferences);
                        $his_sextual_preferences_percent_permatch = 100 / count($his_sextual_preferences);
                        $match_his_sextual_preferences = 0;
                        /*                         * ********** his_social_habits ********** */
                        $his_social_habits = $looksexuser['UserLooksex']['his_social_habits'];
                        $his_social_habits = explode(',', $his_social_habits);
                        $his_social_habits_percent_permatch = 100 / count($his_social_habits);
                        $match_his_social_habits = 0;
                    }
                    $looksexviewer = $this->UserLooksex->find('first', array('conditions' => array('UserLooksex.user_id' => $viewer_user_id, 'is_active' => 1)));
                    if ($looksexviewer) {
                        /*                         * ************* my_physical_appearance *********** */
                        $my_physical_appearance = $looksexviewer['UserLooksex']['my_physical_appearance'];
                        $my_physical_appearance = explode(',', $my_physical_appearance);
                        /*                         * ************* my_sextual_preferences *********** */
                        $my_sextual_preferences = $looksexviewer['UserLooksex']['my_sextual_preferences'];
                        $my_sextual_preferences = explode(',', $my_sextual_preferences);
                        /*                         * ************* my_sextual_preferences *********** */
                        $my_social_habits = $looksexviewer['UserLooksex']['my_social_habits'];
                        $my_social_habits = explode(',', $my_social_habits);
                    }
                    if ($looksexviewer && $looksexuser) {
                        /*                         * ********** count for physical_appearance *************** */
                        foreach ($his_physical_appearance as $key => $value) {
                            foreach ($my_physical_appearance as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_physical_appearance++;
                                }
                            }
                        }
                        $physical = round($his_physical_appearance_percent_permatch * $match_his_physical_appearance);
                        /*                         * ********** count for sextual_preferences*************** */
                        foreach ($his_sextual_preferences as $key => $value) {
                            foreach ($my_sextual_preferences as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_sextual_preferences++;
                                }
                            }
                        }
                        $sextual = round($his_sextual_preferences_percent_permatch * $match_his_sextual_preferences);
                        /*                         * ********** count for social_habits*************** */
                        foreach ($his_social_habits as $key => $value) {
                            foreach ($my_social_habits as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_social_habits++;
                                }
                            }
                        }
                        $social_habits = round($his_social_habits_percent_permatch * $match_his_social_habits);
                    } else {
                        $physical = 0;
                        $sextual = 0;
                        $social_habits = 0;
                    }
                    $Userdetails['User'] = $profile['User'];
                    $Userdetails['Profile'] = $profile['Profile'];
                    $Userdetails['Match_Persent'] = array(
                        'physical' => $physical,
                        'sextual' => $sextual,
                        'social_habits' => $social_habits
                    );
                } else {
                    $Userdetails['User'] = $profile['User'];
                    $Userdetails['Profile'] = $profile['Profile'];
                    //unset($Userdetails['Match_Persent']);
                }
                $Userdetails['success'] = 1;
                $Userdetails['msg'] = 'success';
                $Userdetails['path'] = PIC_PATH;
            } else {
                $Userdetails['success'] = 2;
                $Userdetails['msg'] = 'user id or viewer user id not valid';
            }
        } else {
            $Userdetails['success'] = 0;
            $Userdetails['msg'] = 'user id or viewer user id not found';
        }
        echo json_encode($Userdetails);
    }

    /*     * ********* this service use for add note from profile details ************** */

    public function add_note() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $note_user_id = isset($this->request->data['note_user_id']) ? $this->request->data['note_user_id'] : ''; // whose profile user want to leave a note 
        $notedata = isset($this->request->data['note']) ? $this->request->data['note'] : '';
        if ($user_id && $note_user_id) {
            /*             * ************ check user  leave any note for user ************ */
            $note = $this->Note->find('first', array('conditions' => array('Note.user_id' => $user_id, 'Note.note_user_id' => $note_user_id)));
            if ($note) {
                $notedetails['Note'] = array(
                    'id' => $note['Note']['id'],
                    'user_id' => $user_id,
                    'note_user_id' => $note_user_id,
                    'note' => $notedata,
                    'modification_date' => date('Y-m-d H:i:s')
                );
            } else {
                $notedetails['Note'] = array(
                    //'id' => $note['Note']['id'],
                    'user_id' => $user_id,
                    'note_user_id' => $note_user_id,
                    'note' => $notedata,
                    'creation_date' => date('Y-m-d H:i:s')
                );
            }
            if ($this->Note->save($notedetails)) {
                $data['success'] = 1;
                $data['msg'] = 'success';
            } else {
                $data['success'] = 2;
                $data['msg'] = 'unable to save into database';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id and note user id not found';
        }
        echo json_encode($data);
    }

    /*     * ********** this service user who has view my profile that users  show 06042015**************** */

    public function profile_viewers_details() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        if ($user_id) {
            $option['fields'] = array('User.*', 'Profile.*', 'Viewer.*');
            $option['joins'] = array(
                array('table' => 'viewers',
                    'alias' => 'Viewer',
                    'type' => 'INNER',
                    'conditions' => array('User.id = Viewer.user_id')
            ));
            $option['conditions'] = array('Viewer.viewer_user_id' => $user_id);
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $profile_viewers = $this->User->find('all', $option);
            if ($profile_viewers) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['data'] = $profile_viewers;
            } else {
                $data['success'] = 2;
                $data['msg'] = 'no data found';
            }
            //pr($this->User->getDataSource()->getLog());
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user_id not found';
        }
        echo json_encode($data);
    }

    /*     * ****** this service use for unshare all album access from share  album  access list  19022015 --- Mir ---******** */

    public function unshare_all_album_access() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; // who send album
        //$receiver_id = isset($this->request->data['id']) ? $this->request->data['id'] : ''; // who receive album
        if ($user_id) {
            $chk = $this->ShareAlbum->find('first', array('conditions' => array('ShareAlbum.sender_id' => $user_id)));
            if ($chk) {
                $condition = array('ShareAlbum.sender_id' => $user_id);
                $this->ShareAlbum->updateAll(array('is_received' => 2), $condition);
                echo json_encode(array('success' => 1, 'msg' => 'album access has been deleted successfully '));
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'no data found in this id'));
            }
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'id not found'));
        }
        // pr($this->ShareAlbum->getDataSource()->getLog());
    }
    /********* database update screen name function *********/
//    public function update_screen_name(){
//        $this->autoRender = false; 
//       $user = $this->User->find('all');
//       foreach($user as $key=>$value) {
//           $screen_name = $user[$key]['User']['username'];
//           $user_id = $user[$key]['User']['id'];
//           $this->Profile->create();
//           $this->Profile->updateAll(array('screen_name'=> "'".$screen_name."'"), array('Profile.user_id'=>$user_id));
//       }
//       pr($user);
  //  }
     /*     * ******** rename caption archive images **************** */

    public function rename_caption_archive_image() {
        $this->autoRender = false;
        if (isset($this->request->data['pic_id'])) {
            $arr = array();
            $album = $this->Archive->findById($this->request->data['pic_id']);
            if ($album) {
                $album_data['Archive']['id'] = $this->request->data['pic_id'];
                $album_data['Archive']['caption'] = $this->request->data['caption'];
                $ret = $this->Archive->save($album_data);
                echo json_encode(array('success' => 1, 'msg' => 'successfully rename caption'));
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'id not found in database'));
            }
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'user id not found'));
        }
        exit;
    }

}
