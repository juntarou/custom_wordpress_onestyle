<?php
/*
template Name: ページサービス
*/
?>
<?xml version="1.0" encoding="shift_jis"?><!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<meta name="description" content="ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー">
<meta name="keywords" content="ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー">

<!-- スマホ用設定 -->
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
<meta name="format-detection" content="telephone=no">
<link rel="apple-touch-icon" href="/sp/img/apple-touch-icon.png">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<script src="js/jquery.js"></script>
<!--script src="js/sp_display.js"></script-->
<script type="text/javascript">try { var lb = new Vesicomyid.Bivalves("109156"); lb.init(); } catch(err) {} </script>
</head>

<body class="s-service gmoseo s-seoservice">
<header class="globalHeader">
<a href="<?php home_url(); ?>"><p class="logo">SMART PHONE SITE SAMPLE</p></a>
<?php if(have_posts()):while(have_posts()):the_post(); ?>
<div class="bar">
	<h1><?php the_title(); ?></h1>
</div>
</header><!-- #header -->

<section class="service">

<?php the_content(); ?>

<?php endwhile;endif; ?>

</section>

<?php get_footer(); ?>
