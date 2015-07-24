<?php 
function get_first_collection_images() {
	if (metadata('collection', 'total_items') > 0) {
		/* find child items  */
		$collectionId = metadata('collection','id');
		$childArray=get_child_collections($collectionId);
		$thumbnailCount=0;
		$childCount=0;
		while ($thumbnailCount <= 3):
			$childID=$childArray[$childCount]['id'];
			set_current_record('collection', get_record_by_id('collection', $childID));
			while (loop('items') AND $thumbnailCount <= 3){
				echo item_thumbnail();
				$thumbnailCount++;
			}
			$childCount++;
		endwhile;
	} else {
	while(loop('items',4)) echo item_thumbnail();
	return $html;
	}
}
function get_child_collections($collectionId) {
    if(plugin_is_active('CollectionTree')) {
        $treeChildren = get_db()->getTable('CollectionTree')->getChildCollections($collectionId);
        $childCollections = array();
        foreach($treeChildren as $treeChild) {
            $childCollections[] = get_record_by_id('collection', $treeChild['id']);
        }
        return $childCollections;
    }
    return array();
}
?>
