<?php
$pageTitle = __('Browse Collections');
echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));
?>

<h1><?php echo $pageTitle; ?></h1>
<?php echo pagination_links(); ?>

<?php foreach (loop('collections') as $collection): ?>

<div class="collection-panel">
<div id="collection-container">
<div class="item-meta">
    <h2><?php echo link_to_collection(metadata('collection', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>

    <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
    <div class="item-description">
        <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
	</div>
    <?php endif; ?>
 
    <p class="view-items-link"><?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))), array('collection' => metadata('collection', 'id'))); ?></p>

    <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
</div>
</div>

</div><!-- end class="collection-panel" -->

<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

<?php echo foot(); ?>
