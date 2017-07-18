<div class="header">
    <h1 class="page-title">Edit Users</h1>
</div>

<?php echo $this->Form->create('User', array('type' => 'file')); ?>
<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
<?php echo $this->Form->input('Profile.id', array('type' => 'hidden')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        <label>Screen Name </label>
        <?php echo $this->Form->input('screen_name', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'screen_name')); ?>

        <label>Email *</label>
        <?php echo $this->Form->input('email', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'email', 'disabled' => TRUE)); ?>

        <label>Token *</label>
        <?php echo $this->Form->input('token', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'token', 'disabled' => TRUE)); ?>

        <label>Latitude</label>
        <?php echo $this->Form->input('lat', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'lat', 'disabled' => TRUE)); ?>

        <label>Longitude</label>
        <?php echo $this->Form->input('long', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'long', 'disabled' => TRUE)); ?>


        <label>Status</label>
        <?php $status_options = array('1' => 'Active', '0' => 'Inactive'); ?>
        <?php echo $this->Form->input('status', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'status', 'options' => $status_options)); ?>
        <?php
        if ($user_details['User']['profile_pic']) {
            $path = "profile_pic/" . $user_details['User']['profile_pic'];
        } else {
            $path = "img/no_image.png";
        }
        ?>

        <label>Image</label>
        <img src="<?php echo $this->webroot; ?><?php echo $path; ?>" height="200" width="200"><br/><br/>
        <?php echo $this->Form->input('profile_pic', array('label' => FALSE, 'div' => FALSE, 'type' => 'file', 'class' => 'input-xlarge', 'id' => 'profile_pic')); ?>
        <br/><br/>
        <p><strong>Basic Profile :</strong></p>
        <label>Identity *</label>
        <?php
        $status_options = array(
            "" => "---Select---",
            " Bear " => "Bear",
            "Bear Chaser" => "Bear Chaser",
            " Daddy " => "Daddy",
            "Daddy Chaser" => "Daddy Chaser",
            "Military" => "Military",
            "Jock" => "Jock",
            "Muscle" => "Muscle",
            "Leather" => "Leather",
            "Geek" => "Geek",
            "Transgender" => "Transgender",
            "Twink" => "Twink",
            "Poz" => "Poz",
            "Circuit" => "Circuit",
            "Bisexual" => "Bisexual",
            "Discreet" => "Discreet",
            "Nudist" => "Nudist",
            "Rugged" => "Rugged",
            "Clean Cut" => "Clean Cut",
            "Otter" => "Otter",
        );
        ?>
        <?php
        if ($user_details['Profile']['identity']) {
            $str_arr = $user_details['Profile']['identity'];
            $sel = explode(',', $str_arr);
        }
        ?>
        <?php echo $this->Form->input('Profile.identity', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'multiple' => true, 'selected' => $sel, 'class' => 'input-xlarge', 'id' => 'identity', 'options' => $status_options)); ?>
        <label>Ethnicity *</label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "Asian" => "Asian",
            "White/Caucasian" => "White/Caucasian",
            "Latin/Hispanic" => "Latin/Hispanic",
            "Black/African" => "Black/African",
            "Native American" => "Native American",
            "Middle Eastern" => "Middle Eastern",
            "Pacific Islander" => "Pacific Islander",
            "Mixed/Multi" => "Mixed/Multi",
            "East Indian" => "East Indian",
            "Other" => "Other",
        );
        ?>
<?php echo $this->Form->input('Profile.ethnicity', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'class' => 'input-xlarge', 'id' => 'ethnicity', 'options' => $status_options)); ?>



        <label>Dob *</label>
<?php echo $this->Form->input('Profile.birthday', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'dob')); ?>

        <label>Height</label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "4 ft 1 inch  (124cm)" => "4 ft 1 inch  (124cm)",
            "4 ft 2 inch  (127cm)" => "4 ft 2 inch  (127cm)",
            "4 ft 3 inch  (130cm)" => "4 ft 3 inch  (130cm)",
            "4 ft 4 inch  (132cm)" => "4 ft 4 inch  (132cm)",
            "4 ft 5 inch  (135cm)" => "4 ft 5 inch  (135cm)",
            "4 ft 6 inch  (137cm)" => "4 ft 6 inch  (137cm)",
            "4 ft 7 inch  (140cm)" => "4 ft 7 inch  (140cm)",
            "4 ft 8 inch  (142cm)" => "4 ft 8 inch  (142cm)",
            "4 ft 9 inch  (145cm)" => "4 ft 9 inch  (145cm)",
            "4 ft 10 inch  (147cm)" => "4 ft 10 inch  (147cm)",
            "4 ft 11 inch  (150cm)" => "4 ft 11 inch  (150cm)",
            "5 ft 1 inch  (155cm)" => "5 ft 1 inch  (155cm)",
            "5 ft 2 inch  (157cm)" => "5 ft 2 inch  (157cm)",
            "5 ft 3 inch  (160cm)" => "5 ft 3 inch  (160cm)",
            "5 ft 4 inch  (163cm)" => "5 ft 4 inch  (163cm)",
            "5 ft 5 inch  (165cm)" => "5 ft 5 inch  (165cm)",
            "5 ft 6 inch  (168cm)" => "5 ft 6 inch  (168cm)",
            "5 ft 7 inch  (170cm)" => "5 ft 7 inch  (170cm)",
            "5 ft 8 inch  (173cm)" => "5 ft 8 inch  (173cm)",
            "5 ft 9 inch  (175cm)" => "5 ft 9 inch  (175cm)",
            "5 ft 10 inch  (178cm)" => "5 ft 10 inch  (178cm)",
            "5 ft 11 inch  (180cm)" => "5 ft 11 inch  (180cm)",
            "6 ft 1 inch  (185cm)" => "6 ft 1 inch  (185cm)",
            "6 ft 2 inch  (188cm)" => "6 ft 2 inch  (188cm)",
            "6 ft 3 inch  (191cm)" => "6 ft 3 inch  (191cm)",
            "6 ft 4 inch  (193cm)" => "6 ft 4 inch  (193cm)",
            "6 ft 5 inch  (196cm)" => "6 ft 5 inch  (196cm)",
            "6 ft 6 inch  (198cm)" => "6 ft 6 inch  (198cm)",
            "6 ft 7 inch  (201cm)" => "6 ft 7 inch  (201cm)",
            "6 ft 8 inch  (203cm)" => "6 ft 8 inch  (203cm)",
            "6 ft 9 inch  (206cm)" => "6 ft 9 inch  (206cm)",
            "6 ft 10 inch  (208cm)" => "6 ft 10 inch  (208cm)",
            "6 ft 11 inch  (211cm)" => "6 ft 11 inch  (211cm)",
            "7 ft 1 inch  (216cm)" => "7 ft 1 inch  (216cm)",
            "7 ft 2 inch  (218cm)" => "7 ft 2 inch  (218cm)",
            "7 ft 3 inch  (221cm)" => "7 ft 3 inch  (221cm)",
            "7 ft 4 inch  (224cm)" => "7 ft 4 inch  (224cm)",
            "7 ft 5 inch  (226cm)" => "7 ft 5 inch  (226cm)",
            "7 ft 6 inch  (229cm)" => "7 ft 6 inch  (229cm)",
            "7 ft 7 inch  (231cm)" => "7 ft 7 inch  (231cm)",
            "7 ft 8 inch  (234cm)" => "7 ft 8 inch  (234cm)",
            "7 ft 9 inch  (236cm)" => "7 ft 9 inch  (236cm)",
            "7 ft 10 inch  (239cm)" => "7 ft 10 inch  (239cm)",
            "7 ft 11 inch  (241cm)" => "7 ft 11 inch  (241cm)",
            "8 ft 1 inch  (246cm)" => "8 ft 1 inch  (246cm)",
            "8 ft 2 inch  (249cm)" => "8 ft 2 inch  (249cm)",
            "8 ft 3 inch  (251cm)" => "8 ft 3 inch  (251cm)",
            "8 ft 4 inch  (254cm)" => "8 ft 4 inch  (254cm)",
            "8 ft 5 inch  (257cm)" => "8 ft 5 inch  (257cm)",
            "8 ft 6 inch  (259cm)" => "8 ft 6 inch  (259cm)",
            "8 ft 7 inch  (262cm)" => "8 ft 7 inch  (262cm)",
            "8 ft 8 inch  (264cm)" => "8 ft 8 inch  (264cm)",
            "8 ft 9 inch  (267cm)" => "8 ft 9 inch  (267cm)",
            "8 ft 10 inch  (269cm)" => "8 ft 10 inch  (269cm)",
            "8 ft 11 inch  (272cm)" => "8 ft 11 inch  (272cm)"
                )
        ?>
<?php echo $this->Form->input('Profile.height', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'height', 'options' => $status_options)); ?>
        <label>Weight</label>

        <?php
        $status_options = array(
            "" => "---Select---",
            "100 lbs  (45 kgs)" => "100 lbs  (45 kgs)",
            "101 lbs  (46 kgs)" => "101 lbs  (46 kgs)",
            "102 lbs  (46 kgs)" => "102 lbs  (46 kgs)",
            "103 lbs  (47 kgs)" => "103 lbs  (47 kgs)",
            "104 lbs  (47 kgs)" => "104 lbs  (47 kgs)",
            "105 lbs  (48 kgs)" => "105 lbs  (48 kgs)",
            "106 lbs  (48 kgs)" => "106 lbs  (48 kgs)",
            "107 lbs  (49 kgs)" => "107 lbs  (49 kgs)",
            "108 lbs  (49 kgs)" => "108 lbs  (49 kgs)",
            "109 lbs  (49 kgs)" => "109 lbs  (49 kgs)",
            "110 lbs  (50 kgs)" => "110 lbs  (50 kgs)",
            "111 lbs  (50 kgs)" => "111 lbs  (50 kgs)",
            "112 lbs  (51 kgs)" => "112 lbs  (51 kgs)",
            "113 lbs  (51 kgs)" => "113 lbs  (51 kgs)",
            "114 lbs  (52 kgs)" => "114 lbs  (52 kgs)",
            "115 lbs  (52 kgs)" => "115 lbs  (52 kgs)",
            "116 lbs  (53 kgs)" => "116 lbs  (53 kgs)",
            "117 lbs  (53 kgs)" => "117 lbs  (53 kgs)",
            "118 lbs  (54 kgs)" => "118 lbs  (54 kgs)",
            "119 lbs  (54 kgs)" => "119 lbs  (54 kgs)",
            "120 lbs  (54 kgs)" => "120 lbs  (54 kgs)",
            "121 lbs  (55 kgs)" => "121 lbs  (55 kgs)",
            "122 lbs  (55 kgs)" => "122 lbs  (55 kgs)",
            "123 lbs  (56 kgs)" => "123 lbs  (56 kgs)",
            "124 lbs  (56 kgs)" => "124 lbs  (56 kgs)",
            "125 lbs  (57 kgs)" => "125 lbs  (57 kgs)",
            "126 lbs  (57 kgs)" => "126 lbs  (57 kgs)",
            "127 lbs  (58 kgs)" => "127 lbs  (58 kgs)",
            "128 lbs  (58 kgs)" => "128 lbs  (58 kgs)",
            "129 lbs  (59 kgs)" => "129 lbs  (59 kgs)",
            "130 lbs  (59 kgs)" => "130 lbs  (59 kgs)",
            "131 lbs  (59 kgs)" => "131 lbs  (59 kgs)",
            "132 lbs  (60 kgs)" => "132 lbs  (60 kgs)",
            "133 lbs  (60 kgs)" => "133 lbs  (60 kgs)",
            "134 lbs  (61 kgs)" => "134 lbs  (61 kgs)",
            "135 lbs  (61 kgs)" => "135 lbs  (61 kgs)",
            "136 lbs  (62 kgs)" => "136 lbs  (62 kgs)",
            "137 lbs  (62 kgs)" => "137 lbs  (62 kgs)",
            "138 lbs  (63 kgs)" => "138 lbs  (63 kgs)",
            "139 lbs  (63 kgs)" => "139 lbs  (63 kgs)",
            "140 lbs  (64 kgs)" => "140 lbs  (64 kgs)",
            "141 lbs  (64 kgs)" => "141 lbs  (64 kgs)",
            "142 lbs  (64 kgs)" => "142 lbs  (64 kgs)",
            "143 lbs  (65 kgs)" => "143 lbs  (65 kgs)",
            "144 lbs  (65 kgs)" => "144 lbs  (65 kgs)",
            "145 lbs  (66 kgs)" => "145 lbs  (66 kgs)",
            "146 lbs  (66 kgs)" => "146 lbs  (66 kgs)",
            "147 lbs  (67 kgs)" => "147 lbs  (67 kgs)",
            "148 lbs  (67 kgs)" => "148 lbs  (67 kgs)",
            "149 lbs  (68 kgs)" => "149 lbs  (68 kgs)",
            "150 lbs  (68 kgs)" => "150 lbs  (68 kgs)",
            "151 lbs  (68 kgs)" => "151 lbs  (68 kgs)",
            "152 lbs  (69 kgs)" => "152 lbs  (69 kgs)",
            "153 lbs  (69 kgs)" => "153 lbs  (69 kgs)",
            "154 lbs  (70 kgs)" => "154 lbs  (70 kgs)",
            "155 lbs  (70 kgs)" => "155 lbs  (70 kgs)",
            "156 lbs  (71 kgs)" => "156 lbs  (71 kgs)",
            "157 lbs  (71 kgs)" => "157 lbs  (71 kgs)",
            "158 lbs  (72 kgs)" => "158 lbs  (72 kgs)",
            "159 lbs  (72 kgs)" => "159 lbs  (72 kgs)",
            "160 lbs  (73 kgs)" => "160 lbs  (73 kgs)",
            "161 lbs  (73 kgs)" => "161 lbs  (73 kgs)",
            "162 lbs  (73 kgs)" => "162 lbs  (73 kgs)",
            "163 lbs  (74 kgs)" => "163 lbs  (74 kgs)",
            "164 lbs  (74 kgs)" => "164 lbs  (74 kgs)",
            "165 lbs  (75 kgs)" => "165 lbs  (75 kgs)",
            "166 lbs  (75 kgs)" => "166 lbs  (75 kgs)",
            "167 lbs  (76 kgs)" => "167 lbs  (76 kgs)",
            "168 lbs  (76 kgs)" => "168 lbs  (76 kgs)",
            "169 lbs  (77 kgs)" => "169 lbs  (77 kgs)",
            "170 lbs  (77 kgs)" => "170 lbs  (77 kgs)",
            "171 lbs  (78 kgs)" => "171 lbs  (78 kgs)",
            "172 lbs  (78 kgs)" => "172 lbs  (78 kgs)",
            "173 lbs  (78 kgs)" => "173 lbs  (78 kgs)",
            "174 lbs  (79 kgs)" => "174 lbs  (79 kgs)",
            "175 lbs  (79 kgs)" => "175 lbs  (79 kgs)",
            "176 lbs  (80 kgs)" => "176 lbs  (80 kgs)",
            "177 lbs  (80 kgs)" => "177 lbs  (80 kgs)",
            "178 lbs  (81 kgs)" => "178 lbs  (81 kgs)",
            "179 lbs  (81 kgs)" => "179 lbs  (81 kgs)",
            "180 lbs  (82 kgs)" => "180 lbs  (82 kgs)",
            "181 lbs  (82 kgs)" => "181 lbs  (82 kgs)",
            "182 lbs  (83 kgs)" => "182 lbs  (83 kgs)",
            "183 lbs  (83 kgs)" => "183 lbs  (83 kgs)",
            "184 lbs  (83 kgs)" => "184 lbs  (83 kgs)",
            "185 lbs  (84 kgs)" => "185 lbs  (84 kgs)",
            "186 lbs  (84 kgs)" => "186 lbs  (84 kgs)",
            "187 lbs  (85 kgs)" => "187 lbs  (85 kgs)",
            "188 lbs  (85 kgs)" => "188 lbs  (85 kgs)",
            "189 lbs  (86 kgs)" => "189 lbs  (86 kgs)",
            "190 lbs  (86 kgs)" => "190 lbs  (86 kgs)",
            "191 lbs  (87 kgs)" => "191 lbs  (87 kgs)",
            "192 lbs  (87 kgs)" => "192 lbs  (87 kgs)",
            "193 lbs  (88 kgs)" => "193 lbs  (88 kgs)",
            "194 lbs  (88 kgs)" => "194 lbs  (88 kgs)",
            "195 lbs  (88 kgs)" => "195 lbs  (88 kgs)",
            "196 lbs  (89 kgs)" => "196 lbs  (89 kgs)",
            "197 lbs  (89 kgs)" => "197 lbs  (89 kgs)",
            "198 lbs  (90 kgs)" => "198 lbs  (90 kgs)",
            "199 lbs  (90 kgs)" => "199 lbs  (90 kgs)",
            "200 lbs  (91 kgs)" => "200 lbs  (91 kgs)",
            "201 lbs  (91 kgs)" => "201 lbs  (91 kgs)",
            "202 lbs  (92 kgs)" => "202 lbs  (92 kgs)",
            "203 lbs  (92 kgs)" => "203 lbs  (92 kgs)",
            "204 lbs  (93 kgs)" => "204 lbs  (93 kgs)",
            "205 lbs  (93 kgs)" => "205 lbs  (93 kgs)",
            "206 lbs  (93 kgs)" => "206 lbs  (93 kgs)",
            "207 lbs  (94 kgs)" => "207 lbs  (94 kgs)",
            "208 lbs  (94 kgs)" => "208 lbs  (94 kgs)",
            "209 lbs  (95 kgs)" => "209 lbs  (95 kgs)",
            "210 lbs  (95 kgs)" => "210 lbs  (95 kgs)",
            "211 lbs  (96 kgs)" => "211 lbs  (96 kgs)",
            "212 lbs  (96 kgs)" => "212 lbs  (96 kgs)",
            "213 lbs  (97 kgs)" => "213 lbs  (97 kgs)",
            "214 lbs  (97 kgs)" => "214 lbs  (97 kgs)",
            "215 lbs  (98 kgs)" => "215 lbs  (98 kgs)",
            "216 lbs  (98 kgs)" => "216 lbs  (98 kgs)",
            "217 lbs  (98 kgs)" => "217 lbs  (98 kgs)",
            "218 lbs  (99 kgs)" => "218 lbs  (99 kgs)",
            "219 lbs  (99 kgs)" => "219 lbs  (99 kgs)",
            "220 lbs  (100 kgs)" => "220 lbs  (100 kgs)",
            "221 lbs  (100 kgs)" => "221 lbs  (100 kgs)",
            "222 lbs  (101 kgs)" => "222 lbs  (101 kgs)",
            "223 lbs  (101 kgs)" => "223 lbs  (101 kgs)",
            "224 lbs  (102 kgs)" => "224 lbs  (102 kgs)",
            "225 lbs  (102 kgs)" => "225 lbs  (102 kgs)",
            "226 lbs  (103 kgs)" => "226 lbs  (103 kgs)",
            "227 lbs  (103 kgs)" => "227 lbs  (103 kgs)",
            "228 lbs  (103 kgs)" => "228 lbs  (103 kgs)",
            "229 lbs  (104 kgs)" => "229 lbs  (104 kgs)",
            "230 lbs  (104 kgs)" => "230 lbs  (104 kgs)",
            "231 lbs  (105 kgs)" => "231 lbs  (105 kgs)",
            "232 lbs  (105 kgs)" => "232 lbs  (105 kgs)",
            "233 lbs  (106 kgs)" => "233 lbs  (106 kgs)",
            "234 lbs  (106 kgs)" => "234 lbs  (106 kgs)",
            "235 lbs  (107 kgs)" => "235 lbs  (107 kgs)",
            "236 lbs  (107 kgs)" => "236 lbs  (107 kgs)",
            "237 lbs  (108 kgs)" => "237 lbs  (108 kgs)",
            "238 lbs  (108 kgs)" => "238 lbs  (108 kgs)",
            "239 lbs  (108 kgs)" => "239 lbs  (108 kgs)",
            "240 lbs  (109 kgs)" => "240 lbs  (109 kgs)",
            "241 lbs  (109 kgs)" => "241 lbs  (109 kgs)",
            "242 lbs  (110 kgs)" => "242 lbs  (110 kgs)",
            "243 lbs  (110 kgs)" => "243 lbs  (110 kgs)",
            "244 lbs  (111 kgs)" => "244 lbs  (111 kgs)",
            "245 lbs  (111 kgs)" => "245 lbs  (111 kgs)",
            "246 lbs  (112 kgs)" => "246 lbs  (112 kgs)",
            "247 lbs  (112 kgs)" => "247 lbs  (112 kgs)",
            "248 lbs  (112 kgs)" => "248 lbs  (112 kgs)",
            "249 lbs  (113 kgs)" => "249 lbs  (113 kgs)",
            "250 lbs  (113 kgs)" => "250 lbs  (113 kgs)",
            "251 lbs  (114 kgs)" => "251 lbs  (114 kgs)",
            "252 lbs  (114 kgs)" => "252 lbs  (114 kgs)",
            "253 lbs  (115 kgs)" => "253 lbs  (115 kgs)",
            "254 lbs  (115 kgs)" => "254 lbs  (115 kgs)",
            "255 lbs  (116 kgs)" => "255 lbs  (116 kgs)",
            "256 lbs  (116 kgs)" => "256 lbs  (116 kgs)",
            "257 lbs  (117 kgs)" => "257 lbs  (117 kgs)",
            "258 lbs  (117 kgs)" => "258 lbs  (117 kgs)",
            "259 lbs  (117 kgs)" => "259 lbs  (117 kgs)",
            "260 lbs  (118 kgs)" => "260 lbs  (118 kgs)",
            "261 lbs  (118 kgs)" => "261 lbs  (118 kgs)",
            "262 lbs  (119 kgs)" => "262 lbs  (119 kgs)",
            "263 lbs  (119 kgs)" => "263 lbs  (119 kgs)",
            "264 lbs  (120 kgs)" => "264 lbs  (120 kgs)",
            "265 lbs  (120 kgs)" => "265 lbs  (120 kgs)",
            "266 lbs  (121 kgs)" => "266 lbs  (121 kgs)",
            "267 lbs  (121 kgs)" => "267 lbs  (121 kgs)",
            "268 lbs  (122 kgs)" => "268 lbs  (122 kgs)",
            "269 lbs  (122 kgs)" => "269 lbs  (122 kgs)",
            "270 lbs  (122 kgs)" => "270 lbs  (122 kgs)",
            "271 lbs  (123 kgs)" => "271 lbs  (123 kgs)",
            "272 lbs  (123 kgs)" => "272 lbs  (123 kgs)",
            "273 lbs  (124 kgs)" => "273 lbs  (124 kgs)",
            "274 lbs  (124 kgs)" => "274 lbs  (124 kgs)",
            "275 lbs  (125 kgs)" => "275 lbs  (125 kgs)",
            "276 lbs  (125 kgs)" => "276 lbs  (125 kgs)",
            "277 lbs  (126 kgs)" => "277 lbs  (126 kgs)",
            "278 lbs  (126 kgs)" => "278 lbs  (126 kgs)",
            "279 lbs  (127 kgs)" => "279 lbs  (127 kgs)",
            "280 lbs  (127 kgs)" => "280 lbs  (127 kgs)",
            "281 lbs  (127 kgs)" => "281 lbs  (127 kgs)",
            "282 lbs  (128 kgs)" => "282 lbs  (128 kgs)",
            "283 lbs  (128 kgs)" => "283 lbs  (128 kgs)",
            "284 lbs  (129 kgs)" => "284 lbs  (129 kgs)",
            "285 lbs  (129 kgs)" => "285 lbs  (129 kgs)",
            "286 lbs  (130 kgs)" => "286 lbs  (130 kgs)",
            "287 lbs  (130 kgs)" => "287 lbs  (130 kgs)",
            "288 lbs  (131 kgs)" => "288 lbs  (131 kgs)",
            "289 lbs  (131 kgs)" => "289 lbs  (131 kgs)",
            "290 lbs  (132 kgs)" => "290 lbs  (132 kgs)",
            "291 lbs  (132 kgs)" => "291 lbs  (132 kgs)",
            "292 lbs  (132 kgs)" => "292 lbs  (132 kgs)",
            "293 lbs  (133 kgs)" => "293 lbs  (133 kgs)",
            "294 lbs  (133 kgs)" => "294 lbs  (133 kgs)",
            "295 lbs  (134 kgs)" => "295 lbs  (134 kgs)",
            "296 lbs  (134 kgs)" => "296 lbs  (134 kgs)",
            "297 lbs  (135 kgs)" => "297 lbs  (135 kgs)",
            "298 lbs  (135 kgs)" => "298 lbs  (135 kgs)",
            "299 lbs  (136 kgs)" => "299 lbs  (136 kgs)",
            "300 lbs  (136 kgs)" => "300 lbs  (136 kgs)",
                )
        ?>
        <?php echo $this->Form->input('Profile.weight', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'weight', 'options' => $status_options)); ?>
        <label>About Me</label>
        <?php echo $this->Form->input('Profile.about_me', array('type' => 'textarea', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'about_me')); ?>
        <label>His Identity</label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "Bear" => "Bear",
            "Bear Chaser" => "Bear Chaser",
            "Daddy" => "Daddy",
            "Daddy Chaser" => "Daddy Chaser",
            "Military" => "Military",
            "Jock" => "Jock",
            "Muscle" => "Muscle",
            "Leather" => "Leather",
            "Geek" => "Geek",
            "Transgender" => "Transgender",
            "Twink" => "Twink",
            "Poz" => "Poz",
            "Circuit" => "Circuit",
            "Bisexual" => "Bisexual",
            "Discreet" => "Discreet",
            "Nudist" => "Nudist",
            "Rugged" => "Rugged",
            "Clean Cut" => "Clean Cut",
            "Otter" => "Otter",
        );
        ?>
        <?php
        if ($user_details['Profile']['his_identitie']) {
//           $str_arr1 = substr($user_details['Profile']['his_identitie'],0,-1);
            $str_arr1 = $user_details['Profile']['his_identitie'];
            $sel1 = explode(',', $str_arr1);
        }
        ?>
        <?php echo $this->Form->input('Profile.his_identitie', array('type' => 'select', 'multiple' => true, 'selected' => $sel1, 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'his_identitie', 'options' => $status_options)); ?>
        <label>Relationship Status</label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "Single" => "Single",
            "In a Relationship" => "In a Relationship",
            "Dating" => "Dating",
            "Partnered" => "Partnered",
            "Married" => "Married",
            "Engaged" => "Engaged",
            "Open Relationship" => "Open Relationship",
            "Not Sure/Curious" => "Not Sure/Curious",
        );
        ?>
        <?php echo $this->Form->input('Profile.relationship_status', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'relationship_status', 'options' => $status_options)); ?>
        <label>Where I Leave</label>
        <?php echo $this->Form->input('Profile.where_I_leave', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'where_I_leave')); ?>
        <label>Facebook Link</label>
        <?php echo $this->Form->input('Profile.facebook_link', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'facebook_link')); ?>
        <label>Twitter Link</label>
        <?php echo $this->Form->input('Profile.twitter_link', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'twitter_link')); ?>
        <label>Linkedin Link</label>
        <?php echo $this->Form->input('Profile.linkedin_link', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'linkedin_link')); ?>


    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

