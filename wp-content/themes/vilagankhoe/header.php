<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<!--[if lt IE 9]>
		<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>		
		<div id="page" class="hfeed site">
			<header id="masthead" class="site-header" role="banner">
				<div class="container">
					<div class="row top">
						<div class="one-third column " id="logo">							
							<?php if (is_front_page() || is_home()) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo.png" alt=""/></a></h1>
							<?php else : ?>
								<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo.png" alt=""/></a></p>
							<?php endif;
							?>
						</div>
						<div class="two-thirds column" id="search-nav">
							<form id="search" class="column offset-by-four" action="<?= get_permalink(82) ?>">
								<input type="hidden" name="cx" value="partner-pub-008542593403486818317:fokhjyjrd0s" /> 
								<input type="hidden" name="cof" value="FORID:10" /> 
								<input type="hidden" name="ie" value="ISO-8859-1" /> 
								<input type="text" name="q" value="" placeholder="Nhập từ khóa" />
								<input type="submit" name="submit" value=""/>
							</form>
							<script type="text/javascript" src="http://www.google.com/cse/brand?form=cse-search-box&amp;lang=vi"></script>
							<nav >
								<?php
								wp_nav_menu(
										array(
											'theme_location' => 'header-menu',
											'menu_id' => 'menu'));
								?>
							</nav>
						</div>
					</div>
					<div class="row slogan tag-line">						
						<h2 id="tamsoat" class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div>
				</div>
			</header>
			<div id="main" class="site-main">