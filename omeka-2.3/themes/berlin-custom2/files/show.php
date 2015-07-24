<?php
    $fileTitle = metadata('file', array('Dublin Core', 'Title')) ? strip_formatting(metadata('file', array('Dublin Core', 'Title'))) : metadata('file', 'original filename');

    if ($fileTitle != '') {
        $fileTitle = ': &quot;' . $fileTitle . '&quot; ';
    } else {
        $fileTitle = '';
    }
    $fileTitle = __('File #%s', metadata('file', 'id')) . $fileTitle;
?>
<?php echo head(array('title' => $fileTitle, 'bodyclass'=>'files show primary-secondary')); ?>

<h1><?php echo $fileTitle; ?></h1>
<?php $item_id = metadata('file', 'item_id'); ?>
		<?php $item = get_record_by_id('item', $item_id); ?>
		<?php set_current_record('item', $item); ?>
<h2>This file is from <?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>
<div class="file-left-panel">
    <?php echo file_markup($file, array('imageSize'=>'thumbnail')); ?>
</div>
 <?php if(metadata($file, array('PDF Text', 'Text'))): ?>
<div class="file-right-panel">
       <div class="element">
 		<h3>Transcription</h3>
		<div class="element-text">
			<?php echo metadata($file, array('PDF Text', 'Text'))?> 
    		</div>
   </div>
</div>
<?php endif; ?>
<div class="element-text">
		<?php echo all_element_texts('file'); ?>
 	</div>
<?php echo foot();?>
