<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_url('//fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
    queue_css_file('normalize');
    queue_css_file('style', 'screen');
    queue_css_file('print', 'print');
	 queue_css_file('elastislide');
	queue_css_file('rgstyle');
	queue_css_file('tooltipster');
	queue_css_file('timeline');
    echo head_css();
    ?>
<script src="https://youcanbook.me/resources/scripts/ycbm.modal.js"></script>
<link rel="stylesheet" href="https://youcanbook.me/resources/css/simplemodal/simplemodal.css" type="text/css"/>
    <!-- JavaScripts -->
    <?php queue_js_file('vendor/modernizr'); ?>
    <?php queue_js_file('vendor/selectivizr'); ?>
    <?php queue_js_file('jquery-extra-selectors'); ?>
    <?php queue_js_file('vendor/respond'); ?>
    <?php queue_js_file('globals'); ?>
     <?php queue_js_file('bootstrap.min'); ?>
	<?php queue_js_file('jquery.tmpl.min'); ?>
	<?php queue_js_file('jquery.beforeafter-1.4'); ?>
	<?php queue_js_file('jquery.elastislide'); ?>
	<?php queue_js_file('jquery.tooltipster'); ?>
	<?php queue_js_file('jquery.elevatezoom'); ?>
	<?php queue_js_file('gallery'); ?>
<?php queue_js_file('timeline'); ?>
    <?php echo head_js(); ?>
    <script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">
			<div class="rg-photo-index"></div>	
			<div class="rg-zoom-tips"></div>	
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image"></div>
				<div class="rg-loading"></div>
				
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<p></p>
					</div>
				</div>
				<div class="rg-page-link"></div>
			</div>
		</script>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <div id="wrap">
        <header>
            <div id="site-title">
                <?php echo link_to_home_page(theme_logo()); ?>
            </div>
            <div id="search-container">
                <?php echo search_form(array('show_advanced' => true)); ?>
            </div>
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        </header>

        <nav class="top">
            <?php echo public_nav_main(); ?>
        </nav>

        <div id="content">
