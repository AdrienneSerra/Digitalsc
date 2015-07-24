jQuery(function() {
	// ======================= imagesLoaded Plugin ===============================
	// https://github.com/desandro/imagesloaded

	// jQuery('#my-container').imagesLoaded(myFunction)
	// execute a callback when all images have loaded.
	// needed because .load() doesn't work on cached images

	// callback function gets image collection as argument
	//  this is the container

	// original: mit license. paul irish. 2010.
	// contributors: Oren Solomianik, David DeSandro, Yiannis Chatzikonstantinou

	jQuery.fn.imagesLoaded 		= function( callback ) {
	var jQueryimages = this.find('img'),
		len 	= jQueryimages.length,
		_this 	= this,
		blank 	= 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';

	function triggerCallback() {
		callback.call( _this, jQueryimages );
	}

	function imgLoaded() {
		if ( --len <= 0 && this.src !== blank ){
			setTimeout( triggerCallback );
			jQueryimages.off( 'load error', imgLoaded );
		}
	}

	if ( !len ) {
		triggerCallback();
	}

	jQueryimages.on( 'load error',  imgLoaded ).each( function() {
		// cached images don't fire load sometimes, so we reset src.
		if (this.complete || this.complete === undefined){
			var src = this.src;
			// webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
			// data uri bypasses webkit log warning (thx doug jones)
			this.src = blank;
			this.src = src;
		}
	});

	return this;
	};

	// gallery container
	var jQueryrgGallery			= jQuery('#rg-gallery'),
	// carousel container
	jQueryesCarousel			= jQueryrgGallery.find('div.es-carousel-wrapper'),
	// the carousel items
	jQueryitems				= jQueryesCarousel.find('ul > li'),
	// total number of items
	itemsCount			= jQueryitems.length;
	
	Gallery				= (function() {
			// index of the current item
		var current			= 0, 
			// mode : carousel || fullview
			mode 			= 'carousel',
			// control if one image is being loaded
			anim			= false,
			init			= function() {
				
				// (not necessary) preloading the images here...
				jQueryitems.add('<img src="images/ajax-loader.gif"/><img src="images/black.png"/>').imagesLoaded( function() {
					// add options
					_addViewModes();
					
					// add large image wrapper
					_addImageWrapper();
					
					// show first image
					_showImage( jQueryitems.eq( current ) );
						
				});
				
				// initialize the carousel
				if( mode === 'carousel' )
					_initCarousel();
				
			},
			_initCarousel	= function() {
				
				// we are using the elastislide plugin:
				// http://tympanus.net/codrops/2011/09/12/elastislide-responsive-carousel/
				jQueryesCarousel.show().elastislide({
					imageW 	: 65,
					onClick	: function( jQueryitem ) {
						if( anim ) return false;
						anim	= true;
						// on click show image
						_showImage(jQueryitem);
						// change current
						current	= jQueryitem.index();
					}
				});
				
				// set elastislide's current to current
				jQueryesCarousel.elastislide( 'setCurrent', current );
				
			},
			_addViewModes	= function() {
				
				// top right buttons: hide / show carousel
				
				var jQueryviewfull	= jQuery('<a href="#" class="rg-view-full"></a>'),
					jQueryviewthumbs	= jQuery('<a href="#" class="rg-view-thumbs rg-view-selected"></a>');
				
				jQueryrgGallery.prepend( jQuery('<div class="rg-view"/>').append( jQueryviewfull ).append( jQueryviewthumbs ) );
				
				jQueryviewfull.on('click.rgGallery', function( event ) {
						if( mode === 'carousel' )
							jQueryesCarousel.elastislide( 'destroy' );
						jQueryesCarousel.hide();
					jQueryviewfull.addClass('rg-view-selected');
					jQueryviewthumbs.removeClass('rg-view-selected');
					mode	= 'fullview';
					return false;
				});
				
				jQueryviewthumbs.on('click.rgGallery', function( event ) {
					_initCarousel();
					jQueryviewthumbs.addClass('rg-view-selected');
					jQueryviewfull.removeClass('rg-view-selected');
					mode	= 'carousel';
					return false;
				});
				
				if( mode === 'fullview' )
					jQueryviewfull.trigger('click');
					
			},
			_addImageWrapper= function() {
				
				// adds the structure for the large image and the navigation buttons (if total items > 1)
				// also initializes the navigation events
				
				jQuery('#img-wrapper-tmpl').tmpl( {itemsCount : itemsCount} ).appendTo( jQueryrgGallery );
				
				if( itemsCount > 1 ) {
					// addNavigation
					var jQuerynavPrev		= jQueryrgGallery.find('a.rg-image-nav-prev'),
						jQuerynavNext		= jQueryrgGallery.find('a.rg-image-nav-next'),
						jQueryimgWrapper		= jQueryrgGallery.find('div.rg-image');
						
					jQuerynavPrev.on('click.rgGallery', function( event ) {
						_navigate( 'left' );
						return false;
					});	
					
					jQuerynavNext.on('click.rgGallery', function( event ) {
						_navigate( 'right' );
						return false;
					});
				
					// add touchwipe events on the large image wrapper
					jQueryimgWrapper.touchwipe({
						wipeLeft			: function() {
							_navigate( 'right' );
						},
						wipeRight			: function() {
							_navigate( 'left' );
						},
						preventDefaultEvents: false
					});
				
					jQuery(document).on('keyup.rgGallery', function( event ) {
						if (event.keyCode == 39)
							_navigate( 'right' );
						else if (event.keyCode == 37)
							_navigate( 'left' );	
					});
					
				}
				
			},
			_navigate		= function( dir ) {
				
				// navigate through the large images
				
				if( anim ) return false;
				anim	= true;
				
				if( dir === 'right' ) {
					if( current + 1 >= itemsCount )
						current = 0;
					else
						++current;
				}
				else if( dir === 'left' ) {
					if( current - 1 < 0 )
						current = itemsCount - 1;
					else
						--current;
				}
				
				_showImage( jQueryitems.eq( current ) );
				
			},
			_showImage		= function( jQueryitem ) {
				
				// shows the large image that is associated to the jQueryitem
				
				var jQueryloader	= jQueryrgGallery.find('div.rg-loading').show();
				
				jQueryitems.removeClass('selected');
				jQueryitem.addClass('selected');
					 
				var jQuerythumb		= jQueryitem.find('img'),
					largesrc	= jQuerythumb.data('large'),
					title		= jQuerythumb.data('description');
					link 	=jQuerythumb.data('link');
					original = jQuerythumb.data('zoom-image');
				
				jQuery('<img/>').load( function() {
					
					jQueryrgGallery.find('div.rg-image').empty().append('<img class="zoom-image" src="' + largesrc + '" data-zoom-image="' + original + '"/>');
					
					

				jQuery('.zoom-image').click(
					function(){
					jQuery('.zoom-image').elevateZoom({
						
						 
						zoomType: "inner",
						scrollZoom: true
					

						});
					});
					
				
					
				
					jQuery('.rg-image-nav-next').click(function(){
						jQuery('.zoomContainer').remove();
						});
					jQuery('.rg-image-nav-prev').click(function(){
						jQuery('.zoomContainer').remove();
						});

					

					if(typeof title !== 'undefined' && title !== false)
						jQueryrgGallery.find('div.rg-caption').show().children('p').html( title );
					
		
          				 jQuery('.tooltip').tooltipster({
                				contentAsHTML: true,
						interactive: true,
						interactiveTolerance: 500
		
            					});
        


					jQueryloader.hide();
					
					if( mode === 'carousel' ) {
						jQueryesCarousel.elastislide( 'reload' );
						jQueryesCarousel.elastislide( 'setCurrent', current );
					}
					
					anim	= false;
					
					jQueryrgGallery.find('div.rg-zoom-tips').text('Click on the image to magnify, scroll to adjust the zoom, click on the image thumbnail remove the magnifier');
					
					jQueryrgGallery.find('div.rg-photo-index').html('Page '+ (current + 1) +' of '+ itemsCount);
					
					

					jQueryrgGallery.find('div.rg-page-link').html( link );
				
					}).attr( 'src', largesrc );
				
			},
		

			addItems		= function( jQuerynew ) {
			
				jQueryesCarousel.find('ul').append(jQuerynew);
				jQueryitems 		= jQueryitems.add( jQuery(jQuerynew) );
				itemsCount	= jQueryitems.length; 
				jQueryesCarousel.elastislide( 'add', jQuerynew );
			
			};
		
		return { 
			init 		: init,
			addItems	: addItems
		};
	
	})();

	Gallery.init();
	
	/*
	Example to add more items to the gallery:
	
	var jQuerynew  = jQuery('<li><a href="#"><img src="images/thumbs/1.jpg" data-large="images/1.jpg" alt="image01" data-description="From off a hill whose concave womb reworded" /></a></li>');
	Gallery.addItems( jQuerynew );
	*/
});