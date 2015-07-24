<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>

<h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>
<div id="primary">
<?php if(count($item->Files)>1): ?>
<?php $index = 0; ?>
<?php $total = count($item->Files); ?>
<div id="rg-gallery" class="rg-gallery">
    <div class="rg-thumbs">
        <!-- Elastislide Carousel Thumbnail Viewer -->
        <div class="es-carousel-wrapper">
            <div class="es-nav">
                <span class="es-nav-prev">Previous</span>
                <span class="es-nav-next">Next</span>
            </div>
            <div class="es-carousel">
                <ul>				
				
				<?php foreach (loop('files', $item->Files) as $index => $file): ?> 
					
					 <li><a href="#" title="Page <?php echo $index + 1; ?> of <?php echo $total; ?>"><img src="<?php echo file_display_url($file, 'square_thumbnail')?>" data-large="<?php echo file_display_url($file, 'thumbnail')?>" data-zoom-image="<?php echo file_display_url($file, 'original')?>" alt="<?php echo metadata($file, array('Dublin Core', 'Title'))?>" data-description="<?php echo metadata($file, array('Scripto', 'Transcription'))?>" data-link='<?php echo link_to_file_show(array('class'=>'show', 'target'=>__('_blank'), 'title'=>__('View Page Metadata')), 'View Page Details')?>' />
                        </a>
					</li>
                		<?php $index++; ?>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
<!-- End Elastislide Carousel Thumbnail Viewer -->
</div>
</div>
<!-- End Gallery Html Containers -->

<div class="note">(Note: Some features on this page may not work in Internet Explorer. If you do not see a large image below the thumbnails, try refreshing the page several times or use a different browser.)</div>

<?php endif; ?>

<?php if (count($item->Files)<2): ?>
	<?php foreach (loop('files', $item->Files) as $index => $file): ?> 
         <div id="left-panel">
		<div class="note">Click on the image to magnify, scroll to adjust the zoom</div>
		<div class="item-file">
			<img class="zoom-file" src="<?php echo file_display_url($file, 'thumbnail')?>" data-zoom-image="<?php echo file_display_url($file, 'original')?>"/>
        	</div>
	<h3><?php echo link_to_file_show(array('class'=>'show', 'target'=>__('_blank'), 'title'=>__('View Page Metadata')), 'View Page Details')?></h3>
	</div>
	<div id="right-panel">
    		<div class="element">
			<h3>Transcription</h3>
				<div class="element-text">
					<?php echo metadata($file, array('PDF Text', 'Text'))?> 
    				</div>
   			</div>
	</div>
	<?php endforeach; ?>
<?php endif; ?>
</div><!-- end primary -->
<div id="primary">
    
    <?php echo all_element_texts('item'); ?>
    
    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

</div><!-- end primary -->

<aside id="sidebar">

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (metadata('item', 'Collection Name')): ?>
    <div id="collection" class="element">
        <h2><?php echo __('Collection'); ?></h2>
        <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
    </div>
    <?php endif; ?>

    <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata('item', 'has tags')): ?>
    <div id="item-tags" class="element">
        <h2><?php echo __('Tags'); ?></h2>
        <div class="element-text"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif;?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2><?php echo __('Citation'); ?></h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>

</aside>

<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>

<?php echo foot(); ?>
