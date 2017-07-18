<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>Looking :: Administrator 
            <?php
            if (empty($title_for_layout)) {
                ?>
                Administrator Panel
                <?php
            } else {
                echo $title_for_layout;
            }
            ?>
        </title>

        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $this->Html->script(array('jquery-1.11.0.min','jquery.validate')); ?>
        <?php
        echo $this->Html->meta('icon');
        
        //echo $this->Html->css('admin/theme');
        echo $this->Html->css('files/font-awesome/css/font-awesome');
     
        
        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>

        <style type="text/css">
            #line-chart {
                height:300px;
                width:800px;
                margin: 0px auto;
                margin-top: 1em;
            }
            .brand { font-family: georgia, serif; }
            .brand .first {
                color: #ccc;
                font-style: italic;
            }
            .brand .second {
                color: #fff;
                font-weight: bold;
            }
        </style>
	 

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
    <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
    <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
    <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> 
    <body class=""> 
        <!--<![endif]-->

        <!-- Top navigation start -->
       
        <!-- Top navigation end -->

       

        <div class="content" <?php if (!$this->Session->check('Auth.Admin')) { ?>style="margin-left: 0;"<?php } ?>>

            <?php
            if ($this->Session->check('Auth.Admin')) {
                ?>
                <!-- Page heading start -->
                <!--<div class="header">
                <?php //pr($this->request);exit;  ?>
                    <h1 class="page-title">Users</h1>
                </div>-->
                <!-- Page heading end -->
                <?php
            }
            ?>

            <!-- Inner container start -->
            <div class="container-fluid">
                <div class="row-fluid">

                    <?php
                    /*if($this->Session->check('msg_error')){
                        echo $this->Session->read('msg_error');//exit;
                        $this->Session->delete('msg_error');
                    }
                    if ($this->Session->valid('msg_success')) {
                        $allFlash = $this->Session->flash('msg_success');
                        $msgCls = 'alert-success';
                    } elseif ($this->Session->valid('msg_error')) {
                        $allFlash = $this->Session->flash('msg_error');
                        $msgCls = 'alert-error';
                    }

                    if ($allFlash) {
                        ?>
                        <!-- Message div start -->
                        <div class="alert <?php echo $msgCls; ?>">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span id="message"><strong><?php echo $allFlash; ?></strong></span>
                        </div>
                        <!-- Message div end -->
                        <?php
                    }*/
                    echo $this->Session->flash('notification');
                    ?>

                    <!-- Content area start -->
                    <?php echo $this->fetch('content'); ?>
                    <!-- Content area end -->



                </div>
            </div>
            <!-- Inner container end -->

        </div>
        <!-- Content end -->



        


    </body>
</html>
