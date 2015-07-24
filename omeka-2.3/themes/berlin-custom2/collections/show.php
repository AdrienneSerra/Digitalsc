<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
if ($collectionTitle == '') {
    $collectionTitle = __('[Untitled]');
}
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>

<h1><?php echo $collectionTitle; ?></h1>

<?php echo all_element_texts('collection'); ?>

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>


<div id="collection-items">
   
    <?php if (metadata('collection', 'total_items') > 0): ?>
 
        <?php foreach (loop('items') as $item): ?>
       
		<div class="collection-panel">
		
		
		<?php if(metadata('item', 'has thumbnail')): ?>
		<div class="panel-image">
 			<?php echo link_to_item(item_image('thumbnail')); ?> 
		</div>
		<?php endif; ?>

		<div class="item-meta">
 			<h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>


			<?php if($itemAbstract = metadata('item', array('Dublin Core', 'Abstract'))): ?>
                		<div class="item-description"><?php echo $itemAbstract; ?>
				</div>
			<?php elseif($itemDescription = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>150))): ?>
				<div class="item-description"><?php echo $itemDescription; ?>
				</div> 
			<?php endif; ?>
			</div><!-- end item-meta -->
			
			</div><!-- end collection-panel -->
			<?php endforeach; ?>
<h2><?php echo link_to_items_browse(__('View all Items in the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h2>
    <?php else: ?>
<div class="description-container"><h7>Sorry, there are no items in this collection yet.</h7></div>
    <?php endif; ?>
</div><!-- end collection-items -->


<?php echo foot(); ?>
