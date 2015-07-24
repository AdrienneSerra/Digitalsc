// JavaScript Document


jQuery('.zoom-file').click(
	function(){
		jQuery('.zoom-file').elevateZoom({		 
			zoomType: "inner",
			scrollZoom: true
			});
		});
					


jQuery('.zoom-file').click(function(){
	jQuery('.zoomContainer').remove();
	});
