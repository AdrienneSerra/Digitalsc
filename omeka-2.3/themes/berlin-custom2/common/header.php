<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="http://omeka.lib.vt.edu/files/thumbnails/website%20logos/favicon.ico" type="image/x-icon"/>
    <link href='http://fonts.googleapis.com/css?family=Niconne' rel='stylesheet' type='text/css'>
	<?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>

    <title><?php echo option('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <?php fire_plugin_hook('public_head',array('view'=>$this)); ?>
    <!-- Stylesheets -->
   
	
	<?php
    queue_css_file('style');
    queue_css_file('skeleton');
    queue_css_file('elastislide');
	queue_css_file('rgstyle');
	queue_css_file('tooltipster');
	queue_css_file('timeline');
	queue_css_file('jquery.fancybox');
echo head_css();
    ?>
<script src="https://youcanbook.me/resources/scripts/ycbm.modal.js"></script>
<link rel="stylesheet" href="https://youcanbook.me/resources/css/simplemodal/simplemodal.css" type="text/css"/>

    <!-- JavaScripts -->
    

<?php queue_js_file('vendor/modernizr'); ?>
    <?php queue_js_file('vendor/selectivizr', 'javascripts', array('conditional' => '(gte IE 6)&(lte IE 8)')); ?>
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
<?php queue_js_file('panorado_min'); ?>
<?php queue_js_file('jquery.fancybox.pack'); ?>

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


        <div id="header" class="row">
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
            <div id="site-title" class="container">
				<a id="vt-header" title="Virginia Tech Home Page" href="http://www.vt.edu/"></a>
				<a id="unit-header" title="VT Special Collections Online Home" href="http://omeka.lib.vt.edu/"></a>
			</div>
            <div id="search-container">
                <h2>Search</h2>
                    <?php echo search_form(array('show_advanced'=>TRUE)); ?>
            </div>
</div>
	
  <div id="header-image">       
   <div id="wrap">
	<div id="primary-nav" role="navigation">
               <?php
                    echo public_nav_main();
               ?>
           </div>
                  <div id="mobile-nav" role="navigation" aria-label="<?php echo __('Mobile Navigation'); ?>">
             <?php
                  echo public_nav_main();
             ?>
         </div>
 
    	<div id="content">

   
<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>


