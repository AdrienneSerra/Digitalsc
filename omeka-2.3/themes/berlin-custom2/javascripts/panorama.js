// JavaScript Document


         		window.onload = function() {
            			viewer = new PanoradoJS(document.getElementById("pano"));
            viewer.image = { src: '<?php echo file_display_url($file, \'original\')?>', projection: 'spherical' };
         }
     