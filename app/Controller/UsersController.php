<?php

define("ENCRYPTION_KEY", "wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA");
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
//include braintree payment gateway//
App::import('Vendor', 'Braintree', array('file' => 'braintree' . DS . 'lib' . DS . 'Braintree.php'));

class UsersController extends AppController {

    public $components = array('Qimage', 'GCM');
    public $uses = array('User', 'Profile', 'User_partner', 'User_album', 'BlockedUser', 'UserLookdate', 'UserLooksex', 'Archive', 'ShareAlbum', 'ReceiveAlbum', 'Favourite', 'Note', 'Viewer', 'ProfileLock', 'RecentImage', 'Phrase', 'ChatUser', 'Admin', 'Flag', 'BlockChatUser', 'ChatCountMessage', 'MatchesFilterValue', 'Subscription', 'RemoveAd', 'Transaction', 'UserRestriction', 'Trial', 'VerifyLog', 'Banner');

    public function beforeFilter() {
        parent::beforeFilter();
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $lat = isset($this->request->data['lat']) ? $this->request->data['lat'] : '';
        $long = isset($this->request->data['long']) ? $this->request->data['long'] : '';
        $accuracy = isset($this->request->data['accuracy']) ? $this->request->data['accuracy'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        $email = isset($this->request->data['email']) ? $this->request->data['email'] : '';
        $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
        if ($email && $password && $current_date) {
            $password = Security::hash($password, null, true);
            $userdetails = $this->User->find('first', array('conditions' => array('User.email' => $email, 'User.password' => $password)));
            if ($userdetails) {
                $user_id = $userdetails['User']['id'];
            }
        }
        if ($user_id) {
            $userupdatepaidorfreemember = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            if ($userupdatepaidorfreemember) {
                if ($userupdatepaidorfreemember['User']['status'] == 0) {
                    echo json_encode(array('success' => -1, 'msg' => 'inactive user'));
                    die;
                }
                $valid_upto = $userupdatepaidorfreemember['User']['valid_upto'];
                $removead_valid_upto = $userupdatepaidorfreemember['User']['removead_valid_upto'];
                if ($userupdatepaidorfreemember['User']['member_type'] == 1) {
                    if (date('Y-m-d') > $valid_upto) {
                        $this->User->updateAll(
                                array('User.member_type' => 0, 'User.is_trial' => 0), array('User.id' => $user_id)
                        );
                        //====for reset filter cache delete========//
                        $this->MatchesFilterValue->deleteAll(array('MatchesFilterValue.user_id' => $user_id, 'MatchesFilterValue.type' => 'browse'));
                        //=====Expire loking profile====//
                        $newTime = date("Y-m-d H:i:s", strtotime($current_date . " -1 minutes"));
                        //$this->UserLooksex->saveField('end_time', $newTime);
                        $this->UserLooksex->updateAll(
                                array('UserLooksex.end_time' => "'" . $newTime . "'"), array('UserLooksex.user_id' => $user_id)
                        );
                    }
                }
                if ($userupdatepaidorfreemember['User']['removead'] == 1) {
                    if (date('Y-m-d') > $removead_valid_upto) {
                        $this->User->updateAll(
                                array('User.removead' => 0), array('User.id' => $user_id)
                        );
                    }
                }
                //echo json_encode(array('login_user_details' => $userupdatepaidorfreemember));
            }
        }
        if ($user_id && $lat && $long && $accuracy) {
            $userdetailsupdate = $this->User->find('first', array('conditions' => array('User.id' => $user_id, 'User.status' => 1)));
            if ($userdetailsupdate) {
                $userdataupdate['User']['id'] = $user_id;
                $userdataupdate['User']['lat'] = $lat;
                $userdataupdate['User']['long'] = $long;
                $userdataupdate['User']['accuracy'] = (int) $accuracy;
                /*                 * ****** update field for online ******** */
                $this->User->save($userdataupdate);
            }
        }
    }

    public function index() {
        $this->autoRender = false;
        echo 'Index Page';
        //$id=$this->Session->read('Auth.User.id');  	
        //$data=$this->User->findAllByUsernameAndPassword('ramesh','65cea807eef6b9a9b8816955da0e313761d88a85');
        //pr($data);
        //pr($this->User->getDataSource()->getLog());
    }

    /**
     * Returns an encrypted & utf8-encoded
     */
    function encrypt($pure_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }

    /**
     * Returns decrypted original string
     */
    function decrypt($encrypted_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
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
            if (isset($this->request->data['userid']) && $this->request->data['userid'] != 0) {
                //pr($this->request->data);die;
                $start_time = isset($this->request->data['start_time']) ? $this->request->data['start_time'] : '0000-00-00 00:00:00';
                $end_time = isset($this->request->data['end_time']) ? $this->request->data['end_time'] : '0000-00-00 00:00:00';
                $bith_day = isset($this->request->data['birthday']) ? $this->request->data['birthday'] : '0000-00-00 00:00:00';
                $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
                $userdata['Profile']['user_id'] = isset($this->request->data['userid']) ? $this->request->data['userid'] : '';
                //$userdata['Profile']['screen_name'] = isset($this->request->data['screen_name']) ? $this->request->data['screen_name'] : '';
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
                $userdata['Profile']['height_cm'] = isset($this->request->data['height_cm']) ? $this->request->data['height_cm'] : '';
                $userdata['Profile']['weight'] = isset($this->request->data['weight']) ? $this->request->data['weight'] : '';
                $userdata['Profile']['Weight_kg'] = isset($this->request->data['Weight_kg']) ? $this->request->data['Weight_kg'] : '';
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
                //pr($userdata);die();
                $is_completed = 0;
                foreach ($userdata['Profile'] as $key => $val):
                    if (trim($val) == '') {
                        $is_completed = 1;
                    }
                endforeach;
                $finish = ($is_completed == 0) ? 1 : 0;

                //end checking profile is completed============

                $userdata['Profile']['start_time'] = $start_time;
                $userdata['Profile']['end_time'] = $end_time;
                $userdata['Profile']['birthday'] = $bith_day;

                //pr($userdata);die();

                $chk = $this->Profile->find('first', array('conditions' => array('Profile.user_id' => $userdata['Profile']['user_id'])));
                if (empty($chk)) {
                    $ret = $this->User->updateAll(array('User.is_completed ' => $finish, 'User.registration_status' => 2), array('User.id ' => $this->request->data['userid']));
                    $this->Profile->save($userdata);
                    echo json_encode(array('success' => 1, 'msg' => 'Data has been successfully saved'));
                    exit;
                } else {

                    $userdata['Profile']['id'] = $chk['Profile']['id'];
                    $this->Profile->save($userdata);
                    if ($chk['Profile']['about_me'] != $this->request->data['about_me']) {
                        $ret = $this->User->updateAll(array('User.profiletext_change ' => 1, 'User.profile_text_change_date' => "'" . $current_date . "'"), array('User.id ' => $this->request->data['userid']));
                    }
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
        $id = isset($this->request->data['userid']) ? $this->request->data['userid'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        $recently_email = isset($this->request->data['recently_email']) ? $this->request->data['recently_email'] : ''; //this send email recently or online
        //get inactive user id by admin//
        $get_unbanuser = $this->User->find('all', array('conditions' => array('User.status' => 0)));
        $unban_user_id = Hash::extract($get_unbanuser, '{n}.User.id');
        //===blocked by login user===//
        $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $id)));
        $block_user_id = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
        //========blocked login user by others========//
        $get_block_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.blocked_id' => $id)));
        $block_others_user_id = Hash::extract($get_block_user_data, '{n}.BlockedUser.user_id');
        $bock_user_id = array_merge($block_user_id, $block_others_user_id, $unban_user_id);
        //pr($bock_user_id);die;
        $con = array();
        $is_view = 0;
        $is_share = 0;
        $is_profile_active = 0;
        if (isset($this->request->data['userid'])) {

            //======get limit for free user or paid user==//
            $login_user_member = $this->User->find('first', array('conditions' => array('User.id' => $this->request->data['userid'])));
            $member_type = $login_user_member['User']['member_type'];
            $limit = $this->match_limit($member_type, 'Match');
            $limit = $limit - 1;
            //=======End============//
            $con['fields'] = array('User.*', 'Profile.*', 'UserPartner.*', 'ChatUser.*');
            $con['joins'] = array(
                array('table' => 'chat_users',
                    'alias' => 'ChatUser',
                    'type' => 'Left',
                    'conditions' => array(
                        'ChatUser.user_id = User.id',
                        'AND' => array(
                            array('ChatUser.chat_user_id' => $id),
                        )
                    )
            ));
            //$id = $this->request->data['userid'];
            if ($recently_email) {
                $con['conditions'] = array('User.id !=' => $id, "NOT" => array('User.id' => $bock_user_id), 'User.email' => explode(',', $recently_email), 'User.registration_status' => 3);
            } else {
                $con['conditions'] = array('User.id !=' => $id, "NOT" => array('User.id' => $bock_user_id), 'User.registration_status' => 3);
            }
            $con['limit'] = $limit;
            $con['order'] = array('User.database_distance' => 'ASC');
            /*             * ******check any one view my profile******** */
            $is_view = $this->check_view($this->request->data['userid']);
            /*             * ******End********* */
            /*             * ******check any one share album with me******** */
            $is_share = $this->check_sharealbum($this->request->data['userid']);
            /*             * ******End********* */
            /*             * ******count total user view my profile******** */
            $count_view = $this->count_view($this->request->data['userid']);
            /*             * ******End********* */
            /*             * ******count total user share album with me******** */
            $count_sharealbum = $this->count_sharealbum($this->request->data['userid']);
            $total_view_and_share = $count_view + $count_sharealbum;
            /*             * ******End********* */
            /*             * *****check profile active ********* */
            $is_profile_active = $this->check_profile_active($current_date, $this->request->data['userid']);
            /*             * ********END***************** */
            $this->User->virtualFields = array('database_distance' => "( 6371 * acos( cos( radians(" . $login_user_member['User']['lat'] . ") ) * cos( radians( User.lat ) ) * cos( radians( User.long`) - radians(" . $login_user_member['User']['long'] . ") ) + sin( radians(" . $login_user_member['User']['lat'] . ") ) * sin( radians( User.lat ) ) ) )");
        } else {
            $con['conditions'] = array('User.registration_status' => 3);
        }
        $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
        //pr($con);die;

        $user_data = $this->User->find('all', $con);

        // pr($user_data);die;
        //pr($this->User->getDataSource()->getLog(true));die;
        $all_user_data = array();
        $filter_cache = array();
        $total_unread_message = 0;
        if (isset($this->request->data['userid']) && $current_date) {

            if ($user_data) {
                //pr($user_data) ;die;
                foreach ($user_data as $key => $value) {
                    //pr($value);die;
                    if ($value['ChatUser']['invite'] > 0) {
                        $invite = 1;
                    } else {
                        $invite = 0;
                    }
                    $total_unread_message+=($value['ChatUser']['count'] + $invite);
                }
                /*                 * *******count user locked profie or not ******** */
                //$profilelockcount=$this->ProfileLock->find('all', array('conditions' => array('ProfileLock.count' => 1, 'ProfileLock.lock_user_id' => $this->request->data['userid'])));
                //if($profilelockcount) { 
                //        $total_unread_message+=count($profilelockcount);                         
                //}
            }
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $login_id = $this->request->data['userid'];
            $login_user = $this->User->find('all', array('conditions' => array('User.id' => $login_id)));
            $login_user_lat = $login_user[0]['User']['lat'];
            $login_user_long = $login_user[0]['User']['long'];
            $login_user_member_type = $login_user[0]['User']['member_type'];
            $login_user_removead = $login_user[0]['User']['removead'];
            $login_user_is_trial = $login_user[0]['User']['is_trial'];
            foreach ($login_user as $key1 => $value1) {
                unset($login_user[$key1]['User']['database_distance']);
                $login_user[$key1]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value1['User']['id']);
            }
            foreach ($user_data as $key => $value) {
                unset($user_data[$key]['User']['database_distance']);
                $user_data[$key]['User']['distance'] = $this->distance($login_user_lat, $login_user_long, $value['User']['lat'], $value['User']['long'], 'M');
                $user_data[$key]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value['User']['id']);
            }
            $user_data = Set::sort($user_data, '{n}.User.distance', 'asc');
            $all_user_data = array_merge($login_user, $user_data);
            //***************for filter chache**********//
            $if_exist_save_filter = $this->MatchesFilterValue->find('first', array('conditions' => array(
                    'MatchesFilterValue.user_id ' => $this->request->data['userid'],
                    'MatchesFilterValue.type ' => 'browse'
            )));
            if ($if_exist_save_filter) {
                $filter_cache = $if_exist_save_filter['MatchesFilterValue'];
            }

            //***************END***************//
        } else {
            $all_user_data = $user_data;
        }
        if ($all_user_data) {
            /*             * *****get the max accuricy number ******* */
            $accuracy_value = Hash::extract($all_user_data, '{n}.User.accuracy');
            //pr($accuracy_value);die;
            $accuracy_max_value = (int) max($accuracy_value);
            /*             * **********END*************** */
        }
        /*         * ******for give user looksex data******** */
        $user_looksexdata = array();
        $user_looksex = $this->UserLooksex->find('first', array('conditions' => array(
                'and' => array(
                    array(
                        'UserLooksex.user_id ' => $id,
                        'UserLooksex.start_time <=' => $current_date,
                        'UserLooksex.end_time >=' => $current_date
                    )
                )
        )));
        if ($user_looksex) {
            $user_looksexdata = $user_looksex['UserLooksex'];
        }
        /*         * **********END**************** */


        // pr($all_user_data);die;
        echo json_encode(array('success' => 1, 'is_share_album' => $is_share, 'is_viewed' => $is_view, 'total_unread_message' => $total_unread_message, 'total_view_and_share' => $total_view_and_share, 'user_looking_profile_active' => $is_profile_active, 'accuracy' => $accuracy_max_value, 'login_user_member_type' => $login_user_member_type, 'login_user_removead' => $login_user_removead, 'login_user_is_trial' => $login_user_is_trial, 'filter_cache' => $filter_cache, 'userlooksex_data' => $user_looksexdata, 'data' => $all_user_data, 'path' => PIC_PATH));
        die;
    }

    /*     * ****** for looking profile is_active _check*************** */

    public function check_profile_active($current_date, $user_id) {
        //=== For is active checking===//
        $if_exist_profile = $this->UserLooksex->find('all', array('conditions' => array(
                'and' => array(
                    array(
                        'UserLooksex.user_id ' => $user_id,
                        'UserLooksex.start_time <=' => $current_date,
                        'UserLooksex.end_time >=' => $current_date
                    )
                )
        )));
        if (count($if_exist_profile) > 0) {
            $is_profile_active = 1;
        } else {
            $is_profile_active = 0;
        }
        return $is_profile_active;
    }

    /*     * **********End******************* */

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

    public function uploadFile($file) {
        $rootPath = WWW_ROOT . 'profile_pic/';
        // pr($file); die;
        $file_name = rand(10, 10000) . $file['name'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        move_uploaded_file($file_tmp, $rootPath . $file_name);
        return $file_name;
        exit;
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
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        //=====For video upload====//
        $file_type_val = $file['type'];
        $file_type = explode('/', $file_type_val);
        if ($file_type[0] == 'video') {
            $video_name = $this->uploadFile($file);
            $caption = isset($this->request->data['caption']) ? $this->request->data['caption'] : '';
            $album_data['User_album']['user_id'] = $userId;
            $album_data['User_album']['photo_name'] = $video_name;
            $album_data['User_album']['caption'] = $caption;
            $album_data['User_album']['file_type'] = 1;

            $ret = $this->User_album->save($album_data);
            echo json_encode(array('success' => 1, 'msg' => 'Video has been successfully uploaded', 'path' => PIC_PATH));
            exit;
        }

        if ($type == 'profile_pic') {  // this block for profile picture when user will be upload his profile picture.
            $profileData = $this->User->find('first', array('conditions' => array('User.id' => $userId), 'fields' => array('id', 'profile_pic')));
            if (!empty($profileData['User']['profile_pic'])) {
                @unlink($rootPath . 'profile_pic/' . $profileData['User']['profile_pic']);
                @unlink($rootPath . 'profile_pic/thumb/' . $profileData['User']['profile_pic']);
            }
        } else {
            //==check album upload restiction===//
            $login_user = $this->User->find('first', array('conditions' => array('User.id' => $userId)));
            $login_user_member_type = $login_user['User']['member_type'];
            $login_user_removead = $login_user['User']['removead'];
            //======get limit for free user or paid user==//
            $limit = $this->match_limit($login_user_member_type, 'PrivateAlbum');
            //======End===========//
            $album_type = isset($this->request->data['album_type']) ? $this->request->data['album_type'] : '';
            if ($album_type) {
                
            } else {
                if ($limit != 0) {
                    $count_album_images = $this->User_album->find('count', array('conditions' => array('User_album.user_id' => $this->request->data['userid'], 'User_album.album_type' => 4)));

                    if ($count_album_images >= $limit) {

                        echo json_encode(array('success' => 2, 'msg' => 'You can only store up to ' . number_format($limit) . ' photos and 1 verified private photo in your Private Album'));
                        exit;
                    }
                }
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
                $profile_pic_type = isset($this->request->data['profile_pic_type']) ? $this->request->data['profile_pic_type'] : ''; //1 means face pic 2 means verified photo
                if ($profile_pic_type == '') {
                    $profile_pic_type = 0;
                }
                $ret = $this->User->updateAll(array(' User.profile_pic' => "'" . $imageName . "'", 'User.registration_status' => 3, 'User.profile_pic_type' => (int) $profile_pic_type, 'profile_pic_date ' => "'" . $current_date . "'", 'User.photo_change' => 1), array(' User.id ' => $userId));
                echo json_encode(array('success' => 1, 'msg' => 'profile picture has been successfully uploaded', 'upload_image' => $imageName, 'path' => PIC_PATH));
                exit;
            } else {
                $caption = isset($this->request->data['caption']) ? $this->request->data['caption'] : '';
                $album_type = isset($this->request->data['album_type']) ? $this->request->data['album_type'] : '';
                $album_id = isset($this->request->data['album_id']) ? $this->request->data['album_id'] : '';
                if ($album_id) {
                    $album_data['User_album']['id'] = $album_id;
                }
                if ($album_type == '') {
                    $album_type = 4;
                }
                $album_data['User_album']['user_id'] = $userId;
                $album_data['User_album']['photo_name'] = $imageName;
                $album_data['User_album']['caption'] = $caption;
                $album_data['User_album']['album_type'] = $album_type;
                $album_data['User_album']['creation_date'] = $current_date;
                // $album_data['User_album']['album_id'] = $this->request->data['album_id'];

                $ret = $this->User_album->save($album_data);
                echo json_encode(array('success' => 1, 'msg' => 'picture has been successfully uploaded', 'upload_image' => $imageName, 'path' => PIC_PATH));
                exit;
            }
        }
    }

    // End here,  this function will be work for member profile picture upload/update and album picture upload ============


    public function member_album() {
        $this->autoRender = false;
        if (isset($this->request->data['userid'])) {
            //this is user for when this service call from received album section then send only album images not add profile pic images//
            $received_album = isset($this->request->data['received_album']) ? $this->request->data['received_album'] : '';
            //End//
            $login_user_pic = array();
            $all_album = array();
            $arr = array();
            $user_details = $this->User->find('first', array('conditions' => array('User.id' => $this->request->data['userid'])));
            $login_user_member_type = $user_details['User']['member_type'];
            $login_user_removead = $user_details['User']['removead'];
            $login_user_is_trial = $user_details['User']['is_trial'];
            $login_user_pic[] = array('id' => 'login user',
                'user_id' => $this->request->data['userid'],
                'photo_name' => $user_details['User']['profile_pic'],
                'file_type' => 0,
                'caption' => '',
                'album_type' => $user_details['User']['profile_pic_type'],
                'creation_date' => $user_details['User']['profile_pic_date']
            );
            //check is exist verified pic in the album//
            $check_verified_pic = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $this->request->data['userid'], 'User_album.album_type' => 3)));
            //======get limit for free user or paid user==//
            $limit = $this->match_limit($login_user_member_type, 'PrivateAlbum');
            //======End===========//
            if (empty($check_verified_pic)) {
                $login_user_pic[] = array('id' => '',
                    'user_id' => $this->request->data['userid'],
                    'photo_name' => '',
                    'file_type' => 0,
                    'caption' => '',
                    'album_type' => '3',
                    'creation_date' => ''
                );
                //$limit=$limit-1;
                if ($limit != 0) {
                    $album = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $this->request->data['userid']), 'order' => array('User_album.album_type' => 'asc', 'User_album.id' => 'asc'), 'limit' => $limit));
                } else {
                    $album = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $this->request->data['userid']), 'order' => array('User_album.album_type' => 'asc', 'User_album.id' => 'asc')));
                }
            } else {
                if ($limit != 0) {
                    $limit = $limit + 1;
                    $album = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $this->request->data['userid']), 'order' => array('User_album.album_type' => 'asc', 'User_album.id' => 'asc'), 'limit' => $limit));
                } else {
                    $album = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $this->request->data['userid']), 'order' => array('User_album.album_type' => 'asc', 'User_album.id' => 'asc')));
                }
                //$limit=$limit+1;
            }
            //End//
            // pr($user_details);
            //$screen_name['screen_name'] = $user_details['User']['screen_name'];
            // $album = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $this->request->data['userid']),'order' => array('User_album.album_type'=>'asc','User_album.id'=>'asc'),'limit'=>$limit));
            //pr($this->User_album->getDataSource()->getLog(true));die;
            foreach ($album as $data) {
                $arr[] = $data['User_album'];
            }
            if ($received_album) {
                $all_album = array_merge($arr);
            } else {
                $all_album = array_merge($login_user_pic, $arr);
            }

            echo json_encode(array('success' => 1, 'login_user_member_type' => $login_user_member_type, 'login_user_removead' => $login_user_removead, 'login_user_is_trial' => $login_user_is_trial, 'screen_name' => $user_details['User']['screen_name'], 'data' => $all_album, 'path' => PIC_PATH));
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

//    public function user_block($type = null) {
//        $this->autoRender = false;
//        if (isset($this->request->data['userid']) && isset($this->request->data['blockid'])) {
//            if ($type == 'unblock') {
//                $this->Blocked_user->deleteAll(array('Blocked_user.user_id' => $this->request->data['userid'], 'Blocked_user.blocked_id' => $this->request->data['blockid']));
//                pr($this->Blocked_user->getDataSource()->getLog());
//                echo json_encode(array('success' => 1, 'msg' => 'user has been successfully un-blocked'));
//                exit;
//            }
//
//            $chk = $this->Blocked_user->find('all', array('conditions' => array('Blocked_user.user_id' => $this->request->data['userid'], 'AND ' => array('Blocked_user.blocked_id' => $this->request->data['blockid']))));
//            if (empty($chk)) {
//                $data['Blocked_user']['user_id'] = $this->request->data['userid'];
//                $data['Blocked_user']['blocked_id'] = $this->request->data['blockid'];
//                $this->Blocked_user->save($data);
//                echo json_encode(array('success' => 1, 'msg' => 'user has been successfully blocked'));
//                exit;
//            } else {
//                echo json_encode(array('success' => 0, 'msg' => 'already blocked'));
//                exit;
//            }
//        }
//    }

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
        //echo $valid_upto=date('Y-m-d',strtotime('+1 month', strtotime(date('Y-m-d'))));die;
//        $r = fopen('../../app/webroot/tracker3.txt', 'a+');
//
//        fwrite($r, 'Time: ' . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL . 'ip address:' . $_SERVER['REMOTE_ADDR']);
//        foreach ($this->request->data as $k => $v) {
//
//            fwrite($r, $k . ' : ' . $v . PHP_EOL . PHP_EOL);
//        }

        if ($this->request->is('post')) {

            $name = isset($this->request->data['screen_name']) ? $this->request->data['screen_name'] : '';
            $email = isset($this->request->data['email']) ? $this->request->data['email'] : '';
            $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
            $country = isset($this->request->data['country']) ? $this->request->data['country'] : '';
            $city = isset($this->request->data['city']) ? $this->request->data['city'] : '';
            $lat = isset($this->request->data['lat']) ? $this->request->data['lat'] : '';
            $long = isset($this->request->data['long']) ? $this->request->data['long'] : '';
            $device_token = isset($this->request->data['device_token']) ? $this->request->data['device_token'] : '';
            $device_type = isset($this->request->data['device_type']) ? $this->request->data['device_type'] : '';
            $accuracy = isset($this->request->data['accuracy']) ? $this->request->data['accuracy'] : '';


            $chk = $this->User->find('first', array('conditions' => array('User.email' => $email)));
            if (empty($chk)) {
                $trial_details = $this->Trial->find('first');
                $trial_month = 0;
                $member_type = 0;
                $is_trial = 0;
                if ($trial_details) {
                    $trial_month = $trial_details['Trial']['month']; //month change to day as per client request
                    if ($trial_month > 0) {
                        $member_type = 1;
                        $is_trial = 1;
                    }
                }
                $valid_upto = date('Y-m-d', strtotime('+' . $trial_month . ' days', strtotime(date('Y-m-d'))));
                $userdata['User']['token'] = $this->generateRandomString('upper-alphanumaric', 5);
                $userdata['User']['screen_name'] = $name;
                $userdata['User']['email'] = $email;
                $userdata['User']['password'] = $password;
                $userdata['User']['original_password'] = base64_encode($password);
                $userdata['User']['country'] = $country;
                $userdata['User']['lat'] = $lat;
                $userdata['User']['long'] = $long;
                $userdata['User']['status'] = 1;
                $userdata['User']['profile_status'] = 1;
                $userdata['User']['registration_status'] = 1;
                $userdata['User']['device_token'] = $device_token;
                $userdata['User']['device_type'] = $device_type;
                $userdata['User']['accuracy'] = (int) $accuracy;
                $userdata['User']['member_type'] = $member_type; //for first 1 month free
                $userdata['User']['valid_upto'] = $valid_upto; //for first 1 month free
                $userdata['User']['is_trial'] = $is_trial; //for first 1 month free  trial preiod
                $userdata['User']['creation_date'] = date('Y-m-d H:i:s');
                $userdata['User']['profiletext_change'] = 1;
                $userdata['User']['photo_change'] = 1;

                $this->User->save($userdata);
                //die;
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
        $email = isset($this->request->data['email']) ? $this->request->data['email'] : '';
        $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        $device_token = isset($this->request->data['device_token']) ? $this->request->data['device_token'] : '';
        $device_type = isset($this->request->data['device_type']) ? $this->request->data['device_type'] : '';
        if ($email && $password && $current_date) {
            $password = Security::hash($password, null, true);
            $userdetails = $this->User->find('first', array('conditions' => array('User.email' => $email, 'User.password' => $password, 'User.status' => 1)));
            //pr($userdetails['User']);
            // pr($this->User->getDataSource()->getLog());
            if ($userdetails) {
                $data = $userdetails['User'];
                $looksex = array();
                /*                 * ****** update field for online ******** */
                $this->User->updateAll(array('User.online_status ' => 1, 'User.device_token ' => "'" . $device_token . "'", 'User.device_type ' => "'" . $device_type . "'", 'User.modification_date' => "'" . $current_date . "'"), array(' User.id ' => $data['id']));

                /*                 * ************END************** */
                //echo $data['id'];
                $userlooksex = $this->UserLooksex->find('all', array('conditions' => array('UserLooksex.user_id' => $data['id'])));

                foreach ($userlooksex as $key => $value) {

                    $if_exist_profile = $this->UserLooksex->find('first', array('conditions' => array(
                            'and' => array(
                                array('UserLooksex.start_time <=' => $current_date,
                                    'UserLooksex.end_time >=' => $current_date
                                ),
                                'UserLooksex.id =' => $value['UserLooksex']['id']
                            )
                    )));
                    //pr($if_exist_profile); die;
                    if (count($if_exist_profile) > 0) {
                        $looksex = $if_exist_profile['UserLooksex'];
                    }
                    // pr($if_exist_profile);
                }
                echo json_encode(array('success' => 1, 'msg' => 'succefully logged in', 'user_data' => $data, 'look_sex' => $looksex, 'path' => PIC_PATH));
                //$this->Auth->logout();
                exit;
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'username or password is invalid'));
                exit;
            }
        } else {
            echo json_encode(array('success' => 2, 'msg' => 'username or password and current date should not be blank'));
            exit;
        }
    }

    public function logout() {
        //$this->Session->setFlash('You have successfully logout !!!', 'default', array('class' => 'success'), 'msg');
        //return $this->redirect($this->Auth->logout());
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id) {
            /*             * ****** update field for online to offline ******** */
            if ($this->User->updateAll(array(' User.online_status ' => 2), array(' User.id ' => $user_id))) {
                $data['success'] = 1;
                $data['msg'] = 'successfully log out';
            } else {
                $data['success'] = 1;
                $data['msg'] = 'unable to log out';
            }
            /*             * ************END************** */
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id not found';
        }
        echo json_encode($data);
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
//        $r = fopen('../../app/webroot/tracker3.txt', 'a+');
//                   fwrite($r, 'Time: ' . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL . 'ip address:' . $_SERVER['REMOTE_ADDR']);
//                    foreach ($this->request->data as $k => $v) {
////
//                    fwrite($r, $k . ' : ' . $v . PHP_EOL . PHP_EOL);
//                     }

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
        $description = isset($this->request->data['description']) ? $this->request->data['description'] : '';
        $duration = isset($this->request->data['duration']) ? $this->request->data['duration'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : ''; //get current date
        //['UserLooksex']['description']
        $type = isset($this->request->data['type']) ? $this->request->data['type'] : '';
        //===for calculate notification time calculate===//
        $actual_date = date('Y-m-d H:i:s', strtotime($end_time));
        $actual_endDate = strtotime($actual_date);
        $getprevDate = $actual_endDate - (60 * 10);
        $notification_time = date("Y-m-d H:i:s", $getprevDate);

        //End for exist time//
        if ($user_id && $profile_name && $start_time && $end_time && $my_physical_appearance && $his_physical_appearance && $my_sextual_preferences && $his_sextual_preferences && $my_social_habits && $his_social_habits && $current_date) {
            $login_user_member = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $login_user_member_type = $login_user_member['User']['member_type'];
            $login_user_removead = $login_user_member['User']['removead'];
            $login_user_is_trial = $login_user_member['User']['is_trial'];
            if ($login_user_member_type == 0) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['login_user_member_type'] = $login_user_member_type;
                $data['login_user_removead'] = $login_user_removead;
                $data['login_user_is_trial'] = $login_user_is_trial;
                echo json_encode($data);
                die;
            }
            $data['login_user_member_type'] = $login_user_member_type;
            $data['login_user_removead'] = $login_user_removead;
            $data['login_user_is_trial'] = $login_user_is_trial;
            /*             * ******* check user looking profile is active or not if inactive then delete profile lock *********** */
            $check_user_looksex_profile = $this->UserLooksex->find('first', array('conditions' => array(
                    'and' => array(
                        array('UserLooksex.start_time <=' => $current_date,
                            'UserLooksex.end_time >=' => $current_date
                        ),
                        'UserLooksex.user_id =' => $user_id
                    )
            )));
            if (count($check_user_looksex_profile) > 0) {
                //$check_user_looksex_active = 1;
            } else {
                /*                 * *********delete profile lock when user lokking profile expire****** */
                //$delete_user_lock_profile = $this->ProfileLock->find('all', array('conditions' => array('ProfileLock.user_id' => $user_id,'ProfileLock.is_locked' => 1,'ProfileLock.browse' => 'looking')));
                //if($delete_user_lock_profile){
                //$user_profilelock_id = Hash::extract($delete_user_lock_profile, '{n}.ProfileLock.id');
                //$this->ProfileLock->delete($user_profilelock_id);
                //}
                //$delete_lock_profile = $this->ProfileLock->find('all', array('conditions' => array('ProfileLock.lock_user_id' => $user_id,'ProfileLock.is_locked' => 1,'ProfileLock.browse' => 'looking')));
                //if($delete_lock_profile){
                //$profilelock_id = Hash::extract($delete_lock_profile, '{n}.ProfileLock.id');
                //$this->ProfileLock->delete($profilelock_id);
                //pr($this->UserLooksex->getDataSource()->getLog(true));die;
                // }
            }
            /*             * *********END************ */
            /* check if profile name already exists then update sex profile  else in sert sex profile */
            $looksex = $this->UserLooksex->find('all', array('conditions' => array('UserLooksex.user_id' => $user_id, 'UserLooksex.profile_name' => $profile_name)));
            //pr($looksex[0]['UserLooksex']);die;
            if ($looksex) {
                if ($type == '') {
                    $data['success'] = 3;
                    $data['msg'] = 'profile name already exists';
                } else {
                    //For check exist time//
                    $if_exist_profile = $this->UserLooksex->find('all', array('conditions' => array(
                            'and' => array(
                                array('UserLooksex.start_time <= ' => $end_time,
                                    'UserLooksex.end_time >= ' => $start_time
                                ),
                                'UserLooksex.user_id =' => $user_id
                            )
                    )));
                    if (count($if_exist_profile) > 0) {
                        $msg_array = '';
                        foreach ($if_exist_profile as $profile_exist) {
                            //expire active profile//
                            $this->UserLooksex->id = $profile_exist['UserLooksex']['id'];
                            //$end_time=date_create($current_date);
                            $newTime = date("Y-m-d H:i:s", strtotime($current_date . " -1 minutes"));
                            $this->UserLooksex->saveField('end_time', $newTime);
                            //end//
                            //$existing_end_time = $profile_exist['UserLooksex']['end_time']; 
                            //if($end_time>$existing_end_time)
                            //{
                            //    //get sucess
                            //   // die('check');
                            //}
                            //else
                            //{
                            // // die('success');
                            //  $msg_array .= $profile_exist['UserLooksex']['start_time'].' - '.$profile_exist['UserLooksex']['end_time'].', ';
                            //  $msg_error =rtrim($msg_array,' ,');
                            //  $data['success'] = 2;
                            //  $data['msg'] = 'Time already exist '.$msg_error;
                            //  echo json_encode($data);
                            //  die;
                            //}
                        }
                    }
                    //die('success');
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
                        'description' => addslashes($description),
                        'start_time' => date('Y-m-d H:i:s', strtotime($start_time)),
                        'end_time' => date('Y-m-d H:i:s', strtotime($end_time)),
                        'duration' => $duration,
                        'is_active' => 1,
                        'notification_time' => $notification_time,
                        'is_notify' => 0,
                        'modification_date' => date('Y-m-d H:i:s')
                    );
                    //pr($user);

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
                //pr($this->UserLooksex->getDataSource()->getLog(true));die
                //For check exist time//
                $if_exist_profile = $this->UserLooksex->find('all', array('conditions' => array(
                        'and' => array(
                            array('UserLooksex.start_time <= ' => $end_time,
                                'UserLooksex.end_time >= ' => $start_time
                            ),
                            'UserLooksex.user_id =' => $user_id
                        )
                )));
                if (count($if_exist_profile) > 0) {
                    $msg_array = '';
                    foreach ($if_exist_profile as $profile_exist) {
                        $this->UserLooksex->id = $profile_exist['UserLooksex']['id'];
                        $newTime = date("Y-m-d H:i:s", strtotime($current_date . " -1 minutes"));
                        $this->UserLooksex->saveField('end_time', $newTime);
                        unset($this->UserLooksex->id);
                        // $msg_array .= $profile_exist['UserLooksex']['start_time'].' - '.$profile_exist['UserLooksex']['end_time'].', ';
                    }
                    //$msg_error =rtrim($msg_array,' ,');
                    //$data['success'] = 2;
                    // $data['msg'] = 'Time already exist '.$msg_error;
                    // echo json_encode($data);
                    // die;
                    /*                     * ********* inactive invitaion i send and who send******* */
                    //$this->ShareAlbum->updateAll(
                    //array('ShareAlbum.is_received' => 2), array('ShareAlbum.receiver_id' => $user_id)
                    //);
                    //$this->ShareAlbum->updateAll(
                    //array('ShareAlbum.is_received' => 2), array('ShareAlbum.sender_id' => $user_id)
                    //);
                    /*                     * ********* inactive invitaion when user look profile expire******* */
                    //$this->ChatUser->updateAll(
                    //array('ChatUser.invite' => 0), array('ChatUser.user_id' => $user_id)
                    //);
                    //delete all profile lock
                    //   $this->ProfileLock->deleteAll(
                    //array(
                    //    "ProfileLock.user_id" => $user_id,
                    //    'ProfileLock.is_locked' => 1,
                    //    'ProfileLock.browse' => 'looking'
                    //)
                    //);
                    //       $this->ProfileLock->deleteAll(
                    //    array(
                    //        "ProfileLock.lock_user_id" => $user_id,
                    //        'ProfileLock.is_locked' => 1,
                    //        'ProfileLock.browse' => 'looking'
                    //    )
                    //);
                }

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
                    'description' => addslashes($description),
                    'start_time' => date('Y-m-d H:i:s', strtotime($start_time)),
                    'end_time' => date('Y-m-d H:i:s', strtotime($end_time)),
                    'duration' => $duration,
                    'is_active' => 1,
                    'notification_time' => $notification_time,
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
            $data['msg'] = 'user id and profile name or some field should not be blank';
        }
        echo json_encode($data);
    }

    /*     * *****************End**************************** */


    /*     * ****** this service use for view looking sex data 11022015 --- Mir ---******** */

    public function view_looking_sex() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        if ($user_id) {
            //===login userdetails===//
            $login_user_member = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $login_user_member_type = $login_user_member['User']['member_type'];
            $login_user_removead = $login_user_member['User']['removead'];
            $login_user_is_trial = $login_user_member['User']['is_trial'];
            if ($login_user_member_type == 0) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['login_user_member_type'] = $login_user_member_type;
                $data['login_user_removead'] = $login_user_removead;
                $data['login_user_is_trial'] = $login_user_is_trial;
                echo json_encode($data);
                die;
            }
            $data['login_user_member_type'] = $login_user_member_type;
            $data['login_user_removead'] = $login_user_removead;
            $data['login_user_is_trial'] = $login_user_is_trial;
            //====End====//
            $userlooksex = $this->UserLooksex->find('all', array('conditions' => array('UserLooksex.user_id' => $user_id), 'order' => array('UserLooksex.id asc')));

            foreach ($userlooksex as $key => $value) {

                $if_exist_profile = $this->UserLooksex->find('first', array('conditions' => array(
                        'and' => array(
                            array('UserLooksex.start_time <=' => $current_date,
                                'UserLooksex.end_time >=' => $current_date
                            ),
                            'UserLooksex.id =' => $value['UserLooksex']['id']
                        )
                )));
                //pr($if_exist_profile); die;
                if (count($if_exist_profile) > 0) {
                    $is_profile_active = 1;
                } else {
                    $is_profile_active = 0;
                }
                $userlooksex[$key]['UserLooksex']['description'] = stripslashes($value['UserLooksex']['description']);
                $userlooksex[$key]['UserLooksex']['my_physical_appearance'] = stripslashes($value['UserLooksex']['my_physical_appearance']);
                $userlooksex[$key]['UserLooksex']['his_physical_appearance'] = stripslashes($value['UserLooksex']['his_physical_appearance']);
                $userlooksex[$key]['UserLooksex']['my_sextual_preferences'] = stripslashes($value['UserLooksex']['my_sextual_preferences']);
                $userlooksex[$key]['UserLooksex']['his_sextual_preferences'] = stripslashes($value['UserLooksex']['his_sextual_preferences']);
                $userlooksex[$key]['UserLooksex']['my_social_habits'] = stripslashes($value['UserLooksex']['my_social_habits']);
                $userlooksex[$key]['UserLooksex']['his_social_habits'] = stripslashes($value['UserLooksex']['his_social_habits']);
                $userlooksex[$key]['UserLooksex']['is_profile_active'] = $is_profile_active;
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
        if ($user_id && $my_traits && $his_traits && $my_interest && $my_physical_appearance && $his_physical_appearance && $my_sextual_preferences && $his_sextual_preferences && $my_social_habits && $his_social_habits) {
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
            $data['msg'] = 'user id or some field value not found';
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
            $user_details = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $login_user_member_type = $user_details['User']['member_type'];
            $login_user_removead = $user_details['User']['removead'];
            $login_user_is_trial = $user_details['User']['is_trial'];
            //$option['fields'] = array('id','user_id','photo_name AS image','creation_date');
            // $option['conditions'] =  array('Archive.user_id' => $user_id);
            $archive = $this->Archive->find('all', array('conditions' => array('Archive.user_id' => $user_id), 'order' => array('Archive.id' => 'desc')));
            //$view_recent_images = $this->RecentImage->find('all', array('conditions' => array('RecentImage.user_id' => $user_id),'order' => array('RecentImage.id desc')));
            //pr($view_recent_images);
            //pr($archive);
            //$total_data=array_merge($view_recent_images,$archive);
            //foreach($total_data as $key=>$RecentImage) {
            //foreach($RecentImage as $k=>$val_image)
            //{
            //   $recent_img []['RecentImage'] = $val_image;
            //    
            //}
            //
            //}
            //pr($recent_img);
            if ($archive) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['login_user_member_type'] = $login_user_member_type;
                $data['login_user_removead'] = $login_user_removead;
                $data['login_user_is_trial'] = $login_user_is_trial;
                $data['screen_name'] = $user_details['User']['screen_name'];
                $data['data'] = Hash::extract($archive, '{n}.Archive');
                //$data['recent_images'] = Hash::extract($view_recent_images, '{n}.RecentImage');
                $data['path'] = PIC_PATH;
                // $data['recent_image_path'] = RECENT_IMG_PATH;
            } else {
                $data['success'] = 0;
                $data['login_user_member_type'] = $login_user_member_type;
                $data['login_user_removead'] = $login_user_removead;
                $data['login_user_is_trial'] = $login_user_is_trial;
                $data['msg'] = 'no data found';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id not found';
        }
        $banner = $this->Banner->findById(1);
        if ($banner) {
            $banner_image = $banner['Banner']['banner_image'];
        } else {
            $banner_image = '';
        }
        $data['Banner']['image'] = $banner_image;
        $data['Banner']['image_path'] = BANNER_IMG_PATH;
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
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        if ($sender_id && $receiver_id) {
            //======get member type  free user or paid user==//
            $login_user_member = $this->User->find('first', array('conditions' => array('User.id' => $sender_id)));
            $member_type = $login_user_member['User']['member_type'];
            //=======End============//
            $album = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $sender_id)));
            if ($album) {
                $sharealbum = $this->ShareAlbum->find('first', array('conditions' => array('ShareAlbum.sender_id' => $sender_id, 'ShareAlbum.receiver_id' => $receiver_id)));
                if ($sharealbum) {
                    /*                     * ***** if is_received=1 then set is_received=2 means unshare and if  is_received=2 then set is_received=1 means share*** */
                    if ($sharealbum['ShareAlbum']['is_received'] == 1) {
                        $is_received = 2;
                        $is_view = 0;
                    } else {
                        $is_received = 1;
                        $is_view = 1;
                    }
                    /*                     * *********** unshare album access ************ */
                    $user['ShareAlbum'] = array(
                        'id' => $sharealbum['ShareAlbum']['id'],
                        'sender_id' => $sender_id,
                        'receiver_id' => $receiver_id,
                        'is_received' => $is_received,
                        'is_view' => $is_view,
                        'creation_date' => $current_date
                    );
                    // pr($sharealbum);
                    $data['success'] = 2;
                    $data['msg'] = 'already share album';
                } else {
                    $is_received = 1;
                    /*                     * *********** share album access ************ */
                    $user['ShareAlbum'] = array(
                        //'id' => $sharealbum[0]['ShareAlbum']['id'],
                        'sender_id' => $sender_id,
                        'receiver_id' => $receiver_id,
                        'is_view' => 1,
                        'is_received' => $is_received,
                        'creation_date' => $current_date
                    );
                }
                //if($member_type==0){
                $limit = $this->match_limit($member_type, 'PrivateAlbumSharePerDay');
                if ($user['ShareAlbum']['is_received'] == 1) {
                    if ($limit != 0) {
                        $count_sharealbum_per_day = $this->ShareAlbum->find('count', array('conditions' => array('ShareAlbum.sender_id' => $sender_id, 'ShareAlbum.is_received' => 1, 'DATE(ShareAlbum.creation_date)' => date('Y-m-d', strtotime($current_date)))));
                        //pr($limit);
                        //echo $count_sharealbum_per_day;
                        //die;
                        if ($count_sharealbum_per_day >= $limit) {
                            echo json_encode(array('success' => 3, 'msg' => 'You have reached your Album Shares limit of ' . number_format($limit) . ' guys per day.'));
                            exit();
                        }
                    }
                }
                //}
                //die;
                if ($this->ShareAlbum->save($user)) {
                    /*                     * ***********total count message ************ */
                    $chatusers = $this->ChatUser->find('all', array('conditions' => array('ChatUser.chat_user_id' => $receiver_id)));
                    $total_unread_message = 0;
                    if ($chatusers) {

                        foreach ($chatusers as $key => $value) {
                            if ($value['ChatUser']['invite'] > 0) {
                                $invite = 1;
                            } else {
                                $invite = 0;
                            }
                            $total_unread_message+=($value['ChatUser']['count'] + $invite);
                        }
                    }
                    /*                     * *******count user locked profie or not ******** */
                    //$profilelockcount=$this->ProfileLock->find('all', array('conditions' => array('ProfileLock.count' => 1, 'ProfileLock.lock_user_id' => $receiver_id)));
                    //if($profilelockcount) { 
                    //        $total_unread_message+=count($profilelockcount);                         
                    //}

                    if ($total_unread_message == 0) {
                        $total_unread_message = '';
                    }
                    /*                     * ***********End******************** */
                    /*                     * ****** get user name for push notification ************ */

                    $username = $this->User->findById($sender_id);
                    /*                     * ************* END ******************** */
                    /*                     * ***** for push notification **************** */
                    $userdetails = $this->User->findById($receiver_id);
                    if ($userdetails) {
                        $device_type = $userdetails['User']['device_type'];
                        $device_token = $userdetails['User']['device_token'];
                        $online_status = $userdetails['User']['online_status'];
                        // pr($device_token);
                        /*                         * ******count total user view my profile******** */
                        $count_view = $this->count_view($receiver_id);
                        /*                         * ******End********* */
                        /*                         * ******count total user share album with me******** */
                        $count_sharealbum = $this->count_sharealbum($receiver_id);
                        $total_view_and_share = $count_view + $count_sharealbum;
                        //pr($count_sharealbum);die;
                        /*                         * ******End********* */
                        /*                         * ********* send notification for android ************* */
                        if ($device_type == 'android') {
                            if ($is_received == 1 && $online_status == 1) {
                                $device_token = array($device_token);
                                $msg = $username['User']['screen_name'] . ' share album with you';
                                $message = array("msg" => $msg, 'sound' => 'default');
                                $this->GCM->send_notification($device_token, $message);
                                //$result = $gcm->send_notification($device_ids, $message);
                            }
                        } else {
                            //echo $is_received;
                            if ($is_received == 1 && $online_status == 1) {
                                /*                                 * ********* send notification for ios ************* */
                                $pemfile = WWW_ROOT . 'files/looking.pem';
                                $passphrase = 'looking';
                                $msg = $username['User']['screen_name'] . ' share album with you';
                                $ctx = stream_context_create();
                                stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfile);
                                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                                // Open a connection to the APNS server
                                $fp = stream_socket_client(
                                        'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

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
                                //$payload = json_encode($body);
                                $payload = '{"aps":{"alert":"' . $msg . '","count_unread_msg" : 1,"type" : "share_album","total_view_and_share":"' . (int) $total_view_and_share . '","sound":"default","badge":' . (int) $total_unread_message . '}}';
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
                $data['success'] = 4;
                $data['msg'] = 'please add some images';
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
            $login_user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $member_type = $login_user['User']['member_type'];
            /*             * *********update viewer table is_view********** */
            $this->ShareAlbum->updateAll(
                    array('ShareAlbum.is_view' => 0), array('ShareAlbum.receiver_id' => $user_id)
            );
            /*             * ****END******** */
            //======get limit for free user or paid user==//
            $limit = $this->match_limit($member_type, 'AlbumReceived');
            //======End===========//
            $option['limit'] = $limit;
            $option['fields'] = array('User.*', 'Profile.*', 'ShareAlbum.*');
            $option['joins'] = array(
                array('table' => 'share_albums',
                    'alias' => 'ShareAlbum',
                    'type' => 'INNER',
                    'conditions' => array('User.id = ShareAlbum.sender_id')
            ));
            $option['conditions'] = array('ShareAlbum.receiver_id' => $user_id, 'ShareAlbum.is_received' => 1);
            $option['order'] = array('ShareAlbum.creation_date' => 'DESC');
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
                $data['login_user'] = $login_user;
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
        $banner = $this->Banner->findById(1);
        if ($banner) {
            $banner_image = $banner['Banner']['banner_image'];
        } else {
            $banner_image = '';
        }
        $data['Banner']['image'] = $banner_image;
        $data['Banner']['image_path'] = BANNER_IMG_PATH;
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
            $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
            $recently_email = isset($this->request->data['recently_email']) ? $this->request->data['recently_email'] : ''; //this send email recently or online
            $data = $this->UserLookdate->findById($userdata['UserLookdate']['id']);
            //get inactive user id by admin//
            $get_unbanuser = $this->User->find('all', array('conditions' => array('User.status' => 0)));
            $unban_user_id = Hash::extract($get_unbanuser, '{n}.User.id');
            //===blocked by login user===//
            $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $this->request->data['user_id'])));
            $block_user_id = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
            //========blocked login user by others========//
            $get_block_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.blocked_id' => $this->request->data['user_id'])));
            $block_others_user_id = Hash::extract($get_block_user_data, '{n}.BlockedUser.user_id');
            $block_user = array_merge($block_user_id, $block_others_user_id, $unban_user_id);
            if (count($block_user) > 0) {
                $block_user_id = ',' . implode(',', $block_user);
            } else {
                $block_user_id = '';
            }
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $login_user = $this->User->find('all', array('conditions' => array('User.id' => $this->request->data['user_id'])));
            $login_user_lat = $login_user[0]['User']['lat'];
            $login_user_long = $login_user[0]['User']['long'];
            $login_user_member_type = $login_user[0]['User']['member_type'];
            $login_user_removead = $login_user[0]['User']['removead'];
            $login_user_is_trial = $login_user[0]['User']['is_trial'];

            foreach ($login_user as $key1 => $value1) {
                $login_user[$key1]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value1['User']['id']);
            }
            //======get limit for free user or paid user==//
            $limit = $this->match_limit($login_user_member_type, 'Match');
            $limit = $limit - 1;
            //`chat_users` AS `ChatUser` ON (`ChatUser`.`user_id` = `User`.`id` AND `ChatUser`.`chat_user_id` = '3')
            if (!empty($data)) {

                //=========End================//
                //$SqlQry = "SELECT User.*,( 6371 * acos( cos( radians('" . $login_user_lat . "') ) * cos( radians( lat ) ) * cos( radians( `long` ) - radians('" . $login_user_long . "') ) + sin( radians('" . $login_user_lat . "') ) * sin( radians( lat ) ) ) ) AS database_distance,Profile.*,UserPartner.*,ChatUser.* FROM user_lookdates
                // left join users as User on user_lookdates.user_id=User.id
                // left join profiles as Profile on user_lookdates.user_id=Profile.user_id
                // left join user_partners as UserPartner on user_lookdates.user_id=UserPartner.user_id
                // left join chat_users as ChatUser on (`ChatUser`.`user_id` = `User`.`id` AND `ChatUser`.`chat_user_id` =".$this->request->data['user_id'].")
                // WHERE
                // User.registration_status = 3 and User.email IN('".$recently_email."')  and
                // user_lookdates.user_id NOT IN (".$this->request->data['user_id'].$block_user_id.")   
                // 
                // and (`my_traits` REGEXP REPLACE('" . $data['UserLookdate']['his_traits'] . "', ',','(\\,|$)|')
                // or `my_physical_appearance` REGEXP REPLACE('" . $data['UserLookdate']['his_physical_appearance'] . "', ',','(\\,|$)|')
                // or `my_sextual_preferences` REGEXP REPLACE('" . $data['UserLookdate']['his_sextual_preferences'] . "', ',','(\\,|$)|')
                // or `my_social_habits` REGEXP REPLACE('" . $data['UserLookdate']['his_social_habits'] . "', ',','(\\,|$)|')) order by database_distance asc limit ".$limit;


                $SqlQry = "SELECT User.*,( 6371 * acos( cos( radians('" . $login_user_lat . "') ) * cos( radians( lat ) ) * cos( radians( `long` ) - radians('" . $login_user_long . "') ) + sin( radians('" . $login_user_lat . "') ) * sin( radians( lat ) ) ) ) AS database_distance,Profile.*,UserPartner.*,ChatUser.* FROM user_lookdates
                left join users as User on user_lookdates.user_id=User.id
                left join profiles as Profile on user_lookdates.user_id=Profile.user_id
                left join user_partners as UserPartner on user_lookdates.user_id=UserPartner.user_id
                left join chat_users as ChatUser on (`ChatUser`.`user_id` = `User`.`id` AND `ChatUser`.`chat_user_id` =" . $this->request->data['user_id'] . ")
                WHERE
                User.registration_status = 3 and User.email IN(" . $recently_email . ")  and
                user_lookdates.user_id NOT IN (" . $this->request->data['user_id'] . $block_user_id . ")   
			    order by database_distance asc limit " . $limit;
                $result = $this->UserLookdate->query($SqlQry);
                //pr($result);die;
                // pr($this->UserLookdate->getDataSource()->getLog());
//                $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
//                $login_user = $this->User->find('all', array('conditions' => array('User.id' => $this->request->data['user_id'])));
//                $login_user_lat=$login_user[0]['User']['lat'];
//                $login_user_long=$login_user[0]['User']['long'];
//				$login_user_member_type=$login_user[0]['User']['member_type'];
//				$login_user_removead=$login_user[0]['User']['removead'];
//
//                foreach($login_user as $key1=>$value1) {
//                $login_user[$key1]['User']['looking_profile_active'] = $this->check_profile_active($current_date,$value1['User']['id']);
//                }
                //if (count($login_user) > 0) {
                //    $result = array_merge($login_user, $result);
                //}
                $all_user_data = array();
                $filter_cache = array();
                /*                 * **********unread message count ***** */
                $options['fields'] = array('User.*', 'Profile.*', 'UserPartner.*', 'ChatUser.*');
                $options['joins'] = array(
                    array('table' => 'chat_users',
                        'alias' => 'ChatUser',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ChatUser.user_id = User.id',
                            'AND' => array(
                                array('ChatUser.chat_user_id' => $this->request->data['user_id']),
                            )
                        )
                ));
                $options['conditions'] = array('User.id !=' => $this->request->data['user_id'], "NOT" => array('User.id' => $block_user));
                $options['order'] = array('ChatUser.creation_date' => 'DESC');
                $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
                $chatusers = $this->User->find('all', $options);
                $total_unread_message = 0;
                if ($chatusers) {

                    foreach ($chatusers as $key => $value) {
                        if ($value['ChatUser']['invite'] > 0) {
                            $invite = 1;
                        } else {
                            $invite = 0;
                        }
                        //if($browse=='dating'){
                        $is_active_look_date = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id' => $value['ChatUser']['user_id'])));
                        if ($is_active_look_date) {
                            $total_unread_message+=$value['ChatUser']['count'];
                        }
                        $total_unread_message+=$invite;
                        // }
                        //$total_unread_message+=($value['ChatUser']['count']+$invite);                         
                    }
                }
                /*                 * *******count user locked profie or not ******** */
                //$profilelockcount=$this->ProfileLock->find('all', array('conditions' => array('ProfileLock.count' => 1, 'ProfileLock.lock_user_id' => $this->request->data['user_id'])));
                //if($profilelockcount) { 
                //        $total_unread_message+=count($profilelockcount);                         
                //}
                // pr($profilelockcount);die;
                /*                 * **********End********* */
                //$total_unread_message=0;
                //if (!empty($result)) {
                $user_data = array_unique($result, SORT_REGULAR);
                foreach ($user_data as $key => $value) {
                    unset($user_data[$key][0]);
                    $user_data[$key]['User']['distance'] = $this->distance($login_user_lat, $login_user_long, $value['User']['lat'], $value['User']['long'], 'M');
                    $user_data[$key]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value['User']['id']);
                }
                $user_data = Set::sort($user_data, '{n}.User.distance', 'asc');
                $all_user_data = array_merge($login_user, $user_data);
                /*                 * ********check user view my profile ********* */
                $is_view = $this->check_view($this->request->data['user_id']);
                /*                 * ********END************ */
                /*                 * ******count total user view my profile******** */
                $count_view = $this->count_view($this->request->data['user_id']);
                /*                 * ******End********* */
                /*                 * ******count total user share album with me******** */
                $count_sharealbum = $this->count_sharealbum($this->request->data['user_id']);
                $total_view_and_share = $count_view + $count_sharealbum;
                /*                 * ******End********* */
                /*                 * ******check any one share album with me******** */
                $is_share = $this->check_sharealbum($this->request->data['user_id']);
                /*                 * ******End********* */
                /*                 * *****check profile active ********* */
                $is_profile_active = $this->check_profile_active($current_date, $this->request->data['user_id']);
                /*                 * ********END***************** */
                //***************for filter chache**********//
                $if_exist_save_filter = $this->MatchesFilterValue->find('first', array('conditions' => array(
                        'MatchesFilterValue.user_id ' => $this->request->data['user_id'],
                        'MatchesFilterValue.type ' => 'dating'
                )));
                if ($if_exist_save_filter) {
                    $filter_cache = $if_exist_save_filter['MatchesFilterValue'];
                }

                //***************END***************//
                if ($all_user_data) {
                    /*                     * *****get the max accuricy number ******* */
                    $accuracy_value = Hash::extract($all_user_data, '{n}.User.accuracy');
                    //pr($accuracy_value);die;
                    $accuracy_max_value = (int) max($accuracy_value);
                    /*                     * **********END*************** */
                }
                /*                 * ******for give user looksex data******** */
                $user_looksexdata = array();
                $user_looksex = $this->UserLooksex->find('first', array('conditions' => array(
                        'and' => array(
                            array(
                                'UserLooksex.user_id ' => $this->request->data['user_id'],
                                'UserLooksex.start_time <=' => $current_date,
                                'UserLooksex.end_time >=' => $current_date
                            )
                        )
                )));
                if ($user_looksex) {
                    $user_looksexdata = $user_looksex['UserLooksex'];
                }
                /*                 * **********END**************** */
                //pr($this->UserLookdate->getDataSource()->getLog());die;

                echo json_encode(array('success' => 1, 'is_share_album' => $is_share, 'is_viewed' => $is_view, 'total_unread_message' => $total_unread_message, 'total_view_and_share' => $total_view_and_share, 'user_looking_profile_active' => $is_profile_active, 'accuracy' => $accuracy_max_value, 'login_user_member_type' => $login_user_member_type, 'login_user_removead' => $login_user_removead, 'login_user_is_trial' => $login_user_is_trial, 'filter_cache' => $filter_cache, 'userlooksex_data' => $user_looksexdata, 'data' => $all_user_data, 'path' => PIC_PATH));
                die;
                // } else {
                // echo json_encode(array('success' => 2, 'msg' => 'Not matches found'));
                // die;
                // }
            } else {
                echo json_encode(array('success' => 2, 'login_user_member_type' => $login_user_member_type, 'login_user_removead' => $login_user_removead, 'login_user_is_trial' => $login_user_is_trial, 'msg' => 'Not found'));
                die;
            }
        }
    }

    public function use_profile_looksex() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            if ($this->request->data['id'] != '' && $this->request->data['user_id'] != '') {
                $userdata['UserLooksex']['id'] = $this->request->data['id'];
                $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
                //get inactive user id by admin//
                $get_unbanuser = $this->User->find('all', array('conditions' => array('User.status' => 0)));
                $unban_user_id = Hash::extract($get_unbanuser, '{n}.User.id');
                //===blocked by login user===//
                $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $this->request->data['user_id'])));
                $block_user_id = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
                //========blocked login user by others========//
                $get_block_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.blocked_id' => $this->request->data['user_id'])));
                $block_others_user_id = Hash::extract($get_block_user_data, '{n}.BlockedUser.user_id');
                $block_user = array_merge($block_user_id, $block_others_user_id, $unban_user_id);
                if (count($block_user) > 0) {
                    $block_user_id = ',' . implode(',', $block_user);
                } else {
                    $block_user_id = '';
                }
                $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
                $login_user = $this->User->find('all', array('conditions' => array('User.id' => $this->request->data['user_id'])));
                $login_user_lat = $login_user[0]['User']['lat'];
                $login_user_long = $login_user[0]['User']['long'];
                $login_user_member_type = $login_user[0]['User']['member_type'];
                $login_user_removead = $login_user[0]['User']['removead'];
                $login_user_is_trial = $login_user[0]['User']['is_trial'];
                foreach ($login_user as $key1 => $value1) {
                    $login_user[$key1]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value1['User']['id']);
                }
                //======get limit for free user or paid user==//
                $limit = $this->match_limit($login_user_member_type, 'Match');
                $limit = $limit - 1;
                //=========End================//
                $data = $this->UserLooksex->findById($userdata['UserLooksex']['id']);
                if (!empty($data)) {

                    $SqlQry = "SELECT User.*,( 6371 * acos( cos( radians('" . $login_user_lat . "') ) * cos( radians( lat ) ) * cos( radians( `long` ) - radians('" . $login_user_long . "') ) + sin( radians('" . $login_user_lat . "') ) * sin( radians( lat ) ) ) ) AS database_distance,Profile.*,UserPartner.*,ChatUser.*,UserLooksex.* FROM user_looksexes as UserLooksex
                    left join users as User on UserLooksex.user_id=User.id
                    left join profiles as Profile on UserLooksex.user_id=Profile.user_id
                    left join user_partners as UserPartner on UserLooksex.user_id=UserPartner.user_id
                    left join chat_users as ChatUser on (`ChatUser`.`user_id` = `User`.`id` AND `ChatUser`.`chat_user_id` =" . $this->request->data['user_id'] . ")
                    WHERE
                     User.registration_status = 3 and
                    UserLooksex.user_id NOT IN (" . $this->request->data['user_id'] . $block_user_id . ") 
                     
                    and UserLooksex.start_time <= '" . $current_date . "' and UserLooksex.end_time >= '" . $current_date . "'group by UserLooksex.user_id order by database_distance asc limit " . $limit;
                    $result = $this->UserLooksex->query($SqlQry);
//                    $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
//                    $login_user = $this->User->find('all', array('conditions' => array('User.id' => $this->request->data['user_id'])));
//                    $login_user_lat=$login_user[0]['User']['lat'];
//                    $login_user_long=$login_user[0]['User']['long'];
//					$login_user_member_type=$login_user[0]['User']['member_type'];
//					$login_user_removead=$login_user[0]['User']['removead'];		
//                    foreach($login_user as $key1=>$value1) {
//                $login_user[$key1]['User']['looking_profile_active'] = $this->check_profile_active($current_date,$value1['User']['id']);
//                    }
                    /*                     * **********unread message count ***** */
                    $options['fields'] = array('User.*', 'Profile.*', 'UserPartner.*', 'ChatUser.*');
                    $options['joins'] = array(
                        array('table' => 'chat_users',
                            'alias' => 'ChatUser',
                            'type' => 'INNER',
                            'conditions' => array(
                                'ChatUser.user_id = User.id',
                                'AND' => array(
                                    array('ChatUser.chat_user_id' => $this->request->data['user_id']),
                                )
                            )
                    ));
                    $options['conditions'] = array('User.id !=' => $this->request->data['user_id'], "NOT" => array('User.id' => $block_user));
                    $options['order'] = array('ChatUser.creation_date' => 'DESC');
                    $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
                    $chatusers = $this->User->find('all', $options);
                    $total_unread_message = 0;
                    if ($chatusers) {

                        foreach ($chatusers as $key => $value) {
                            /*                             * ****check message sender profile active or not ********* */
                            $is_profile_active = $this->check_profile_active($current_date, $value['ChatUser']['user_id']);
                            if ($is_profile_active == 0) {
                                $this->ChatUser->updateAll(
                                        array('ChatUser.count' => 0), array('ChatUser.user_id' => $value['ChatUser']['user_id'], 'ChatUser.chat_user_id' => $value['ChatUser']['chat_user_id']));
                            }
                            /*                             * ****END********* */
                            // if($value['ChatUser']['invite']>0){
                            //     $invite=1;
                            // }else{
                            //    $invite=0; 
                            // }
                            //// echo $value['ChatUser']['count'];
                            // $total_unread_message+=($value['ChatUser']['count']+$invite);                         
                        }
                    }
                    /*                     * **********End********* */
                    /*                     * *******count user locked profie or not ******** */
                    //$profilelockcount=$this->ProfileLock->find('all', array('conditions' => array('ProfileLock.count' => 1, 'ProfileLock.lock_user_id' => $this->request->data['user_id'])));
                    //if($profilelockcount) { 
                    //        $total_unread_message+=count($profilelockcount);                         
                    //}
                    //=== For is active checking===//
                    $all_user_data = array();
                    $filter_cache = array();
                    $user_looksexdata = array();

                    //$total_unread_message=0;
                    $if_exist_profile = $this->UserLooksex->find('first', array('conditions' => array(
                            'and' => array(
                                array('UserLooksex.start_time <=' => $current_date,
                                    'UserLooksex.end_time >=' => $current_date
                                ),
                                'UserLooksex.id =' => $userdata['UserLooksex']['id']
                            )
                    )));
                    if (count($if_exist_profile) > 0) {
                        $is_profile_active = 1;
                        $user_looksexdata = $if_exist_profile['UserLooksex'];
                    } else {
                        $is_profile_active = 0;
                    }
                    //if (count($login_user) > 0) {
                    //    $result = array_merge($login_user, $result);
                    //}
                    //if (!empty($result)) {
                    $user_data = array_unique($result, SORT_REGULAR);
                    foreach ($user_data as $key => $value) {
                        unset($user_data[$key][0]);
                        $user_data[$key]['User']['distance'] = $this->distance($login_user_lat, $login_user_long, $value['User']['lat'], $value['User']['long'], 'M');
                        $user_data[$key]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value['User']['id']);
                        if ($value['ChatUser']['invite'] > 0) {
                            $invite = 1;
                        } else {
                            $invite = 0;
                        }
                        // echo $value['ChatUser']['count'];
                        $total_unread_message+=($value['ChatUser']['count'] + $invite);
                        /*                         * ******percentage count for sorting******** */
                        if ($if_exist_profile) {
                            //echo ""
                            $physical = $this->percentage($if_exist_profile['UserLooksex']['his_physical_appearance'], $value['UserLooksex']['my_physical_appearance']);
                            $sextual = $this->percentage($if_exist_profile['UserLooksex']['his_sextual_preferences'], $value['UserLooksex']['my_sextual_preferences']);
                            $social_habits = $this->percentage($if_exist_profile['UserLooksex']['his_social_habits'], $value['UserLooksex']['my_social_habits']);
                            $identity = $this->percentage($login_user[0]['Profile']['his_identitie'], $value['Profile']['identity']);
                            $overall_per_sum = ($physical + $sextual + $social_habits + $identity);
                            if ($overall_per_sum > 0) {
                                $overall_percentage = round(($overall_per_sum * 100) / 400);
                            } else {
                                $overall_percentage = 0;
                            }

                            //echo $overall_percentage;die;
                        } else {
                            $overall_percentage = 0;
                        }

                        $user_data[$key]['User']['percentage'] = $overall_percentage;
                        unset($user_data[$key]['UserLooksex']);
                        /*                         * **End*********** */
                    }
                    //$user_data=Set::sort($user_data, '{n}.User.percentage', 'desc');
                    $user_data = Set::sort($user_data, '{n}.User.distance', 'asc');
                    $all_user_data = array_merge($login_user, $user_data);
                    /*                     * ********check user view my profile ********* */
                    $is_view = $this->check_view($this->request->data['user_id']);
                    /*                     * ********END************ */
                    /*                     * ******check any one share album with me******** */
                    $is_share = $this->check_sharealbum($this->request->data['user_id']);
                    /*                     * ******End********* */
                    /*                     * ******count total user view my profile******** */
                    $count_view = $this->count_view($this->request->data['user_id']);
                    /*                     * ******End********* */
                    /*                     * ******count total user share album with me******** */
                    $count_sharealbum = $this->count_sharealbum($this->request->data['user_id']);
                    $total_view_and_share = $count_view + $count_sharealbum;
                    /*                     * ******End********* */
                    //***************for filter chache**********//
                    $if_exist_save_filter = $this->MatchesFilterValue->find('first', array('conditions' => array(
                            'MatchesFilterValue.user_id ' => $this->request->data['user_id'],
                            'MatchesFilterValue.type ' => 'looking'
                    )));
                    if ($if_exist_save_filter) {
                        $filter_cache = $if_exist_save_filter['MatchesFilterValue'];
                    }

                    //***************END***************//
                    if ($all_user_data) {
                        /*                         * *****get the max accuricy number ******* */
                        $accuracy_value = Hash::extract($all_user_data, '{n}.User.accuracy');
                        //pr($accuracy_value);die;
                        $accuracy_max_value = (int) max($accuracy_value);
                        /*                         * **********END*************** */
                    }
                    echo json_encode(array('success' => 1, 'is_share_album' => $is_share, 'is_viewed' => $is_view, 'total_unread_message' => $total_unread_message, 'total_view_and_share' => $total_view_and_share, 'is_profile_active' => $is_profile_active, 'accuracy' => $accuracy_max_value, 'login_user_member_type' => $login_user_member_type, 'login_user_removead' => $login_user_removead, 'login_user_is_trial' => $login_user_is_trial, 'filter_cache' => $filter_cache, 'userlooksex_data' => $user_looksexdata, 'data' => $all_user_data, 'path' => PIC_PATH));
                    die;
                    //} else {
                    //  echo json_encode(array('success' => 2, 'msg' => 'Not matches found'));
                    // die;
                    // }
                } else {
                    echo json_encode(array('success' => 2, 'login_user_member_type' => $login_user_member_type, 'login_user_removead' => $login_user_removead, 'login_user_is_trial' => $login_user_is_trial, 'msg' => 'Not found'));
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
        $browse = isset($this->request->data['browse']) ? $this->request->data['browse'] : ''; // add to favourite from which section (browser,looking_date or looking_sex)
        if ($user_id && $favourite_user_id && $browse) {
            //======get limit for free user or paid user==//
            $login_user_member_type = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $member_type = $login_user_member_type['User']['member_type'];
            $limit = $this->match_limit($member_type, 'Favorite');
            //=======End============//
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
                    'browse' => $browse,
                    'creation_date' => date('Y-m-d H:i:s'),
                    'modification_date' => date('Y-m-d H:i:s')
                );
                // pr($sharealbum);
            } else {
                $favouriteuser['Favourite'] = array(
                    'user_id' => $user_id,
                    'favourite_user_id' => $favourite_user_id,
                    'is_favourite' => 1,
                    'browse' => $browse,
                    'creation_date' => date('Y-m-d H:i:s')
                );
            }
            if ($favouriteuser['Favourite']['is_favourite'] == 1) {
                $count_favourite = $this->Favourite->find('count', array('conditions' => array('Favourite.user_id' => $user_id, 'Favourite.is_favourite' => 1, 'Favourite.browse' => $browse)));
                //pr($limit);
                //die;
                if ($count_favourite >= $limit) {

                    echo json_encode(array('success' => 3, 'msg' => 'You have reached your Favorite limit of ' . number_format($limit) . ' guys. Please remove a Favorite if you would like to add a new one.'));
                    exit();
                }
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
            $data['msg'] = 'user id and favourite user id or browse not found';
        }
        echo json_encode($data);
    }

    /*     * ********* add to favourite screen and unfavourite screen ************** */

    public function view_favourite_screen() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $browse = isset($this->request->data['browse']) ? $this->request->data['browse'] : ''; // view favourite from which section (browser,looking_date or looking_sex)
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        //$favourite_user_id = isset($this->request->data['favourite_user_id']) ? $this->request->data['favourite_user_id'] : ''; // who receive album
        /*         * ********for filter by default distance wise sorting so we can not work on distanc sort****** */
        $last_login = isset($this->request->data['last_login']) ? $this->request->data['last_login'] : '';
        $mutual_favorites = isset($this->request->data['mutual_favorites']) ? $this->request->data['mutual_favorites'] : '';
        $recently_added = isset($this->request->data['recently_added']) ? $this->request->data['recently_added'] : '';
        $search_value = isset($this->request->data['search_value']) ? $this->request->data['search_value'] : '';
        /*         * *********END************ */
        if ($user_id && $browse) {
            //get inactive user id by admin//
            $get_unbanuser = $this->User->find('all', array('conditions' => array('User.status' => 0)));
            $unban_user_id = Hash::extract($get_unbanuser, '{n}.User.id');
            //===blocked by login user===//
            $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $user_id)));
            $block_user_id = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
            //========blocked login user by others========//
            $get_block_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.blocked_id' => $user_id)));
            $block_others_user_id = Hash::extract($get_block_user_data, '{n}.BlockedUser.user_id');
            $bock_user_id = array_merge($block_user_id, $block_others_user_id, $unban_user_id);
            /*             * *******END************ */
            /*             * *********login user details ********* */
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $login_user = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
            $login_user_lat = $login_user[0]['User']['lat'];
            $login_user_long = $login_user[0]['User']['long'];
            $member_type = $login_user[0]['User']['member_type'];
            $removead = $login_user[0]['User']['removead'];

            //foreach($login_user as $key1=>$value1) {
            //    $login_user[$key1]['User']['looking_profile_active'] = $this->check_profile_active($current_date,$value1['User']['id']);
            //}
            /*             * ***********END**** */
            $fav_con['conditions'] = array('Favourite.user_id' => $user_id, 'Favourite.is_favourite' => 1);
            $favourite = $this->Favourite->find('all', $fav_con);
            // $favourite = $this->Favourite->find('all', array('conditions' => array('Favourite.user_id' => $user_id,'Favourite.is_favourite' => 1)));
            $favourite_user_id = Hash::extract($favourite, '{n}.Favourite.favourite_user_id');
            /*             * ********for mutual favaorite filter ******** */
            if ($mutual_favorites) {
                $mutual_fav_con['conditions'] = array('Favourite.favourite_user_id' => $user_id, 'Favourite.is_favourite' => 1);
                $mutual_favourite = $this->Favourite->find('all', $mutual_fav_con);
                $check_favourite_user_id = Hash::extract($mutual_favourite, '{n}.Favourite.user_id'); //check who favourite me
                $favourite_user_id = array_intersect($favourite_user_id, $check_favourite_user_id);
                //pr($favourite_user_id);die;
            }

            /*             * *********END***************** */
            /*             * ******for search by name or token ******** */
            if ($search_value) {
                $options['conditions']['OR'] = array(
                    "User.screen_name LIKE" => "%" . $search_value . "%",
                    "User.token LIKE" => "%" . $search_value . "%",
                );
            }
            //===for limit condition for filter on===//
            //if($search_value || $recently_added || $last_login || $mutual_favorites){
            if ($search_value) {
                //======get limit for free user or paid user==//
                $limit = $this->match_limit($member_type, 'Search');
                //======End===========//
                $options['limit'] = $limit;
            } else {
                //======get limit for free user or paid user==//
                $limit = $this->match_limit($member_type, 'Favorite');
                //======End===========//
                $options['limit'] = $limit;
            }
            //echo $options['limit'];die;
            /*             * ********END************** */
            //pr($favourite_user_id);
            /*             * **********unread message count ***** */
            $option['fields'] = array('User.*', 'Profile.*', 'UserPartner.*', 'ChatUser.*');
            $option['joins'] = array(
                array('table' => 'chat_users',
                    'alias' => 'ChatUser',
                    'type' => 'INNER',
                    'conditions' => array(
                        'ChatUser.user_id = User.id',
                        'AND' => array(
                            array('ChatUser.chat_user_id' => $user_id),
                        )
                    )
            ));
            $option['conditions'] = array('User.id !=' => $user_id, "NOT" => array('User.id' => $bock_user_id));
            $option['order'] = array('ChatUser.creation_date' => 'DESC');
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $chatusers = $this->User->find('all', $option);
            $total_unread_message = 0;
            if ($chatusers) {
                if ($browse == 'looking') {
                    foreach ($chatusers as $key => $value) {
                        /*                         * ****check message sender profile active or not ********* */
                        $is_profile_active = $this->check_profile_active($current_date, $value['ChatUser']['user_id']);
                        if ($is_profile_active == 0) {
                            $this->ChatUser->updateAll(
                                    array('ChatUser.count' => 0), array('ChatUser.user_id' => $value['ChatUser']['user_id'], 'ChatUser.chat_user_id' => $value['ChatUser']['chat_user_id']));
                        }
                    }
                    /*                     * ****END********* */
                    //  if($value['ChatUser']['invite']>0){
                    //      $invite=1;
                    //  }else{
                    //     $invite=0; 
                    //  }
                    //  if($browse=='date'){
                    //  $is_active_look_date = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id' => $value['ChatUser']['user_id'])));
                    //  if($is_active_look_date) {
                    //    $total_unread_message+=$value['ChatUser']['count'];
                    //  }
                    //  $total_unread_message+=$invite;
                    //}else{
                    //      $total_unread_message+=($value['ChatUser']['count']+$invite);
                    //  }
                }
            }
            /*             * **********End********* */
            /*             * *******count user locked profie or not ******** */
            //$profilelockcount=$this->ProfileLock->find('all', array('conditions' => array('ProfileLock.count' => 1, 'ProfileLock.lock_user_id' => $user_id)));
            //if($profilelockcount) { 
            //        $total_unread_message+=count($profilelockcount);                         
            //}
            $options['order'] = array('database_distance' => 'ASC');
            $options['fields'] = array('User.*', '( 6371 * acos( cos( radians("' . $login_user_lat . '") ) * cos( radians( lat ) ) * cos( radians( `long` ) - radians("' . $login_user_long . '") ) + sin( radians("' . $login_user_lat . '") ) * sin( radians( lat ) ) ) ) AS database_distance', 'Profile.*', 'UserPartner.*', 'ChatUser.*', 'Favourite.*');
            if ($browse == 'looking') {

                //=== For is active checking===//
                $if_exist_profile = $this->UserLooksex->find('all', array('conditions' => array(
                        'and' => array(
                            array(
                                'UserLooksex.user_id ' => $favourite_user_id,
                                'UserLooksex.start_time <=' => $current_date,
                                'UserLooksex.end_time >=' => $current_date
                            )
                        )
                )));
                $looksex_user_id = Hash::extract($if_exist_profile, '{n}.UserLooksex.user_id');
                // pr($this->UserLooksex->getDataSource()->getLog(true));die;
                //pr($if_exist_profile);die;

                /*                 * ********************** */
                $options['joins'] = array(
                    array('table' => 'favourites',
                        'alias' => 'Favourite',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Favourite.favourite_user_id = User.id',
                            'AND' => array(
                                array('Favourite.user_id' => $user_id),
                                array('User.id' => $looksex_user_id),
                                array('Favourite.is_favourite' => 1),
                                //array('Favourite.browse' => $browse),
                                "NOT" => array('User.id' => $bock_user_id)
                            )
                        )
                    ),
                    array('table' => 'chat_users',
                        'alias' => 'ChatUser',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ChatUser.user_id = User.id',
                            'AND' => array(
                                array('ChatUser.chat_user_id' => $user_id),
                            )
                        )
                    )
                );
            } else if ($browse == 'date') {
                $UserLookdate = $this->UserLookdate->find('all', array('conditions' => array('UserLookdate.user_id' => $favourite_user_id)));
                $lookdate_user_id = Hash::extract($UserLookdate, '{n}.UserLookdate.user_id');
                $options['joins'] = array(
                    array('table' => 'favourites',
                        'alias' => 'Favourite',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Favourite.favourite_user_id = User.id',
                            'AND' => array(
                                array('Favourite.user_id' => $user_id),
                                array('User.id' => $lookdate_user_id),
                                array('Favourite.is_favourite' => 1),
                                //array('Favourite.browse' => $browse),
                                "NOT" => array('User.id' => $bock_user_id)
                            )
                        )
                    ),
                    array('table' => 'chat_users',
                        'alias' => 'ChatUser',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ChatUser.user_id = User.id',
                            'AND' => array(
                                array('ChatUser.chat_user_id' => $user_id),
                            )
                        )
                ));
                //pr($UserLookdate);die;
            } else {
                $options['joins'] = array(
                    array('table' => 'favourites',
                        'alias' => 'Favourite',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Favourite.favourite_user_id = User.id',
                            'AND' => array(
                                array('Favourite.user_id' => $user_id),
                                array('User.id' => $favourite_user_id),
                                array('Favourite.is_favourite' => 1),
                                // array('Favourite.browse' => $browse),
                                "NOT" => array('User.id' => $bock_user_id)
                            )
                        )
                    ),
                    array('table' => 'chat_users',
                        'alias' => 'ChatUser',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ChatUser.user_id = User.id',
                            'AND' => array(
                                array('ChatUser.chat_user_id' => $user_id),
                            )
                        )
                ));
            }
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $favourite = $this->User->find('all', $options);
            foreach ($favourite as $key => $value) {
                unset($favourite[$key][0]);
                $favourite[$key]['User']['distance'] = $this->distance($login_user_lat, $login_user_long, $value['User']['lat'], $value['User']['long'], 'M');
                $favourite[$key]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value['User']['id']);
                if ($value['ChatUser']['invite'] > 0) {
                    $invite = 1;
                } else {
                    $invite = 0;
                }
                $total_unread_message+=($value['ChatUser']['count'] + $invite);
            }
            // pr($this->User->getDataSource()->getLog(true));die;
            //pr($this->User->getDataSource()->getLog(true));die;
            //pr($favourite);die;
            /*             * ******for give user looksex data******** */
            $user_looksex = $this->UserLooksex->find('first', array('conditions' => array(
                    'and' => array(
                        array(
                            'UserLooksex.user_id ' => $user_id,
                            'UserLooksex.start_time <=' => $current_date,
                            'UserLooksex.end_time >=' => $current_date
                        )
                    )
            )));
            if ($user_looksex) {
                $data['userlooksex_data'] = $user_looksex['UserLooksex'];
            }
            /*             * **********END**************** */
            if ($favourite) {
                if ($recently_added) {
                    $favourite = Set::sort($favourite, '{n}.Favourite.creation_date', 'desc');
                } else if ($last_login) {
                    $favourite = Set::sort($favourite, '{n}.User.modification_date', 'desc');
                } else {
                    $favourite = Set::sort($favourite, '{n}.User.distance', 'asc');
                }

                /*                 * ********check user view my profile ********* */
                $is_view = $this->check_view($user_id);
                /*                 * ********END************ */
                /*                 * ******check any one share album with me******** */
                $is_share = $this->check_sharealbum($user_id);
                /*                 * ******End********* */
                /*                 * ******count total user view my profile******** */
                $count_view = $this->count_view($user_id);
                /*                 * ******End********* */
                /*                 * ******count total user share album with me******** */
                $count_sharealbum = $this->count_sharealbum($user_id);
                $total_view_and_share = $count_view + $count_sharealbum;
                /*                 * ******End********* */
                /*                 * *****check profile active ********* */
                $is_profile_active = $this->check_profile_active($current_date, $this->request->data['user_id']);
                /*                 * ********END***************** */

                /*                 * *****get the max accuricy number ******* */
                $accuracy_value = Hash::extract($favourite, '{n}.User.accuracy');
                //pr($accuracy_value);die;
                $accuracy_max_value = (int) max($accuracy_value);
                /*                 * **********END*************** */
                $data['success'] = 1;

                $data['msg'] = 'success';
                $data['is_share_album'] = $is_share;
                $data['is_viewed'] = $is_view;
                $data['total_unread_message'] = $total_unread_message;
                $data['total_view_and_share'] = $total_view_and_share;
                $data['user_looking_profile_active'] = $is_profile_active;
                $data['accuracy'] = $accuracy_max_value;
                $data['login_user_member_type'] = $member_type;
                $data['login_user_removead'] = $removead;
                $data['user_data'] = $favourite;
                $data['path'] = PIC_PATH;
            } else {
                $data['success'] = 2;
                $data['login_user_member_type'] = $member_type;
                $data['login_user_removead'] = $removead;
                $data['msg'] = 'No data found';
                $data['user_looking_profile_active'] = $this->check_profile_active($current_date, $this->request->data['user_id']);
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id or browse  not found';
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
            if (is_nan($miles) == 1) {
                $miles = 0;
            }
            return round(($miles * 1.609344));
        } else if ($unit == "N") {
            if (is_nan($miles) == 1) {
                $miles = 0;
            }
            return round(($miles * 0.8684));
        } else {
            if (is_nan($miles) == 1) {
                $miles = 0;
            }
            return round($miles);
        }
    }

    /*     * ********* this service use for who are  view my profile that save into db and view other user profile and match percentage ************** */

    public function view_profile_details() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $viewer_user_id = isset($this->request->data['viewer_user_id']) ? $this->request->data['viewer_user_id'] : ''; // whose profile view
        $type = isset($this->request->data['type']) ? $this->request->data['type'] : ''; //track which page user come  looking sex or date or search page
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : ''; //get current date
        if ($user_id && $viewer_user_id) {

            $viewer = $this->Viewer->find('first', array('conditions' => array('Viewer.user_id' => $user_id, 'Viewer.viewer_user_id' => $viewer_user_id)));
            if ($user_id == $viewer_user_id) {
                $is_view_profile = 0;
            } else {
                // $is_view_profile=1;
                $is_view_profile = 0; //change later not deliver red dot notification
            }
            /**             * ******* save viewer table **************** */
            if (!$viewer) {

                $viewers['Viewer'] = array(
                    'user_id' => $user_id,
                    'viewer_user_id' => $viewer_user_id,
                    'is_view' => $is_view_profile,
                    'creation_date' => $current_date,
                    'modification_date' => $current_date
                );
            } else {
                $viewers['Viewer'] = array(
                    'id' => $viewer['Viewer']['id'],
                    'user_id' => $user_id,
                    'viewer_user_id' => $viewer_user_id,
                    'is_view' => $is_view_profile,
                    'creation_date' => $current_date,
                    'modification_date' => $current_date
                );
            }
            if ($this->Viewer->save($viewers)) {
                /*  if($user_id!=$viewer_user_id) {
                  //                 * ****** get user name for push notification ************ //

                  $username = $this->User->findById($user_id);
                  //                 * ************* END ******************** //
                  //                 * ***** for push notification **************** //
                  $userdetails = $this->User->findById($viewer_user_id);
                  if ($userdetails) {
                  $device_type = $userdetails['User']['device_type'];
                  $device_token = $userdetails['User']['device_token'];
                  $online_status = $userdetails['User']['online_status'];
                  // pr($device_token);
                  // *******count total user view my profile******** //
                  $count_view=$this->count_view($viewer_user_id);
                  // *******End********* //
                  // *******count total user share album with me******** //
                  $count_sharealbum=$this->count_sharealbum($viewer_user_id);
                  $total_view_and_share=$count_view+$count_sharealbum;
                  // *******End********** //
                  //                     * ********* send notification for android ************* //
                  if ($device_type == 'android') {
                  if ($is_received == 1 && $online_status ==1) {
                  $device_token = array($device_token);
                  $msg = $username['User']['screen_name'] . ' share album with you';
                  $message = array("msg" => $msg, 'sound' => 'default');
                  $this->GCM->send_notification($device_token, $message);
                  //$result = $gcm->send_notification($device_ids, $message);
                  }
                  } else {
                  //echo $is_received;
                  if ($online_status ==1) {
                  //                            * ********* send notification for ios ************* //
                  $pemfile = WWW_ROOT . 'files/looking.pem';
                  $passphrase = 'looking';
                  $msg = $username['User']['screen_name'] . ' view your profile';
                  $ctx = stream_context_create();
                  stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfile);
                  stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                  // Open a connection to the APNS server
                  $fp = stream_socket_client(
                  'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                  if (!$fp)
                  exit("Failed to connect: $err $errstr" . PHP_EOL);
                  $payload = '{"aps":{"alert":"'.$msg.'","count_unread_msg" : 1,"sound":"default","type": "viewer_message","total_view_and_share":"'.(int)$total_view_and_share.'"}}';
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
                  } */
            }
            /*             * ************ get current user lat long ************** */
            $user = $this->User->findById($user_id);
            if ($user) {
                $user_lat = $user['User']['lat'];
                $user_long = $user['User']['long'];
                $login_user_member_type = $user['User']['member_type'];
                $login_user_removead = $user['User']['removead'];
                $login_user_is_trial = $user['User']['is_trial'];
            }
            /*             * *********** END **************** */
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $this->User->unbindModel(array('hasOne' => array('UserPartner')));
            $this->User->virtualFields = array('age' => "FLOOR(DATEDIFF (NOW(), Profile.birthday)/365)");
            $profile = $this->User->findById($viewer_user_id);
            if ($profile && $user) {
                /*                 * ********** description field add in profile virtualy ************* */
                $profile['Profile']['description'] = '';
                /*                 * ***********END****************** */
                $viewer_lat = $profile['User']['lat'];
                $viewer_long = $profile['User']['long'];
                /*                 * *********** get distance miles *************** */
                $distance = $this->distance($user_lat, $user_long, $viewer_lat, $viewer_long, 'M');
                //echo is_nan($distance);
                if (is_nan($distance) == 1) {
                    $distance = 0;
                }
                //echo $distance;die;
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
                $Userdetails['User_Profile_Lock'] = array(); //User has locked his profile for that user or not;
                $Userdetails['View_User_Profile_Lock'] = array(); //whose profile user view he/she has locked  his  profile for  the user  or not
                //$Userdetails['traits'] = array();
                $Userdetails['Over_All_Percentage'] = '';
                $Userdetails['traits'] = '';
                $Userdetails['interest'] = '';
                $Userdetails['physicial_appearance'] = '';
                $Userdetails['sextual_preferences'] = '';
                $Userdetails['social_habits'] = '';
                $Userdetails['identity'] = '';
                $Userdetails['Block_Chat'] = array();
                $Userdetails['Block_Chat_View_User'] = array();
                $Userdetails['Looksex_Profile_Active'] = array();
                $Userdetails['User_Looksex_Profile_Active'] = array();
                $Userdetails['User_Invitation'] = array();
                $Userdetails['Viewer_Invitation'] = array(); //whose profile user view
                $Userdetails['Lookdate_Profile_Active'] = array();
                $Userdetails['User_Lookdate_Profile_Active'] = array();
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
                    $Profile_pic = array(
                        array(
                            'id' => 'profile_pic',
                            'user_id' => $viewer_user_id,
                            'photo_name' => $profile['User']['profile_pic'],
                            'caption' => '',
                            'album_type' => $profile['User']['profile_pic_type'],
                            'creation_date' => $profile['User']['profile_pic_date']
                    ));
                    $album = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $viewer_user_id), 'order' => array('User_album.album_type asc')));
                    //pr($album);
                    if ($album) {
                        $album_picture = Hash::extract($album, '{n}.User_album');
                        $Userdetails['Viewer_Share_Album']['album_images'] = array_merge($Profile_pic, $album_picture);
                        //pr($image);
                        // die;
                    } else {
                        $Userdetails['Viewer_Share_Album']['album_images'] = $Profile_pic;
                    }
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
                /*                 * ************ check whose profile user view he already favourite this user or not ************ */
                $viewer_favourite = $this->Favourite->find('first', array('conditions' => array('Favourite.user_id' => $viewer_user_id, 'Favourite.favourite_user_id' => $user_id, 'Favourite.is_favourite' => 1)));
                if ($viewer_favourite) {
                    $Userdetails['Viewer_Favourite'] = $viewer_favourite['Favourite'];
                }
                /*                 * *************** END ******************* */

                /*                 * ********** check user  alredy lock chat for the view user ************ */
                $block_chat = $this->BlockChatUser->find('first', array('conditions' => array('BlockChatUser.user_id' => $user_id, 'BlockChatUser.block_user_id' => $viewer_user_id, 'BlockChatUser.is_blocked' => 1)));
                if ($block_chat) {
                    $Userdetails['Block_Chat'] = $block_chat['BlockChatUser'];
                }
                /*                 * *************** END ******************* */
                /*                 * ********** check view user  alredy lock chat for the user ************ */
                $block_chat_view = $this->BlockChatUser->find('first', array('conditions' => array('BlockChatUser.user_id' => $viewer_user_id, 'BlockChatUser.block_user_id' => $user_id, 'BlockChatUser.is_blocked' => 1)));
                if ($block_chat_view) {
                    $Userdetails['Block_Chat_View_User'] = $block_chat_view['BlockChatUser'];
                }
                /*                 * *************** END ******************* */

                /*                 * ******* check looking profile is active or not *********** */
                $check_looksex_profile = $this->UserLooksex->find('first', array('conditions' => array(
                        'and' => array(
                            array('UserLooksex.start_time <=' => $current_date,
                                'UserLooksex.end_time >=' => $current_date
                            ),
                            'UserLooksex.user_id =' => $viewer_user_id
                        )
                )));
                //echo $current_date;
                //pr($check_looksex_profile);
                if (count($check_looksex_profile) > 0) {
                    $check_looksex_active = 1;
                } else {
                    $check_looksex_active = 0;
                    /*                     * ********* inactive invitaion when user look profile expire******* */
                    $this->ChatUser->updateAll(
                            array('ChatUser.invite' => 0), array('ChatUser.user_id' => $viewer_user_id)
                    );
                    /*                     * *********delete profile lock when viewer lokking profile expire****** */
                    $delete_lock_profile = $this->ProfileLock->find('first', array('conditions' => array('ProfileLock.user_id' => $viewer_user_id, 'ProfileLock.lock_user_id' => $user_id, 'ProfileLock.is_locked' => 1, 'ProfileLock.browse' => 'looking')));
                    if ($delete_lock_profile) {
                        $this->ProfileLock->delete($delete_lock_profile['ProfileLock']['id']);
                    }
                    /*                     * **********END************* */
                    //unshare album//
                    //$this->ShareAlbum->updateAll(
                    //array('ShareAlbum.is_received' => 2), array('ShareAlbum.sender_id' => $viewer_user_id,'ShareAlbum.receiver_id' => $user_id)
                    //);
                    //End
                }
                $Userdetails['Looksex_Profile_Active'] = $check_looksex_active;
                /*                 * *************End************ */
                /*                 * ******* check user looking profile is active or not *********** */
                $check_user_looksex_profile = $this->UserLooksex->find('first', array('conditions' => array(
                        'and' => array(
                            array('UserLooksex.start_time <=' => $current_date,
                                'UserLooksex.end_time >=' => $current_date
                            ),
                            'UserLooksex.user_id =' => $user_id
                        )
                )));
                //echo $current_date;
                //pr($check_looksex_profile);
                if (count($check_user_looksex_profile) > 0) {
                    $check_user_looksex_active = 1;
                } else {
                    $check_user_looksex_active = 0;
                    /*                     * ********* inactive invitaion when user look profile expire******* */
                    $this->ChatUser->updateAll(
                            array('ChatUser.invite' => 0), array('ChatUser.user_id' => $user_id)
                    );
                    //$this->ChatUser->updateAll(
                    //array('ChatUser.invite' => 0), array('ChatUser.chat_user_id' => $user_id)
                    //);
                    /*                     * *********delete profile lock when user lokking profile expire****** */
                    $delete_lock_profile = $this->ProfileLock->find('first', array('conditions' => array('ProfileLock.user_id' => $user_id, 'ProfileLock.lock_user_id' => $viewer_user_id, 'ProfileLock.is_locked' => 1, 'ProfileLock.browse' => 'looking')));
                    if ($delete_lock_profile) {
                        $this->ProfileLock->delete($delete_lock_profile['ProfileLock']['id']);
                    }
                    //unshare album//
                    //$this->ShareAlbum->updateAll(
                    // array('ShareAlbum.is_received' => 2), array('ShareAlbum.sender_id' => $user_id,'ShareAlbum.receiver_id' => $viewer_user_id)
                    // );
                    //End
                }
                $Userdetails['User_Looksex_Profile_Active'] = $check_user_looksex_active;

                if ($type == 'looking_sex') {
                    /*                     * *********** check user  alredy lock the view profile user ************ */
                    $lock_profile = $this->ProfileLock->find('first', array('conditions' => array('ProfileLock.user_id' => $user_id, 'ProfileLock.lock_user_id' => $viewer_user_id, 'ProfileLock.is_locked' => 1, 'ProfileLock.browse' => 'looking')));
                    if ($lock_profile) {
                        $Userdetails['User_Profile_Lock'] = $lock_profile['ProfileLock'];
                    }
                    /*                     * *************** END ******************* */
                    /*                     * *********** check view profile user  alredy lock the  user ************ */
                    $lock_profile_view_user = $this->ProfileLock->find('first', array('conditions' => array('ProfileLock.user_id' => $viewer_user_id, 'ProfileLock.lock_user_id' => $user_id, 'ProfileLock.is_locked' => 1, 'ProfileLock.browse' => 'looking')));
                    if ($lock_profile_view_user) {
                        $Userdetails['View_User_Profile_Lock'] = $lock_profile_view_user['ProfileLock'];
                    }
                } else {
                    /*                     * *********** check user  alredy lock the view profile user ************ */
                    $lock_profile = $this->ProfileLock->find('first', array('conditions' => array('ProfileLock.user_id' => $user_id, 'ProfileLock.lock_user_id' => $viewer_user_id, 'ProfileLock.is_locked' => 1, 'ProfileLock.browse !=' => 'looking')));
                    if ($lock_profile) {
                        $Userdetails['User_Profile_Lock'] = $lock_profile['ProfileLock'];
                    }
                    /*                     * *************** END ******************* */
                    /*                     * *********** check view profile user  alredy lock the  user ************ */
                    $lock_profile_view_user = $this->ProfileLock->find('first', array('conditions' => array('ProfileLock.user_id' => $viewer_user_id, 'ProfileLock.lock_user_id' => $user_id, 'ProfileLock.is_locked' => 1, 'ProfileLock.browse !=' => 'looking')));
                    if ($lock_profile_view_user) {
                        $Userdetails['View_User_Profile_Lock'] = $lock_profile_view_user['ProfileLock'];
                    }
                }
                /*                 * *************** END ******************* */
                /*                 * ***********for check viewer look date profile active ************ */
                $UserLookdate = $this->UserLookdate->find('all', array('conditions' => array('UserLookdate.user_id' => $viewer_user_id)));
                if (count($UserLookdate) > 0) {
                    $check_lookdate_active = 1;
                } else {
                    $check_lookdate_active = 0;
                }
                $Userdetails['Lookdate_Profile_Active'] = $check_lookdate_active;
                /*                 * *****END************* */
                /*                 * ***********for check User look date profile active ************ */
                $UserLookdate = $this->UserLookdate->find('all', array('conditions' => array('UserLookdate.user_id' => $user_id)));
                if (count($UserLookdate) > 0) {
                    $check_user_lookdate_active = 1;
                } else {
                    $check_user_lookdate_active = 0;
                }
                $Userdetails['User_Lookdate_Profile_Active'] = $check_user_lookdate_active;
                /*                 * *****END************* */
                /*                 * ***********for check user send invitaion or not ************ */
                $chat_invitation = $this->ChatUser->find('first', array(
                    'conditions' => array(
                        'ChatUser.user_id' => $user_id, 'ChatUser.chat_user_id' => $viewer_user_id,
                    //'OR' =>array(
                    //    array(
                    //    'ChatUser.invite' => 1,
                    //    //'ChatUser.invite' => 2
                    //    )
                    //            )
                )));
                if ($chat_invitation) {
                    $Userdetails['User_Invitation'] = $chat_invitation['ChatUser'];
                }
                /*                 * ***********for check viewer user send invitaion or not to the login user ************ */
                $chat_invitation_viewer = $this->ChatUser->find('first', array(
                    'conditions' => array(
                        'ChatUser.user_id' => $viewer_user_id, 'ChatUser.chat_user_id' => $user_id
                )));
                if ($chat_invitation_viewer) {
                    $Userdetails['Viewer_Invitation'] = $chat_invitation_viewer['ChatUser'];
                }
                //pr($this->User->getDataSource()->getLog());die;
                /*                 * ****************END****************** */
                /*                 * *********** this is for my identities percentage from Profile table************ */
                //pr($profile);
                $user_his_identity = stripslashes($user['Profile']['his_identitie']);
                $user_his_identity = explode(',', $user_his_identity);
                $identity_percent_permatch = 100 / count($user_his_identity);
                $match_identity = 0;
                $viewer_identity = stripslashes($profile['Profile']['identity']);
                $viewer_identity = explode(',', $viewer_identity);
                /*                 * ********** count for identity *************** */
                $identity = array();
                $traits = array();
                $interest = array();
                $physicial_appearance = array();
                $sextual_preferences = array();
                $social_habits = array();

                foreach ($user_his_identity as $key => $value) {
                    foreach ($viewer_identity as $key1 => $value1) {
                        if (trim(strtolower($value)) == trim(strtolower($value1))) {
                            $match_identity++;
                            $identity[] = trim($value);
                        }
                    }
                }
                //echo implode(',',$identity);
                //pr($identity);die;
                $identity_percentage = round($identity_percent_permatch * $match_identity);
                /*                 * *********************END***************** */
                if ($type == 'looking_date') {
                    /*                     * ********* for look date percentage count *********** */
                    $lookdateuser = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id' => $user_id)));
                    if ($lookdateuser) {
                        /*                         * ********** his traits ********* */
                        $his_traits = stripslashes($lookdateuser['UserLookdate']['his_traits']);
                        $his_traits = explode(',', $his_traits);
                        $traits_percent_permatch = 100 / count($his_traits);
                        $match_traits = 0;
                        /*                         * ************* my interest *********** */
                        $my_interest = stripslashes($lookdateuser['UserLookdate']['my_interest']);
                        $my_interest = explode(',', $my_interest);
                        $interest_percent_permatch = 100 / count($my_interest);
                        $match_interest = 0;
                        /*                         * ********** his_physical_appearance ********** */
                        $his_physical_appearance = stripslashes($lookdateuser['UserLookdate']['his_physical_appearance']);
                        $his_physical_appearance = explode(',', $his_physical_appearance);
                        $his_physical_appearance_percent_permatch = 100 / count($his_physical_appearance);
                        $match_his_physical_appearance = 0;
                        /*                         * ********** his_sextual_preferences ********** */
                        $his_sextual_preferences = stripslashes($lookdateuser['UserLookdate']['his_sextual_preferences']);
                        $his_sextual_preferences = explode(',', $his_sextual_preferences);
                        $his_sextual_preferences_percent_permatch = 100 / count($his_sextual_preferences);
                        $match_his_sextual_preferences = 0;
                        /*                         * ********** his_social_habits ********** */
                        $his_social_habits = stripslashes($lookdateuser['UserLookdate']['his_social_habits']);
                        $his_social_habits = explode(',', $his_social_habits);
                        $his_social_habits_percent_permatch = 100 / count($his_social_habits);
                        $match_his_social_habits = 0;
                    }
                    $lookdateviewer = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id' => $viewer_user_id)));
                    //pr($lookdateviewer);
                    if ($lookdateviewer) {
                        /*                         * ********** my_traits ********** */
                        $my_traits = stripslashes($lookdateviewer['UserLookdate']['my_traits']);
                        $my_traits = explode(',', $my_traits);
                        /*                         * ************* my interest *********** */
                        $my_interest_view = stripslashes($lookdateviewer['UserLookdate']['my_interest']);
                        $my_interest_view = explode(',', $my_interest_view);
                        /*                         * ************* my_physical_appearance *********** */
                        $my_physical_appearance = stripslashes($lookdateviewer['UserLookdate']['my_physical_appearance']);
                        $my_physical_appearance = explode(',', $my_physical_appearance);
                        /*                         * ************* my_sextual_preferences *********** */
                        $my_sextual_preferences = stripslashes($lookdateviewer['UserLookdate']['my_sextual_preferences']);
                        $my_sextual_preferences = explode(',', $my_sextual_preferences);
                        /*                         * ************* my_sextual_preferences *********** */
                        $my_social_habits = stripslashes($lookdateviewer['UserLookdate']['my_social_habits']);
                        $my_social_habits = explode(',', $my_social_habits);
                    }
                    if ($lookdateviewer && $lookdateuser) {
                        /*                         * ********** count for traits *************** */
                        foreach ($his_traits as $key => $value) {
                            foreach ($my_traits as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_traits++;
                                    $traits[] = trim($value);
                                    //$Userdetails['traits'] = implode(',',$Userdetails['traits']);
                                    //$Userdetails['traits'] = Hash::extract($Userdetails['traits'], '{n}.traits');
                                }
                            }
                        }
                        $Userdetails['traits'] = implode(',', $traits);
                        $traits_percentage = round($traits_percent_permatch * $match_traits);
                        /*                         * ********** count for interest *************** */
                        foreach ($my_interest as $key => $value) {
                            foreach ($my_interest_view as $key1 => $value1) {
                                // echo $value.'--------'.$value1;
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    //echo 'Mir';
                                    $match_interest++;
                                    $interest[] = trim($value);
                                }
                            }
                        }
                        //echo $match_interest;
                        $Userdetails['interest'] = implode(',', $interest);
                        $interest = round($interest_percent_permatch * $match_interest);
                        /*                         * ********** count for physical_appearance *************** */
                        foreach ($his_physical_appearance as $key => $value) {
                            foreach ($my_physical_appearance as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_physical_appearance++;
                                    $physicial_appearance[] = trim($value);
                                }
                            }
                        }
                        $Userdetails['physicial_appearance'] = implode(',', $physicial_appearance);
                        $physical = round($his_physical_appearance_percent_permatch * $match_his_physical_appearance);
                        /*                         * ********** count for sextual_preferences*************** */
                        foreach ($his_sextual_preferences as $key => $value) {
                            foreach ($my_sextual_preferences as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_sextual_preferences++;
                                    $sextual_preferences[] = trim($value);
                                }
                            }
                        }
                        $Userdetails['sextual_preferences'] = implode(',', $sextual_preferences);
                        $sextual = round($his_sextual_preferences_percent_permatch * $match_his_sextual_preferences);
                        /*                         * ********** count for social_habits*************** */
                        foreach ($his_social_habits as $key => $value) {
                            foreach ($my_social_habits as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_social_habits++;
                                    $social_habits[] = trim($value);
                                }
                            }
                        }
                        $Userdetails['social_habits'] = implode(',', $social_habits);
                        $social_habits = round($his_social_habits_percent_permatch * $match_his_social_habits);
                        $Userdetails['identity'] = implode(',', $identity);
                    } else {
                        $traits_percentage = 0;
                        $interest = 0;
                        $physical = 0;
                        $sextual = 0;
                        $social_habits = 0;
                        $identity_percentage = 0;
                    }
                    $overall_per_sum = ($traits_percentage + $interest + $physical + $sextual + $social_habits + $identity_percentage);
                    if ($overall_per_sum > 0) {
                        $Userdetails['Over_All_Percentage'] = round(($overall_per_sum * 100) / 600);
                    } else {
                        $Userdetails['Over_All_Percentage'] = 0;
                    }
                    $Userdetails['User'] = $profile['User'];
                    $Userdetails['Profile'] = $profile['Profile'];
                    $Userdetails['Match_Persent'] = array(
                        'traits' => $traits_percentage,
                        'interest' => $interest,
                        'physical' => $physical,
                        'sextual' => $sextual,
                        'social_habits' => $social_habits,
                        'identity' => $identity_percentage
                    );
                } elseif ($type == 'looking_sex') {
                    /*                     * ********* for look sex percentage count *********** */
                    $looksexuser = $this->UserLooksex->find('first', array('conditions' => array(
                            'and' => array(
                                array('UserLooksex.start_time <=' => $current_date,
                                    'UserLooksex.end_time >=' => $current_date
                                ),
                                'UserLooksex.user_id =' => $user_id
                            )
                    )));

                    if (count($looksexuser) > 0) {
//                    $looksexuser = $this->UserLooksex->find('first', array('conditions' => array('UserLooksex.user_id' => $user_id, 'is_active' => 1)));
//                    if ($looksexuser) {
                        //$profile['Profile']['description'] = $looksexuser['UserLooksex']['description'];
                        /*                         * ********** his_physical_appearance ********** */
                        $his_physical_appearance = stripslashes($looksexuser['UserLooksex']['his_physical_appearance']);
                        $his_physical_appearance = explode(',', $his_physical_appearance);
                        $his_physical_appearance_percent_permatch = 100 / count($his_physical_appearance);
                        $match_his_physical_appearance = 0;
                        /*                         * ********** his_sextual_preferences ********** */
                        $his_sextual_preferences = stripslashes($looksexuser['UserLooksex']['his_sextual_preferences']);
                        $his_sextual_preferences = explode(',', $his_sextual_preferences);
                        $his_sextual_preferences_percent_permatch = 100 / count($his_sextual_preferences);
                        $match_his_sextual_preferences = 0;
                        /*                         * ********** his_social_habits ********** */
                        $his_social_habits = stripslashes($looksexuser['UserLooksex']['his_social_habits']);
                        $his_social_habits = explode(',', $his_social_habits);
                        $his_social_habits_percent_permatch = 100 / count($his_social_habits);
                        $match_his_social_habits = 0;
                    }
//                    $looksexviewer = $this->UserLooksex->find('first', array('conditions' => array('UserLooksex.user_id' => $viewer_user_id, 'is_active' => 1)));

                    $looksexviewer = $this->UserLooksex->find('first', array('conditions' => array(
                            'and' => array(
                                array('UserLooksex.start_time <=' => $current_date,
                                    'UserLooksex.end_time >=' => $current_date
                                ),
                                'UserLooksex.user_id =' => $viewer_user_id
                            )
                    )));

                    if ($looksexviewer) {
                        $profile['Profile']['description'] = stripslashes($looksexviewer['UserLooksex']['description']);
                        /*                         * ************* my_physical_appearance *********** */
                        $my_physical_appearance = stripslashes($looksexviewer['UserLooksex']['my_physical_appearance']);
                        $my_physical_appearance = explode(',', $my_physical_appearance);
                        /*                         * ************* my_sextual_preferences *********** */
                        $my_sextual_preferences = stripslashes($looksexviewer['UserLooksex']['my_sextual_preferences']);
                        $my_sextual_preferences = explode(',', $my_sextual_preferences);
                        /*                         * ************* my_sextual_preferences *********** */
                        $my_social_habits = stripslashes($looksexviewer['UserLooksex']['my_social_habits']);
                        $my_social_habits = explode(',', $my_social_habits);
                    }
                    if ($looksexviewer && $looksexuser) {
                        /*                         * ********** count for physical_appearance *************** */
                        foreach ($his_physical_appearance as $key => $value) {
                            foreach ($my_physical_appearance as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_physical_appearance++;
                                    $physicial_appearance[] = trim($value);
                                }
                            }
                        }
                        //pr(implode(',',$physicial_appearance));die;
                        $Userdetails['physicial_appearance'] = implode(',', $physicial_appearance);
                        //pr($Userdetails['physical_appearance']);die;
                        $physical = round($his_physical_appearance_percent_permatch * $match_his_physical_appearance);
                        /*                         * ********** count for sextual_preferences*************** */
                        foreach ($his_sextual_preferences as $key => $value) {
                            foreach ($my_sextual_preferences as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_sextual_preferences++;
                                    $sextual_preferences[] = trim($value);
                                }
                            }
                        }
                        $Userdetails['sextual_preferences'] = implode(',', $sextual_preferences);
                        $sextual = round($his_sextual_preferences_percent_permatch * $match_his_sextual_preferences);
                        /*                         * ********** count for social_habits*************** */
                        foreach ($his_social_habits as $key => $value) {
                            foreach ($my_social_habits as $key1 => $value1) {
                                if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                    $match_his_social_habits++;
                                    $social_habits[] = trim($value);
                                }
                            }
                        }
                        $Userdetails['social_habits'] = implode(',', $social_habits);
                        $social_habits = round($his_social_habits_percent_permatch * $match_his_social_habits);
                        $Userdetails['identity'] = implode(',', $identity);
                    } else {
                        $physical = 0;
                        $sextual = 0;
                        $social_habits = 0;
                        $identity_percentage = 0;
                    }
                    $overall_per_sum = ($physical + $sextual + $social_habits + $identity_percentage);
                    if ($overall_per_sum > 0) {
                        $Userdetails['Over_All_Percentage'] = round(($overall_per_sum * 100) / 400);
                    } else {
                        $Userdetails['Over_All_Percentage'] = 0;
                    }
                    $Userdetails['User'] = $profile['User'];
                    $Userdetails['Profile'] = $profile['Profile'];
                    //Aded by mahadev //
                    $Userdetails['Profile']['where_I_leave'] = stripslashes($profile['Profile']['where_I_leave']);
                    $Userdetails['Profile']['about_me'] = stripslashes($profile['Profile']['about_me']);
                    $Userdetails['Match_Persent'] = array(
                        'physical' => $physical,
                        'sextual' => $sextual,
                        'social_habits' => $social_habits,
                        'identity' => $identity_percentage
                    );
                } else {
                    $Userdetails['User'] = $profile['User'];
                    $Userdetails['Profile'] = $profile['Profile'];
                    //unset($Userdetails['Match_Persent']);
                }
                $Userdetails['success'] = 1;
                $Userdetails['msg'] = 'success';
                $Userdetails['path'] = PIC_PATH;
                $Userdetails['login_user_member_type'] = $login_user_member_type;
                $Userdetails['login_user_removead'] = $login_user_removead;
                $Userdetails['login_user_is_trial'] = $login_user_is_trial;
                $Userdetails['chat_history_limit'] = $this->match_limit($login_user_member_type, 'chat_history');
                ;
            } else {
                $Userdetails['success'] = 2;
                $Userdetails['msg'] = 'user id or viewer user id not valid';
            }
        } else {
            $Userdetails['success'] = 0;
            $Userdetails['msg'] = 'user id or viewer user id not found';
        }
        //pr($Userdetails);die;
        echo json_encode($Userdetails);
    }

    /*     * ********* this service use for add and edit note from profile details ************** */

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

    /*     * ********** this is the viewers who has viewed my profile   06042015**************** */

    public function profile_viewers_details() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        //get inactive user id by admin//
        $get_unbanuser = $this->User->find('all', array('conditions' => array('User.status' => 0)));
        $unban_user_id = Hash::extract($get_unbanuser, '{n}.User.id');
        //===blocked by login user===//
        $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $user_id)));
        $block_user_id = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
        //========blocked login user by others========//
        $get_block_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.blocked_id' => $user_id)));
        $block_others_user_id = Hash::extract($get_block_user_data, '{n}.BlockedUser.user_id');
        $bock_user_id = array_merge($block_user_id, $block_others_user_id, $unban_user_id);
        if ($user_id) {
            //======get limit for free user or paid user==//
            $login_user_member_type = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $member_type = $login_user_member_type['User']['member_type'];
            $limit = $this->match_limit($member_type, 'viewed_you');
            //=======End============//
            $option['limit'] = $limit;
            /*             * *********update viewer table is_view********** */
            $this->Viewer->updateAll(
                    array('Viewer.is_view' => 0), array('Viewer.viewer_user_id' => $user_id)
            );
            /*             * ************END*************** */
            $option['fields'] = array('User.*', 'Profile.*', 'Viewer.*');
            $option['joins'] = array(
                array('table' => 'viewers',
                    'alias' => 'Viewer',
                    'type' => 'INNER',
                    'conditions' => array('User.id = Viewer.user_id')
            ));
            $option['conditions'] = array('Viewer.viewer_user_id' => $user_id, 'User.id !=' => $user_id, "NOT" => array('User.id' => $bock_user_id));
            $option['order'] = array('Viewer.creation_date' => 'DESC');
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $profile_viewers = $this->User->find('all', $option);
            if ($profile_viewers) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['path'] = PIC_PATH;
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

    /*     * ********** this is the viewed service that  I have seen  those users profile    17042015**************** */

    public function profile_viewed_details() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        //get inactive user id by admin//
        $get_unbanuser = $this->User->find('all', array('conditions' => array('User.status' => 0)));
        $unban_user_id = Hash::extract($get_unbanuser, '{n}.User.id');
        //===blocked by login user===//
        $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $user_id)));
        $block_user_id = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
        //========blocked login user by others========//
        $get_block_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.blocked_id' => $user_id)));
        $block_others_user_id = Hash::extract($get_block_user_data, '{n}.BlockedUser.user_id');
        $bock_user_id = array_merge($block_user_id, $block_others_user_id, $unban_user_id);
        if ($user_id) {
            //======get limit for free user or paid user==//
            $login_user_member_type = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $member_type = $login_user_member_type['User']['member_type'];
            $limit = $this->match_limit($member_type, 'you_viewed');
            //=======End============//
            $option['limit'] = $limit;
            /*             * *********update viewer table is_view********** */
            $this->Viewer->updateAll(
                    array('Viewer.is_view' => 0), array('Viewer.viewer_user_id' => $user_id)
            );
            /*             * ************END*************** */
            $option['fields'] = array('User.*', 'Profile.*', 'Viewer.*');
            $option['joins'] = array(
                array('table' => 'viewers',
                    'alias' => 'Viewer',
                    'type' => 'INNER',
                    'conditions' => array('User.id = Viewer.viewer_user_id')
            ));
            $option['conditions'] = array('Viewer.user_id' => $user_id, 'User.id !=' => $user_id, "NOT" => array('User.id' => $bock_user_id));
            $option['order'] = array('Viewer.creation_date' => 'DESC');
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $profile_viewers = $this->User->find('all', $option);
            if ($profile_viewers) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['path'] = PIC_PATH;
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
                echo json_encode(array('success' => 2, 'msg' => 'no data found in this id'));
            }
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'id not found'));
        }
        // pr($this->ShareAlbum->getDataSource()->getLog());
    }

    /*     * ******* database update screen name function ******** */

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

    /*     * ****** this service use for move image  archive  to private 14042015 --- Mir ---******** */

    public function move_archive_to_private() {

        $this->autoRender = false;
        $picid = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id && $picid) {
            $arrpicid = explode(',', $picid);
            foreach ($arrpicid as $key => $value) {
                $UserArchive = $this->Archive->findById($value);
                if ($UserArchive) {
                    $photoname = $UserArchive['Archive']['photo_name'];
                    $caption = $UserArchive['Archive']['caption'];
                    $user['User_album'] = array(
                        'user_id' => $user_id,
                        'photo_name' => $photoname,
                        'caption' => $caption,
                            //'creation_date' => date('Y-m-d H:i:s')
                    );
                    $this->User_album->create();
                    if ($this->User_album->save($user)) {
                        $this->Archive->delete($value);
                        $data['success'] = 1;
                        $data['msg'] = 'success';
                    } else {
                        $data['success'] = 0;
                        $data['msg'] = 'failure';
                    }
                } else {
                    $data['success'] = 2;
                    $data['msg'] = 'pic id not valid';
                }
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id and pic id not found';
        }
        echo json_encode($data);
    }

    /*     * ********************* END************************************ */
    /*     * ********** this service use  for view profile details lock and unlock    mir 17042015************ */

    public function lock_unlock_details_profile() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $lock_user_id = isset($this->request->data['lock_user_id']) ? $this->request->data['lock_user_id'] : ''; //whose profile you want to lock
        $browse = isset($this->request->data['browse']) ? $this->request->data['browse'] : ''; //which section user come from browse or dating or looking
        $receiver_id = $lock_user_id;
        $sender_id = $user_id;
        if ($user_id && $lock_user_id) {
            $is_locked = 1;
            if ($browse == 'looking') {
                $lock_profile = $this->ProfileLock->find('first', array('conditions' => array('ProfileLock.user_id' => $user_id, 'ProfileLock.lock_user_id' => $lock_user_id, 'ProfileLock.browse' => 'looking')));
                if ($lock_profile) {
                    /*                     * ***** if is_locked=1 then set is_locked=2 means unlock and if  is_locked=2 then set is_locked=1 means lock*** */
                    if ($lock_profile['ProfileLock']['is_locked'] == 1) {
                        $is_locked = 2;
                        $count = 0;
                    } else {
                        $is_locked = 1;
                        $count = 1;
                    }
                    /*                     * *********** lock unlock profile details ************ */
                    $userlock['ProfileLock'] = array(
                        'id' => $lock_profile['ProfileLock']['id'],
                        'user_id' => $user_id,
                        'lock_user_id' => $lock_user_id,
                        'is_locked' => $is_locked,
                        'count' => $count,
                        'browse' => $browse,
                        'modification_date' => date('Y-m-d H:i:s')
                    );
                    // pr($sharealbum);
                    //$data['success'] = 2;
                    //$data['msg'] = 'already share album';
                } else {
                    $is_locked = 1;
                    $count = 1;
                    /*                     * *********** share album access ************ */
                    $userlock['ProfileLock'] = array(
                        'user_id' => $user_id,
                        'lock_user_id' => $lock_user_id,
                        'is_locked' => $is_locked,
                        'count' => $count,
                        'browse' => $browse,
                        'creation_date' => date('Y-m-d H:i:s')
                    );
                }
            } else {
                $lock_profile = $this->ProfileLock->find('first', array('conditions' => array('ProfileLock.user_id' => $user_id, 'ProfileLock.lock_user_id' => $lock_user_id, 'ProfileLock.browse !=' => 'looking')));
                if ($lock_profile) {
                    /*                     * ***** if is_locked=1 then set is_locked=2 means unlock and if  is_locked=2 then set is_locked=1 means lock*** */
                    if ($lock_profile['ProfileLock']['is_locked'] == 1) {
                        $is_locked = 2;
                        $count = 0;
                    } else {
                        $is_locked = 1;
                        $count = 1;
                    }
                    /*                     * *********** lock unlock profile details ************ */
                    $userlock['ProfileLock'] = array(
                        'id' => $lock_profile['ProfileLock']['id'],
                        'user_id' => $user_id,
                        'lock_user_id' => $lock_user_id,
                        'is_locked' => $is_locked,
                        'count' => $count,
                        'browse' => $browse,
                        'modification_date' => date('Y-m-d H:i:s')
                    );
                    // pr($sharealbum);
                    //$data['success'] = 2;
                    //$data['msg'] = 'already share album';
                } else {
                    $is_locked = 1;
                    $count = 1;
                    /*                     * *********** share album access ************ */
                    $userlock['ProfileLock'] = array(
                        'user_id' => $user_id,
                        'lock_user_id' => $lock_user_id,
                        'is_locked' => $is_locked,
                        'count' => $count,
                        'browse' => $browse,
                        'creation_date' => date('Y-m-d H:i:s')
                    );
                }
            }
            //pr($userlock);die;
            if ($this->ProfileLock->save($userlock)) {
                /*                 * *************************Soham 10 July 2015 Changes Start***************************** */

                //if($is_locked==1)
                //{
                //     /*************total count message *************/
                //     $chatusers = $this->ChatUser->find('all', array('conditions' => array('ChatUser.chat_user_id' => $receiver_id)));
                //     $total_unread_message=0;
                //     if($chatusers) {
                //        foreach ($chatusers as $key => $value) {
                //            if($value['ChatUser']['invite']>0){
                //                $invite=1;
                //            }
                //            else{
                //               $invite=0; 
                //            }
                //            $total_unread_message+=($value['ChatUser']['count']+$invite);                         
                //        }
                //    }
                //    /*********count user locked profie or not *********/
                //    //$profilelockcount=$this->ProfileLock->find('all', array('conditions' => array('ProfileLock.count' => 1, 'ProfileLock.lock_user_id' => $receiver_id)));
                //    //if($profilelockcount) { 
                //    //        $total_unread_message+=count($profilelockcount);                         
                //    //}
                //    /**************END***************/
                //    if($total_unread_message == 0) {
                //        $total_unread_message = '';
                //    }
                //    /*************End*********************/
                //    /******** get user name for push notification ************ */
                //
                //    $username = $this->User->findById($sender_id);
                //    /*************** END ******************** */
                //    /******* for push notification **************** */
                //    $userdetails = $this->User->findById($receiver_id);
                //    if ($userdetails) {
                //        $device_type = $userdetails['User']['device_type'];
                //        $device_token = $userdetails['User']['device_token'];
                //        $online_status = $userdetails['User']['online_status'];
                //        // pr($device_token);
                //        /** ********* send notification for android ************* */
                //        if ($device_type == 'android') {
                //            if ($online_status ==1) {
                //                $device_token = array($device_token);
                //                $msg = $username['User']['screen_name'] . ' unlocked details profile';
                //                $message = array("msg" => $msg, 'sound' => 'default');
                //                $this->GCM->send_notification($device_token, $message);
                //                //$result = $gcm->send_notification($device_ids, $message);
                //            }
                //        } else {
                //            //echo $is_received;
                //            if ($online_status ==1) {
                //            /*********** send notification for ios ************* */
                //                $pemfile = WWW_ROOT . 'files/looking.pem';
                //                $passphrase = 'looking';
                //                $msg = $username['User']['screen_name'] . ' unlocked details profile';
                //                $ctx = stream_context_create();
                //                stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfile);
                //                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                //                // Open a connection to the APNS server
                //                $fp = stream_socket_client(
                //                    'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
                //
                //                if (!$fp)
                //                    exit("Failed to connect: $err $errstr" . PHP_EOL);
                //                $body['aps'] = array(
                //                    'alert' => $msg,
                //                    'count_unread_msg' => 1,
                //                    //'post_tag' => $post_tag,
                //                    //'job_id' => $job_id,
                //                    //'msg_id' => $msg_id,
                //                    //'unread_msg_count' => $msg_unread_count,
                //                    // 'msg_sender_id' => $msg_sender_id,
                //                    //'msg_sender_name' => $msg_sender_name,
                //                    // 'group_id' => $group_id,
                //                    //'group_name' => $group_name,
                //                    'sound' => 'default'
                //                );
                //                // pr(json_encode($body));
                //                // Encode the payload as JSON
                //                //$payload = json_encode($body);
                //                $payload = '{"aps":{"alert":"'.$msg.'","count_unread_msg" : 1,"type" : "unlock_profile","sound":"default","badge":'.(int)$total_unread_message.'}}';
                //                // Build the binary notification
                //                $msg = chr(0) . pack('n', 32) . pack('H*', $device_token) . pack('n', strlen($payload)) . $payload;
                //
                //                // Send it to the server
                //                $result = fwrite($fp, $msg, strlen($msg));
                //                //echo $result;
                //                $json = array();
                //                //                        if (!$result) {
                //                //                            $json = array('success' => '0', 'success_message' => 'Message not delivered');
                //                //                        } else {
                //                //                            $json = array('success' => '1', 'success_message' => 'Message successfully delivered');
                //                //                        }
                //                // Close the connection to the server
                //                fclose($fp);
                //                //return json_encode($json);
                //            }
                //        }
                //    }           
                //}
                /*                 * *************************Soham 10 July 2015 Changes END***************************** */
                $data['success'] = 1;
                $data['msg'] = 'successfully save into database';
            } else {
                $data['success'] = 2;
                $data['msg'] = 'unable to save into database';
            }
            // pr($lock_profile);
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id and lock_user_id not found';
        }
        echo json_encode($data);
    }

    /*     * ********** this service use  for show recent images that user have sent in chat section   mir 20042015************ */

    public function add_recent_image() {
        $this->autoRender = false;
        $userId = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $file = isset($this->request->form['image']) ? $this->request->form['image'] : '';
        if ($userId && $file) {
            $resize = true;
            $resizeOptions = array('width' => '250', 'height' => '200', 'destination' => 'recent_images/thumb/');
            $rootPath = WWW_ROOT;
            $destination = 'profile_pic/';

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
            $recent_image['Archive']['user_id'] = $userId;
            $recent_image['Archive']['photo_name'] = $imageName;
            $recent_image['Archive']['creation_date'] = date('Y-m-d H:i:s');

            if ($this->Archive->save($recent_image)) {
                $data1['success'] = 1;
                $data1['msg'] = 'successfully save into database';
            } else {
                $data1['success'] = 1;
                $data1['msg'] = 'Unable to save into database';
            }
        } else {
            $data1['success'] = 0;
            $data1['msg'] = 'user_id and image not found';
        }
        echo json_encode($data1);
    }

    /*     * ****************** END *************************************************** */
    /*     * **************** for view recent images chat section 20042015*********************** */

    public function view_recent_image() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id) {
            $rootPath = WWW_ROOT;
            $destination = 'recent_images/';
            $picpath = $rootPath . $destination;
            //$view_recent_images = $this->RecentImage->find('all', array('conditions' => array('RecentImage.user_id' => $user_id), 'limit' => 6, 'order' => array('RecentImage.id desc')));
            $view_recent_images = $this->RecentImage->find('all', array('conditions' => array('RecentImage.user_id' => $user_id), 'order' => array('RecentImage.id desc')));
            //$archive = $this->Archive->find('all', array('conditions' => array('Archive.user_id' => $user_id)));
            if ($view_recent_images) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['path'] = RECENT_IMG_PATH;
                //$data['archive_images_path'] = PIC_PATH;
                $data['data'] = Hash::extract($view_recent_images, '{n}.RecentImage');
                // $data['archive_images'] = Hash::extract($archive, '{n}.Archive');
                ;
            } else {
                $data['success'] = 0;
                $data['msg'] = 'no data found';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user_id  not found';
        }
        echo json_encode($data);
    }

    /*     * ******************* END *********************** */
    /*     * **************** for phrase from  chat section 20042015 *********************** */

    public function add_phrases() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $phrases = isset($this->request->data['phrases']) ? $this->request->data['phrases'] : '';
        if ($user_id && $phrases) {
            $arrphrases = explode('~~~', $phrases);
            foreach ($arrphrases as $key => $value) {
                $user['Phrase'] = array(
                    'user_id' => $user_id,
                    'phrases' => $value,
                    'creation_date' => date('Y-m-d H:i:s')
                );
                $this->Phrase->create();
                if ($this->Phrase->save($user)) {
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                } else {
                    $data['success'] = 2;
                    $data['msg'] = 'unable to save into database';
                }
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user_id and phrases not found';
        }
        echo json_encode($data);
    }

    /*     * ******************END******************** */
    /*     * **************** for view phrase from  chat section 20042015 *********************** */

    public function view_phrases() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id) {
            $phrases = $this->Phrase->find('all', array('conditions' => array('Phrase.user_id' => $user_id)));
            if ($phrases) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['data'] = Hash::extract($phrases, '{n}.Phrase');
            } else {
                $data['success'] = 2;
                $data['msg'] = 'no data found';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user_id not found';
        }
        echo json_encode($data);
    }

    /*     * **************** for delete phrase from  chat section 20042015 *********************** */

    public function delete_phrases() {
        $this->autoRender = false;
        $phrases_id = isset($this->request->data['id']) ? $this->request->data['id'] : ''; //this is phrases id
        if ($phrases_id) {
            if ($this->Phrase->delete($phrases_id)) {
                $data['success'] = 1;
                $data['msg'] = 'success';
            } else {
                $data['success'] = 2;
                $data['msg'] = 'unable to delete';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'phrases id not found';
        }
        echo json_encode($data);
    }

    /*     * ************END******************** */

    /*     * ******************** this service use for add chat user mean user has chat to whom ******************* */

    public function add_chat_user() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $chat_user_id = isset($this->request->data['chat_user_id']) ? $this->request->data['chat_user_id'] : '';
        if ($user_id && $chat_user_id) {
            $chat_users = $this->ChatUser->find('all', array('conditions' => array('ChatUser.user_id' => $user_id, 'ChatUser.chat_user_id' => $chat_user_id)));
            if (empty($chat_users)) {
                $chat_users1 = $this->ChatUser->find('all', array('conditions' => array('ChatUser.user_id' => $chat_user_id, 'ChatUser.chat_user_id' => $user_id)));
                if (empty($chat_users1)) {
                    $user1['ChatUser'] = array(
                        'user_id' => $chat_user_id,
                        'chat_user_id' => $user_id,
                        'creation_date' => date('Y-m-d H:i:s')
                    );
                    $this->ChatUser->save($user1);
                }
                //$arrphrases = explode(',', $phrases);
                //foreach ($arrphrases as $key => $value) {
                $user['ChatUser'] = array(
                    'user_id' => $user_id,
                    'chat_user_id' => $chat_user_id,
                    'creation_date' => date('Y-m-d H:i:s')
                );
                $this->ChatUser->create();
                if ($this->ChatUser->save($user)) {
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                } else {
                    $data['success'] = 2;
                    $data['msg'] = 'unable to save into database';
                }
            } else {
                $chat_users1 = $this->ChatUser->find('all', array('conditions' => array('ChatUser.user_id' => $chat_user_id, 'ChatUser.chat_user_id' => $user_id)));
                if (empty($chat_users1)) {
                    $user1['ChatUser'] = array(
                        'user_id' => $chat_user_id,
                        'chat_user_id' => $user_id,
                        'creation_date' => date('Y-m-d H:i:s')
                    );
                    $this->ChatUser->create();
                    $this->ChatUser->save($user1);
                }
                $data['success'] = 1;
                $data['msg'] = 'success';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user_id and chat_user_id not found';
        }
        echo json_encode($data);
    }

    public function view_chat_users() {
        $this->autoRender = false;
        $Userdetails['User_Profile_Lock'] = array();
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $viewer_user_id = isset($this->request->data['lock_user_id']) ? $this->request->data['lock_user_id'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        $browse = isset($this->request->data['browse']) ? $this->request->data['browse'] : ''; //check the user come from looking or not
        $favourites = isset($this->request->data['favourite']) ? $this->request->data['favourite'] : ''; //for filtering favourite user
        $sent_invite = isset($this->request->data['sent_invite']) ? $this->request->data['sent_invite'] : ''; //for filtering whom I sent invite
        $received_invite = isset($this->request->data['received_invite']) ? $this->request->data['received_invite'] : ''; //for filtering whom I received invite
        $search_value = isset($this->request->data['search_value']) ? $this->request->data['search_value'] : ''; //for filtering search by name or token
        $unread = isset($this->request->data['unread']) ? $this->request->data['unread'] : ''; //for serach limit unread message take 
        /*         * ************** get block user id************** */
        //get inactive user id by admin//
        $get_unbanuser = $this->User->find('all', array('conditions' => array('User.status' => 0)));
        $unban_user_id = Hash::extract($get_unbanuser, '{n}.User.id');
        //===blocked by login user===//
        $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $user_id)));
        $block_user_id = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
        //========blocked login user by others========//
        $get_block_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.blocked_id' => $user_id)));
        $block_others_user_id = Hash::extract($get_block_user_data, '{n}.BlockedUser.user_id');
        $bock_user_id = array_merge($block_user_id, $block_others_user_id, $unban_user_id);
        /*         * ******************END**************** */
        if ($user_id) {
            /*             * **********unread message count ***** */
            $option['fields'] = array('User.*', 'Profile.*', 'UserPartner.*', 'ChatUser.*');
            $option['joins'] = array(
                array('table' => 'chat_users',
                    'alias' => 'ChatUser',
                    'type' => 'INNER',
                    'conditions' => array(
                        'ChatUser.user_id = User.id',
                        'AND' => array(
                            array('ChatUser.chat_user_id' => $user_id),
                        )
                    )
            ));
            $option['conditions'] = array('User.id !=' => $user_id, "NOT" => array('User.id' => $bock_user_id));
            $option['order'] = array('ChatUser.creation_date' => 'DESC');
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $chatusers = $this->User->find('all', $option);
            $total_unread_message = 0;
            if ($chatusers) {
                if ($browse == 'looking') {
                    foreach ($chatusers as $key => $value) {

                        /*                         * ****check message sender profile active or not ********* */
                        $is_profile_active = $this->check_profile_active($current_date, $value['ChatUser']['user_id']);
                        if ($is_profile_active == 0) {
                            $this->ChatUser->updateAll(
                                    array('ChatUser.count' => 0), array('ChatUser.user_id' => $value['ChatUser']['user_id'], 'ChatUser.chat_user_id' => $value['ChatUser']['chat_user_id']));
                        }
                        /*                         * ****END********* */
                    }
                }
            }
            /*             * **********End********* */

            //=== For is active checking===//
            $if_exist_profile = $this->UserLooksex->find('all', array('conditions' => array(
                    'and' => array(
                        array(
                            //'UserLooksex.user_id ' => $viewer_user_id,
                            'UserLooksex.start_time <=' => $current_date,
                            'UserLooksex.end_time >=' => $current_date
                        )
                    )
            )));
            $looksex_user_id = Hash::extract($if_exist_profile, '{n}.UserLooksex.user_id');
            // pr($this->UserLooksex->getDataSource()->getLog(true));die;
            //pr($looksex_user_id);die;


            /*             * ********************** */
            //======get member type  free user or paid user==//
            $login_user_member_type = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $member_type = $login_user_member_type['User']['member_type'];
            $removead = $login_user_member_type['User']['removead'];
            //=======End============//
            //if($search_value || $favourites || $unread || $sent_invite || $received_invite){
            //if($search_value){	
            //	$limit=$this->match_limit($member_type,'search');
            //	$options['limit']=$limit;
            //}
            /*             * **check type********** */
            $options['fields'] = array('User.*', 'Profile.*', 'UserPartner.*', 'ChatUser.*');
            if ($browse == 'looking') {
                if ($sent_invite) {
                    /*                     * *****filtering condition ********* */
                    $options['joins'] = array(
                        array('table' => 'chat_users',
                            'alias' => 'ChatUser',
                            'type' => 'INNER',
                            'conditions' => array(
                                'ChatUser.chat_user_id = User.id',
                                'AND' => array(
                                    array('ChatUser.user_id' => $user_id),
                                    array('User.id' => $looksex_user_id),
                                )
                            )
                    ));
                } else {
                    $options['joins'] = array(
                        array('table' => 'chat_users',
                            'alias' => 'ChatUser',
                            'type' => 'INNER',
                            'conditions' => array(
                                'ChatUser.user_id = User.id',
                                'AND' => array(
                                    array('ChatUser.chat_user_id' => $user_id),
                                    array('User.id' => $looksex_user_id),
                                )
                            )
                    ));
                }
            } else if ($browse == 'dating') {
                $chat_users_lookdate = $this->ChatUser->find('all', array('conditions' => array('ChatUser.chat_user_id' => $user_id)));
                $chat_users_lookdate_id = Hash::extract($chat_users_lookdate, '{n}.ChatUser.user_id');
                $UserLookdate = $this->UserLookdate->find('all', array('conditions' => array('UserLookdate.user_id' => $chat_users_lookdate_id)));
                $lookdate_user_id = Hash::extract($UserLookdate, '{n}.UserLookdate.user_id');
                //die;
                /*                 * *****End********* */
                /*                 * *****8check looking user sent invitation or not then except those id ********* */
                $looksex_check_invite_user_id = array();
                foreach ($looksex_user_id as $lookuser) {
                    $chatuserinvite = $this->ChatUser->find('all', array('conditions' => array('ChatUser.user_id' => $lookuser, 'ChatUser.chat_user_id' => $user_id, 'ChatUser.check_invitaion_sent' => 1)));
                    if ($chatuserinvite) {
                        $looksex_check_invite_user_id[] = $lookuser;
                    }
                    //echo $lookuser;die;
                }
                $lookdate_invite_user_id = array_unique(array_merge($looksex_check_invite_user_id, $lookdate_user_id));
                //pr($lookdate_invite_user_id);
                //pr($looksex_check_invite_user_id);die;
                /*                 * *****End******* */
                //$virtualFields = array('total' => 'SUM(ChatUser.count)');

                $options['joins'] = array(
                    array('table' => 'chat_users',
                        'alias' => 'ChatUser',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ChatUser.user_id = User.id',
                            'AND' => array(
                                array('ChatUser.chat_user_id' => $user_id),
                                array('User.id' => $lookdate_invite_user_id),
                            //array('User.id'=>$lookdate_user_id)
                            )
                        )
                ));
            } else {

                $options['joins'] = array(
                    array('table' => 'chat_users',
                        'alias' => 'ChatUser',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ChatUser.user_id = User.id',
                            'AND' => array(
                                array('ChatUser.chat_user_id' => $user_id),
                            //array('User.id'=>$looksex_check_invite_user_id),
                            //array('User.id'=>$lookdate_user_id)
                            )
                        )
                ));
            }
            if ($favourites) {
                $favourite = $this->Favourite->find('all', array('conditions' => array('Favourite.user_id' => $user_id, 'Favourite.is_favourite' => 1)));
                $favourite_user_id = Hash::extract($favourite, '{n}.Favourite.favourite_user_id');
                $options['conditions'] = array('User.id !=' => $user_id, 'User.id' => $favourite_user_id, "NOT" => array('User.id' => $bock_user_id));
            } else if ($sent_invite) {
                //only for looking as per client requirement
                $options['conditions'] = array('User.id !=' => $user_id, "NOT" => array('User.id' => $bock_user_id), 'ChatUser.invite >' => 0);
            } else if ($received_invite) {
                $options['conditions'] = array('User.id !=' => $user_id, "NOT" => array('User.id' => $bock_user_id), 'ChatUser.invite >' => 0);
                //only for browse and dating as per client requirement
            } else {
                $options['conditions'] = array('User.id !=' => $user_id, "NOT" => array('User.id' => $bock_user_id));
            }
            /*             * ******for search by name or token ******** */
            if ($search_value) {
                //$options['conditions'] = array(
                //    //'User.id !=' => $user_id,
                //    "NOT" => array('User.id'=>$bock_user_id),
                //    'User.registration_status' => 3
                //);
                $options['conditions']['OR'] = array(
                    "User.screen_name LIKE" => "%" . $search_value . "%",
                    "User.token LIKE" => "%" . $search_value . "%",
                );
            }
            /*             * ********END************** */
            $options['order'] = array('ChatUser.creation_date' => 'DESC');
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $chatusers = $this->User->find('all', $options);
            $total_unread_message = 0;
            if ($chatusers) {
                $unread_message_chatusers = array();
                $read_message_user = array();
                foreach ($chatusers as $key => $value) {
                    $chatusers[$key]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value['User']['id']);
                    if ($value['ChatUser']['invite'] > 0) {
                        $invite = 1;
                    } else {
                        $invite = 0;
                    }
                    //if($browse=='dating'){
                    //  $is_active_look_date = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id' => $value['ChatUser']['user_id'])));
                    //  if($is_active_look_date) {
                    //      $total_unread_message+=$value['ChatUser']['count'];
                    //    }
                    //    $total_unread_message+=$invite;
                    //}else{

                    $total_unread_message+=($value['ChatUser']['count'] + $invite);
                    //}

                    /*                     * *****sort by unread message ******** */
                    if ($value['ChatUser']['count'] > 0 || $value['ChatUser']['invite'] > 0) {
                        $unread_message_chatusers[] = $chatusers[$key];
                    } else {
                        $read_message_user[] = $chatusers[$key];
                    }
                }

                //pr($read_message_user);
                $chatusers = array_merge($unread_message_chatusers, $read_message_user);
            }
            /*             * *******count user locked profie or not ******** */
            //$profilelockcount=$this->ProfileLock->find('all', array('conditions' => array('ProfileLock.count' => 1, 'ProfileLock.lock_user_id' => $user_id)));
            //if($profilelockcount) { 
            //        $total_unread_message+=count($profilelockcount);                         
            //}
            /*             * ********End*********** */
            // pr($this->User->getDataSource()->getLog(true));
            /*             * *********** check user  alredy lock the view profile user ************ */
            $lock_profile = $this->ProfileLock->find('first', array('conditions' => array('ProfileLock.user_id' => $user_id, 'ProfileLock.lock_user_id' => $viewer_user_id, 'ProfileLock.is_locked' => 1)));
            if ($lock_profile) {
                $Userdetails['User_Profile_Lock'] = $lock_profile['ProfileLock'];
            }
            //pr($this->UserLooksex->getDataSource()->getLog(true));die;
            /*             * *************** END ******************* */
            /*             * ********check user view my profile ********* */
            $is_view = $this->check_view($user_id);
            /*             * ********END************ */
            /*             * ******check any one share album with me******** */
            $is_share = $this->check_sharealbum($user_id);
            /*             * ******End********* */
            /*             * ******count total user view my profile******** */
            $count_view = $this->count_view($user_id);
            /*             * ******End********* */
            /*             * ******count total user share album with me******** */
            $count_sharealbum = $this->count_sharealbum($user_id);
            $total_view_and_share = $count_view + $count_sharealbum;
            /*             * ******End********* */
            /*             * ******for give user looksex data******** */
            $user_looksex = $this->UserLooksex->find('first', array('conditions' => array(
                    'and' => array(
                        array(
                            'UserLooksex.user_id ' => $user_id,
                            'UserLooksex.start_time <=' => $current_date,
                            'UserLooksex.end_time >=' => $current_date
                        )
                    )
            )));
            if ($user_looksex) {
                $data['userlooksex_data'] = $user_looksex['UserLooksex'];
            }
            /*             * **********END**************** */

            if ($chatusers) {
                //====for free user recent message grid limit===//
                //if($member_type==0){
                if ($search_value) {
                    $limit = $this->match_limit($member_type, 'search');
                } else {
                    $limit = $this->match_limit($member_type, 'RecentMassage');
                }
                if ($limit != 0) {
                    $read_message_user = array_slice($read_message_user, 0, $limit);
                }

                //}
                //=====End==========//
                /*                 * *****get the max accuricy number ******* */
                $accuracy_value = Hash::extract($chatusers, '{n}.User.accuracy');
                //pr($accuracy_value);die;
                $accuracy_max_value = (int) max($accuracy_value);
                /*                 * **********END*************** */
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['is_share_album'] = $is_share;
                $data['is_viewed'] = $is_view;
                $data['total_view_and_share'] = $total_view_and_share;
                $data['total_unread_message'] = $total_unread_message;
                $data['path'] = PIC_PATH;
                $data['user_looking_profile_active'] = $this->check_profile_active($current_date, $user_id);
                $data['accuracy'] = $accuracy_max_value;
                //$data['data'] = $chatusers;
                $data['login_user_member_type'] = $member_type;
                $data ['login_user_removead'] = $removead;
                $data['unread_message_grid'] = $unread_message_chatusers;
                $data['read_message_grid'] = $read_message_user;

                $data['profile_lock'] = $Userdetails['User_Profile_Lock'];
            } else {
                $data['success'] = 2;
                $data['msg'] = 'no data found';
                $data['login_user_member_type'] = $member_type;
                $data ['login_user_removead'] = $removead;
                $data['user_looking_profile_active'] = $this->check_profile_active($current_date, $user_id);
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user_id not found';
        }
        echo json_encode($data);
    }

    //===For forgot password(Mahadev)====//
    public function lostPassword() {
        $this->autoRender = false;
        //echo $result = Security::encrypt('12345678', ENCRYPTION_KEY).'<br/>';
        //echo $result1 = Security::decrypt($result, ENCRYPTION_KEY).'<br/>';
        //die;
        //echo $encrypted = $this->encrypt('12345678', ENCRYPTION_KEY);
        //echo "<br />";
        // echo $decrypted = $this->decrypt($encrypted, ENCRYPTION_KEY);
        //die;
        $admin_data = $this->Admin->find('first');
        $admin_email = $admin_data['Admin']['admin_email'];
        if ($this->request->is('post')) {
            if (isset($this->request->data['email'])) {
                $userid = $this->User->find('first', array('conditions' => array('User.email' => $this->request->data['email'])));

                if (count($userid) > 0) {
                    //$original_password=$this->decrypt($userid['User']['original_password'], ENCRYPTION_KEY);
                    $original_password = base64_decode($userid['User']['original_password']);
                    //die;
                    $page_link = ROOT_URL . 'users/reset_password/' . base64_encode($userid['User']['id']) . '/' . base64_encode(date('Y-m-d H:i:s'));
                    $email_template = "
            <div style='width:800px;
            margin:0 auto'>
                    <div style='background-color:grey; color:#fff; font-size:30px; padding:15px 0; text-align:center; display:block !important;'>
            Looking App
            </div>
            <div style = 'background-color:#9e9e9e; padding:10px; font-family:Arial, Helvetica, sans-serif; color:#5a3333; font-size:13px; line-height:16px;'>
            <div style = 'background-color:#fff; padding:10px;'>
            <p>
            Hi, " . $userid['User']['email'] . "</p>

            <p>
            Your Password is '" . $original_password . "'</p>
            </div>
            </div>
            <div style = 'background-color:#dbdbdb; border-top:1px solid #9e9e9e; padding:5px 0; text-align:center; font-size:11px; color:#9a7788; font-family:Arial, Helvetica, sans-serif;'>
            copyright text &copy; 2015</div>
            </div>
            <p>
            &nbsp;
            </p>
            ";
                    //===For Email Send===//
                    $subject = 'Forgot password';
                    $Email = new CakeEmail();
                    $Email->emailFormat('html');
                    $Email->from($admin_email);
                    $Email->to($userid['User']['email']);
                    $Email->subject($subject);
                    $Email->send(html_entity_decode($email_template));

                    echo json_encode(array('success' => 1, 'msg' => 'Email successfully sent'));
                    exit;
                } else {
                    echo json_encode(array('success' => 2, 'msg' => 'Invalid email'));
                    exit;
                }
            } else {
                echo json_encode(array('success' => 0, 'msg' => 'Email id not found'));
                exit;
            }
        }
    }

    public function reset_password($member = null) {
        $this->layout = 'index';
        $member_id = base64_decode($member);
        $this->set('member_id', $member_id);
        if ($member_id > 0) {
            
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'error in update'));
            exit;
        }
    }

    public function ajax_reset_password() {
        $this->layout = 'ajax';
        $this->autoRender = false;

        if (isset($this->data['member_id']) && $this->data['member_id'] != '') {
            $current_userid = $this->data['member_id'];

            $login_details = $this->User->find('first', array(
                'conditions' => array('User.id' => $current_userid)
            ));
//                $prev_pass = $login_details['User']['password'];
//                $old_pass = Security::hash($this->data['old_password'], null, true);
//                echo $old_pass;
//               // echo Security::hash('admin', null, true);exit;
//               // echo $old_pass; die;
//                if ($old_pass != $prev_pass) {
//                    echo 3;
//                    die;
//                } else {
            //exit;
//                    $password = Security::hash($this->data['confirm_password'], null, true); 
//                   echo '----->'.$password; die;
            $password = $this->data['confirm_password'];
            $save['User']['id'] = $current_userid;
            $save['User']['password'] = $password;
            $this->User->save($save);
            echo 1;
            exit;
            //}
        }
    }

    /*     * ****** this function use for add flag 19052015********************* */

    public function add_flag() {
        $this->autoRender = false;
        $sender_id = isset($this->request->data['sender_id']) ? $this->request->data['sender_id'] : '';
        $receiver_id = isset($this->request->data['receiver_id']) ? $this->request->data['receiver_id'] : '';
        $flag = isset($this->request->data['flag']) ? $this->request->data['flag'] : '';
        if ($sender_id && $receiver_id && $flag) {
            $flag_details = $this->Flag->find('all', array('conditions' => array('Flag.sender_id' => $sender_id, 'Flag.receiver_id' => $receiver_id)));
            if (!$flag_details) {
                $user['Flag'] = array(
                    'sender_id' => $sender_id,
                    'receiver_id' => $receiver_id,
                    'flag' => $flag,
                    'creation_date' => date('Y-m-d H:i:s')
                );
                $this->Flag->create();
                if ($this->Flag->save($user)) {
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                } else {
                    $data['success'] = 2;
                    $data['msg'] = 'unable to save into database';
                }
            } else {
                $data['success'] = 3;
                $data['msg'] = 'already exists flag';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'sender_id,receiver_id and flag not found';
        }
        echo json_encode($data);
    }

    /*     * ***********END***************** */
    /*     * ****** this function use for add flag 19052015********************* */

    public function block_chat_user() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $block_user_id = isset($this->request->data['block_user_id']) ? $this->request->data['block_user_id'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        $block_chat = $this->BlockChatUser->find('first', array('conditions' => array('BlockChatUser.user_id' => $user_id, 'BlockChatUser.block_user_id' => $block_user_id)));
        if ($user_id && $block_user_id) {
            if ($block_chat) {
                /*                 * **** if is_blocked=1 then set is_blocked=2 means unblock and if  is_blocked=2 then set is_blocked=1 means block*** */
                if ($block_chat['BlockChatUser']['is_blocked'] == 1) {
                    $is_blocked = 2;
                } else {
                    $is_blocked = 1;
                }
                /*                 * *********** unblock or block chat user ************ */
                $user['BlockChatUser'] = array(
                    'id' => $block_chat['BlockChatUser']['id'],
                    'user_id' => $user_id,
                    'block_user_id' => $block_user_id,
                    'is_blocked' => $is_blocked,
                    'creation_date' => $current_date
                );
                // pr($sharealbum);
                //$data['success'] = 2;
                //$data['msg'] = 'already share album';
            } else {
                $is_blocked = 1;
                /*                 * *********** share album access ************ */
                $user['BlockChatUser'] = array(
                    //'id' => $sharealbum[0]['ShareAlbum']['id'],
                    'user_id' => $user_id,
                    'block_user_id' => $block_user_id,
                    'is_blocked' => $is_blocked,
                    'creation_date' => $current_date
                );
            }
            if ($this->BlockChatUser->save($user)) {
                $data['success'] = 1;
                $data['msg'] = 'success';
            } else {
                $data['success'] = 2;
                $data['msg'] = 'unable to save to database';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id and block user id not found';
        }
        echo json_encode($data);
    }

    /*     * ***************End****************** */
    /*     * ****** this function use for add flag 19052015********************* */

    public function search() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $search_value = isset($this->request->data['search_value']) ? $this->request->data['search_value'] : '';
        $search_tab = isset($this->request->data['tab']) ? $this->request->data['tab'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        if ($user_id) {
            $user_details = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            /*             * ********get block users********* */
            //get inactive user id by admin//
            $get_unbanuser = $this->User->find('all', array('conditions' => array('User.status' => 0)));
            $unban_user_id = Hash::extract($get_unbanuser, '{n}.User.id');
            //===blocked by login user===//
            $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $user_id)));
            $block_user_id = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
            //========blocked login user by others========//
            $get_block_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.blocked_id' => $user_id)));
            $block_others_user_id = Hash::extract($get_block_user_data, '{n}.BlockedUser.user_id');
            $bock_user_id = array_merge($block_user_id, $block_others_user_id, $unban_user_id);
            /*             * *********END****************** */

            //pr($user_details);die;
            /*             * ******* search by screen name and token *********** */
            if ($search_value) {
                $options['conditions'] = array(
                    'User.id !=' => $user_id,
                    "NOT" => array('User.id' => $bock_user_id)
                );
                $options['conditions']['OR'] = array(
                    "User.screen_name LIKE" => "%" . $search_value . "%",
                    "User.token LIKE" => "%" . $search_value . "%",
                );
            }
            /*             * ******* END *********** */
            /*             * ******* search by Online from looking sex *********** */ else if ($search_tab == 'online') {
                //$options['fields'] = array('Friend.*', 'User.*', 'Like.*');
                $options['joins'] = array(
                    array('table' => 'user_looksexes',
                        'alias' => 'UserLooksex',
                        'type' => 'INNER',
                        'conditions' => array(
                            'UserLooksex.user_id = User.id',
                            'AND' => array(
                                array(
                                    'UserLooksex.start_time <=' => $current_date,
                                    'UserLooksex.end_time >=' => $current_date
                                ),
                            )
                        )
                ));
                $options['conditions'] = array(
                    'User.id !=' => $user_id,
                    "NOT" => array('User.id' => $bock_user_id)
                );
            }
            /*             * ******* END *********** */
            /*             * ******* search by Profile unlock  *********** */ else if ($search_tab == 'unlock') {
                //$options['fields'] = array('Friend.*', 'User.*', 'Like.*');
                $options['joins'] = array(
                    array('table' => 'profile_locks',
                        'alias' => 'ProfileLock',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ProfileLock.lock_user_id = User.id',
                            'AND' => array(
                                array(
                                    'ProfileLock.user_id' => $user_id,
                                ),
                            )
                        )
                ));
                $options['conditions'] = array(
                    'User.id !=' => $user_id,
                    "NOT" => array('User.id' => $bock_user_id),
                    'OR' => array(
                        'ProfileLock.is_locked !=' => 1,
                        'ProfileLock.is_locked' => NULL
                    )
                );
            }
            /*             * ******* END *********** */
            /*             * ******* search by Profile unlock  *********** */ else if ($search_tab == 'distance') {
                $lat = $user_details['User']['lat'];
                $lng = $user_details['User']['long'];
                $limit = 100;
                //$options['fields'] = array('Friend.*', 'User.*', 'Like.*');
                // Setup the distance field
                $this->User->virtualFields = array('distance'
                    => '(3959 * acos (cos ( radians(' . $lat . ') )
                          * cos( radians( User.lat ) )
                          * cos( radians( User.long ) 
                          - radians(' . $lng . ') )
                          + sin ( radians(' . $lat . ') )
                          * sin( radians( User.lat ) )))');

                $options['conditions'] = array(
                    'User.id !=' => $user_id,
                    "NOT" => array('User.id' => $bock_user_id),
                    'distance <' => $limit);
            }
            /*             * ******* END *********** */
            /*             * ******* search by Pics *********** */ else if ($search_tab == 'pics') {
                $options['conditions'] = array(
                    'User.id !=' => $user_id,
                    "NOT" => array('User.id' => $bock_user_id),
                    'User.profile_pic !=' => '');
            }
            /*             * ******* END *********** */
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $alluser = $this->User->find('all', $options);
            if ($alluser) {
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['path'] = PIC_PATH;
                $data['data'] = $alluser;
            } else {
                $data['success'] = 2;
                $data['msg'] = 'no data found';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id  not found';
        }
        //pr($this->User->getDataSource()->getLog(true));
        echo json_encode($data);
    }

    /*     * ***************End****************** */
    /*     * ****************** Time extend for looking sex profile*************** */

    public function time_extend_looksex_profile() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //user id
        $profile_id = isset($this->request->data['id']) ? $this->request->data['id'] : ''; //looksex profile id
        //$current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        //For check exist time//
        if ($profile_id && $user_id) {
            $looksex_profile = $this->UserLooksex->findById($profile_id);
            $start_time = $looksex_profile['UserLooksex']['start_time'];
            $end_time = $looksex_profile['UserLooksex']['end_time'];
            $newTime = date("Y-m-d H:i:s", strtotime($end_time . " +60 minutes"));
            //echo $newTime;
            $if_exist_profile = $this->UserLooksex->find('first', array('conditions' => array(
                    'and' => array(
                        array('UserLooksex.start_time <= ' => $newTime,
                            'UserLooksex.end_time >= ' => $start_time
                        ),
                        'UserLooksex.user_id ' => $user_id,
                        'UserLooksex.id !=' => $profile_id,
                    )
            )));
            if (count($if_exist_profile) > 0) {
                $exitprofile_starttime = $if_exist_profile['UserLooksex']['start_time'];
                $date1 = date_create($end_time);
                $date2 = date_create($exitprofile_starttime);

                $diff = date_diff($date1, $date2);
                $minutes = $diff->i;
                if ($minutes > 0) {
                    $newTime = date("Y-m-d H:i:s", strtotime($end_time . " +" . $minutes . " minutes"));
                    $this->UserLooksex->id = $profile_id;
                    if ($this->UserLooksex->saveField('end_time', $newTime)) {
                        $user_looksex = $this->UserLooksex->findById($profile_id);
                        $data['success'] = 1;
                        $data['msg'] = 'success';
                        $data['extend_time'] = $minutes . 'minutes';
                        $data['userlooksex_data'] = $user_looksex['UserLooksex'];
                    } else {
                        $data['success'] = 2;
                        $data['msg'] = 'unable to update';
                    }
                } else {
                    $data['success'] = 3;
                    $data['msg'] = 'unable to update because your next profile start now';
                }
            } else {
                $this->UserLooksex->id = $profile_id;
                if ($this->UserLooksex->saveField('end_time', $newTime)) {
                    $user_looksex = $this->UserLooksex->findById($profile_id);
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                    $data['extend_time'] = '1 hour';
                    $data['userlooksex_data'] = $user_looksex['UserLooksex'];
                } else {
                    $data['success'] = 2;
                    $data['msg'] = 'unable to update';
                }
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id and profile id  not found';
        }
        echo json_encode($data);
    }

    /*     * ****************END************************** */
    /*     * *******Match Percentage filter ********** */

    public function match_filter() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //user id
        $type = isset($this->request->data['type']) ? $this->request->data['type'] : ''; //track which page user come  looking sex or date or Browse page
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        if ($user_id && $current_date) {
            $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $user_id)));
            $block_user = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
            if (count($block_user) > 0) {
                $block_user_id = ',' . implode(',', $block_user);
            } else {
                $block_user_id = '';
            }
            if ($type == 'looking') {
                //=== For is active checking===//
                $data = $this->UserLooksex->find('first', array('conditions' => array(
                        'and' => array(
                            array('UserLooksex.start_time <=' => $current_date,
                                'UserLooksex.end_time >=' => $current_date
                            ),
                            'UserLooksex.user_id =' => $user_id
                        )
                )));
                if ($data) {
                    //$profile_Id=$if_exist_profile['UserLooksex']['id'];
                    $SqlQry = "SELECT User.*,Profile.*,UserPartner.*,UserLooksex.* FROM user_looksexes as UserLooksex
                        left join users as User on UserLooksex.user_id=User.id
                        left join profiles as Profile on UserLooksex.user_id=Profile.user_id
                        left join user_partners as UserPartner on UserLooksex.user_id=UserPartner.user_id
                        WHERE
                        UserLooksex.user_id NOT IN (" . $user_id . $block_user_id . ")
                        and UserLooksex.start_time <= '" . $current_date . "' and UserLooksex.end_time >= '" . $current_date . "'
                        and (`my_physical_appearance` REGEXP REPLACE('" . $data['UserLooksex']['his_physical_appearance'] . "', ',','(\\,|$)|')
                        or `my_sextual_preferences` REGEXP REPLACE('" . $data['UserLooksex']['his_sextual_preferences'] . "', ',','(\\,|$)|')
                        or `my_social_habits` REGEXP REPLACE('" . $data['UserLooksex']['his_social_habits'] . "', ',','(\\,|$)|')) group by UserLooksex.user_id";
                    $result = $this->UserLooksex->query($SqlQry);
                    if ($result) {

                        foreach ($result as $key => $value) {
                            $physical = $this->percentage($data['UserLooksex']['his_physical_appearance'], $value['UserLooksex']['my_physical_appearance']);
                            $sextual = $this->percentage($data['UserLooksex']['his_sextual_preferences'], $value['UserLooksex']['my_sextual_preferences']);
                            $social_habits = $this->percentage($data['UserLooksex']['his_social_habits'], $value['UserLooksex']['my_social_habits']);
                            $overall_per_sum = ($physical + $sextual + $social_habits);
                            if ($overall_per_sum > 0) {
                                $overall_percentage = round(($overall_per_sum * 100) / 300);
                            } else {
                                $overall_percentage = 0;
                            }
                            $result[$key]['User']['percentage'] = $overall_percentage;
                            //echo $overall_percentage;die;
                            unset($result[$key]['UserLooksex']);
                        }
                    }
                    //pr($result);die;
                    $result = Set::sort($result, '{n}.User.percentage', 'desc');
                    $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
                    $login_user = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
                    if (count($login_user) > 0) {
                        $result = array_merge($login_user, $result);
                    }
                    if (!empty($result)) {
                        $SearchResult = array_unique($result, SORT_REGULAR);
                        $data1['success'] = 1;
                        $data1['msg'] = 'success';
                        $data1['data'] = $SearchResult;
                        $data1['path'] = PIC_PATH;
                        // die;
                    } else {
                        $data1['success'] = 2;
                        $data1['msg'] = 'No matches found';
                    }
                } else {
                    $data1['success'] = 3;
                    $data1['msg'] = 'No profile active';
                }
            } else if ($type == 'date') {
                $lookdate = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id' => $user_id)));
                $data = $this->UserLookdate->findById($lookdate['UserLookdate']['id']);
                if (!empty($data)) {
                    $SqlQry = "SELECT User.*,Profile.*,UserPartner.*,UserLookdate.* FROM user_lookdates as UserLookdate
                left join users as User on UserLookdate.user_id=User.id
                left join profiles as Profile on UserLookdate.user_id=Profile.user_id
                left join user_partners as UserPartner on UserLookdate.user_id=UserPartner.user_id
                WHERE
                UserLookdate.user_id NOT IN (" . $user_id . $block_user_id . ")
                and (`my_traits` REGEXP REPLACE('" . $data['UserLookdate']['his_traits'] . "', ',','(\\,|$)|')
                or `my_physical_appearance` REGEXP REPLACE('" . $data['UserLookdate']['his_physical_appearance'] . "', ',','(\\,|$)|')
                or `my_sextual_preferences` REGEXP REPLACE('" . $data['UserLookdate']['his_sextual_preferences'] . "', ',','(\\,|$)|')
                or `my_social_habits` REGEXP REPLACE('" . $data['UserLookdate']['his_social_habits'] . "', ',','(\\,|$)|'))";

                    $result = $this->UserLookdate->query($SqlQry);
                    // pr($result);
                    if ($result) {

                        foreach ($result as $key => $value) {
                            //pr($value['UserLookdate']['my_traits']);
                            $traits_percentage = $this->percentage($data['UserLookdate']['his_traits'], $value['UserLookdate']['my_traits']);
                            $interest = $this->percentage($data['UserLookdate']['my_interest'], $value['UserLookdate']['my_interest']);
                            $physical = $this->percentage($data['UserLookdate']['his_physical_appearance'], $value['UserLookdate']['my_physical_appearance']);
                            $sextual = $this->percentage($data['UserLookdate']['his_sextual_preferences'], $value['UserLookdate']['my_sextual_preferences']);
                            $social_habits = $this->percentage($data['UserLookdate']['his_social_habits'], $value['UserLookdate']['my_social_habits']);
                            $overall_per_sum = ($traits_percentage + $interest + $physical + $sextual + $social_habits);
                            if ($overall_per_sum > 0) {
                                $overall_percentage = round(($overall_per_sum * 100) / 500);
                            } else {
                                $overall_percentage = 0;
                            }
                            $result[$key]['User']['percentage'] = $overall_percentage;
                            //echo $overall_percentage;die;
                            unset($result[$key]['UserLookdate']);
                        }
                    }
                    //pr($result);die;
                    $result = Set::sort($result, '{n}.User.percentage', 'desc');

                    //pr($this->UserLookdate->getDataSource()->getLog());
                    $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
                    $login_user = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
                    if (count($login_user) > 0) {
                        $result = array_merge($login_user, $result);
                    }
                    if (!empty($result)) {
                        $SearchResult = array_unique($result, SORT_REGULAR);
                        $data1['success'] = 1;
                        $data1['msg'] = 'success';
                        $data1['data'] = $SearchResult;
                        $data1['path'] = PIC_PATH;
                    } else {
                        $data1['success'] = 2;
                        $data1['msg'] = 'No matches found';
                    }
                }
            } else {
                $data = $this->Profile->find('first', array('conditions' => array('Profile.user_id' => $user_id)));
                if (!empty($data)) {
                    $SqlQry = "SELECT User.*,Profile.*,UserPartner.* FROM profiles as Profile
                left join users as User on Profile.user_id=User.id
                left join user_partners as UserPartner on Profile.user_id=UserPartner.user_id
                WHERE
                Profile.user_id NOT IN (" . $user_id . $block_user_id . ")
                and (`identity` REGEXP REPLACE('" . $data['Profile']['his_identitie'] . "', ',','(\\,|$)|'))";
                }
                $result = $this->Profile->query($SqlQry);
                // pr($result);
                if ($result) {
                    foreach ($result as $key => $value) {
                        //pr($value['UserLookdate']['my_traits']);
                        $identity = $this->percentage($data['Profile']['his_identitie'], $value['Profile']['identity']);
                        $result[$key]['User']['percentage'] = $identity;
                    }
                }
                //pr($result);die;
                $result = Set::sort($result, '{n}.User.percentage', 'desc');
                //pr($this->UserLookdate->getDataSource()->getLog());
                $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
                $login_user = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
                if (count($login_user) > 0) {
                    $result = array_merge($login_user, $result);
                }
                if (!empty($result)) {
                    $SearchResult = array_unique($result, SORT_REGULAR);
                    $data1['success'] = 1;
                    $data1['msg'] = 'success';
                    $data1['data'] = $SearchResult;
                    $data1['path'] = PIC_PATH;
                } else {
                    $data1['success'] = 2;
                    $data1['msg'] = 'No matches found';
                }
            }
        } else {
            $data1['success'] = 0;
            $data1['msg'] = 'user id and current date not found';
        }
        echo json_encode($data1);
    }

    /*     * ************END**************** */
    /*     * ****percentage count for look sex profile *********** */

    public function percentage($his, $my) {
        $this->autoRender = false;
        //echo $his;
        $his = explode(',', $his);
        $his_percent_permatch = 100 / count($his);
        //pr($his_percent_permatch);die;
        $match = 0;
        $my = explode(',', $my);
        //pr($his);
        //pr($my);

        $result = array_intersect($his, $my);
        $match = count($result);
        //foreach ($his as $key => $value) {
        //                    foreach ($my as $key1 => $value1) {
        //                        //echo trim(strtolower($value1));
        //                        if (trim(strtolower($value)) == trim(strtolower($value1))) {
        //                            $match++;
        //                            
        //                            //pr($value);
        //                            //$traits[]=trim($value);
        //                            //$Userdetails['traits'] = implode(',',$Userdetails['traits']);
        //                           //$Userdetails['traits'] = Hash::extract($Userdetails['traits'], '{n}.traits');
        //                        }
        //                    }
        //                }

        $percentage = round($his_percent_permatch * $match);
        return($percentage);
    }

    /*     * ****send push notification for chat message *********** */

    public function chat_message_push_notification() {
        header('Content-type: text/html; charset=utf-8');
        $this->autoRender = false;
        $sender_id = isset($this->request->data['sender_id']) ? $this->request->data['sender_id'] : ''; //this is current user
        $receiver_id = isset($this->request->data['receiver_id']) ? $this->request->data['receiver_id'] : ''; // who receive message notification
        $message = isset($this->request->data['message']) ? $this->request->data['message'] : '';
        $browse = isset($this->request->data['browse']) ? $this->request->data['browse'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        if ($sender_id && $receiver_id) {
            $chat_count_message = $this->ChatUser->find('first', array('conditions' => array('ChatUser.user_id' => $sender_id, 'ChatUser.chat_user_id' => $receiver_id)));
            if ($chat_count_message) {
                //pr($chat_count_message);die;
                $this->ChatUser->updateAll(
                        array('ChatUser.count' => 'ChatUser.count + 1', 'ChatUser.creation_date' => "'" . $current_date . "'"), array('ChatUser.id' => $chat_count_message['ChatUser']['id']));
                //$unread_message=$chat_count_message['ChatCountMessage']['count'];
            }
            $chat_count_message1 = $this->ChatUser->find('first', array('conditions' => array('ChatUser.user_id' => $receiver_id, 'ChatUser.chat_user_id' => $sender_id)));
            if ($chat_count_message1) {
                //pr($chat_count_message);die;
                $this->ChatUser->updateAll(
                        array('ChatUser.creation_date' => "'" . $current_date . "'"), array('ChatUser.id' => $chat_count_message1['ChatUser']['id']));
                //$unread_message=$chat_count_message['ChatCountMessage']['count'];
            }

            //pr($this->ChatUser->getDataSource()->getLog());die;
            //else{
            //    $chat_users1 = $this->ChatUser->find('all', array('conditions' => array('ChatUser.user_id' => $receiver_id, 'ChatUser.chat_user_id' => $sender_id)));
            //   
            //    if (!$chat_users1) {
            //        // pr($chat_users1);die;
            //        $user1['ChatUser'] = array(
            //            'user_id' => $receiver_id,
            //            'chat_user_id' => $sender_id,
            //            'creation_date' => $current_date
            //        );
            //        $this->ChatUser->save($user1);
            //    }
            //    //pr('MM');die;
            //    /*                 * *********** save chat user ************ */
            //    $user['ChatUser'] = array(
            //        'user_id' => $sender_id,
            //        'chat_user_id' => $receiver_id,
            //        'count' => 1,
            //        //'message' => $message,
            //        'creation_date' => $current_date
            //    );
            //    $this->ChatUser->create();
            //    $this->ChatUser->save($user);
            //    //$unread_message=1;
            //}
            /*             * ***********total count message ************ */
            $chatusers = $this->ChatUser->find('all', array('conditions' => array('ChatUser.chat_user_id' => $receiver_id)));
            $total_unread_message = 0;
            if ($chatusers) {

                foreach ($chatusers as $key => $value) {
                    if ($value['ChatUser']['invite'] > 0) {
                        $invite = 1;
                    } else {
                        $invite = 0;
                    }
                    $total_unread_message+=($value['ChatUser']['count'] + $invite);
                }
            }
            /*             * *******count user locked profie or not ******** */
            //$profilelockcount=$this->ProfileLock->find('all', array('conditions' => array('ProfileLock.count' => 1, 'ProfileLock.lock_user_id' => $receiver_id)));
            //if($profilelockcount) { 
            //        $total_unread_message+=count($profilelockcount);                         
            //}
            /*             * ********End*********** */

            if ($total_unread_message == 0) {
                $total_unread_message = '';
            }
            /*             * ***********End******************** */
            /*             * *****check user look date profile active or not ********* */
            $is_active_look_date = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id' => $sender_id)));
            if ($is_active_look_date) {
                $is_active_lookdate_profile = 1;
            } else {
                $is_active_lookdate_profile = 0;
            }
            /*             * ****END********** */
            /*             * ****** get user name for push notification ************ */

            $username = $this->User->findById($sender_id);
            //$lightning = html_entity_decode($username['User']['screen_name'],ENT_NOQUOTES,'UTF-8');
            //pr($lightning);die;
            /*             * ************* END ******************** */
            /*             * ***** for push notification **************** */
            $userdetails = $this->User->findById($receiver_id);
            if ($userdetails) {
                $device_type = $userdetails['User']['device_type'];
                $device_token = $userdetails['User']['device_token'];
                $online_status = $userdetails['User']['online_status'];
                // pr($device_token);
                /*                 * ********* send notification for android ************* */
                if ($device_type == 'android') {
                    if ($online_status == 1) {
                        $device_token = array($device_token);
                        $msg = $username['User']['screen_name'] . ' send message for you';
                        $message = array("msg" => $msg, 'sound' => 'default');
                        $this->GCM->send_notification($device_token, $message);
                        //$result = $gcm->send_notification($device_ids, $message);
                    }
                } else {
                    if ($online_status == 1) {
                        /*                         * ********* send notification for ios ************* */
                        $pemfile = WWW_ROOT . 'files/looking.pem';
                        $passphrase = 'looking';
                        //$msg = "\xF0\x9F\x98\x81abcd";
                        //$msg ="\xd83d\xde00ios";
                        if ($message == 'send location') {
                            $msg = 'Location received';
                        } else if ($message == 'Detail profile unlocked') {

                            $msg = $username['User']['screen_name'] . ' unlocked ' . $browse . ' profile';
                        } else {
                            $msg = $username['User']['screen_name'] . ' send message for you'; //'You have a message';
                        }
                        $ctx = stream_context_create();
                        stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfile);
                        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                        // Open a connection to the APNS server
                        $fp = stream_socket_client(
                                'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                        if (!$fp)
                            exit("Failed to connect: $err $errstr" . PHP_EOL);
                        $body['aps'] = array(
                            'alert' => $msg,
                            'count_unread_msg' => $total_unread_message,
                            'message' => $message,
                            'type' => 'chat message',
                            'sender_id' => $sender_id,
                            'receiver_id' => $receiver_id,
                            'content-available' => 1,
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
                        //$payload = json_encode($body);
                        $payload = '{"aps":{"alert":"' . $msg . '","message":"' . $message . '","type":"chat message","sender_id":"' . $sender_id . '","receiver_id":"' . $receiver_id . '","sound":"default","badge": ' . (int) $total_unread_message . ',"count_unread_msg": "' . $total_unread_message . '","is_active_lookdate_profile": "' . $is_active_lookdate_profile . '"}}';
                        // Build the binary notification
                        $msg = chr(0) . pack('n', 32) . pack('H*', $device_token) . pack('n', strlen($payload)) . $payload;

                        // Send it to the server
                        $result = fwrite($fp, $msg, strlen($msg));
                        //echo $result;
                        $json = array();
                        // Close the connection to the server
                        fclose($fp);
                    }
                }
                $data['success'] = 1;
                $data['msg'] = 'success';
            }else {
                $data['success'] = 2;
                $data['msg'] = 'user details not found';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'sender_id and receiver_id  not found';
        }
        echo json_encode($data);
    }

    /*     * ****update unread message to read *********** */

    public function update_unread_message() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $sender_id = isset($this->request->data['sender_id']) ? $this->request->data['sender_id'] : ''; // who send message notification
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        if ($sender_id && $user_id && $current_date) {
            $chat_count_message = $this->ChatUser->find('first', array('conditions' => array('ChatUser.user_id' => $sender_id, 'ChatUser.chat_user_id' => $user_id)));
            if ($chat_count_message) {
                $this->ChatUser->updateAll(
                        array('ChatUser.count' => 0, 'ChatUser.invite' => 0, 'creation_date' => "'" . $current_date . "'"), array('ChatUser.id' => $chat_count_message['ChatUser']['id']));
            }
            $data['success'] = 1;
            $data['msg'] = 'success';
        } else {
            $data['success'] = 0;
            $data['msg'] = 'sender_id and user_id  not found';
        }
        echo json_encode($data);
    }

    /*     * ****update update_profilelock_count *********** */

    public function update_profilelock_count() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $viewer_user_id = isset($this->request->data['viewer_user_id']) ? $this->request->data['viewer_user_id'] : ''; // who send message notification
        /*         * **update profile lock counter********** */
        if ($viewer_user_id && $user_id) {
            $this->ProfileLock->updateAll(
                    array('ProfileLock.count' => 0), array('ProfileLock.user_id' => $viewer_user_id, 'ProfileLock.lock_user_id' => $user_id)
            );
            $data['success'] = 1;
            $data['msg'] = 'success';
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user_id and viewer_user_id  not found';
        }
        echo json_encode($data);

        /*         * ********END********* */
    }

    /*     * ********** for sent invitation *********** */

    public function sent_invitation() {
        $this->autoRender = false;
        $sender_id = isset($this->request->data['sender_id']) ? $this->request->data['sender_id'] : ''; //this is current user
        $receiver_id = isset($this->request->data['receiver_id']) ? $this->request->data['receiver_id'] : ''; // who receive message notification
        $accept = isset($this->request->data['accept']) ? $this->request->data['accept'] : ''; // for accept invitation 1 for accept
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        if ($sender_id && $receiver_id) {
            /*             * *******if accept invitation then ******** */
            if ($accept == 1) {
                $chat_count_message = $this->ChatUser->find('first', array('conditions' => array('ChatUser.user_id' => $sender_id, 'ChatUser.chat_user_id' => $receiver_id)));
                $chat_count_message1 = $this->ChatUser->find('first', array('conditions' => array('ChatUser.user_id' => $receiver_id, 'ChatUser.chat_user_id' => $sender_id)));
                if ($chat_count_message) {
                    //pr($chat_count_message);die;
                    $this->ChatUser->updateAll(
                            array('ChatUser.count' => 'ChatUser.count + 1', 'ChatUser.creation_date' => "'" . $current_date . "'"), array('ChatUser.id' => $chat_count_message['ChatUser']['id']));
                }
                if ($chat_count_message1) {
                    //pr($chat_count_message);die;
                    $this->ChatUser->updateAll(
                            array('ChatUser.invite' => 2,), array('ChatUser.id' => $chat_count_message1['ChatUser']['id']));
                }
            }
            /*             * ********END********** */ else {
                $chat_count_message = $this->ChatUser->find('first', array('conditions' => array('ChatUser.user_id' => $sender_id, 'ChatUser.chat_user_id' => $receiver_id)));
                if ($chat_count_message) {
                    //pr($chat_count_message);die;
                    $this->ChatUser->updateAll(
                            array('ChatUser.invite' => 1, 'ChatUser.check_invitaion_sent' => 1), array('ChatUser.id' => $chat_count_message['ChatUser']['id']));
                    //$unread_message=$chat_count_message['ChatCountMessage']['count'];
                } else {
                    $chat_users1 = $this->ChatUser->find('all', array('conditions' => array('ChatUser.user_id' => $receiver_id, 'ChatUser.chat_user_id' => $sender_id)));

                    if ($chat_users1) {
                        
                    } else {
                        $user1['ChatUser'] = array(
                            'user_id' => $receiver_id,
                            'chat_user_id' => $sender_id,
                            'creation_date' => $current_date
                        );
                        $this->ChatUser->save($user1);
                    }
                    //pr('MM');die;
                    /*                     * *********** save chat user ************ */
                    $user['ChatUser'] = array(
                        'user_id' => $sender_id,
                        'chat_user_id' => $receiver_id,
                        'count' => 0,
                        'invite' => 1,
                        'check_invitaion_sent' => 1,
                        'creation_date' => $current_date
                    );
                    $this->ChatUser->create();
                    $this->ChatUser->save($user);
                }
            }
            $username = $this->User->findById($sender_id);
            //$lightning = html_entity_decode($username['User']['screen_name'],ENT_NOQUOTES,'UTF-8');
            //pr($lightning);die;
            /*             * ************* END ******************** */
            /*             * ***** for push notification **************** */
            $userdetails = $this->User->findById($receiver_id);
            if ($userdetails) {
                $device_type = $userdetails['User']['device_type'];
                $device_token = $userdetails['User']['device_token'];
                $online_status = $userdetails['User']['online_status'];

                /*                 * ***********total count message ************ */
                $chatusers = $this->ChatUser->find('all', array('conditions' => array('ChatUser.chat_user_id' => $receiver_id)));
                $total_unread_message = 0;
                if ($chatusers) {

                    foreach ($chatusers as $key => $value) {
                        if ($value['ChatUser']['invite'] > 0) {
                            $invite = 1;
                        } else {
                            $invite = 0;
                        }
                        $total_unread_message+=($value['ChatUser']['count'] + $invite);
                    }
                }
                /*                 * *******count user locked profie or not ******** */
                //$profilelockcount=$this->ProfileLock->find('all', array('conditions' => array('ProfileLock.count' => 1, 'ProfileLock.lock_user_id' => $receiver_id)));
                //if($profilelockcount) { 
                //        $total_unread_message+=count($profilelockcount);                         
                //}
                /*                 * ********End*********** */
                if ($total_unread_message == 0) {
                    $total_unread_message = '';
                }
                /*                 * ***********End******************** */
                // pr($device_token);
                /*                 * ********* send notification for android ************* */
                if ($device_type == 'android') {
                    if ($online_status == 1) {
                        $device_token = array($device_token);
                        $msg = $username['User']['screen_name'] . ' send invitation for you';
                        $message = array("msg" => $msg, 'sound' => 'default');
                        $this->GCM->send_notification($device_token, $message);
                        //$result = $gcm->send_notification($device_ids, $message);
                    }
                } else {
                    if ($online_status == 1) {
                        /*                         * ********* send notification for ios ************* */
                        $pemfile = WWW_ROOT . 'files/looking.pem';
                        $passphrase = 'looking';
                        //$lightning = html_entity_decode('&#57661;',ENT_NOQUOTES,'UTF-8');
                        //echo  $lightning;die;
                        //$msg = "\xF0\x9F\x98\x81";
                        if ($accept == 1) {
                            $msg = $username['User']['screen_name'] . ' accept invitation';
                            $type = 'accept_invitation';
                        } else {
                            $msg = $username['User']['screen_name'] . ' send invitation';
                            $type = 'sent_invitation';
                        }
                        //echo $msg;die;
                        $ctx = stream_context_create();
                        stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfile);
                        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                        // Open a connection to the APNS server
                        $fp = stream_socket_client(
                                'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                        if (!$fp)
                            exit("Failed to connect: $err $errstr" . PHP_EOL);
                        $body['aps'] = array(
                            'alert' => $msg,
                            //'count_unread_msg' => $unread_message,
                            //'message'=>$message,
                            //'type'=>'chat message',
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
                        //$payload = json_encode($body);
                        $payload = '{"aps":{"alert":"' . $msg . '","type":"' . $type . '","sound":"default","badge": ' . (int) $total_unread_message . '}}';
                        // Build the binary notification
                        $msg = chr(0) . pack('n', 32) . pack('H*', $device_token) . pack('n', strlen($payload)) . $payload;

                        // Send it to the server
                        $result = fwrite($fp, $msg, strlen($msg));
                        //echo $result;
                        $json = array();
                        // Close the connection to the server
                        fclose($fp);
                    }
                }
                $data['success'] = 1;
                $data['msg'] = 'success';
            }else {
                $data['success'] = 2;
                $data['msg'] = 'user details not found';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'sender_id and receiver_id  not found';
        }
        echo json_encode($data);
    }

    /*     * *********For Declain Invitation *********** */

    //public function accept_invitation() {
    //   $this->autoRender = false;
    //   $sender_id = isset($this->request->data['sender_id']) ? $this->request->data['sender_id'] : ''; //this is current user
    //   $receiver_id = isset($this->request->data['receiver_id']) ? $this->request->data['receiver_id'] : ''; // who receive message
    //   if ($sender_id && $receiver_id) {
    //       $chat_count_message=$this->ChatUser->find('first',array('conditions' => array('ChatUser.user_id' => $receiver_id,'ChatUser.chat_user_id' => $sender_id)));
    //       if($chat_count_message){
    //           //pr($chat_count_message);die;
    //           $this->ChatUser->updateAll(
    //              array('ChatUser.count' => 'ChatUser.count + 1','ChatUser.creation_date' =>"'".$current_date."'"),
    //              array('ChatUser.id' => $chat_count_message['ChatUser']['id']));
    //       }
    //       $data['success'] = 1;
    //       $data['msg'] = 'success'; 
    //   }else{
    //       $data['success'] = 0;
    //       $data['msg'] = 'sender_id and receiver_id  not found'; 
    //   }
    //   echo json_encode($data);
    //}
    /*     * *******END************ */
    /*     * *********For Declain Invitation *********** */
    public function declain_invitation() {
        $this->autoRender = false;
        $sender_id = isset($this->request->data['sender_id']) ? $this->request->data['sender_id'] : ''; //this is current user
        $receiver_id = isset($this->request->data['receiver_id']) ? $this->request->data['receiver_id'] : ''; // who receive message
        if ($sender_id && $receiver_id) {
            $chat_count_message = $this->ChatUser->find('first', array('conditions' => array('ChatUser.user_id' => $receiver_id, 'ChatUser.chat_user_id' => $sender_id)));
            if ($chat_count_message) {
                //pr($chat_count_message);die;
                $this->ChatUser->updateAll(
                        array('ChatUser.invite' => 0), array('ChatUser.id' => $chat_count_message['ChatUser']['id']));
                //$unread_message=$chat_count_message['ChatCountMessage']['count'];
            }
            $data['success'] = 1;
            $data['msg'] = 'success';
        } else {
            $data['success'] = 0;
            $data['msg'] = 'sender_id and receiver_id  not found';
        }
        echo json_encode($data);
    }

    /*     * *******END************ */

    /*     * ********** For block and unblock user *********** */

    public function block_user() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $blocked_id = isset($this->request->data['blocked_id']) ? $this->request->data['blocked_id'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';

        if ($user_id && $blocked_id && $current_date) {
            //======get member type  free user or paid user==//
            $login_user_member_type = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $member_type = $login_user_member_type['User']['member_type'];
            //=======End============// 
            $get_model_data = $this->BlockedUser->find('first', array('conditions' => array('BlockedUser.user_id' => $user_id, 'BlockedUser.blocked_id' => $blocked_id)));
            if (empty($get_model_data)) {
                $block_data['BlockedUser'] = array(
                    'user_id' => $user_id,
                    'blocked_id' => $blocked_id,
                    'block_dt' => $current_date
                );

                //if($member_type==0){
                $limit = $this->match_limit($member_type, 'BlockPerDay');
//$count_block_per_day=$this->BlockedUser->find('count',array('conditions'=>array('BlockedUser.user_id'=>$user_id,'DATE(BlockedUser.block_dt)'=>date('Y-m-d',strtotime($current_date)))));
//=change as per client feed back remove per day concept//
                if ($limit != 0) {
                    $count_block = $this->BlockedUser->find('count', array('conditions' => array('BlockedUser.user_id' => $user_id)));
                    if ($count_block >= $limit) {
                        echo json_encode(array('success' => 2, 'msg' => 'You have reached your Block limit of ' . number_format($limit) . ' guys. Please remove a Block if you would like to add a new one.'));
                        exit();
                    }
                }
                //}
                //====unsahare album=====//
                $this->ShareAlbum->updateAll(array('ShareAlbum.is_received' => 2, 'ShareAlbum.is_view' => 0), array('ShareAlbum.sender_id' => $user_id, 'ShareAlbum.receiver_id' => $blocked_id));
                //=====unshare favourite=========//
                $this->Favourite->updateAll(array('Favourite.is_favourite' => 2), array('Favourite.user_id' => $user_id, 'Favourite.favourite_user_id' => $blocked_id));
                //========End=========//
                if ($this->BlockedUser->save($block_data)) {
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                } else {
                    $data['success'] = 0;
                    $data['msg'] = 'failure';
                }
            } else if (count($get_model_data) > 0) {
                $block_delete = $this->BlockedUser->deleteAll(
                        array(
                            "BlockedUser.user_id" => $user_id,
                            "BlockedUser.blocked_id" => $blocked_id
                        )
                );
                if ($block_delete) {
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                } else {
                    $data['success'] = 0;
                    $data['msg'] = 'failure';
                }
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'User Id,block Id and current date not found';
        }
        echo json_encode($data);
    }

    /*     * ********** for check any user view my profile *********** */

    public function check_view($user_id) {
        $this->autoRender = false;
        if ($user_id) {
            $option['conditions'] = array('Viewer.viewer_user_id' => $user_id, 'Viewer.is_view' => 1);
            $views = $this->Viewer->find('first', $option);
            if ($views) {
                $is_view = 1;
            } else {
                $is_view = 0;
            }
            return $is_view;
        }
    }

    /*     * ********** for check any user share his album *********** */

    public function check_sharealbum($user_id) {
        $this->autoRender = false;
        if ($user_id) {
            $option['conditions'] = array('ShareAlbum.receiver_id' => $user_id, 'ShareAlbum.is_view' => 1);
            $views = $this->ShareAlbum->find('first', $option);
            if ($views) {
                $is_view = 1;
            } else {
                $is_view = 0;
            }
            return $is_view;
        }
    }

    /*     * ********** for sent invitation *********** */

    public function test_push() {
        $this->loadModel('Test');
        $this->autoRender = false;
        //$user= isset($this->request->data['user']) ? $this->request->data['user'] : '';
        $message = isset($this->request->data['message1']) ? $this->request->data['message1'] : ''; //this is current user
        //echo $message;die;
        $device_token = isset($this->request->data['token']) ? $this->request->data['token'] : ''; //this is current
        //echo $message;die;
        if ($message && $device_token) {
            $block_data['Test'] = array(
                'message' => $message,
            );
            $this->Test->save($block_data);
            $id = $this->Test->getLastInsertId();
            $data_test = $this->Test->findById($id);
            // pr($data_test);
            $r = fopen('../../app/webroot/tracker3.txt', 'a+');
            fwrite($r, 'Time: ' . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL . 'ip address:' . $_SERVER['REMOTE_ADDR']);
            foreach ($this->request->data as $k => $v) {

                fwrite($r, $k . ' : ' . $v . PHP_EOL . PHP_EOL);
            }
            //$device_token = "c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577";
            /*             * ********* send notification for ios ************* */
            $pemfile = WWW_ROOT . 'files/looking.pem';
            $passphrase = 'looking';
            //$lightning = html_entity_decode('&#57661;',ENT_NOQUOTES,'UTF-8');
            //echo  $lightning;die;
            //$msg = "\xF0\x9F\x98\x81";
            $msg = $data_test['Test']['message'];
            //$msg = $data_test['Test']['message']. ' is now online';

            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfile);
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
            // Open a connection to the APNS server
            $fp = stream_socket_client(
                    'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
            //echo $msg;die;
            if (!$fp)
                exit("Failed to connect: $err $errstr" . PHP_EOL);
            //$body['aps'] = array(
            //  'alert' => $msg,
            // 'sound' => 'default',
            // 'type' =>1
            //);
            //$payload = json_encode($body);
            // echo $payload;die;
            $payload = '{"aps":{"alert":"' . $msg . '","sound":"default","badge": 1}}';
            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', $device_token) . pack('n', strlen($payload)) . $payload;

            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));
            //echo $result;
            $json = array();
            // Close the connection to the server
            fclose($fp);
            $data['success'] = 1;
            $data['msg'] = 'success';
        }
        else {
            $data['success'] = 2;
            $data['msg'] = 'msg not found';
        }
        echo json_encode($data);
    }

    /*     * *******************filter section matches 13-08-2015********************* */

    public function matches_filter() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        $type = isset($this->request->data['type']) ? $this->request->data['type'] : ''; //track which page user come  looking sex or dating or Browse page
        $search_value = isset($this->request->data['search_value']) ? $this->request->data['search_value'] : '';
        $his_identitie = isset($this->request->data['his_identitie']) ? $this->request->data['his_identitie'] : '';
        $his_seeking = isset($this->request->data['his_seeking']) ? $this->request->data['his_seeking'] : '';
        $ethnicity = isset($this->request->data['ethnicity']) ? $this->request->data['ethnicity'] : '';
        $relationship_status = isset($this->request->data['relationship_status']) ? $this->request->data['relationship_status'] : '';
        $profile_pic_type = isset($this->request->data['profile_pic_type']) ? $this->request->data['profile_pic_type'] : ''; //1 means face pic 2 means verified photo(face pic means facepic + verified)
        $age_to = str_replace('Not Set', '', isset($this->request->data['age_to']) ? $this->request->data['age_to'] : '');
        $age_from = str_replace('Not Set', '', isset($this->request->data['age_from']) ? $this->request->data['age_from'] : '');
        $match = str_replace('Not Set', '', isset($this->request->data['match']) ? $this->request->data['match'] : ''); //sort by match% get value asc and desc
        $height_cm_to = str_replace('Not Set', '', isset($this->request->data['height_cm_to']) ? $this->request->data['height_cm_to'] : '');
        $height_cm_from = str_replace('Not Set', '', isset($this->request->data['height_cm_from']) ? $this->request->data['height_cm_from'] : '');
        $Weight_kg_to = str_replace('Not Set', '', isset($this->request->data['Weight_kg_to']) ? $this->request->data['Weight_kg_to'] : '');
        $Weight_kg_from = str_replace('Not Set', '', isset($this->request->data['Weight_kg_from']) ? $this->request->data['Weight_kg_from'] : '');
        $recently_email = isset($this->request->data['recently_email']) ? $this->request->data['recently_email'] : ''; //this send email recently or online
        //pr(explode(',',$recently_email));die;
        if ($user_id && $current_date) {
            $identitie_con = array();
            $ethnicity_con = array();
            $relationship_con = array();
            $age_con = array();
            $all_user_data = array();
            $height_con = array();
            $weight_con = array();
            $his_seeking_con = array();
            $profile_pic_type_con = array();
            $filter_cache = array();
            /*             * ********get block users********* */
            //get inactive user id by admin//
            $get_unbanuser = $this->User->find('all', array('conditions' => array('User.status' => 0)));
            $unban_user_id = Hash::extract($get_unbanuser, '{n}.User.id');
            //===blocked by login user===//
            $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $user_id)));
            $block_user_id = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
            //========blocked login user by others========//
            $get_block_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.blocked_id' => $user_id)));
            $block_others_user_id = Hash::extract($get_block_user_data, '{n}.BlockedUser.user_id');
            $bock_user_id = array_merge($block_user_id, $block_others_user_id, $unban_user_id);
            /*             * *********END****************** */
            /*             * *********login user details ********* */
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $login_user = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
            $login_user_lat = $login_user[0]['User']['lat'];
            $login_user_long = $login_user[0]['User']['long'];
            $login_user_member_type = $login_user[0]['User']['member_type'];
            $login_user_removead = $login_user[0]['User']['removead'];
            $login_user_is_trial = $login_user[0]['User']['is_trial'];
            foreach ($login_user as $key1 => $value1) {
                $login_user[$key1]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value1['User']['id']);
            }
            /*             * ***********END**** */
            /*             * *******condition logic******** */
            //if($his_identitie && $his_identitie!='Not Set'){
            //   $identitie_con=array("Profile.identity REGEXP REPLACE('".$his_identitie."', ',','(\,|$)|(^)')");
            //  //$identitie_con=array("Profile.identity REGEXP('[[:<:]]bear[[:>:]]')");
            //   //pr($options);
            //   
            //    }
//            if($his_seeking && $his_seeking!='Not Set'){
//				$his_seeking_con_1='';
//				$his_seeking=explode(',',$his_seeking);
//				foreach($his_seeking as $hisseeking_key=>$hisseeking_value){
//					$hisseeking_value=trim($hisseeking_value);
//					if($hisseeking_key==count($his_seeking)-1){
//					$his_seeking_con_1.="Profile.his_identitie REGEXP '[[:<:]]".$hisseeking_value."[[:>:]]'";
//					}else{
//						$his_seeking_con_1.="Profile.his_identitie REGEXP '[[:<:]]".$hisseeking_value."[[:>:]]' ,";
//					}
//				}
//                //$his_seeking_con=array('OR' => array("Profile.his_identitie REGEXP REPLACE('".$his_seeking."', ',','(\,|$)|(^)')","Profile.identity REGEXP REPLACE('".$his_seeking."', ',','(\,|$)|(^)')"));
//				//$his_seeking_con=array('OR' => array("Profile.his_identitie REGEXP REPLACE('".$his_seeking."', ',','(\,|$)|(^)')"));
//				$his_seeking_final_string_con=explode(',',$his_seeking_con_1);
//				$his_seeking_con=array('OR' => $his_seeking_final_string_con);
//            }
            if ($ethnicity && $ethnicity != 'Not Set') {
                $ethnicity_con = array("Profile.ethnicity REGEXP REPLACE('Not Set," . $ethnicity . "', ',','(\,|$)|(^)')");
            }
            if ($relationship_status && $relationship_status != 'Not Set') {
                //echo $relationship_status;
                $relationship_con = array("Profile.relationship_status REGEXP REPLACE('" . $relationship_status . "', ',','(\,|$)|(^)')");
            }
            if ($profile_pic_type && $profile_pic_type != 'Not Set') {
                if ($profile_pic_type == 1) {
                    $profile_pic_type_con = array('OR' => array(array("User.profile_pic_type" => 1), array("User.profile_pic_type" => 2)));
                    // pr($profile_pic_type_con);
                } else {
                    $profile_pic_type_con = array("User.profile_pic_type" => $profile_pic_type);
                }
            }
            if ($age_to && $age_from) {
                //echo 'kkkkkk';die;
                $current_date1 = date('Y-m-d', strtotime($current_date));
                // echo 
                if ($age_to > $age_from) {
                    $age_to_change = $age_from;
                    $age_from_change = $age_to;
                    $age_to = $age_to_change;
                    $age_from = $age_from_change;
                }
                //$age_to=($age_to*365)-(11*30);//convert day(add 11 months 28 day)
                //$age_from=($age_from*365)+(11*30)+28;
                //$age_from=($age_from*365)+(11*30)+28;
                //$age_to_year=date('Y-m-d',strtotime('-'.$age_to.'day', strtotime($current_date1)));
                // $age_from_year=date('Y-m-d',strtotime('-'.$age_from.'year', strtotime($current_date1)));
                //$age_from_year = date('Y-m-d',strtotime(date('Y',strtotime($age_from_year)).'-01-01'));
                //echo $age_from_year;die;
                //$age_con=array('date(Profile.birthday) BETWEEN ? AND ?' => array($age_from_year, $age_to_year));
                $age_con = array('FLOOR(DATEDIFF (NOW(), Profile.birthday)/365) BETWEEN ? AND ?' => array($age_to, $age_from));
            }
            if ($height_cm_to && $height_cm_from) {
                if ($height_cm_to > $height_cm_from) {
                    $height_cm_to_change = $height_cm_from;
                    $height_cm_from_change = $height_cm_to;
                    $height_cm_to = $height_cm_to_change;
                    $height_cm_from = $height_cm_from_change;
                }
                $height_con = array('Profile.height_cm BETWEEN ? AND ?' => array($height_cm_to, $height_cm_from));
            }
            if ($Weight_kg_to && $Weight_kg_from) {
                if ($Weight_kg_to > $Weight_kg_from) {
                    $Weight_kg_to_change = $Weight_kg_from;
                    $Weight_kg_from_change = $Weight_kg_to;
                    $Weight_kg_to = $Weight_kg_to_change;
                    $Weight_kg_from = $Weight_kg_from_change;
                }
                //echo $Weight_kg_from.'-'.$Weight_kg_to;die;
                $weight_con = array('Profile.Weight_kg BETWEEN ? AND ?' => array($Weight_kg_to, $Weight_kg_from));
            }

            if ($type == 'looking') {
                //$condition = array('User.id !='=>$user_id,"NOT" => array('User.id'=>$bock_user_id),'User.registration_status' => 3,'UserLooksex.start_time <=' => $current_date,'UserLooksex.end_time >=' => $current_date);
                if ($recently_email) {
                    $condition = array("NOT" => array('User.id' => $bock_user_id), 'User.registration_status' => 3, 'User.email' => explode(',', $recently_email), 'UserLooksex.start_time <=' => $current_date, 'UserLooksex.end_time >=' => $current_date);
                } else {
                    $condition = array("NOT" => array('User.id' => $bock_user_id), 'User.registration_status' => 3, 'UserLooksex.start_time <=' => $current_date, 'UserLooksex.end_time >=' => $current_date);
                }
                // $condition = array('User.id !='=>$user_id,"NOT" => array('User.id'=>$bock_user_id),'User.registration_status' => 3); 
            } else {
                //$condition = array('User.id !='=>$user_id,"NOT" => array('User.id'=>$bock_user_id),'User.registration_status' => 3);
                if ($recently_email) {
                    $condition = array("NOT" => array('User.id' => $bock_user_id), 'User.registration_status' => 3, 'User.email' => explode(',', $recently_email));
                } else {
                    $condition = array("NOT" => array('User.id' => $bock_user_id), 'User.registration_status' => 3);
                }
            }
            $options['conditions'] = array_merge($ethnicity_con, $identitie_con, $relationship_con, $age_con, $condition, $height_con, $weight_con, $his_seeking_con, $profile_pic_type_con);
            //$options['order'] = array('User.database_distance' => 'ASC');
            $options['order'] = array('database_distance' => 'ASC');
            //======get limit for free user or paid user==//
            if ($search_value) {
                $limit = $this->match_limit($login_user_member_type, 'Search');
            } else {
                $limit = $this->match_limit($login_user_member_type, 'Match');
            }
            //=========End================//
            if ($his_identitie && $his_identitie == 'Not Set' && $his_seeking && $his_seeking == 'Not Set') {
                $options['limit'] = $limit;
            }

            /*             * *****if serch value then change the condition ********* */
            if ($search_value) {
                // $options['conditions'] = array(
                //    //'User.id !=' => $user_id,
                //    "NOT" => array('User.id'=>$bock_user_id),
                //    'User.registration_status' => 3
                //);
                //$options['conditions'] = $condition;
//                    $options['conditions']['OR'] = array(
//                        "User.token LIKE" => "%".$search_value."%",
//						"AND"=>array("User.screen_name LIKE" => "%".$search_value."%" ,
//						"User.screen_name REGEXP '\ud[a-z0-9]{3}'")
//                    );
                $options['conditions']['OR'] = array(
                    "User.screen_name LIKE" => "%" . $search_value . "%",
                    "User.token LIKE" => "%" . $search_value . "%",
                        //"AND"=>array("User.screen_name LIKE" => "%".$search_value."%" ,
                        //"User.screen_name REGEXP REPLACE('".$search_value."', '\ud[a-z0-9]{3}','(\,|$)|(^)')"
                );
            }//else{
            //$options['conditions']=array_merge($ethnicity_con,$identitie_con,$relationship_con,$age_con,$condition,$height_con,$weight_con,$his_seeking_con,$profile_pic_type_con);
            //  }
            //pr($options);die;
            /*             * *****End********* */
            //$this->User->virtualFields = array('database_distance' => "( 6371 * acos( cos( radians(".$login_user_lat.") ) * cos( radians( User.lat ) ) * cos( radians( User.long`) - radians(".$login_user_long.") ) + sin( radians(".$login_user_lat.") ) * sin( radians( User.lat ) ) ) )");

            if ($type == 'looking') {
                /*                 * *******looking matches filter************ */
                /*                 * *******dating matches filter************ */
                $options['fields'] = array('User.*', '( 6371 * acos( cos( radians("' . $login_user_lat . '") ) * cos( radians( lat ) ) * cos( radians( `long` ) - radians("' . $login_user_long . '") ) + sin( radians("' . $login_user_lat . '") ) * sin( radians( lat ) ) ) ) AS database_distance', 'Profile.*', 'UserPartner.*', 'ChatUser.*', 'UserLooksex.*');
                /*                 * *******userlook date profile ************* */
                $if_exist_looking_profile = $this->UserLooksex->find('first', array('conditions' => array(
                        'and' => array(
                            array('UserLooksex.start_time <=' => $current_date,
                                'UserLooksex.end_time >=' => $current_date
                            ),
                            'UserLooksex.user_id' => $user_id
                        )
                )));
                /*                 * ********End************** */
                $options['joins'] = array(
                    array('table' => 'users',
                        'alias' => 'User',
                        'type' => 'Left',
                        'conditions' => array(
                            'User.id = UserLooksex.user_id',
                        )
                    ),
                    array('table' => 'profiles',
                        'alias' => 'Profile',
                        'type' => 'Left',
                        'conditions' => array(
                            'Profile.user_id = UserLooksex.user_id',
                        )
                    ),
                    array('table' => 'user_partners',
                        'alias' => 'UserPartner',
                        'type' => 'Left',
                        'conditions' => array(
                            'UserPartner.user_id = UserLooksex.user_id',
                        )
                    ),
                    array('table' => 'chat_users',
                        'alias' => 'ChatUser',
                        'type' => 'Left',
                        'conditions' => array(
                            'ChatUser.user_id = UserLooksex.user_id',
                            'AND' => array(
                                array('ChatUser.chat_user_id' => $user_id),
                            )
                        )
                ));
                //pr($options);die;
                $user_data = $this->UserLooksex->find('all', $options);
                //pr($this->UserLooksex->getDataSource()->getLog(true));die;
                //pr($user_data);die;
                $total_unread_message = 0;
                if ($user_data) {
                    foreach ($user_data as $key => $value) {
                        unset($user_data[$key][0]);
                        $user_data[$key]['User']['distance'] = $this->distance($login_user_lat, $login_user_long, $value['User']['lat'], $value['User']['long'], 'M');
                        $user_data[$key]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value['User']['id']);
                        /*                         * *****count unread message ********* */
                        if ($value['ChatUser']['invite'] > 0) {
                            $invite = 1;
                        } else {
                            $invite = 0;
                        }
                        $total_unread_message+=($value['ChatUser']['count'] + $invite);
                        /*                         * **********End************ */
                        /*                         * ******percentage count for sorting******** */
                        if ($if_exist_looking_profile) {
                            //pr($if_exist_looking_profile);die;
                            //echo ""
                            $physical = $this->percentage($if_exist_looking_profile['UserLooksex']['his_physical_appearance'], $value['UserLooksex']['my_physical_appearance']);
                            $sextual = $this->percentage($if_exist_looking_profile['UserLooksex']['his_sextual_preferences'], $value['UserLooksex']['my_sextual_preferences']);
                            $social_habits = $this->percentage($if_exist_looking_profile['UserLooksex']['his_social_habits'], $value['UserLooksex']['my_social_habits']);
                            $identity = $this->percentage($login_user[0]['Profile']['his_identitie'], $value['Profile']['identity']);
                            $overall_per_sum = ($physical + $sextual + $social_habits + $identity);
                            if ($overall_per_sum > 0) {
                                $overall_percentage = round(($overall_per_sum * 100) / 400);
                            } else {
                                $overall_percentage = 0;
                            }

                            //echo $overall_percentage;die;
                        } else {
                            $overall_percentage = 0;
                        }

                        $user_data[$key]['User']['percentage'] = $overall_percentage;
                        unset($user_data[$key]['UserLooksex']);
                        //pr($user_data);die;
                        /*                         * **End*********** */
                    }
                    if ($match) {
                        //$match="desc";
                        $user_data = Set::sort($user_data, '{n}.User.distance', $match);
                        $user_data = Set::sort($user_data, '{n}.User.percentage', $match);
                    } else {
                        $user_data = Set::sort($user_data, '{n}.User.distance', 'asc');
                    }
                }
                /*                 * ********End*********** */
                //***************for filter chache**********//
                $if_exist_save_filter = $this->MatchesFilterValue->find('first', array('conditions' => array(
                        'MatchesFilterValue.user_id ' => $user_id,
                        'MatchesFilterValue.type ' => 'looking'
                )));
                if ($if_exist_save_filter) {
                    $filter_cache = $if_exist_save_filter['MatchesFilterValue'];
                }
            } else if ($type == 'dating') {
                /*                 * *******dating matches filter************ */
                $options['fields'] = array('User.*', '( 6371 * acos( cos( radians("' . $login_user_lat . '") ) * cos( radians( lat ) ) * cos( radians( `long` ) - radians("' . $login_user_long . '") ) + sin( radians("' . $login_user_lat . '") ) * sin( radians( lat ) ) ) ) AS database_distance', 'Profile.*', 'UserPartner.*', 'ChatUser.*', 'UserLookdate.*');
                /*                 * *******userlook date profile ************* */
                $if_exist_lookdate_profile = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id =' => $user_id)));
                /*                 * ********End************** */
                $options['joins'] = array(
                    array('table' => 'users',
                        'alias' => 'User',
                        'type' => 'Left',
                        'conditions' => array(
                            'User.id = UserLookdate.user_id',
                        )
                    ),
                    array('table' => 'profiles',
                        'alias' => 'Profile',
                        'type' => 'Left',
                        'conditions' => array(
                            'Profile.user_id = UserLookdate.user_id',
                        )
                    ),
                    array('table' => 'user_partners',
                        'alias' => 'UserPartner',
                        'type' => 'Left',
                        'conditions' => array(
                            'UserPartner.user_id = UserLookdate.user_id',
                        )
                    ),
                    array('table' => 'chat_users',
                        'alias' => 'ChatUser',
                        'type' => 'Left',
                        'conditions' => array(
                            'ChatUser.user_id = UserLookdate.user_id',
                            'AND' => array(
                                array('ChatUser.chat_user_id' => $user_id),
                            )
                        )
                ));
                $user_data = $this->UserLookdate->find('all', $options);
                //pr($user_data);die;
                $total_unread_message = 0;
                if ($user_data) {
                    foreach ($user_data as $key => $value) {
                        unset($user_data[$key][0]);
                        $user_data[$key]['User']['distance'] = $this->distance($login_user_lat, $login_user_long, $value['User']['lat'], $value['User']['long'], 'M');
                        $user_data[$key]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value['User']['id']);
                        /*                         * *****count unread message ********* */
                        if ($value['ChatUser']['invite'] > 0) {
                            $invite = 1;
                        } else {
                            $invite = 0;
                        }
                        $total_unread_message+=($value['ChatUser']['count'] + $invite);
                        /*                         * **********End************ */
                        /*                         * ******percentage count for sorting******** */
                        if ($if_exist_lookdate_profile) {
                            //echo ""
                            $traits = $this->percentage($if_exist_lookdate_profile['UserLookdate']['his_traits'], $value['UserLookdate']['my_traits']);
                            $interest = $this->percentage($if_exist_lookdate_profile['UserLookdate']['my_interest'], $value['UserLookdate']['my_interest']);
                            $physical = $this->percentage($if_exist_lookdate_profile['UserLookdate']['his_physical_appearance'], $value['UserLookdate']['my_physical_appearance']);
                            $sextual = $this->percentage($if_exist_lookdate_profile['UserLookdate']['his_sextual_preferences'], $value['UserLookdate']['my_sextual_preferences']);
                            $social_habits = $this->percentage($if_exist_lookdate_profile['UserLookdate']['his_social_habits'], $value['UserLookdate']['my_social_habits']);
                            $identity = $this->percentage($login_user[0]['Profile']['his_identitie'], $value['Profile']['identity']);
                            $overall_per_sum = ($traits + $interest + $physical + $sextual + $social_habits + $identity);
                            if ($overall_per_sum > 0) {
                                $overall_percentage = round(($overall_per_sum * 100) / 600);
                            } else {
                                $overall_percentage = 0;
                            }

                            //echo $overall_percentage;die;
                        } else {
                            $overall_percentage = 0;
                        }

                        $user_data[$key]['User']['percentage'] = $overall_percentage;
                        unset($user_data[$key]['UserLookdate']);
                        /*                         * **End*********** */
                    }
                    if ($match) {
                        //$match="desc";
                        $user_data = Set::sort($user_data, '{n}.User.distance', $match);
                        $user_data = Set::sort($user_data, '{n}.User.percentage', $match);
                    } else {
                        $user_data = Set::sort($user_data, '{n}.User.distance', 'asc');
                    }
                }
                //***************for filter chache**********//
                $if_exist_save_filter = $this->MatchesFilterValue->find('first', array('conditions' => array(
                        'MatchesFilterValue.user_id ' => $user_id,
                        'MatchesFilterValue.type ' => 'dating'
                )));
                if ($if_exist_save_filter) {
                    $filter_cache = $if_exist_save_filter['MatchesFilterValue'];
                }
            } else {
                /*                 * *******browse filter********* */
                $options['fields'] = array('User.*', '( 6371 * acos( cos( radians("' . $login_user_lat . '") ) * cos( radians( lat ) ) * cos( radians( `long` ) - radians("' . $login_user_long . '") ) + sin( radians("' . $login_user_lat . '") ) * sin( radians( lat ) ) ) ) AS database_distance', 'Profile.*', 'UserPartner.*', 'ChatUser.*');
                $options['joins'] = array(
                    array('table' => 'chat_users',
                        'alias' => 'ChatUser',
                        'type' => 'Left',
                        'conditions' => array(
                            'ChatUser.user_id = User.id',
                            'AND' => array(
                                array('ChatUser.chat_user_id' => $user_id),
                            )
                        )
                ));
                $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
                $user_data = $this->User->find('all', $options);
                //pr($options);die;
                //pr($this->User->getDataSource()->getLog()); die();
                $total_unread_message = 0;
                if ($user_data) {
                    foreach ($user_data as $key => $value) {
                        unset($user_data[$key][0]);
                        $user_data[$key]['User']['distance'] = $this->distance($login_user_lat, $login_user_long, $value['User']['lat'], $value['User']['long'], 'M');
                        $user_data[$key]['User']['looking_profile_active'] = $this->check_profile_active($current_date, $value['User']['id']);
                        /*                         * *****count unread message ********* */
                        if ($value['ChatUser']['invite'] > 0) {
                            $invite = 1;
                        } else {
                            $invite = 0;
                        }
                        $total_unread_message+=($value['ChatUser']['count'] + $invite);
                        /*                         * **********End************ */
                    }
                    $user_data = Set::sort($user_data, '{n}.User.distance', 'asc');
                }
                //***************for filter chache**********//
                $if_exist_save_filter = $this->MatchesFilterValue->find('first', array('conditions' => array(
                        'MatchesFilterValue.user_id ' => $user_id,
                        'MatchesFilterValue.type ' => 'browse'
                )));
                if ($if_exist_save_filter) {
                    $filter_cache = $if_exist_save_filter['MatchesFilterValue'];
                }
            }

            //$all_user_data = array_merge($login_user, $user_data);
            $all_user_data = $user_data;
            /*             * ******check any one view my profile******** */
            $is_view = $this->check_view($user_id);
            /*             * ******End********* */
            /*             * ******check any one share album with me******** */
            $is_share = $this->check_sharealbum($user_id);
            /*             * ******End********* */
            /*             * ******count total user view my profile******** */
            $count_view = $this->count_view($user_id);
            /*             * ******End********* */
            /*             * ******count total user share album with me******** */
            $count_sharealbum = $this->count_sharealbum($user_id);
            $total_view_and_share = $count_view + $count_sharealbum;
            /*             * ******End********* */
            /*             * *****check profile active ********* */
            $is_profile_active = $this->check_profile_active($current_date, $user_id);
            //echo $is_profile_active;die;
            /*             * ********END***************** */
            /*             * ******for give user looksex data******** */
            $user_looksex = $this->UserLooksex->find('first', array('conditions' => array(
                    'and' => array(
                        array(
                            'UserLooksex.user_id ' => $user_id,
                            'UserLooksex.start_time <=' => $current_date,
                            'UserLooksex.end_time >=' => $current_date
                        )
                    )
            )));
            //pr($user_looksex);
            if ($user_looksex) {
                $data['userlooksex_data'] = $user_looksex['UserLooksex'];
            }
            /*             * **********END**************** */
            /*             * ********check filter for bear bear chaser ********** */
            if ($his_identitie && $his_identitie != 'Not Set') {

                $results = array();
                $his_identitie_value = explode(',', $his_identitie);
                //pr($his_identitie_value);
                $identity_total = Hash::extract($all_user_data, '{n}.Profile.identity');
                if ($identity_total) {
                    foreach ($identity_total as $key => $value) {
                        $identity_value = explode(',', $value);
                        $match_identity = array_intersect($his_identitie_value, $identity_value);
                        //pr($identity_value);
                        //pr($match_identity);
                        if (count($match_identity) > 0) {
                            $results[] = $all_user_data[$key];
                        }
                    }
                }

                //die;
                unset($all_user_data);
                $all_user_data = array();
                $all_user_data = $results;
                //$all_user_data=array_slice($results, 0, $limit);
                //pr($all_user_data);die;
                // echo $value;
                //echo $identity_total[0];die;
                //pr($identity_total);die;
                //die;
            }
            /*             * *********END************* */
            if ($his_seeking && $his_seeking != 'Not Set') {
                $results1 = array();
                $his_seeking_value = explode(',', $his_seeking);
                //pr($his_identitie_value);
                $his_seeking_total = Hash::extract($all_user_data, '{n}.Profile.his_identitie');
                //pr($his_seeking_total);
                if ($his_seeking_total) {
                    foreach ($his_seeking_total as $key => $value) {
                        $identity_value = explode(',', $value);
                        $match_identity = array_intersect($his_seeking_value, $identity_value);
                        //pr($identity_value);
                        //pr($match_identity);
                        if (count($match_identity) > 0) {
                            $results1[] = $all_user_data[$key];
                        }
                    }
                }

                //die;
                unset($all_user_data);
                $all_user_data = array();
                $all_user_data = $results1;

                // pr($all_user_data);die;
                // echo $value;
                //echo $identity_total[0];die;
                //pr($identity_total);die;
                //die;
            }
            if (($his_seeking && $his_seeking != 'Not Set') || ($his_identitie && $his_identitie != 'Not Set')) {
                $all_user_data = array_slice($all_user_data, 0, $limit);
            }

            if ($all_user_data) {
                //$match_login_uerr=array_intersect_assoc($all_user_data,$login_user);
                //pr($match_login_uerr);
                //if()
                //********for login user top****//
                $total_user_id = Hash::extract($all_user_data, '{n}.User.id');
                $login_first = array_intersect($total_user_id, array($user_id));
                $login_user_first = array();
                if ($login_first) {
                    $login_user_first[] = $all_user_data[key($login_first)];
                    $final = array_merge($login_user_first, $all_user_data);
                    $all_user_data = array_merge(array_unique($final, SORT_REGULAR));
                }


                //pr($login_user_first);
                //pr($all_user_data);die;
                /*                 * *****get the max accuricy number ******* */
                $accuracy_value = Hash::extract($all_user_data, '{n}.User.accuracy');
                $accuracy_max_value = (int) max($accuracy_value);
                /*                 * **********END*************** */
                $data['success'] = 1;
                $data['msg'] = 'success';
                $data['is_share_album'] = $is_share;
                $data['is_viewed'] = $is_view;
                $data['total_view_and_share'] = $total_view_and_share;
                $data['total_unread_message'] = $total_unread_message;
                $data['user_looking_profile_active'] = $is_profile_active;
                $data['accuracy'] = $accuracy_max_value;
                $data['login_user_member_type'] = $login_user_member_type;
                $data['login_user_removead'] = $login_user_removead;
                $data['login_user_is_trial'] = $login_user_is_trial;
                $data['filter_cache'] = $filter_cache;
                $data['data'] = $all_user_data;
                $data['path'] = PIC_PATH;
            } else {
                $data['success'] = 2;
                $data['login_user_member_type'] = $login_user_member_type;
                $data['login_user_removead'] = $login_user_removead;
                $data['login_user_is_trial'] = $login_user_is_trial;
                $data['msg'] = 'no record found';
                $data['user_looking_profile_active'] = $is_profile_active;
                $data['filter_cache'] = $filter_cache;
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id or current_date should not blank';
        }

        //pr($data);die;
        //pr($this->User->getDataSource()->getLog()); die();
        echo json_encode($data);
    }

    /*     * *********************END***************************************** */
    /*     * ***********clear_all_message 24-08-2015**************** */

    public function clear_all_message() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        //$current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        //$type = isset($this->request->data['type']) ? $this->request->data['type'] : ''; //track which page user come  looking sex or dating or Browse page
        if ($user_id) {
            $this->ChatUser->deleteAll(array('ChatUser.chat_user_id' => $user_id));
            $data['success'] = 1;
            $data['msg'] = 'successfully clear messages';
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id  should not blank';
        }
        echo json_encode($data);
    }

    /*     * **********END***************** */
    /*     * ***********clear_all_message 24-08-2015**************** */

    public function stop_current_search() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $profile_id = isset($this->request->data['id']) ? $this->request->data['id'] : ''; //looksex profile id
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        //$type = isset($this->request->data['type']) ? $this->request->data['type'] : ''; //track which page user come  looking sex or dating or Browse page
        if ($user_id && $profile_id && $current_date) {
            $if_exist_profile = $this->UserLooksex->find('first', array('conditions' => array(
                    'UserLooksex.user_id ' => $user_id,
                    'UserLooksex.id ' => $profile_id,
            )));
            if (count($if_exist_profile) > 0) {
                $this->UserLooksex->id = $profile_id;
                //$end_time=date_create($current_date);
                $newTime = date("Y-m-d H:i:s", strtotime($current_date . " -1 minutes"));
                if ($this->UserLooksex->saveField('end_time', $newTime)) {
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                } else {
                    $data['success'] = 2;
                    $data['msg'] = 'unable to update';
                }
            } else {
                $data['success'] = 3;
                $data['msg'] = 'profile not exists';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id profile id and current date  should not blank';
        }
        echo json_encode($data);
    }

    /*     * **********END***************** */
    /*     * ***********clear_all_message 24-08-2015**************** */

    public function save_filter_cache() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        $type = isset($this->request->data['type']) ? $this->request->data['type'] : ''; //track which page user come  looking  or dating or Browse page
        $enable_filters = isset($this->request->data['enable_filters']) ? $this->request->data['enable_filters'] : '';
        $online = isset($this->request->data['online']) ? $this->request->data['online'] : '';
        $match = isset($this->request->data['match']) ? $this->request->data['match'] : '';
        $user_photos = isset($this->request->data['user_photos']) ? $this->request->data['user_photos'] : '';
        $his_identities = isset($this->request->data['his_identities']) ? $this->request->data['his_identities'] : '';
        $his_seeking = isset($this->request->data['his_seeking']) ? $this->request->data['his_seeking'] : '';
        $ethnicity = isset($this->request->data['ethnicity']) ? $this->request->data['ethnicity'] : '';
        $relationship_status = isset($this->request->data['relationship_status']) ? $this->request->data['relationship_status'] : '';
        $age = isset($this->request->data['age']) ? $this->request->data['age'] : '';
        //$age_from = isset($this->request->data['age_from']) ? $this->request->data['age_from'] : '';
        $height = isset($this->request->data['height']) ? $this->request->data['height'] : '';
        //$height_cm_from = isset($this->request->data['height_cm_from']) ? $this->request->data['height_cm_from'] : '';
        $weight = isset($this->request->data['weight']) ? $this->request->data['weight'] : '';
        $list_array = isset($this->request->data['list_array']) ? $this->request->data['list_array'] : '';
        //$weight_kg_from = isset($this->request->data['weight_kg_from']) ? $this->request->data['weight_kg_from'] : '';
        if ($user_id && $current_date && $type) {
            $if_exist_save_filter = $this->MatchesFilterValue->find('first', array('conditions' => array(
                    'MatchesFilterValue.user_id ' => $user_id,
                    'MatchesFilterValue.type ' => $type,
            )));
            if (count($if_exist_save_filter) > 0) {
                $this->MatchesFilterValue->id = $if_exist_save_filter['MatchesFilterValue']['id'];
                $filterdata['MatchesFilterValue']['user_id'] = $user_id;
                $filterdata['MatchesFilterValue']['enable_filters'] = $enable_filters;
                $filterdata['MatchesFilterValue']['online'] = $online;
                $filterdata['MatchesFilterValue']['match'] = $match;
                $filterdata['MatchesFilterValue']['user_photos'] = $user_photos;
                $filterdata['MatchesFilterValue']['his_identities'] = $his_identities;
                $filterdata['MatchesFilterValue']['his_seeking'] = $his_seeking;
                $filterdata['MatchesFilterValue']['ethnicity'] = $ethnicity;
                $filterdata['MatchesFilterValue']['relationship_status'] = $relationship_status;
                $filterdata['MatchesFilterValue']['age'] = $age;
                // $filterdata['MatchesFilterValue']['age_from'] = $age_from;
                $filterdata['MatchesFilterValue']['height'] = $height;
                // $filterdata['MatchesFilterValue']['height_cm_from'] = $height_cm_to;
                $filterdata['MatchesFilterValue']['weight'] = $weight;
                //$filterdata['MatchesFilterValue']['weight_kg_from'] = $weight_kg_from;
                $filterdata['MatchesFilterValue']['type'] = $type;
                $filterdata['MatchesFilterValue']['list_array'] = $list_array;
                $filterdata['MatchesFilterValue']['creation_date'] = $current_date;
                //pr($filterdata);
                if ($this->MatchesFilterValue->save($filterdata)) {
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                    $data['type'] = $type;
                } else {
                    $data['success'] = 2;
                    $data['msg'] = 'unable to update';
                }
            } else {
                $filterdata['MatchesFilterValue']['user_id'] = $user_id;
                $filterdata['MatchesFilterValue']['enable_filters'] = $enable_filters;
                $filterdata['MatchesFilterValue']['online'] = $online;
                $filterdata['MatchesFilterValue']['match'] = $match;
                $filterdata['MatchesFilterValue']['user_photos'] = $user_photos;
                $filterdata['MatchesFilterValue']['his_identities'] = $his_identities;
                $filterdata['MatchesFilterValue']['his_seeking'] = $his_seeking;
                $filterdata['MatchesFilterValue']['ethnicity'] = $ethnicity;
                $filterdata['MatchesFilterValue']['relationship_status'] = $relationship_status;
                $filterdata['MatchesFilterValue']['age'] = $age;
                // $filterdata['MatchesFilterValue']['age_from'] = $age_from;
                $filterdata['MatchesFilterValue']['height'] = $height;
                // $filterdata['MatchesFilterValue']['height_cm_from'] = $height_cm_to;
                $filterdata['MatchesFilterValue']['weight'] = $weight;
                //$filterdata['MatchesFilterValue']['weight_kg_from'] = $weight_kg_from;
                $filterdata['MatchesFilterValue']['type'] = $type;
                $filterdata['MatchesFilterValue']['list_array'] = $list_array;
                $filterdata['MatchesFilterValue']['creation_date'] = $current_date;
                //pr($filterdata);
                if ($this->MatchesFilterValue->save($filterdata)) {
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                } else {
                    $data['success'] = 2;
                    $data['msg'] = 'unable to update';
                }
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id  and current date type  should not blank';
        }
        echo json_encode($data);
    }

    /*     * **********END***************** */
    /*     * ***********  Braintree  ********* */

    public function braintreeConfiguration() {
        $this->autoRender = false;
        /*
          Braintree_Configuration::environment('sandbox');
          Braintree_Configuration::merchantId('jm9jkfschbbmbhjj');
          Braintree_Configuration::publicKey('ntnkm9xhpddycwbz');
          Braintree_Configuration::privateKey('6bd559c2cf1519eca65e82af52799d6b');
         */
        /* suva Sandbox Account Details */

        Braintree_Configuration::environment('sandbox');
        Braintree_Configuration::merchantId('xryfqpq6j3d3s9mm');
        Braintree_Configuration::publicKey('52dsgsybqwq3chzt');
        Braintree_Configuration::privateKey('7951a62a8d0452acf2d5231d450751f2');
    }

    public function clientTokenGeneration() {
        $this->autoRender = false;
        //$clientToken='66334126';
        $this->braintreeConfiguration();
        //$aCustomerId ='88278163';
        //$aCustomerId ='14422459'; // can be generated from braintreegateway.com vault->New Customer
        $aCustomerId = '';
        $clientToken = Braintree_ClientToken::generate(array(
                    "customerId" => $aCustomerId
        )); //14422459 Mir customer Id
        if ($clientToken) {
            $json_msg = array('success' => 1, 'msg' => 'Get Client Token.', 'clientToken' => $clientToken);
        } else {
            $json_msg = array('success' => 0, 'msg' => 'Unable to create');
        }
        echo json_encode($json_msg);
        exit;
    }

    public function paymentCheckout() {
        $this->autoRender = false;
        $this->braintreeConfiguration(); /* Braintree configuration details */
        //$device_id = isset($this->request->data['device_id'])?trim($this->request->data['device_id']):"";
        $user_id = isset($this->request->data['user_id']) ? trim($this->request->data['user_id']) : "";
        $nonce = isset($this->request->data['payment_method_nonce']) ? trim($this->request->data['payment_method_nonce']) : ""; //The nonce is   792ccbb8-068e-44a7-9031-c62a491a6de8
        $subscription_id = isset($this->request->data['subscription_id']) ? trim($this->request->data['subscription_id']) : "";
        //$removead_id = isset($this->request->data['removead_id'])?trim($this->request->data['removead_id']):"";
        $payment_for = isset($this->request->data['payment_for']) ? trim($this->request->data['payment_for']) : ""; //Payment for subscription or remove add(1=>subscription 2=>removeadd)
        //$amount = isset($this->request->data['amount'])?trim($this->request->data['amount']):"";
        //$data = isset($this->request->data['all_data'])?trim($this->request->data['all_data']):"";
        $error_status = 0;
        if ($user_id == '') {
            $json_msg = array('success' => 2, 'msg' => 'Not a valid user.Please login again.');
            echo json_encode($json_msg);
            $error_status = 1;
            exit;
        } else if ($nonce == '') {
            $json_msg = array('success' => 2, 'msg' => 'Please Mention Nonce Token.');
            echo json_encode($json_msg);
            $error_status = 1;
            exit;
        } else if ($payment_for == '') {
            $json_msg = array('success' => 2, 'msg' => 'Payment for should not be blank.');
            echo json_encode($json_msg);
            $error_status = 1;
            exit;
        }

        // echo ($user_type);exit();
        if (isset($user_id)) {
            //$amount=0;
            //echo date_default_timezone_get();die;
            if ($payment_for == 1) {
                $subscriptions = $this->Subscription->find('first', array('conditions' => array('Subscription.id' => $subscription_id)));
                if ($subscriptions) {
                    $amount = $subscriptions['Subscription']['price'];
                    $month = $subscriptions['Subscription']['month'];
                    $valid_upto = date('Y-m-d', strtotime('+' . $month . 'month', strtotime(date('Y-m-d'))));
                } else {
                    $json_msg = array('success' => 2, 'msg' => 'Subscription Id dose not valid.');
                    echo json_encode($json_msg);
                    $error_status = 1;
                    exit;
                }
            } else if ($payment_for == 2) {
                $removeads = $this->RemoveAd->find('first', array('conditions' => array('RemoveAd.id' => $subscription_id)));
                if ($removeads) {
                    $amount = $removeads['RemoveAd']['price'];
                    $month = $removeads['RemoveAd']['month'];
                    $valid_upto = date('Y-m-d', strtotime('+' . $month . 'month', strtotime(date('Y-m-d'))));
                } else {
                    $json_msg = array('success' => 2, 'msg' => 'RemoveAd Id dose not valid.');
                    echo json_encode($json_msg);
                    $error_status = 1;
                    exit;
                }
            } else {
                $json_msg = array('success' => 2, 'msg' => 'RemoveAd Id does not valid.');
                echo json_encode($json_msg);
                $error_status = 1;
                exit;
            }

            $n_user_status = $this->User->find('count', array('conditions' => array('User.id' => $user_id, 'User.status' => 1)));

            if ($n_user_status == 0) {
                $json_msg = array('success' => 2, 'msg' => 'Your account is not activated yet or you are blocked by admin.');
                echo json_encode($json_msg);
                $error_status = 1;
                exit;
            } else {
                $n_user = $this->User->find('first', array('conditions' => array('User.id' => $user_id, 'User.status' => 1)));
                $email = $n_user['User']['email'];
                //$this->User->updateAll(array('User.paypal_status'=>1),array('User.id'=>$user_id));
                // $first_name   = $n_user['User']['first_name'];  
                //$last_name    = $n_user['User']['last_name'];
                //echo $first_name.' - '.$last_name;

                $result = Braintree_Transaction::sale(array(
                            "amount" => $amount,
                            'paymentMethodNonce' => $nonce,
                            'customer' => array(
                                'id' => $user_id,
                                // 'firstName' => $first_name,
                                // 'lastName' => $last_name,
                                'email' => $email
                            ),
                            'options' => array(
                                'submitForSettlement' => true
                            )
                ));

                //echo '<pre>'. pr($result).'</pre>'.'<br/>success= '.$result->success.'<br/>transaction_id = '.$result->transaction->_attributes['id'];
                if (!empty($result)) {
                    if ($result->success) { // success status sent from brain tree card payment.
                        //@mail('sumitra.unified@gmail.com','success','ranjita.unified@gmail.com');
                        $data_to_be_saved['Transaction']['user_id'] = $user_id;
                        $data_to_be_saved['Transaction']['nonce'] = $nonce;
                        $data_to_be_saved['Transaction']['transaction_id'] = $result->transaction->_attributes['id'];
                        $data_to_be_saved['Transaction']['payment_status'] = $result->transaction->_attributes['status'];
                        $data_to_be_saved['Transaction']['payment_type'] = $result->transaction->_attributes['type'];
                        $data_to_be_saved['Transaction']['amount'] = $result->transaction->_attributes['amount'];
                        $data_to_be_saved['Transaction']['currency'] = $result->transaction->_attributes['currencyIsoCode'];
                        $data_to_be_saved['Transaction']['merchant_acc_id'] = $result->transaction->_attributes['merchantAccountId'];
                        //$data_to_be_saved['Transaction']['customer_first_name'] = $result->transaction->_attributes['customer']['firstName'];
                        //$data_to_be_saved['Transaction']['customer_last_name']  = $result->transaction->_attributes['customer']['lastName'];
                        $data_to_be_saved['Transaction']['customer_email'] = $result->transaction->_attributes['customer']['email'];
                        $data_to_be_saved['Transaction']['card_type'] = $result->transaction->_attributes['creditCard']['cardType'];
                        $data_to_be_saved['Transaction']['last4_digit'] = $result->transaction->_attributes['creditCard']['last4'];
                        $data_to_be_saved['Transaction']['exp_month'] = $result->transaction->_attributes['creditCard']['expirationMonth'];
                        $data_to_be_saved['Transaction']['exp_year'] = $result->transaction->_attributes['creditCard']['expirationYear'];
                        $data_to_be_saved['Transaction']['payment_for'] = $payment_for;
                        $data_to_be_saved['Transaction']['created_date'] = date('Y-m-d h:i:s');

                        if ($this->Transaction->save($data_to_be_saved)) {
                            // {@mail('sumitra.unified@gmail.com','save','ranjita.unified@gmail.com');
                            if ($payment_for == 1) {
                                $this->User->updateAll(array('User.member_type' => 1, 'User.valid_upto' => "'" . $valid_upto . "'"), array('User.id' => $user_id));
                            } else {
                                $this->User->updateAll(array('User.removead' => 1, 'User.removead_valid_upto' => "'" . $valid_upto . "'"), array('User.id' => $user_id));
                            }
                        }
                        /*                         * *****************  File(Cirtificate images) updated to the database End *************** */
                        //if(!empty($data) && $data!="")
                        //{
                        //    $data_arr = explode(',',$data);
                        //    $update_err = 0;
                        //    foreach($data_arr as $each_data)
                        //    {
                        //    if(!empty($each_data)){
                        //        $each_data_arr = explode('-',$each_data); //'tutor_degrees_id-tutor_degrees-image_name' or 'tutor_courses_id-tutor_courses-image_name'
                        //        if($each_data_arr[1]=='tutor_degrees')
                        //        {
                        //         if(copy($srcPath.$each_data_arr[2],$degree_destPath.$each_data_arr[2]))
                        //         {
                        //             $this->TutorDegree->updateAll(array('TutorDegree.photo'=>"'".$each_data_arr[2]."'"),array('TutorDegree.id'=>$each_data_arr[0]));
                        //             //pr($this->TutorDegree->getDataSource()->getLog(TRUE)); exit;
                        //             $update_err =1;
                        //             
                        //         }
                        //        }
                        //        else if($each_data_arr[1]=='tutor_courses')
                        //        {
                        //         if(copy($srcPath.$each_data_arr[2],$course_destPath.$each_data_arr[2]))
                        //         {
                        //             //echo $each_data_arr[1]."upload"; exit;
                        //             $this->TutorCourse->updateAll(array('TutorCourse.photo'=>"'".$each_data_arr[2]."'"),array('TutorCourse.id'=>$each_data_arr[0]));
                        //             //pr($this->TutorCourse->getDataSource()->getLog(TRUE)); exit;
                        //             $update_err =1;
                        //         }
                        //        }
                        //    }
                        //       
                        //    }
                        //    
                        //}
                        //$cmd = "wget -bq --spider ".BASE_URL."services/send_upload_mail?user_id=".$user_id;
                        //shell_exec(escapeshellcmd($cmd));
                        //    $admin_user = $this->User->find('first', array('conditions' => array('User.id'=>1)));
                        //    $mail_msg="<div style='width:80%;'><img src='".BASE_URL."img/coed_logo.jpeg'>
                        //      <br/>
                        //      Hello ".$admin_user['User']['first_name'].' '.$admin_user['User']['last_name']." ,
                        //      <br/>
                        //        <p>".$n_user['User']['first_name'].' '.$n_user['User']['last_name']." has requested himself as a tutor and requested to verify his profile.Please login to admin to verify the credentials.</p>
                        //      <p>Warmest Regards,<p/>
                        //      <p>TutorApp Team<p/>
                        //      </div>";
                        //  //pr($admin_user); exit;    
                        //    $Email = new CakeEmail();
                        //    $Email->from(array(site_mail_id => 'TutorApp'));
                        //    $Email->to($admin_user['User']['email_id']);
                        //    $Email->subject('TutorApp Tutor Degree-Course Verification');
                        //    $Email->emailFormat('html');
                        //    $Email->send($mail_msg);
                        //    @mail('sumitra.unified@gmail.com','mail gone','ranjita.unified@gmail.com');
                        /*                         * ****************** File(Cirtificate images) updated to the database End ******************** */
                        $json_msg = array('success' => 1, 'msg' => 'Payment successfully completed.', 'data' => $result);
                        echo json_encode($json_msg);
                        exit;
                        //}
                    } else {
                        $json_msg = array('success' => 0, 'msg' => $result->message, 'data' => $result);
                        echo json_encode($json_msg);
                        exit;
                    }
                } else {
                    $json_msg = array('success' => 0, 'msg' => 'Payment status failed.');
                    echo json_encode($json_msg);
                    exit;
                }
            } /* Else end active by admin */
        }/* If End Device Id set */ else {
            $json_msg = array('success' => 0, 'msg' => 'Invalid login credentials');
            echo json_encode($json_msg);
            exit;
        }
    }

    /*     * *******payment page ********** */

    public function payment_details() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id) {
            $login_user = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
            $subscriptions = $this->Subscription->find('all', array('order' => array('Subscription.month asc')));
            if ($subscriptions) {
                $subscriptions_arr = Hash::extract($subscriptions, '{n}.Subscription');
                ;
            } else {
                $subscriptions_arr = array();
            }
            $removeads = $this->RemoveAd->find('all', array('order' => array('RemoveAd.month asc')));
            if ($removeads) {
                $removeads_arr = Hash::extract($removeads, '{n}.RemoveAd');
                ;
            } else {
                $removeads_arr = array();
            }
            $data['success'] = 1;
            $data['msg'] = 'success';
            $data['server_time_zone'] = date_default_timezone_get();
            $data['subscription'] = $subscriptions_arr;
            $data['removeads'] = $removeads_arr;
            $data['login_user'] = $login_user;
            //$data['path'] = PIC_PATH;
            //$data['data'] = $login_user;
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id not found';
        }
        echo json_encode($data);
    }

    //========payment success for inapp purchase=======//
    public function payment_success() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? trim($this->request->data['user_id']) : "";
        $payment_for = isset($this->request->data['payment_for']) ? trim($this->request->data['payment_for']) : ""; //Payment for subscription or remove add(1=>subscription 2=>removeadd)
        $amount = isset($this->request->data['amount']) ? trim($this->request->data['amount']) : "";
        $month = isset($this->request->data['month']) ? trim($this->request->data['month']) : ""; //pay for how many month 
        //$data = isset($this->request->data['all_data'])?trim($this->request->data['all_data']):"";
        if ($user_id == '') {
            $json_msg = array('success' => 0, 'msg' => 'Not a valid user.Please login again.');
            echo json_encode($json_msg);
            exit;
        } else if ($amount == '') {
            $json_msg = array('success' => 0, 'msg' => 'Amount should not be blank.');
            echo json_encode($json_msg);
            exit;
        } else if ($payment_for == '') {
            $json_msg = array('success' => 0, 'msg' => 'Payment for should not be blank.');
            echo json_encode($json_msg);
            exit;
        } else if ($month == '') {
            $json_msg = array('success' => 0, 'msg' => 'Month should not be blank.');
            echo json_encode($json_msg);
            exit;
        }
        $login_user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
        if (date('Y-m-d', strtotime($login_user['User']['valid_upto'])) > date('Y-m-d')) {
            $valid_upto = date('Y-m-d', strtotime('+' . $month . 'month', strtotime($login_user['User']['valid_upto'])));
        } else {
            $valid_upto = date('Y-m-d', strtotime('+' . $month . 'month', strtotime(date('Y-m-d'))));
        }
        if ($payment_for == 1) {
            $this->User->updateAll(array('User.is_trial' => 0, 'User.member_type' => 1, 'User.valid_upto' => "'" . $valid_upto . "'"), array('User.id' => $user_id));
        } else {
            $this->User->updateAll(array('User.removead' => 1, 'User.removead_valid_upto' => "'" . $valid_upto . "'"), array('User.id' => $user_id));
        }
        $json_msg = array('success' => 1, 'msg' => 'Payment successfully completed.', 'valid_upto' => date('Y-m-d H:i:s', strtotime($valid_upto)));
        echo json_encode($json_msg);
        exit;
    }

    /*     * *******setting page ********** */

    public function setting() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id) {
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $login_user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $count_view = $this->count_view($user_id);
            $count_sharealbum = $this->count_sharealbum($user_id);
            $data['success'] = 1;
            $data['msg'] = 'success';
            $data['count_view'] = $count_view;
            $data['count_album'] = $count_sharealbum;
            $data['path'] = PIC_PATH;
            $data['data'] = $login_user;
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id not found';
        }
        echo json_encode($data);
    }

    /*     * ********** for count total user view my profile *********** */

    public function count_view($user_id) {
        $this->autoRender = false;
        if ($user_id) {
            $option['conditions'] = array('Viewer.viewer_user_id' => $user_id, 'Viewer.is_view' => 1);
            $views = $this->Viewer->find('count', $option);
            return $views;
        }
    }

    /*     * ********** for count total user share his album *********** */

    public function count_sharealbum($user_id) {
        $this->autoRender = false;
        if ($user_id) {
            $option['conditions'] = array('ShareAlbum.receiver_id' => $user_id, 'ShareAlbum.is_view' => 1);
            $views = $this->ShareAlbum->find('count', $option);
            return $views;
        }
    }

    /*     * ***** for match_limit $member_type means free or paid 0=>free 1=> paid* $limit_type means which section limit like match massage******** */

    public function match_limit($member_type, $limit_type) {
        $this->autoRender = false;
        $match_limit = $this->UserRestriction->find('first', array('conditions' => array('UserRestriction.limit_type' => $limit_type, 'UserRestriction.member_type' => $member_type,)));
        if ($match_limit) {
            $limit = $match_limit['UserRestriction']['limit'];
        } else {
            $limit = 0;
        }
        //echo $member_type;die;
        return $limit;
    }

    /*     * *****END********** */

    public function verify_apple_purchase() {
        $this->autoRender = false;
        $apple_app_product_id = isset($this->request->data['apple_app_product_id']) ? $this->request->data['apple_app_product_id'] : '';
        $apple_app_bundle_id = isset($this->request->data['apple_app_bundle_id']) ? $this->request->data['apple_app_bundle_id'] : '';
        $purchase_receipt_data = isset($this->request->data['purchase_receipt_data']) ? $this->request->data['purchase_receipt_data'] : '';
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        //echo json_encode(array('user_id'=>$user_id,'apple_app_bundle_id'=>$apple_app_bundle_id,'purchase_receipt_data'=>$purchase_receipt_data,'apple_app_product_id'=>$apple_app_product_id));
        //echo strtotime(date('Y-m-d'));
        //$expire_date_sec=1451650339000/1000;
        //echo $valid_upto=date('Y-m-d H:i:s',$expire_date_sec);
        if ($user_id) {
            //get the endpoint
            // if($this->config_arr['apple_store_is_live']=='y'){
            // $endpoint = $this->config_arr['apple_store_live_url'];
            //}else{
            $endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';
            // }
            $apple_app_bundle_id = $apple_app_bundle_id;
            $apple_app_product_id = $apple_app_product_id;
            //create post data
            $postData = json_encode(
                    array('receipt-data' => $purchase_receipt_data, 'password' => 'a0f6ab9c1ee74e3d9d2cf39642b51a9b')
            );
            //prepare the result array
            $result = array('verified' => false, 'msg' => '');
            //fire request with curl
            $ch = curl_init($endpoint);
            if ($ch === false) {
                return false;
            }
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            // execute the cURL request and fetch response data
            $response = curl_exec($ch);
            curl_close($ch);
            //check for response
            if ($response === false) {
                return false;
            }
            //echo $response;
            //=======insert data into verify receipt log====//
            // $verifydata['VerifyLog']['user_id'] = $user_id;
            //$verifydata['VerifyLog']['json_data'] = $response;
            //$verifydata['VerifyLog']['creation_date'] = date('Y-m-d H:i:s');
            //$this->VerifyLog->save($verifydata);
            // parse the response data
            $data = json_decode($response, true);
            if (isset($data)) {
                if ($data['status'] == 0) {
                    if (isset($data['latest_receipt_info'])) {
                        $keys = array_keys($data['latest_receipt_info']);
                        $lastkey = end($keys);
                        if (isset($data['latest_receipt_info'][$lastkey]['expires_date_ms'])) {
                            $expire_date_sec = $data['latest_receipt_info'][$lastkey]['expires_date_ms'] / 1000;
                            //$valid_upto=date('Y-m-d H:i:s',$expire_date_sec);
                            $valid_upto = date('Y-m-d', $expire_date_sec);
                            $this->User->updateAll(array('User.is_trial' => 0, 'User.member_type' => 1, 'User.valid_upto' => "'" . $valid_upto . "'"), array('User.id' => $user_id));
                        }
                    }
                }
            }
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'user id required', 'latest_receipt' => ''));
        }
    }

    //===For support====//
    public function support() {
        $this->autoRender = false;
        $phone = isset($this->request->data['phone']) ? $this->request->data['phone'] : '';
        $name = isset($this->request->data['name']) ? $this->request->data['name'] : '';
        $details = isset($this->request->data['details']) ? $this->request->data['details'] : '';
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $admin_data = $this->Admin->find('first');
        $admin_email = $admin_data['Admin']['admin_email'];
        if ($phone && $name && $details && $user_id) {
            $userdetails = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            if ($userdetails) {
                $user_email = $userdetails['User']['email'];
            } else {
                $user_email = 'support@gmail.com';
            }
            $email_template = "
            <div style='width:800px;
            margin:0 auto'>
                    <div style='background-color:grey; color:#fff; font-size:30px; padding:15px 0; text-align:center; display:block !important;'>
            Looking App
            </div>
            <div style = 'background-color:#9e9e9e; padding:10px; font-family:Arial, Helvetica, sans-serif; color:#5a3333; font-size:13px; line-height:16px;'>
            <div style = 'background-color:#fff; padding:10px;'>
            <p>
            Hi, " . $admin_data['Admin']['username'] . "</p>
			<p>
			Following is the new support request by user,
			</p>
            <p>
            Phone : " . $phone . "
			</p>
			<p>
            Name : " . $name . "
			</p>
			<p>
            Details : " . $details . "
			</p>
            </div>
            </div>
            <div style = 'background-color:#dbdbdb; border-top:1px solid #9e9e9e; padding:5px 0; text-align:center; font-size:11px; color:#9a7788; font-family:Arial, Helvetica, sans-serif;'>
            copyright text &copy; 2015</div>
            </div>
            <p>
            &nbsp;
            </p>
            ";
            //===For Email Send===//
            $subject = 'Support Request';
            $Email = new CakeEmail();
            $Email->emailFormat('html');
            $Email->from($user_email);
            $Email->to($admin_email);
            $Email->subject($subject);
            $Email->send(html_entity_decode($email_template));

            echo json_encode(array('success' => 1, 'msg' => 'Email successfully sent'));
            exit;
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'phone,name,user_id and details are required'));
            exit;
        }
    }

    //===For my_profile====//
    public function my_profile() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        if ($user_id) {
            $userdetails = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            echo json_encode(array('success' => 1, 'msg' => 'success', 'user_data' => $userdetails, 'path' => PIC_PATH));
            exit;
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'user_id  required'));
            exit;
        }
    }

    //===For edit_profile====//
    public function edit_profile() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        if ($user_id) {
            $start_time = isset($this->request->data['start_time']) ? $this->request->data['start_time'] : '0000-00-00 00:00:00';
            $end_time = isset($this->request->data['end_time']) ? $this->request->data['end_time'] : '0000-00-00 00:00:00';
            $bith_day = isset($this->request->data['birthday']) ? $this->request->data['birthday'] : '0000-00-00 00:00:00';

            $userdata['Profile']['user_id'] = $user_id;
            //$userdata['Profile']['screen_name'] = isset($this->request->data['screen_name']) ? $this->request->data['screen_name'] : '';
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
            $userdata['Profile']['height_cm'] = isset($this->request->data['height_cm']) ? $this->request->data['height_cm'] : '';
            $userdata['Profile']['weight'] = isset($this->request->data['weight']) ? $this->request->data['weight'] : '';
            $userdata['Profile']['Weight_kg'] = isset($this->request->data['Weight_kg']) ? $this->request->data['Weight_kg'] : '';
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
            $profile = $this->Profile->find('first', array('conditions' => array('Profile.user_id' => $user_id)));
            if ($profile) {
                $userdata['Profile']['id'] = $profile['Profile']['id'];
                $this->Profile->save($userdata);
            }

            //======save email and screen name=======//
            $userdataupdate['User']['id'] = $user_id;
            $userdataupdate['User']['screen_name'] = isset($this->request->data['screen_name']) ? $this->request->data['screen_name'] : '';
            $userdataupdate['User']['email'] = isset($this->request->data['email']) ? $this->request->data['email'] : '';
            ;
            /*             * ****** update field for online ******** */
            $this->User->save($userdataupdate);
            if ($profile['Profile']['id'] != $userdata['Profile']['about_me']) {
                $ret = $this->User->updateAll(array('User.profiletext_change ' => 1, 'User.profile_text_change_date' => "'" . $current_date . "'"), array('User.id ' => $user_id));
            }
            echo json_encode(array('success' => 1, 'msg' => 'success'));
            exit;
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'user_id  required'));
            exit;
        }
    }

    //===For edit_profile====//
    public function change_password() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
        if ($user_id && $password) {
            $haspassword = Security::hash($password, null, true);
            $userdetails = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            if ($userdetails) {
                if ($userdetails['User']['password'] == $haspassword) {
                    echo json_encode(array('success' => 3, 'msg' => 'old password and new password same'));
                    exit;
                } else {

                    //======save email and screen name=======//
                    $userdataupdate['User']['id'] = $user_id;
                    $userdataupdate['User']['password'] = $password;
                    /*                     * ****** update field for online ******** */
                    $this->User->save($userdataupdate);
                    echo json_encode(array('success' => 1, 'msg' => 'successfully change password'));
                    exit;
                }
            } else {
                echo json_encode(array('success' => 2, 'msg' => 'invalid user id'));
                exit;
            }
        } else {
            echo json_encode(array('success' => 0, 'msg' => 'user_id and password required'));
            exit;
        }
    }

    //=========blocked user list========//
    public function blocked_user_list() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        /*         * *********END************ */
        if ($user_id) {
            /*             * *********login user details ********* */
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $login_user = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
            $login_user_lat = $login_user[0]['User']['lat'];
            $login_user_long = $login_user[0]['User']['long'];
            $member_type = $login_user[0]['User']['member_type'];
            $removead = $login_user[0]['User']['removead'];
            /*             * ********* get block users************ */
            $get_lock_user_data = $this->BlockedUser->find('all', array('conditions' => array('BlockedUser.user_id' => $user_id), 'order' => array('BlockedUser.block_dt desc')));
            //pr($get_lock_user_data);die;
            $bock_user_id = Hash::extract($get_lock_user_data, '{n}.BlockedUser.blocked_id');
            /*             * *******END************ */
            $this->User->unbindModel(array('hasMany' => array('BlockedUser')));
            $option['conditions'] = array('User.id' => $bock_user_id);
            $block_user_list = $this->User->find('all', $option);
            //pr($bock_user_id);die;
            /*             * ******for give user looksex data******** */
            $user_looksex = $this->UserLooksex->find('first', array('conditions' => array(
                    'and' => array(
                        array(
                            'UserLooksex.user_id ' => $user_id,
                            'UserLooksex.start_time <=' => $current_date,
                            'UserLooksex.end_time >=' => $current_date
                        )
                    )
            )));
            if ($user_looksex) {
                $data['userlooksex_data'] = $user_looksex['UserLooksex'];
            }
            /*             * **********END**************** */
            if ($block_user_list) {
                $data['success'] = 1;

                $data['msg'] = 'success';
                $data['user_looking_profile_active'] = $this->check_profile_active($current_date, $user_id);
                $data['login_user_member_type'] = $member_type;
                $data['login_user_removead'] = $removead;
                $data['user_data'] = $block_user_list;
                $data['path'] = PIC_PATH;
            } else {
                $data['success'] = 2;
                $data['login_user_member_type'] = $member_type;
                $data['login_user_removead'] = $removead;
                $data['msg'] = 'No data found';
                $data['user_looking_profile_active'] = $this->check_profile_active($current_date, $user_id);
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id or browse  not found';
        }
        echo json_encode($data);
    }

    //=======unblock all ========//
    public function unblock_all_users() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        /*         * *********END************ */
        if ($user_id) {

            /*             * **********END**************** */
            if ($this->BlockedUser->deleteAll(array('BlockedUser.user_id' => $user_id))) {
                $data['success'] = 1;
                $data['msg'] = 'success';
            } else {
                $data['success'] = 2;
                $data['msg'] = 'unable to unblock';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id  not found';
        }
        echo json_encode($data);
    }

    //=======read all message ========//
    public function read_all_message() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        /*         * *********END************ */
        if ($user_id) {

            /*             * **********END**************** */
            if ($this->ChatUser->updateAll(array('ChatUser.invite' => 0, 'ChatUser.count' => 0), array('ChatUser.chat_user_id' => $user_id))) {
                $data['success'] = 1;
                $data['msg'] = 'success';
            } else {
                $data['success'] = 2;
                $data['msg'] = 'unable to read all message';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id  not found';
        }
        echo json_encode($data);
    }

    //=======Lock Detailed Profiles ========//
    public function lock_detail_profile() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        $type = isset($this->request->data['type']) ? $this->request->data['type'] : ''; //looking,dating,both
        /*         * *********END************ */
        if ($user_id) {

            if ($type) {
                $condition = array('ProfileLock.user_id' => $user_id, 'ProfileLock.browse' => $type);
            } else {
                $condition = array('ProfileLock.user_id' => $user_id);
            }
            /*             * **********END**************** */
            if ($this->ProfileLock->updateAll(array('ProfileLock.is_received' => 2, 'ProfileLock.count' => 0), $condition)) {
                $data['success'] = 1;
                $data['msg'] = 'success';
            } else {
                $data['success'] = 2;
                $data['msg'] = 'unable to lock private album';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id  not found';
        }
        echo json_encode($data);
    }

    //=======Lock Detailed Profiles ========//
    public function delete_profile() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : ''; //this is current user
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        /*         * *********END************ */
        if ($user_id) {
            //=====delete User======//
            $this->User->delete($user_id);
            //=====delete profile=====//
            $this->Profile->deleteAll(array('Profile.user_id' => $user_id));
            //=====delete User_partner=====//
            $this->User_partner->deleteAll(array('User_partner.user_id' => $user_id));
            //=====delete User_album=====//
            $this->User_album->deleteAll(array('User_album.user_id' => $user_id));
            //=====delete BlockedUser=====//
            $this->BlockedUser->deleteAll(array('BlockedUser.user_id' => $user_id));
            //=====delete BlockedUser blocked_id=====//
            $this->BlockedUser->deleteAll(array('BlockedUser.blocked_id' => $user_id));
            //=====delete UserLookdate=====//
            $this->UserLookdate->deleteAll(array('UserLookdate.user_id' => $user_id));
            //=====delete UserLooksex=====//
            $this->UserLooksex->deleteAll(array('UserLooksex.user_id' => $user_id));
            //=====delete Archive=====//
            $this->Archive->deleteAll(array('Archive.user_id' => $user_id));
            //=====delete ShareAlbum=====//
            $this->ShareAlbum->deleteAll(array('ShareAlbum.sender_id' => $user_id));
            //=====delete ShareAlbum=====//
            $this->ShareAlbum->deleteAll(array('ShareAlbum.receiver_id' => $user_id));
            //=====delete Favourite=====//
            $this->Favourite->deleteAll(array('Favourite.user_id' => $user_id));
            //=====delete Favourite=====//
            $this->Favourite->deleteAll(array('Favourite.favourite_user_id' => $user_id));
            //=====delete Note=====//
            $this->Note->deleteAll(array('Note.user_id' => $user_id));
            //=====delete Note=====//
            $this->Note->deleteAll(array('Note.note_user_id' => $user_id));
            //=====delete Viewer=====//
            $this->Viewer->deleteAll(array('Viewer.user_id' => $user_id));
            //=====delete Viewer=====//
            $this->Viewer->deleteAll(array('Viewer.viewer_user_id' => $user_id));
            //=====delete ProfileLock=====//
            $this->ProfileLock->deleteAll(array('ProfileLock.user_id' => $user_id));
            //=====delete ProfileLock=====//
            $this->ProfileLock->deleteAll(array('ProfileLock.lock_user_id' => $user_id));
            //=====delete RecentImage=====//
            $this->RecentImage->deleteAll(array('RecentImage.user_id' => $user_id));
            //=====delete Phrase=====//
            $this->Phrase->deleteAll(array('Phrase.user_id' => $user_id));
            //=====delete ChatUser=====//
            $this->ChatUser->deleteAll(array('ChatUser.user_id' => $user_id));
            //=====delete ChatUser=====//
            $this->ChatUser->deleteAll(array('ChatUser.chat_user_id' => $user_id));
            //=====delete Flag=====//
            $this->Flag->deleteAll(array('Flag.	sender_id' => $user_id));
            //=====delete Flag=====//
            $this->Flag->deleteAll(array('Flag.	receiver_id' => $user_id));
            //=====delete BlockChatUser=====//
            $this->BlockChatUser->deleteAll(array('BlockChatUser.user_id' => $user_id));
            //=====delete BlockChatUser=====//
            $this->BlockChatUser->deleteAll(array('BlockChatUser.block_user_id' => $user_id));
            //=====delete MatchesFilterValue=====//
            $this->MatchesFilterValue->deleteAll(array('MatchesFilterValue.user_id' => $user_id));
            /*             * **********END**************** */
            $data['success'] = 1;
            $data['msg'] = 'success';
        } else {
            $data['success'] = 0;
            $data['msg'] = 'user id  not found';
        }
        echo json_encode($data);
    }

    /*     * *********************************** for admin panel 20042015 *************************** */

    /**
     * Displayes list of users
     */
    public function admin_index() {
        $this->set('title_for_layout', ' - Users Management');
        //$limit = $this->params['pass']['0'];
        if (!isset($this->params['pass']['0'])) {
            $limit = 10;
        } else {
            $limit = $this->params['pass']['0'];
        }
        $this->paginate['User'] = array(
            'limit' => $limit,
            'order' => array(
                'User.id' => 'DESC'
            )
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
        //pr($results);die;
        $this->set('results', $results);
        $this->set('count', count($results));
    }

    public function admin_banuser() {
        $this->set('title_for_layout', ' - Users Management');

        if (!isset($this->params['pass']['0'])) {
            $limit = 10;
        } else {
            $limit = $this->params['pass']['0'];
        }

        $this->paginate['User'] = array(
            'conditions' => array('User.status' => 0),
            'limit' => $limit,
            'order' => array(
                'User.id' => 'DESC'
            )
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
        $this->set('results', $results);
        $this->set('count', count($results));
    }

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

    /**
     * 
     * Method to edit an user
     */
    public function admin_edit($id = null) {
        if (!$id) {
            $this->redirect($this->referer());
        }

        $this->User->id = $id;
        $users = $this->User->findById($this->User->id);
        if ($this->request->is('post') || $this->request->is('put')) {
            $file = $this->request->data['User']['profile_pic']['name'];
            //pr($file);
            if ($file) {
                $resize = true;
                $resizeOptions = array('width' => '250', 'height' => '200', 'destination' => 'profile_pic/thumb/');
                $rootPath = WWW_ROOT;
                $destination = 'profile_pic/';
                if (!empty($users['User']['profile_pic'])) {
                    @unlink($rootPath . 'profile_pic/' . $users['User']['profile_pic']);
                    @unlink($rootPath . 'profile_pic/thumb/' . $users['User']['profile_pic']);
                }
                $data = array();
                $data['file'] = $this->request->data['User']['profile_pic'];
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
                    $this->request->data['User']['profile_pic'] = $imageName;
                }
            } else {
                unset($this->request->data['User']['profile_pic']);
            }
            if ($this->request->data['Profile']['identity']) {
                $this->request->data['Profile']['identity'] = implode(',', $this->request->data['Profile']['identity']);
            }
            if ($this->request->data['Profile']['his_identitie']) {
                $this->request->data['Profile']['his_identitie'] = implode(',', $this->request->data['Profile']['his_identitie']);
            }
            // pr($this->request->data);die;
            $this->User->create();
            if ($this->User->saveAll($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                //$this->redirect(array('action' => 'index', 'admin' => TRUE));
            }
        }
        $this->set('user_details', $users);
        $this->request->data = $this->User->read();
    }

    /**
     * Displayes list of  Private album
     */
    public function admin_album() {
        $this->set('title_for_layout', ' - Private Images');

        $this->paginate['User_album'] = array(
            'limit' => 10,
            'order' => array(
                'User_album.id' => 'DESC'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);

            $this->paginate['User_album']['conditions'] = array(
                "User_album.user_id" => $user_id,
                    // "User.email LIKE" => "%" . $search . "%",
                    //"User.last_name LIKE" => "%" . $search . "%"
            );
            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('User_album');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
    }

    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $album = $this->User_album->findById($id);
        $user_id = $album['User_album']['user_id'];
        if (!empty($album['User_album']['photo_name'])) {
            @unlink($rootPath . 'profile_pic/' . $album['User_album']['photo_name']);
            @unlink($rootPath . 'profile_pic/thumb/' . $album['User_album']['photo_name']);
        }
        $this->User_album->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'users', 'action' => 'album', $user_id, 'admin' => TRUE));
        //$this->redirect($this->referer());
    }

    public function admin_add_album() {
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('users', $users);
        if ($this->request->is('post')) {
            $file = $this->request->data['User_album']['photo_name']['name'];
            //pr($file);
            if ($file) {
                $resize = true;
                $resizeOptions = array('width' => '250', 'height' => '200', 'destination' => 'profile_pic/thumb/');
                $rootPath = WWW_ROOT;
                $destination = 'profile_pic/';
                $data = array();
                $data['file'] = $this->request->data['User_album']['photo_name'];
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
                    $this->request->data['User_album']['photo_name'] = $imageName;
                }
            }
            if ($this->User_album->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                $this->redirect(array('controller' => 'users', 'action' => 'album', $this->request->data['User_album']['user_id'], 'admin' => TRUE));
            } else {
                $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-success', array(), 'notification');
            }
        }
    }

    public function admin_move_archive($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $UserArchive = $this->User_album->findById($id);
        $user_id = $UserArchive['User_album']['user_id'];
        if (!empty($UserArchive['User_album']['photo_name'])) {
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
                $this->User_album->delete($id);
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                $this->redirect(array('controller' => 'users', 'action' => 'album', $user_id, 'admin' => TRUE));
            } else {
                $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-success', array(), 'notification');
            }
        }
    }

    public function admin_archive() {
        $this->set('title_for_layout', ' - Archive Images');

        $this->paginate['Archive'] = array(
            'limit' => 10,
            'order' => array(
                'Archive.id' => 'DESC'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);

            $this->paginate['Archive']['conditions'] = array(
                "Archive.user_id" => $user_id,
                    // "User.email LIKE" => "%" . $search . "%",
                    //"User.last_name LIKE" => "%" . $search . "%"
            );
            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('Archive');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
    }

    public function admin_delete_archive($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $album = $this->Archive->findById($id);
        $user_id = $album['Archive']['user_id'];
        if (!empty($album['Archive']['photo_name'])) {
            @unlink($rootPath . 'profile_pic/' . $album['Archive']['photo_name']);
            @unlink($rootPath . 'profile_pic/thumb/' . $album['Archive']['photo_name']);
        }
        $this->Archive->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'users', 'action' => 'archive', $user_id, 'admin' => TRUE));
        //$this->redirect($this->referer());
    }

    public function admin_move_private($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $UserArchive = $this->Archive->findById($id);
        $user_id = $UserArchive['Archive']['user_id'];
        if (!empty($UserArchive['Archive']['photo_name'])) {
            $photoname = $UserArchive['Archive']['photo_name'];
            $caption = $UserArchive['Archive']['caption'];
            $user['User_album'] = array(
                'user_id' => $user_id,
                'photo_name' => $photoname,
                'caption' => $caption,
                    //'creation_date' => date('Y-m-d H:i:s')
            );
            $this->User_album->create();
            if ($this->User_album->save($user)) {
                $this->Archive->delete($id);
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                $this->redirect(array('controller' => 'users', 'action' => 'archive', $user_id, 'admin' => TRUE));
            } else {
                $this->Session->setFlash($this->errorMessage('nothing_updated'), 'admin/notifications/message-success', array(), 'notification');
            }
        }
    }

    public function admin_viewer() {
        $this->set('title_for_layout', ' - Profile Viewer');
        $this->paginate['User'] = array(
            'limit' => 10,
            'order' => array(
                'User.id' => 'DESC'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);
            $this->paginate['User']['fields'] = array('User.*', 'Profile.*', 'Viewer.*');
            $this->paginate['User']['joins'] = array(
                array(
                    'table' => 'viewers',
                    'alias' => 'Viewer',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = Viewer.user_id',
                        'AND' => array(
                            array('Viewer.viewer_user_id' => $user_id),
                        // array('Friend.request_status' => 1)
                        )
                    )
                )
            );
            //$this->paginate['User']['conditions'] = array('Viewer.viewer_user_id' => $user_id);
            // "User.email LIKE" => "%" . $search . "%",
            //"User.last_name LIKE" => "%" . $search . "%"

            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('User');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
        //pr($this->User->getDataSource()->getLog());
    }

    public function admin_viewed() {
        $this->set('title_for_layout', ' - Profile Views');
        $this->paginate['User'] = array(
            'limit' => 10,
            'order' => array(
                'User.id' => 'DESC'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);
            $this->paginate['User']['fields'] = array('User.*', 'Profile.*', 'Viewer.*');
            $this->paginate['User']['joins'] = array(
                array(
                    'table' => 'viewers',
                    'alias' => 'Viewer',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = Viewer.viewer_user_id',
                        'AND' => array(
                            array('Viewer.user_id' => $user_id),
                        // array('Friend.request_status' => 1)
                        )
                    )
                )
            );
            //$this->paginate['User']['conditions'] = array('Viewer.viewer_user_id' => $user_id);
            // "User.email LIKE" => "%" . $search . "%",
            //"User.last_name LIKE" => "%" . $search . "%"

            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('User');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
        //pr($this->User->getDataSource()->getLog());
    }

    public function admin_delete_viewer_viewed($id = null, $type = null) {
        if (!$id && !$type) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $album = $this->Viewer->findById($id);
        if ($type == 'viewer') {
            $user_id = $album['Viewer']['viewer_user_id'];
            $action = 'viewer';
        } else {
            $user_id = $album['Viewer']['user_id'];
            $action = 'viewed';
        }
        $this->Viewer->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'users', 'action' => $action, $user_id, 'admin' => TRUE));
        //$this->redirect($this->referer());
    }

    /**
     * Displayes list of  Private album
     */
    public function admin_favourite() {
        $this->set('title_for_layout', ' - Private Images');

        $this->paginate['User'] = array(
            'limit' => 10,
            'order' => array(
                'User.id' => 'DESC'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);
            $this->paginate['User']['fields'] = array('User.*', 'Profile.*', 'Favourite.*');
            $this->paginate['User']['joins'] = array(
                array('table' => 'favourites',
                    'alias' => 'Favourite',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Favourite.favourite_user_id = User.id',
                        'AND' => array(
                            array('Favourite.user_id' => $user_id),
                        //array('Favourite.is_favourite' => 1)
                        )
                    )
                )
            );
            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('User');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
    }

    public function admin_change_favourite_status($id, $status) {
        if (!$id || !isset($status)) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->Favourite->updateAll(
                array('Favourite.is_favourite' => $status), array('Favourite.id' => $id)
        );

        if ($status == 2)
            $msg = 'record_inactive';
        elseif ($status == 1)
            $msg = 'record_active';
        $users = $this->Favourite->findById($id);
        $this->Session->setFlash($this->errorMessage($msg), 'admin/notifications/message-success', array(), 'notification');
        // $this->redirect($this->referer());
        $this->redirect(array('controller' => 'users', 'action' => 'favourite', $users['Favourite']['user_id'], 'admin' => TRUE));
    }

    public function admin_delete_favourite($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $album = $this->Favourite->findById($id);
        $user_id = $album['Favourite']['user_id'];
        $this->Favourite->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'users', 'action' => 'favourite', $user_id, 'admin' => TRUE));
        //$this->redirect($this->referer());
    }

    public function admin_album_access() {
        $this->set('title_for_layout', ' - Album Access');

        $this->paginate['User'] = array(
            'limit' => 10,
            'order' => array(
                'User.id' => 'DESC'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);
            $this->paginate['User']['fields'] = array('User.*', 'Profile.*', 'ShareAlbum.*');
            $this->paginate['User']['joins'] = array(
                array('table' => 'share_albums',
                    'alias' => 'ShareAlbum',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = ShareAlbum.receiver_id',
                        'AND' => array(
                            array('ShareAlbum.sender_id' => $user_id),
                        //array('Favourite.is_favourite' => 1)
                        )
                    )
                )
            );
            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('User');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
            //pr($this->User->getDataSource()->getLog());
        } else {
            $this->set('count', 0);
        }
    }

    public function admin_change_album_status($id, $status) {
        if (!$id || !isset($status)) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->ShareAlbum->updateAll(
                array('ShareAlbum.is_received' => $status), array('ShareAlbum.id' => $id)
        );

        if ($status == 2)
            $msg = 'record_inactive';
        elseif ($status == 1)
            $msg = 'record_active';
        $users = $this->ShareAlbum->findById($id);
        $this->Session->setFlash($this->errorMessage($msg), 'admin/notifications/message-success', array(), 'notification');
        // $this->redirect($this->referer());
        $this->redirect(array('controller' => 'users', 'action' => 'album_access', $users['ShareAlbum']['sender_id'], 'admin' => TRUE));
    }

    public function admin_delete_album_access($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $album = $this->ShareAlbum->findById($id);
        $user_id = $album['ShareAlbum']['sender_id'];
        $this->ShareAlbum->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'users', 'action' => 'album_access', $user_id, 'admin' => TRUE));
        //$this->redirect($this->referer());
    }

    public function admin_profile_access() {
        $this->set('title_for_layout', ' - Profile Access');

        $this->paginate['User'] = array(
            'limit' => 10,
            'order' => array(
                'User.id' => 'DESC'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);
            $this->paginate['User']['fields'] = array('User.*', 'Profile.*', 'ProfileLock.*');
            $this->paginate['User']['joins'] = array(
                array('table' => 'profile_locks',
                    'alias' => 'ProfileLock',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = ProfileLock.lock_user_id',
                        'AND' => array(
                            array('ProfileLock.user_id' => $user_id),
                        //array('Favourite.is_favourite' => 1)
                        )
                    )
                )
            );
            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('User');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
            //pr($this->User->getDataSource()->getLog());
        } else {
            $this->set('count', 0);
        }
    }

    public function admin_change_profile_status($id, $status) {
        if (!$id || !isset($status)) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->ProfileLock->updateAll(
                array('ProfileLock.is_locked' => $status), array('ProfileLock.id' => $id)
        );

        if ($status == 2)
            $msg = 'record_inactive';
        elseif ($status == 1)
            $msg = 'record_active';
        $users = $this->ProfileLock->findById($id);
        $this->Session->setFlash($this->errorMessage($msg), 'admin/notifications/message-success', array(), 'notification');
        // $this->redirect($this->referer());
        $this->redirect(array('controller' => 'users', 'action' => 'profile_access', $users['ProfileLock']['user_id'], 'admin' => TRUE));
    }

    public function admin_delete_profile_access($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $album = $this->ProfileLock->findById($id);
        $user_id = $album['ProfileLock']['user_id'];
        $this->ProfileLock->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'users', 'action' => 'profile_access', $user_id, 'admin' => TRUE));
        //$this->redirect($this->referer());
    }

    public function admin_note() {
        $this->set('title_for_layout', ' - Note Management');

        $this->paginate['User'] = array(
            'limit' => 10,
            'order' => array(
                'User.id' => 'Desc'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);
            $this->paginate['User']['fields'] = array('User.*', 'Profile.*', 'Note.*');
            $this->paginate['User']['joins'] = array(
                array('table' => 'notes',
                    'alias' => 'Note',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Note.note_user_id = User.id',
                        'AND' => array(
                            array('Note.user_id' => $user_id),
                        //array('Favourite.is_favourite' => 1)
                        )
                    )
                )
            );
            //$this->paginate['order'] = array('Note.id' => 'DESC');
            //$this->paginate['UserLookdate']['conditions'] = array('UserLookdate.user_id' => $user_id);
            // "User.email LIKE" => "%" . $search . "%",
            //"User.last_name LIKE" => "%" . $search . "%"
            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('User');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
    }

    public function admin_add_note() {
        $this->set('title_for_layout', ' - Add Note');
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        if ($this->request->is('post')) {
            if ($this->request->data['Note']['user_id'] == $this->request->data['Note']['note_user_id']) {
                $this->Session->setFlash($this->errorMessage('user_noteuser_not_same'), 'admin/notifications/message-error', array(), 'notification');
            } else {
                $note = $this->Note->find('first', array('conditions' => array('Note.user_id' => $this->request->data['Note']['user_id'], 'Note.note_user_id' => $this->request->data['Note']['note_user_id'])));
                if ($note) {
                    $this->request->data['Note']['id'] = $note['Note']['id'];
                }
                $this->request->data['Note']['creation_date'] = date('Y-m-d H:i:s');
                $this->Note->create();
                if ($this->Note->save($this->request->data)) {
                    $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                    $this->redirect($this->referer());
                }
            }
        }
    }

    public function admin_delete_note($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $album = $this->Note->findById($id);
        $user_id = $album['Note']['user_id'];
        $this->Note->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'users', 'action' => 'note', $user_id, 'admin' => TRUE));
        //$this->redirect($this->referer());
    }

    public function admin_edit_note($id = null) {
        if (!$id) {
            $this->redirect($this->referer());
        }

        $this->Note->id = $id;
        //$users = $this->User->findById($this->User->id);
        if ($this->request->is('post') || $this->request->is('put')) {
            $album = $this->Note->findById($id);
            $user_id = $album['Note']['user_id'];
            $this->Note->create();
            if ($this->Note->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                // $this->redirect(array('controller' => 'users', 'action' => 'note', $user_id, 'admin' => TRUE));
            }
        }
        //$this->set('user_details', $users);
        $this->request->data = $this->Note->read();
    }

    public function admin_phrases() {
        $this->set('title_for_layout', ' - Phrases');

        $this->paginate['Phrase'] = array(
            'limit' => 10,
            'order' => array(
                'Phrase.id' => 'DESC'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);
            //$this->paginate['User']['fields'] = array('User.*', 'Profile.*', 'Favourite.*');
            // $this->paginate['User']['joins'] = array(
//                array('table' => 'favourites',
//                    'alias' => 'Favourite',
//                    'type' => 'INNER',
//                    'conditions' => array(
//                        'Favourite.favourite_user_id = User.id',
//                        'AND' => array(
//                            array('Favourite.user_id' => $user_id),
//                        //array('Favourite.is_favourite' => 1)
//                        )
//                    )
//                )
//            );
            $this->paginate['Phrase']['conditions'] = array('Phrase.user_id' => $user_id);
            // "User.email LIKE" => "%" . $search . "%",
            //"User.last_name LIKE" => "%" . $search . "%"
            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('Phrase');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
    }

    public function admin_add_phrases() {
        $this->set('title_for_layout', ' - Add Phrases');
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->data['Phrase']['creation_date'] = date('Y-m-d H:i:s');
            $this->Phrase->create();
            if ($this->Phrase->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                $this->redirect($this->referer());
            }
        }
    }

    public function admin_edit_phrases($id = null) {
        $this->set('title_for_layout', ' - Edit Phrases');
        if (!$id) {
            $this->redirect($this->referer());
        }

        $this->Phrase->id = $id;
        //$users = $this->User->findById($this->User->id);
        if ($this->request->is('post') || $this->request->is('put')) {
            $album = $this->Phrase->findById($id);
            $user_id = $album['Phrase']['user_id'];
            $this->Phrase->create();
            if ($this->Phrase->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                //$this->redirect(array('controller' => 'users', 'action' => 'phrases', $user_id, 'admin' => TRUE));
            }
        }
        //$this->set('user_details', $users);
        $this->request->data = $this->Phrase->read();
    }

    public function admin_delete_phrases($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $album = $this->Phrase->findById($id);
        $user_id = $album['Phrase']['user_id'];
        $this->Phrase->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'users', 'action' => 'phrases', $user_id, 'admin' => TRUE));
        //$this->redirect($this->referer());
    }

    public function admin_recent_images() {
        $this->set('title_for_layout', ' - Recent Images');

        $this->paginate['RecentImage'] = array(
            'limit' => 10,
            'order' => array(
                'RecentImage.id' => 'DESC'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);
            //$this->paginate['User']['fields'] = array('User.*', 'Profile.*', 'Favourite.*');
            // $this->paginate['User']['joins'] = array(
//                array('table' => 'favourites',
//                    'alias' => 'Favourite',
//                    'type' => 'INNER',
//                    'conditions' => array(
//                        'Favourite.favourite_user_id = User.id',
//                        'AND' => array(
//                            array('Favourite.user_id' => $user_id),
//                        //array('Favourite.is_favourite' => 1)
//                        )
//                    )
//                )
//            );
            $this->paginate['RecentImage']['conditions'] = array('RecentImage.user_id' => $user_id);
            // "User.email LIKE" => "%" . $search . "%",
            //"User.last_name LIKE" => "%" . $search . "%"
            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('RecentImage');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
    }

    public function admin_delete_recent_image($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $album = $this->RecentImage->findById($id);
        $user_id = $album['RecentImage']['user_id'];
        if (!empty($album['RecentImage']['image'])) {
            @unlink($rootPath . 'recent_images/' . $album['RecentImage']['image']);
            @unlink($rootPath . 'recent_images/thumb/' . $album['RecentImage']['image']);
        }
        $this->RecentImage->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'users', 'action' => 'recent_images', $user_id, 'admin' => TRUE));
        //$this->redirect($this->referer());
    }

    public function admin_add_recent_image() {
        $this->set('title_for_layout', ' - Add Phrases');
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        if ($this->request->is('post')) {
            $file = $this->request->data['RecentImage']['image']['name'];
            //pr($file);
            if ($file) {
                $resize = true;
                $resizeOptions = array('width' => '250', 'height' => '200', 'destination' => 'recent_images/thumb/');
                $rootPath = WWW_ROOT;
                $destination = 'recent_images/';
                $data = array();
                $data['file'] = $this->request->data['RecentImage']['image'];
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
                    $this->request->data['RecentImage']['image'] = $imageName;
                }
            }

            $this->request->data['RecentImage']['creation_date'] = date('Y-m-d H:i:s');
            $this->RecentImage->create();
            if ($this->RecentImage->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                $this->redirect($this->referer());
            }
        }
    }

    public function admin_looking_date() {
        $this->set('title_for_layout', ' - Looking Date');

        $this->paginate['UserLookdate'] = array(
            'limit' => 10,
            'order' => array(
                'UserLookdate.id' => 'DESC'
            )
        );
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //
        if ($user_id) {
            //pr($user_id);
            // die;
            $this->set('user_id', $user_id);
            //$this->paginate['User']['fields'] = array('User.*', 'Profile.*', 'Favourite.*');
            // $this->paginate['User']['joins'] = array(
//                array('table' => 'favourites',
//                    'alias' => 'Favourite',
//                    'type' => 'INNER',
//                    'conditions' => array(
//                        'Favourite.favourite_user_id = User.id',
//                        'AND' => array(
//                            array('Favourite.user_id' => $user_id),
//                        //array('Favourite.is_favourite' => 1)
//                        )
//                    )
//                )
//            );
            $this->paginate['UserLookdate']['conditions'] = array('UserLookdate.user_id' => $user_id);
            // "User.email LIKE" => "%" . $search . "%",
            //"User.last_name LIKE" => "%" . $search . "%"
            $this->Paginator->settings = $this->paginate;
            $results = $this->paginate('UserLookdate');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
    }

    public function admin_edit_lookdate($id = null) {
        if (!$id) {
            $this->redirect($this->referer());
        }

        $this->UserLookdate->id = $id;
        $users = $this->UserLookdate->findById($this->UserLookdate->id);
        //pr($users);
        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->request->data['UserLookdate']['my_traits']) {
                $this->request->data['UserLookdate']['my_traits'] = addslashes(implode(',', $this->request->data['UserLookdate']['my_traits']));
            }
            if ($this->request->data['UserLookdate']['his_traits']) {
                $this->request->data['UserLookdate']['his_traits'] = addslashes(implode(',', $this->request->data['UserLookdate']['his_traits']));
            }
            if ($this->request->data['UserLookdate']['my_interest']) {
                $this->request->data['UserLookdate']['my_interest'] = addslashes(implode(',', $this->request->data['UserLookdate']['my_interest']));
            }
            if ($this->request->data['UserLookdate']['my_physical_appearance']) {
                $this->request->data['UserLookdate']['my_physical_appearance'] = addslashes(implode(',', $this->request->data['UserLookdate']['my_physical_appearance']));
            }
            if ($this->request->data['UserLookdate']['his_physical_appearance']) {
                $this->request->data['UserLookdate']['his_physical_appearance'] = addslashes(implode(',', $this->request->data['UserLookdate']['his_physical_appearance']));
            }
            if ($this->request->data['UserLookdate']['my_sextual_preferences']) {
                $this->request->data['UserLookdate']['my_sextual_preferences'] = addslashes(implode(',', $this->request->data['UserLookdate']['my_sextual_preferences']));
            }
            if ($this->request->data['UserLookdate']['his_sextual_preferences']) {
                $this->request->data['UserLookdate']['his_sextual_preferences'] = addslashes(implode(',', $this->request->data['UserLookdate']['his_sextual_preferences']));
            }
            if ($this->request->data['UserLookdate']['my_social_habits']) {
                $this->request->data['UserLookdate']['my_social_habits'] = addslashes(implode(',', $this->request->data['UserLookdate']['my_social_habits']));
            }
            if ($this->request->data['UserLookdate']['his_social_habits']) {
                $this->request->data['UserLookdate']['his_social_habits'] = addslashes(implode(',', $this->request->data['UserLookdate']['his_social_habits']));
            }
            $this->request->data['UserLookdate']['modification_date'] = date('Y-m-d H:i:s');
            // pr($this->request->data);die;
            $this->UserLookdate->create();
            if ($this->UserLookdate->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                $this->redirect($this->referer());
            }
        }
        $this->set('user_details', $users);
        $this->request->data = $this->UserLookdate->read();
    }

    public function admin_delete_lookdate($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        $album = $this->UserLookdate->findById($id);
        $user_id = $album['UserLookdate']['user_id'];
        $this->UserLookdate->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'users', 'action' => 'looking_date', $user_id, 'admin' => TRUE));
        //$this->redirect($this->referer());
    }

    public function admin_add_lookdate() {
        $this->set('title_for_layout', ' - Add Lookdate');
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.email')));
        $this->set('options', $users);
        ############################################################################################
        if ($this->request->is('post') || $this->request->is('put')) {
            $lookdate = $this->UserLookdate->find('first', array('conditions' => array('UserLookdate.user_id' => $this->request->data['UserLookdate']['user_id'])));
            if (!$lookdate) {
                if ($this->request->data['UserLookdate']['my_traits']) {
                    $this->request->data['UserLookdate']['my_traits'] = addslashes(implode(',', $this->request->data['UserLookdate']['my_traits']));
                }
                if ($this->request->data['UserLookdate']['his_traits']) {
                    $this->request->data['UserLookdate']['his_traits'] = addslashes(implode(',', $this->request->data['UserLookdate']['his_traits']));
                }
                if ($this->request->data['UserLookdate']['my_interest']) {
                    $this->request->data['UserLookdate']['my_interest'] = addslashes(implode(',', $this->request->data['UserLookdate']['my_interest']));
                }
                if ($this->request->data['UserLookdate']['my_physical_appearance']) {
                    $this->request->data['UserLookdate']['my_physical_appearance'] = addslashes(implode(',', $this->request->data['UserLookdate']['my_physical_appearance']));
                }
                if ($this->request->data['UserLookdate']['his_physical_appearance']) {
                    $this->request->data['UserLookdate']['his_physical_appearance'] = addslashes(implode(',', $this->request->data['UserLookdate']['his_physical_appearance']));
                }
                if ($this->request->data['UserLookdate']['my_sextual_preferences']) {
                    $this->request->data['UserLookdate']['my_sextual_preferences'] = addslashes(implode(',', $this->request->data['UserLookdate']['my_sextual_preferences']));
                }
                if ($this->request->data['UserLookdate']['his_sextual_preferences']) {
                    $this->request->data['UserLookdate']['his_sextual_preferences'] = addslashes(implode(',', $this->request->data['UserLookdate']['his_sextual_preferences']));
                }
                if ($this->request->data['UserLookdate']['my_social_habits']) {
                    $this->request->data['UserLookdate']['my_social_habits'] = addslashes(implode(',', $this->request->data['UserLookdate']['my_social_habits']));
                }
                if ($this->request->data['UserLookdate']['his_social_habits']) {
                    $this->request->data['UserLookdate']['his_social_habits'] = addslashes(implode(',', $this->request->data['UserLookdate']['his_social_habits']));
                }
                $this->request->data['UserLookdate']['modification_date'] = date('Y-m-d H:i:s');
                // pr($this->request->data);die;
                $this->UserLookdate->create();
                if ($this->UserLookdate->save($this->request->data)) {
                    $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                    $this->redirect($this->referer());
                }
            } else {

                $this->Session->setFlash($this->errorMessage('already_profile_exists'), 'admin/notifications/message-error', array(), 'notification');
            }
        }
    }

    public function check_is_active() {
        $this->autoRender = false;
        //echo date_default_timezone_get('Asia/K');
//         date_default_timezone_set("UTC");
//                    $current_date = '2015-05-05 20:57:00';
//                    $if_exist_profile =  $this->UserLooksex->find('all',array('conditions'=>array(
//                        'and' => array(
//                        array('UserLooksex.start_time <= ' => $current_date,
//                              'UserLooksex.end_time >= ' => $current_date
//                             ),
//                        'UserLooksex.user_id =' => 42
//                        )
//                    )));
//                    pr($if_exist_profile);
//                    $msg_array = '';
//                    foreach($if_exist_profile as $profile_exist)
//                    {
//                        $msg_array .= $profile_exist['UserLooksex']['start_time'].' - '.$profile_exist['UserLooksex']['end_time'].', ';
//                    }
//                    $msg_error =rtrim($msg_array,' ,');
//                    echo $msg_exist;
//        die;
//        $looks_data = $this->UserLooksex->find('all',array('conditions'=>array('end_time >'=>$current_date)));
//        if(count($looks_data)>0)
//        {
//        foreach($looks_data as $data)
//        {
//            $this->UserLooksex->id = $data['UserLooksex']['id'];
//            $this->UserLooksex->saveField('is_active', 0);
//        }
//        }
        date_default_timezone_set("Asia/Kolkata");
        $current_date = date('Y-m-d H:i:s');
        echo $current_date;
        die;
        $if_exist_profile = $this->UserLooksex->find('all', array('conditions' => array(
                'UserLooksex.notification_time <= ' => $current_date,
                'AND' => array(
                    'UserLooksex.is_notify =' => 0
                )
        )));
        if (count($if_exist_profile) > 0) {
            //=====Get looksex data====//
            foreach ($if_exist_profile as $look_sex_data) {
                //=====For update notify status======//
                $this->UserLooksex->id = $look_sex_data['UserLooksex']['id'];
                $this->UserLooksex->saveField('is_notify', 1);
            }
        }
        exit;
    }

    public function test_age() {
        $this->autoRender = false;
        $age_to = str_replace('Not Set', '', isset($this->request->data['age_to']) ? $this->request->data['age_to'] : '');
        $age_from = str_replace('Not Set', '', isset($this->request->data['age_from']) ? $this->request->data['age_from'] : '');
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        if ($age_to && $age_from) {
            //echo 'kkkkkk';die;
            $current_date1 = date('Y-m-d', strtotime($current_date));
            // echo 
            if ($age_to > $age_from) {
                $age_to_change = $age_from;
                $age_from_change = $age_to;
                $age_to = $age_to_change;
                $age_from = $age_from_change;
            }
            //$age_to=($age_to*365)+(11*30)+28;//convert day(add 11 months 28 day)
            //$age_from=($age_from*365)+(11*30)+28;
            echo $age_to_year = date('Y-m-d', strtotime('-' . $age_to . 'year', strtotime($current_date1))) . '<br>';
            echo $age_from_year = date('Y-m-d', strtotime('-' . $age_from . 'year', strtotime($current_date1)));
            echo $age_from_year1 = date('Y-m-d', strtotime(date('Y', strtotime($age_from_year)) . '-01-01'));
        }
    }

    public function test_add_verify_table() {
        $this->autoRender = false;
        $user_id = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : '';
        $response = isset($this->request->data['response']) ? $this->request->data['response'] : '';
        $verifydata['VerifyLog']['user_id'] = $user_id;
        $verifydata['VerifyLog']['json_data'] = $response;
        $verifydata['VerifyLog']['creation_date'] = date('Y-m-d H:i:s');
        //pr($verifydata);
        $this->VerifyLog->save($verifydata);
    }

    public function admin_export() {

        $this->response->download("export.csv");
        $search = isset($this->request->data['User']['search']);
        $condition['fields'] = array('email', 'screen_name', 'token', 'valid_upto', 'member_type', 'creation_date', 'removead', 'removead_valid_upto', 'is_trial');
        $condition['order'] = array('User.id' => 'DESC');
        if ($search) {
            $condition['conditions']['OR'] = array(
                "User.screen_name LIKE" => "%" . $search . "%",
                "User.email LIKE" => "%" . $search . "%",
                    //"User.last_name LIKE" => "%" . $search . "%"
            );
        }
        $data = $this->User->find('all', $condition);
        //pr($data);die;
        $this->set(compact('data'));

        $this->layout = 'ajax';

        return;
    }

    public function admin_export_banned() {

        $this->response->download("export_banned_users.csv");
        $search = isset($this->request->data['User']['search']);
        $condition['fields'] = array('email', 'screen_name', 'token', 'valid_upto', 'member_type', 'creation_date', 'removead', 'removead_valid_upto', 'is_trial');
        $condition['order'] = array('User.id' => 'DESC');
        $condition['conditions'] = array('User.status' => 0);
        if ($search) {
            $condition['conditions']['OR'] = array(
                "User.screen_name LIKE" => "%" . $search . "%",
                "User.email LIKE" => "%" . $search . "%",
                    //"User.last_name LIKE" => "%" . $search . "%"
            );
        }
        $data = $this->User->find('all', $condition);
        //pr($data);die;
        $this->set(compact('data'));

        $this->layout = 'ajax';

        return;
    }

}
