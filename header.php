<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package portknow
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:300,300i,400" rel="stylesheet"> 

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'portknow' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<!-- <button id="ss" style="position: fixed; bottom: 100px;">as</button> -->
		
		<div id="bg-top-head"><div class="top-head">
			<h1 hidden class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
				</a>
			</h1>

			<div id="post-navigation" class="navigation-class nav-first" role="navigation">
				<i class="material-icons ico-menu menu-mob-top" onclick="openNav()">menu</i>
				<span>
				
				<span id="nav-first-title">Menu</span>
				<?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
				</span>
				
			</div><!-- #site-navigation -->

			<div class="site-branding">			

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img id="ass" class="aligncenter" src="<?php bloginfo('template_url'); ?>/img/bacapikiranputih.svg" />
				</a>
			</div><!-- .site-branding -->
			<div class="top-right">
				<div id="top-search" class=""> 
					<?php get_search_form(); ?>
					<i class="material-icons close-top-ico">close</i>	
				</div>
				<div style="position: relative;height: 100%;">
					<div id=top-ico>
						<i class="material-icons search-top-ico">search</i>
						<!-- <i class="material-icons">person</i> -->
						<?php 
							if (is_user_logged_in ()) {
								$cu_user = wp_get_current_user();
								// $cu_id = $cu_user->ID;
								// echo get_avatar($cu_id,'30');
								echo '<a href="';
								echo get_permalink( get_page_by_path( 'edit-user' ) );

								echo '" class="hover_op usr">'.$cu_user->display_name.'</a>'; 
							?><a href="<?php echo wp_logout_url( home_url() ); ?>" class="hover_op lgt" >Logout</a>
						<?php } else {
						?>

						<a href="#openModal"><button class="lgn">Masuk</button></a><a href="<?php echo get_permalink( get_page_by_path( 'daftar' ) ); ?>"><button class="rgt">Daftar</button></a>
						<?php } ?>
					</div>	
				</div>
			</div>
		</div></div>
		<div class="bot-head">
		
				<?php if (is_front_page()) : ?>
			<div class="as">
				<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
			</div>
				<?php endif; endif;?>
		
		</div>
		<?php if(!is_front_page()): ?>
		<div class="nav-head" <?php echo (is_user_logged_in()? 'style="top: 382px;"' : '' );?>>
			<div id="site-navigation" class="navigation-class nav-second">
				<?php wp_nav_menu (array('theme_location' => 'secondary-menu','menu_class' => 'nav'));?>
			</div>
			<div class="mob-menu">
				<i class="material-icons ico-menu" onclick="openNav()">menu</i>
				<div class="search-bar"><?php get_search_form(); ?></div>
			</div>
		</div>
	<?php endif;?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">


<!-- Side nav -->

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

	<div id="sideavatar">

		<?php 
			if (is_user_logged_in ()) {
				$cu_user = wp_get_current_user();
				$cu_id = $cu_user->ID;
				echo get_avatar($cu_id,'80');
				echo '<a href="';
				echo get_permalink( get_page_by_path( 'edit-user' ) );

				echo '" class="hover_op usr">'.$cu_user->display_name.'</a>'; 
			?><a href="<?php echo wp_logout_url( home_url() ); ?>" class="hover_op lgt" >Logout</a>
		<?php }
		?>
	</div>

  <?php wp_nav_menu (array('theme_location' => 'primary','menu_class' => 'nav'));?>
</div>



<!-- LOGIN FORM POPUP -->

<div id="openModal" class="modalDialog">
    <div>	<a href="#close" title="Close" class="close">X</a>
    <h2>Silahkan Login</h2>
    <?php echo do_shortcode('[wppb-login]'); ?>
    </div>
</div>




