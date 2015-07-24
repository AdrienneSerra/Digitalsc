<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<?php echo item_search_filters(); ?>

<?php echo pagination_links(); ?>

<?php if ($total_results > 0): ?>

<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Creator')] = 'Dublin Core,Creator';
$sortLinks[__('Date')] = 'Dublin Core,Date';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php endif; ?>

<?php foreach (loop('items') as $item): ?>
	
<div class="collection-panel">
    		<div id="collection-container">
		

		<?php if(metadata('item', 'has thumbnail')): ?>
			<div class="panel-image">
 				<?php echo link_to_item(item_image('thumbnail')); ?> 
			</div>
		<?php endif; ?>
 			

			<div class="item-meta">
			<h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>

				<?php if($itemAbstract = metadata('item', array('Dublin Core', 'Abstract'))): ?>
                			<div class="item-description">
						<?php echo $itemAbstract; ?>
					</div>
				<?php elseif($itemDescription = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>150))): ?>
					<div class="item-description">
						<?php echo $itemDescription; ?>
					</div> 
				<?php endif; ?>

 				<?php if (metadata('item', 'has tags')): ?>
    					<div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
       					 <?php echo tag_string('items'); ?></p>
    					</div>
    				<?php endif; ?>

			</div><!--end class "item-meta"-->
    		
	</div><!-- end id="collection-container" -->
</div><!-- end class="collection-panel" -->
<?php endforeach; ?>
<?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
<?php echo pagination_links(); ?>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
