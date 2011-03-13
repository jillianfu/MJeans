<?php

//
//  M Jeans Child Theme Functions
//	Built on the Thematic Theme Framework

// Unleash the power of Thematic's dynamic classes
// 
// define('THEMATIC_COMPATIBLE_BODY_CLASS', true);
// define('THEMATIC_COMPATIBLE_POST_CLASS', true);

// Unleash the power of Thematic's comment form
//
// define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);

// Unleash the power of Thematic's feed link functions
//
// define('THEMATIC_COMPATIBLE_FEEDLINKS', true);

//Deregister WP included JQuery and load JQuery Scripts
function add_scripts() { // adds jquery library and plugin scripts to head
  if ( !is_admin() ) { // instruction to only load if it is not the admin area
      // register your script location, dependencies and version
      wp_deregister_script('jquery'); // deregister wp included jquery
      wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');  // register the google-hosted jquery library
      wp_register_script('jqueryui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js');  // register the google-hosted jqueryui library
      wp_enqueue_script('jquery');
      wp_enqueue_script('jqueryui');
      // wp_enqueue_script('jquery_maximage', get_bloginfo('stylesheet_directory') . '/js/jquery.maximage.js', array('jquery')); // calls the plugin script code
      wp_enqueue_script('js-init', get_bloginfo('stylesheet_directory') . '/js/js-init.js', array('jquery')); //calls the init file
			wp_enqueue_script('simplethumbs', get_bloginfo('stylesheet_directory') . '/js/simplethumbs.min.js', array('jquery')); //calls the plugin script code
			//wp_enqueue_script('bgsleight', get_bloginfo('stylesheet_directory') . '/js/bgsleight.js', array('jquery')); //calls the plugin script code
  }
}
add_action('init','add_scripts');

function childtheme_ie_style() { ?>

	<!--[if IE]>
		<link rel="stylesheet" type="text/css" href= "http://m-jeans.com/wp-content/themes/mjeans_childtheme/css/ie.css" />
	<![endif]-->
<?php }

add_action('wp_head', 'childtheme_ie_style');

function childtheme_doctitle() {
 
 // You don't want to change this one.
 $site_name = get_bloginfo('name');
	//$site_name = 'M Jeans.';
 
 // But you like to have a different separator
 $separator = '';
 
 // We will keep the original code
 if ( is_single() ) {
 $content = single_post_title('', FALSE);
 }
 elseif ( is_home() || is_front_page() ) {
 $content = get_bloginfo('description');
 }
 elseif ( is_page() ) {
 $content = single_post_title('', FALSE);
 }
 elseif ( is_search() ) {
 $content = __('Search Results for:', 'thematic');
 $content .= ' ' . wp_specialchars(stripslashes(get_search_query()), true);
 }
 elseif ( is_category() ) {
 $content = __('Category Archives:', 'thematic');
 $content .= ' ' . single_cat_title("", false);;
 }
 elseif ( is_tag() ) {
 $content = __('Tag Archives:', 'thematic');
 $content .= ' ' . thematic_tag_query();
 }
 elseif ( is_404() ) {
 $content = __('Not Found', 'thematic');
 }
 else {
 $content = get_bloginfo('description');
 }
 
 if (get_query_var('paged')) {
 $content .= ' ' .$separator. ' ';
 $content .= 'Page';
 $content .= ' ';
 $content .= get_query_var('paged');
 }
 
 // until we reach this point. You want to have the site_name everywhere?
 // Ok .. here it is.
 $my_elements = array(
 'site_name' => $site_name,
 'separator' => $separator,
 'content' => $content
 );
 
 // and now we're reversing the array as long as we're not on home or front_page
 if (!( is_home() || is_front_page() )) {
 $my_elements = array_reverse($my_elements);
 }
 
 // And don't forget to return your new creation
 return $my_elements;
}
 
// Add the filter to the original function
add_filter('thematic_doctitle', 'childtheme_doctitle');


function childtheme_favicon() { ?>
    <link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/images/favicon.ico">
<?php }

add_action('wp_head', 'childtheme_favicon');


// Filter away the default scripts loaded with Thematic
function childtheme_head_scripts() {
 // Abscence makes the heart grow fonder
}
add_filter('thematic_head_scripts','childtheme_head_scripts');

function your_function(){
	echo '<meta name="description" content="M Jeans. Jeans made exclusively for tall men">';
	echo '<meta name="keywords" content="M Jeans, denim, menswear, clothes, clothing, Mark Seeger, W Jeans, jeans, tall men">';
}
add_action('wp_head', 'your_function');

// Clean up the Dashboard by removing unneccesary thematic sidebars
// Thanks to Allan Cole for this code: www.allancole.com
function childtheme_sidebars_init() {
 
// Unregister and sidebars you don't need based on its ID.
// For a full list of Thematic sidebar IDs, look at /thematc/library/extensions/widgets-extensions.php
unregister_sidebar('index-top');
unregister_sidebar('index-insert');
unregister_sidebar('index-bottom');
unregister_sidebar('single-top');
unregister_sidebar('single-insert');
unregister_sidebar('single-bottom');
unregister_sidebar('page-top');
unregister_sidebar('page-bottom');
unregister_sidebar('1st-subsidiary-aside');
unregister_sidebar('2nd-subsidiary-aside');
unregister_sidebar('3rd-subsidiary-aside');
}

// When WP initiates, add the above settings
add_action( 'init', 'childtheme_sidebars_init',20 );

// We're not using drop down menus so remove the header js scripts built into WP
function childtheme_remove_scripts() {
    remove_action('wp_head','thematic_head_scripts');
}
add_action('init', 'childtheme_remove_scripts');

// Add background images

function bg_image() {
?>
<div id="shop_bg">
<?php
	if (is_page('2')) :
?>
	<img src="<?php bloginfo('template_directory') ?>'/../mjeans_childtheme/images/loading.gif" width="10" height="10" class="thumb_loader">
<script>
	var whatpage = "homepage";
</script>
<?php
elseif(is_page('235')) : ?>
<script>
	var whatpage = "about";
</script>
<?php
	elseif(is_page('59') || is_page('343')) :
?>
	<script>
		var whatpage = "shop";
	</script>

    <?php
  	elseif(is_page('148') || is_page('346') || is_page('345')) :
?>
	<script>
		var whatpage = "cart";
	</script>

    <?php
  elseif (is_page('contact')):
    ?>
	<script>
		var whatpage = "contact";
	</script>
    <?php

  elseif (is_page('6')) :
    ?>
	<script>
		var whatpage = "blog";
	</script>
    <?php

  elseif (is_single('')) :
    ?>
	<script>
		var whatpage = "singleblog";
	</script>
    <?php 

  elseif (is_tag()) :
    ?>
	<script>
		var whatpage = "tagblog";
	</script>
    <?php
	endif ;
?>
</div>
<?php
}	
add_action('thematic_before','bg_image');

//The following REMOVES PAGE titles... but KEEPS POST titles on blog page
function child_remove_pagetitles() {
   // Make changes to the original function
   if (is_page()) {
          $posttitle = '';
       } elseif (is_single()) {
          $posttitle = '<h1 class="entry-title">' . get_the_title() . "</h1>\n";
   //continue with original function
       } elseif (is_404()) {
           $posttitle = '<h1 class="entry-title">' . __('Not Found', 'thematic') . "</h1>\n";
       } else {
           $posttitle = '<h2 class="entry-title"><a href="';
           $posttitle .= get_permalink();
           $posttitle .= '" title="';
           $posttitle .= __('Permalink to ', 'thematic') . the_title_attribute('echo=0');
           $posttitle .= '" rel="bookmark">';
           $posttitle .= get_the_title();
           $posttitle .= "</a></h2>\n";
       }
   return $posttitle;
   }
add_filter('thematic_postheader_posttitle' ,'child_remove_pagetitles');
//END remove page titles


// Change the logo on pages
// Create small logo on all pages except for about page
function change_logo() {
  if (is_page('about')) {
    ?>
        <div id="blog-title-paged";>
	  <h1><a title="M Jeans" href="http://m-jeans.com">M Jeans</a></h1>
        </div>
    <?php
  }
}

add_filter('thematic_header','change_logo');


//Adding a header on the M blog page
function blog_header() {
    if (is_page('6') || is_single() || is_tag()) { ?>
    
        <div id="blog-header">
            <p>M Blog</p>
        </div>
        
    <?php }
    }

add_filter('thematic_belowheader','blog_header');


// Changes all the blog posts to excerpts on the blog page
function my_excerpts($content = false) {

// If is the home page, an archive, or search results
	if(is_page('6')) :
		global $post;
		$content = $post->post_excerpt;

	// If an excerpt is set in the Optional Excerpt box
		if($content) :
			$content = apply_filters('the_excerpt', $content);

	// If no excerpt is set
		else :
			$content = $post->post_content;
			$excerpt_length = 55;
			$words = explode(' ', $content, $excerpt_length + 1);
			if(count($words) > $excerpt_length) :
				array_pop($words);
				array_push($words, '...');
				$content = implode(' ', $words);
			endif;
			$content = '<p>' . $content . '</p>';

		endif;
	endif;

// Make sure to return the content
	return $content;

}
// Add filter to the_content
	add_filter('the_content', 'my_excerpts');
	
	
////Add Twitter link under each post
//
//function childtheme_postfooter($output) {
//    $twitterlink = '<p class="twitter"><a href="http://twitter.com/#!/M_Jeans">Follow me on Twitter</a></p>';
//    return ($twitterlink . $output);
//}
//add_filter('thematic_postfooter','childtheme_postfooter');	
	
// Generate footer code
 
//function childtheme_footer($thm_footertext) {
//     $date = date('Y');
//     $blog_name = get_bloginfo('name');
//     $admin_url = get_bloginfo('wpurl') . '/wp-admin';
//     $entries_rss = get_bloginfo('rss2_url');
// 
//     $thm_footertext = sprintf(
//     '<p>&copy; %s %s | <a href="http://wptheming.com/2009/10/useful-thematic-filters/">Entries RSS</a></p>',
//     $date, $blog_name, $admin_url, $entries_rss);
// 
//     return $thm_footertext;
//     }
// 
//add_filter('thematic_footertext', 'childtheme_footer');


function product_rollover() {
  if(is_page('59')) { ?>
	
	<?php $thumb_array = array(
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_3_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_3_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_6_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_6_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_4_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_4_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_1_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_1_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_2_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_2_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_5_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_5_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_8_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_8_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_7_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_7_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_9_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_9_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_10_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_10_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_11_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_11_small.jpg"
			),
			array(
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_13_large.jpg",
					"http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_13_small.jpg"
			)
			
		) ;
		
		echo '<div id="thumbcontainer"><div id="thumbs">';
		$thumb_cntr = 0;
		foreach($thumb_array as $thumb)  {

			echo '<div id="product1" onclick="return false" class="thumbs">';
			echo ($thumb_cntr == 2) ? '<a class="active_thumbnail" href="' : '<a href="';
			echo $thumb[0].'">';
			echo '<img src="'.$thumb[1].'">';
			echo'</a></div>';
			$thumb_cntr++;			
		}
		echo '</div></div>';
		?>

<!-- <div id="thumbcontainer">
<div id="thumbs">
  <div id="product1" onclick="return false" class="thumbs">
  <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_3_large.jpg">
	<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />
	<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_3_small.jpg"></a>
  </div>
  
  <div id="product2" onclick="return false" class="thumbs">
    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_6_large.jpg">
	<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />	
	<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_6_small.jpg"></a>
  </div>
  
  <div id="product3" onclick="return false" class="thumbs">
    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_4_large.jpg">
	<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />
	<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_4_small.jpg"></a>
  </div>
  
  <div id="product4" onclick="return false" class="thumbs">
    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_1_large.jpg">
	<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />
	<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_1_small.jpg"></a>
  </div>
  
  <div id="product5" onclick="return false" class="thumbs">
    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_2_large.jpg">
	<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />	
	<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_2_small.jpg"></a>
   </div>
  
  <div id="product6" onclick="return false" class="thumbs">
    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_5_large.jpg">
	<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />	
	<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_5_small.jpg"></a>
  </div>
  
  <div id="product7" onclick="return false" class="thumbs">
    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_8_large.jpg">
	<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />	
	<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_8_small.jpg"></a>
  </div>
  
  <div id="product8" onclick="return false" class="thumbs">
    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_7_large.jpg">
	<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />
	<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_7_small.jpg"></a>
  </div>
	
	<div id="product9" onclick="return false" class="thumbs">
	    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_9_large.jpg">
		<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />	
		<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_9_small.jpg"></a>
	</div>

<div id="product10" onclick="return false" class="thumbs">
    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_10_large.jpg">
	<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />	
    <img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_10_small.jpg"></a>
</div>
        
	<div id="product11" onclick="return false" class="thumbs">
	<img src="<?php bloginfo('template_directory') ?>/../mjeans_childtheme/images/loading.gif" class="thumb_loading" />			
    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_11_large.jpg">
	<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_11_small.jpg"></a>
    </div>       

	<div id="product12" onclick="return false" class="thumbs">
    <a href="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_13_large.jpg">
	<img src="<?php bloginfo('template_directory') ?>/images/loading.gif" />	
	<img src="http://m-jeans.com/wp-content/themes/mjeans_childtheme/images/product_13_small.jpg"></a>
    </div>  	
</div>
</div> -->
  <?php }
}

add_filter('thematic_belowcontainer','product_rollover');

function add_google_analytics() { ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20588221-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php }
add_action('wp_footer', 'add_google_analytics');

?>