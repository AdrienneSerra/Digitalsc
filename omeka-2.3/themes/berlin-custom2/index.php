<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
 
<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>
<div id="left-panel">
<div class="description-container"><h7>Welcome to Virginia Tech Special Collections Online!</h7></div>
<!-- Slider -->
<div class="slider-box">
<div id="homeCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#homeCarousel" data-slide-to="1"></li>
    <li data-target="#homeCarousel" data-slide-to="2"></li>
    <li data-target="#homeCarousel" data-slide-to="3"></li>
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
     <div class="active item">
<img alt="uniform" src="http://omeka.lib.vt.edu/files/thumbnails/carousel_images/cadetuniform.jpg">
<div class="carousel-caption">
<h4><a href="https://omeka.lib.vt.edu/collections/show/22">The Virginia Tech Cadet Corps Museum</a></h4>
<p>See the entire museum collection, documenting the history of the Virginia Tech Corps of Cadets</p>
</div>
</div>
    <?php $featuredItems= get_records('Item', array('featured'=> true), 3); ?>
    <?php set_loop_records('Item', $featuredItems); ?>
    <?php if(has_loop_records('Item')): ?>
    <?php foreach(loop('Items') as $item): ?>
   <div class="item">
<?php $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>
<?php if(count($item->Files)>4): ?>
      <?php echo item_image('thumbnail', array('alt' => $itemTitle),3); ?>
  <?php elseif(count($item->Files)<5): ?>
  <?php echo item_image('thumbnail', array('alt' => $itemTitle)); ?>
<?php endif; ?>
            <div class="carousel-caption">

                <h4>Featured Item: <?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></h4>
                    <?php if($itemAbstract = metadata('Item', array('Dublin Core', 'Abstract'))): ?>
                        <p><?php echo $itemAbstract; ?></p>
                    <?php elseif($itemDescription = metadata('Item', array('Dublin Core', 'Description'), array('snippet'=>150))): ?>
                        <p><?php echo $itemDescription; ?></p>
                     <?php endif; ?>
            </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
   </div>
    <a class="carousel-control left" href="#homeCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#homeCarousel" data-slide="next">&rsaquo;</a>
    </div>
</div><!-- end slider -->

<div class="description-text">This site features digital collections of rare and unique materials such as letters, diaries, photographs, films, maps, newspapers, posters, reports and other media from the Special Collections of Virginia Tech.</div>
 
</div><!-- end left-panel -->

<!-- right-panel -->
<div id="right-panel">
<div class="spacer-box"></div>
<h9>Browse Content by...</h9>
<div class="navigation-container">
<a href="https://omeka.lib.vt.edu/collections/browse">
<div id="navigation-panel">
<img src="http://omeka.lib.vt.edu/themes/berlin-custom/images/turrillletter2.png">
<div class="navigation-title"><h8>Collections</h8></div>
</div>
</a>

<a href="exhibits">
<div id="navigation-panel">
<img src="http://omeka.lib.vt.edu/themes/berlin-custom/images/neatline-exhibit2.png">
<div class="navigation-title"><h8>Exhibits</h8></div>
</div>
</a>

<a href="about-us">
<div id="navigation-panel">
<img src="http://omeka.lib.vt.edu/themes/berlin-custom/images/readingroom.png">
<div class="navigation-title"><h8>Services</h8></div>
</div>
</a>

 </div>
<!-- Recent Items -->
    <div id="recent-items">
        <h2><?php echo __('Recently Added Items'); ?></h2>
        <?php
        $homepageRecentItems = (int)get_theme_option('Homepage Recent Items') ? get_theme_option('Homepage Recent Items') : '3';
        set_loop_records('items', get_recent_items($homepageRecentItems));
        if (has_loop_records('items')):
        ?>
        <ul class="items-list">
        <?php foreach (loop('items') as $item): ?>
        <li class="item">
            <h3><?php echo link_to_item(); ?></h3>
            <?php if($itemDescription = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>150))): ?>
                <p class="item-description"><?php echo $itemDescription; ?></p>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p><?php echo __('No recent items available.'); ?></p>
        <?php endif; ?>
        <p class="view-items-link"><?php echo link_to_items_browse(__('View All Items')); ?></p>
    </div><!-- end recent-items -->
</div><!-- end right-panel -->

<?php echo foot(); ?>

