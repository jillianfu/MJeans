// script to initiate maxImage background
// jQuery(function() {
//     jQuery('.maxImage').maxImage({
//         isBackground: true,
//         overflow: 'auto',
//         verticalAlign: 'top'
//      });
//     
//     jQuery.noConflict();
//     jQuery('img.widthmaxImage').maxImage({
//         maxFollows: 'width',
//         verticalAlign: 'top'
//     });
//     
//     //jQuery('img.widthmaxImage').maxImage({
//     //    isBackground: true,
//     //    overflow: 'auto',
//     //    verticalAlign: 'top'
//     // });
// 
// });

//script for sticky footer but still not working on the shop page
//jQuery(document).ready(function(jQuery){
//        matchHeight();
//	function matchHeight() {
//		var mainHeight = jQuery("#wrapper").outerHeight() - jQuery("#header").outerHeight() - jQuery("#leader").outerHeight() - jQuery("#footer").outerHeight() - parseInt(jQuery("#footer").css("margin-top")) - 1 - parseInt(jQuery("#main").css("padding-top"))- parseInt(jQuery("#main").css("padding-bottom"));
//		var mainReal = jQuery("#main").outerHeight(true);
//
//		if ((mainHeight + 1 + parseInt(jQuery("#main").css("padding-top")) + parseInt(jQuery("#main").css("padding-bottom"))) > mainReal) {
//			jQuery('#main').height(mainHeight);
//		}
//	}
//jQuery(window).resize(matchHeight);
//});

// Script for thumbnail hoverstates - add opacity: 1 to active_thumbnail class

jQuery(document).ready(function(jQuery){
jQuery(window).bind("load", function() {
    var activeOpacity   = 1.0,
        inactiveOpacity = 0.6,
        fadeTime = 350,
        clickedClass = "active_thumbnail",
        thumbs = ".thumbs a";

    jQuery(thumbs).fadeTo(1, inactiveOpacity);

    jQuery(thumbs).hover(
        function(){
            jQuery(this).stop().fadeTo(fadeTime, activeOpacity);
        },
        function(){
            // Only fade out if the user hasn't clicked the thumb
            if(!jQuery(this).hasClass(clickedClass)) {
                jQuery(this).stop().fadeTo(fadeTime, inactiveOpacity);
            }
        });
     jQuery(thumbs).click(function() {
         // Remove selected class from any elements other than this
         var previous = jQuery(thumbs + '.' + clickedClass).eq();
         var clicked = jQuery(this);
         if(clicked !== previous) {
             previous.removeClass(clickedClass);
         }
         clicked.addClass(clickedClass).fadeTo(fadeTime, activeOpacity);
     });
        jQuery(thumbs).click(function() {
         var next = jQuery(thumbs).eq();
         var unclicked = jQuery(this);
         if(unclicked !== next) {
         }
         unclicked.fadeTo(fadeTime, inactiveOpacity);
     });
});
});

//thumbnail fades
jQuery(document).ready(function(jQuery){
jQuery(window).bind("load", function() {
    var activeOpacity   = 1.0,
        inactiveOpacity = 0.6,
        fadeTime = 350,
        clickedClass = "active_thumbnail",
        thumbs = ".thumbs a";

    jQuery(thumbs).fadeTo(1, inactiveOpacity);

    jQuery(thumbs).hover(
        function(){
            jQuery(this).stop().fadeTo(fadeTime, activeOpacity);
        },
        function(){
            // Only fade out if the user hasn't clicked the thumb
            if(!jQuery(this).hasClass(clickedClass)) {
                jQuery(this).stop().fadeTo(fadeTime, inactiveOpacity);
            }
        });
     jQuery(thumbs).click(function() {
         // Remove selected class from any elements other than this
         var previous = jQuery(thumbs + '.' + clickedClass).eq();
         var clicked = jQuery(this);
         if(clicked !== previous) {
             previous.removeClass(clickedClass);
         }
         clicked.addClass(clickedClass).fadeTo(fadeTime, activeOpacity);
     });
        jQuery(thumbs).click(function() {
         var next = jQuery(thumbs).eq();
         var unclicked = jQuery(this);
         if(unclicked !== next) {
         }
         unclicked.fadeTo(fadeTime, inactiveOpacity);
     });
});
});

jQuery(window).resize(function() {
	var width = jQuery('body').width();
	var height = jQuery('body').height();
	var proportion = width / height;
	var img_proportion = 1375 / 979;
		if(proportion>=img_proportion)  {
			jQuery('#shop_bg img').attr('width',width);			
		}
		else  {
			jQuery('#shop_bg img').attr('height',height);
			}
});




jQuery(document).ready(function() {
	var width = jQuery('body').width();
	var height = jQuery('body').height();
	var proportion = width / height;
	var img_proportion = 1375 / 979;
	var whatimg;
	switch(whatpage)  {
		case "homepage":
		whatimg = "http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/homepage_pic.jpg";
		break;
		
		case "about":
		whatimg = "http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/about_bg.jpg";
		break;
		
		case "shop":
		console.log (whatpage);
		whatimg = "http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_4_large.jpg";
		break;
		
		case "shopcart":
		whatimg = "http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_1_large.jpg";
		break;
		
		case "contact":
		whatimg = "http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/contact_bg2.jpg";
		break;
		
		case "blog":
		whatimg = "http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/blog_bg.jpg";
		break;
		
		case "tagblog":
		whatimg = "http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/blog_bg.jpg";
		break;
		
		case "singleblog":
		whatimg = "http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/blog_bg.jpg";
		break;
		
	}
	
	jQuery('<img />')
	    .attr('src', whatimg)
	    .load(function(){
			if(whatpage=="shop") {
				jQuery('.thumb_loader').css('display','none');
			}
	        jQuery('#shop_bg').append( jQuery(this) );

		if(proportion>=img_proportion)  {
			jQuery('#shop_bg img').attr('width',width);
		}
		else  {
			jQuery('#shop_bg img').attr('height',height);
		}			
    });
  jQuery('.thumbs a').each(function() {	
		var link = jQuery(this).attr("href");			
		jQuery('<img />')
		    .attr('src', link)
		    .load(function(){

	    });
			
	});	
  jQuery('.thumbs a').click(function() {
	var link = jQuery(this).attr("href");
	jQuery('#shop_bg img').attr('src',link);
	if(proportion>=img_proportion)  {
		jQuery('#shop_bg img').attr('width',width);		
	}
	else  {
		jQuery('#shop_bg img').attr('height',height);				
	}
  });
});