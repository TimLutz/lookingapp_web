<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
    <link href="<?php bloginfo('template_url'); ?>/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
    <script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('img').each(function(){
				var href = jQuery(this).attr('src').replace("[url]", "<?php bloginfo('template_url'); ?>");
				jQuery(this).attr('src', href);
			});
		});
</script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
</head>
<body <?php body_class(); ?>>
<header id="menu-area">
<nav class="navbar navbar-default main-navbar top" role="navigation">  
        <div class="navbar-header">

          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

            <span class="sr-only">Toggle navigation</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

          </button>

          <!-- LOGO -->                                               

           <a class="navbar-brand logo" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="logo" /></a>                      

        </div>
       <div id="navbar" class="navbar-collapse collapse top_right">

          <ul id="top-menu" class="nav navbar-nav main-nav menu-scroll top_nav">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
          </ul>                            

        </div>        
    </nav>
</header>
