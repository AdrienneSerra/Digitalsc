if (!Omeka) {
    var Omeka = {};
}

(function (jQuery) {
    Omeka.showAdvancedForm = function () {
        var advancedForm = jQuery('#advanced-form');
        var searchTextbox = jQuery('#search-form input[type=text]');
        var searchSubmit = jQuery('#search-form input[type=submit]');
        if (advancedForm) {
            advancedForm.css("display", "none");
            searchSubmit.addClass("with-advanced").after('<a href="#" id="advanced-search" class="button">Advanced Search</a>');
            advancedForm.click(function (event) {
                event.stopPropagation();
            });
            jQuery("#advanced-search").click(function (event) {
                event.preventDefault();
                event.stopPropagation();
                advancedForm.fadeToggle();
                jQuery(document).click(function (event) {
                    if (event.target.id == 'query') {
                        return;
                    }
                    advancedForm.fadeOut();
                    jQuery(this).unbind(event);
                });
            });
        } else {
            jQuery('#search-form input[type=submit]').addClass("blue button");
        }
        
        
    };
    
    Omeka.dropDown = function(){
        var dropdownMenu = jQuery('#mobile-nav');
        dropdownMenu.prepend('<a class="menu">Menu</a>');
        //Hide the rest of the menu
        jQuery('#mobile-nav .navigation').hide();

        //function the will toggle the menu
        jQuery('.menu').click(function() {
            var x = jQuery(this).attr('id');

            if (x==1) {
                jQuery("#mobile-nav .navigation").slideUp();
               jQuery(this).attr('id', '0');
            } else {
                jQuery("#mobile-nav .navigation").slideDown();
                jQuery(this).attr('id','1');
            }
        });
    };
})(jQuery);
