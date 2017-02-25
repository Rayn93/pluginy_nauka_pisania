<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />

        <?php if (is_search()): ?>
            <meta name="robots" content="noindex, nofollow" /> 
        <?php endif; ?>

        <title>
		
			<?php
				//echo bloginfo('name');
				//echo wp_title();
				
				if(is_archive()) {
					echo ucfirst(trim(wp_title('', false))) . ' - ';
				} else
				
				if(!(is_404()) && (is_single()) || (is_page())) {
					$title = wp_title('', false);
					if(!empty($title)) {
						echo $title . ' - ';
					}
				} else
				
				if(is_404()) {
					echo 'Nie znaleziono strony';
				}
				
				if(is_home()) {
					bloginfo('name');
					echo ' - ';
					bloginfo('description');
				} else {
					echo bloginfo('name');
				}
				
				global $paged;
				if($paged > 1) {
					echo ' - strona ' . $paged;
				}
				
			?>
		
		</title>

        <link rel="shortcut icon" href="/favicon.ico">

        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <link rel="stylesheet" href="<?php echo LOVETOEAT_THEME_URL; ?>/css/reset.css">
        <link rel="stylesheet" href="<?php echo LOVETOEAT_THEME_URL; ?>/css/common.css">
        <link rel="stylesheet" href="<?php echo LOVETOEAT_THEME_URL; ?>/css/food-fight.css">

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <?php wp_head(); ?>

        <script src="<?php echo LOVETOEAT_THEME_URL; ?>/js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo LOVETOEAT_THEME_URL; ?>/js/food-fight.js"></script>
    </head>
    
    <body <?php body_class(); ?>>