<div class="navbar">
            <div class="navbar-inner">
                    <?php
                    if($this->Session->check('Auth.Admin')){
                    ?>
                    <ul class="nav pull-right">

                        <li id="fat-menu" class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user"></i> <?php echo $this->Session->read('Auth.Admin.display_name'); ?>
                                <i class="icon-caret-down"></i>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'profile', 'admin' => TRUE)); ?>">Update Profile</a></li>
                                <li class="divider"></li>
                                <li><a tabindex="-1" class="visible-phone" href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'settings', 'admin' => TRUE)); ?>">Settings</a></li>
                                <li class="divider visible-phone"></li>
                                <li><a tabindex="-1" href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'logout', 'admin' => TRUE)); ?>">Logout</a></li>
                            </ul>
                        </li>

                    </ul>
                    <?php
                    }
                    ?>
                    <a class="brand" href="#"><!--<span class="first">Looking</span> <span class="second">Admin</span>--> <img src="<?php echo $this->webroot; ?>img/admin-logo.png" alt="logo"></a>
            </div>
        </div>
