<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>


    <h1><?php echo metadata('item', array('Dublin Core','Title')); ?></h1>

    <?php
    $titles = metadata('item',array('Dublin Core','Title'),array('all'));

    if(count($titles) > 1):
    ?>
    <h3><?php echo __('All Titles'); ?></h3>
    <ul class="title-list">
        <?php foreach($titles as $title): ?>
            <li class="item-title">
                <?php echo $title; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
<!---- This section describes different viewer options. If your item is a PDF, audio/video or panorama, you need to select one of these from the Viewer field in Item Type Metadata in order for these to display correctly -->
   <?php $viewer = metadata($item, array('Item Type Metadata', 'Viewer')); ?>
    <?php switch ($viewer):
	case 'PDF': ?>
            <?php echo files_for_item(); ?>          
		<?php break; ?>

        <?php case 'AV': ?>
            <?php echo files_for_item(); ?>
            <?php break; ?>

	<?php case 'Panorama': ?>
	<?php foreach (loop('files', $item->Files) as $index => $file): ?>
	<div class="item-file">
			<img src="<?php echo file_display_url($file, 'fullsize')?>"/>
        	</div>
		<script type="text/javascript">
			window.onload = function() {
            			viewer = new PanoradoJS(document.getElementById("pano"));
            			viewer.image = { src: "<?php echo file_display_url($file, 'original')?>", projection: "spherical", gridSize: "8°", scale: "1", };
        		 	}
 		</script>
	<div class="item-file">
		<canvas id="pano" style="width:100%;height:450px">Please update your browser for HTML5 support!</canvas>
		<a href="http://www.panorado.com" target="_blank">Viewer by Panorado</a>
	</div>
	<h3><?php echo link_to_file_show(array('class'=>'show', 'target'=>__('_blank'), 'title'=>__('View Page Metadata')), 'View Page Details')?></h3>

    <?php endforeach; ?>
            <?php break; ?>

        <?php case 'OHMS': ?>   
        <iframe src='/ohms-viewer/viewer.php?cachefile=<?php echo metadata($item, array('Dublin Core', 'Identifier')); ?>.xml' width=100% height=900px><a href='/ohms-viewer/viewer.php?cachefile=<?php echo metadata($item, array('Dublin Core', 'Identifier')); ?>.xml' target='_blank'>Listen here</a></iframe>
        <?php break; ?>
        
      	<?php case 'default': ?>
	<?php default: ?>
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
					
					 <li><a href="#" title="Page <?php echo $index + 1; ?> of <?php echo $total; ?>"><img src="<?php echo file_display_url($file, 'square_thumbnail')?>" data-large="<?php echo file_display_url($file, 'fullsize')?>" data-zoom-image="<?php echo file_display_url($file, 'original')?>" alt="<?php echo metadata($file, array('Dublin Core', 'Title'))?>" data-description="<?php echo metadata($file, array('Scripto', 'Transcription'))?>" data-link='<?php echo link_to_file_show(array('class'=>'show', 'target'=>__('_blank'), 'title'=>__('View Page Metadata')), 'View Page Details')?>' />
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
		<div class="item-file">
			<img class="zoom-file" src="<?php echo file_display_url($file, 'fullsize')?>" data-zoom-image="<?php echo file_display_url($file, 'original')?>"/>
			<div class="note">Click on the image to magnify, scroll to adjust the zoom</div>
        	</div>
	<h3><a href="<?php echo file_display_url($file, 'original')?>" target="_blank">View Fullsize Image</a></h3>
	</div>
 <?php if(metadata($file, array('PDF Text', 'Text'))): ?>
	<div id="right-panel">
    <h3>Transcription</h3>
	<div class="element-text">
		<?php echo metadata($file, array('PDF Text', 'Text'))?> 
    </div>
   </div>
	<?php endif; ?>
	 <?php endforeach; ?>
 <?php endif; ?>
 <?php endswitch ?>

 <!-- Items metadata -->
    <div id="item-metadata">
      

 <?php echo all_element_texts('item'); ?>

    
   <?php if(metadata('item','Collection Name')): ?>
      <div id="collection" class="element">
        <h3><?php echo __('Collection'); ?></h3>
        <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
      </div>
   <?php endif; ?>
</section>
     <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata('item','has tags')): ?>
    <div id="item-tags" class="element">
        <h3><?php echo __('Tags'); ?></h3>
        <div class="element-text"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif;?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h3><?php echo __('Citation'); ?></h3>
        <div class="element-text"><?php echo metadata('item','citation',array('no_escape'=>true)); ?></div>
    </div>
       <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>


    <ul class="item-pagination navigation">
        <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
        <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
    </ul>
</div>
</div> <!-- End of Primary. -->
<?php echo foot(); ?>

