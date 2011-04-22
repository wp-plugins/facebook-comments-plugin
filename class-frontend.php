<?php

//ADD FB OPENGRAPH INFO
function fbgraphinfo() { ?>
<meta property="fb:app_id" content="<?php echo get_option('fbcomments_appID'); ?>"/>
<?php
	if (get_option('fbcomments_boxstyle') != '' || get_option('fbcomments_h3style') != '' || get_option('fbcomments_countstyle') != '' || get_option('fbcomments_commentstyle') != '' || get_option('fbcomments_bg') != '') { echo "<style type=\"text/css\">\n";}
	if (get_option('fbcomments_boxstyle') != '') { echo ".fbcomments { ".get_option('fbcomments_boxstyle')." }\n"; }
	if (get_option('fbcomments_h3style') != '') { echo ".fbcomments h3 { ".get_option('fbcomments_h3style')." }\n"; }
	if (get_option('fbcomments_countstyle') != '') { echo ".fbcomments p { ".get_option('fbcomments_countstyle')." }\n"; }
	if (get_option('fbcomments_commentstyle') != '') { echo ".fbcommentbox { ".get_option('fbcomments_commentstyle')." }\n"; }
	if (get_option('fbcomments_bg') != '') { echo "#content .fb_ltr { background: ". get_option('fbcomments_bg')." }\n"; }
	if (get_option('fbcomments_boxstyle') != '' || get_option('fbcomments_h3style') != '' || get_option('fbcomments_countstyle') != '' || get_option('fbcomments_commentstyle') != '' || get_option('fbcomments_bg') != '') {echo "</style>";}
}
add_action('wp_head', 'fbgraphinfo');

//ADD XFBML

add_filter('language_attributes', 'schema');
function schema($attr) {
	if (get_option('fbcomments_opengraph') == 'on') {$attr .= "\n xmlns:og=\"http://ogp.me/ns#\"";}
	if (get_option('fbcomments_fbns') == 'on') {$attr .= "\n xmlns:fb=\"http://www.facebook.com/2008/fbml\"";}
	return $attr;
}

function fbmlsetup() {
if (get_option('fbcomments_fbml') == 'on') {
?>
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
    FB.init({xfbml: true, appId: <?php echo (get_option('fbcomments_appID') ? get_option('fbcomments_appID') : 'null'); ?> });
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
</script>
<?php }}
add_action('wp_footer', 'fbmlsetup', 100);


//COMMENT BOX
function fbcommentbox($content) {
  if ((is_single() && get_option('fbcomments_posts') == 'on') ||
      (is_page() && get_option('fbcomments_pages') == 'on') ||
      ((is_home() || is_front_page()) && get_option('fbcomments_homepage') == 'on')) {
    if (get_option('fbcomments_migrated') == 'on') { $migrated = "migrated=\"1\"";}
    if (get_option('fbcomments_count') == 'on') { $commentcount = "<p><fb:comments-count href=".get_permalink()."></fb:comments-count> ".get_option('fbcomments_countmsg')."</p>";}
    $content .= "<div class=\"fbcomments\">".
      "<h3>".get_option('fbcomments_title')."</h3>".$commentcount.
      "<div class=\"fbcommentbox\"><fb:comments href=\"".get_permalink()."\" num_posts=\"".get_option('fbcomments_count')."\" width=\"".get_option('fbcomments_width')."\" colorscheme=\"".get_option('fbcomments_scheme')."\" ".$migrated."></fb:comments></div>";
    if (get_option('fbcomments_linklove') != '') {
      $content .= '<p>Powered by <a href="http://pleer.co.uk/wordpress/plugins/facebook-comments/">Facebook Comments</a></p>';
    }
    $content .= "</div>";
  }
  return $content;
}
add_filter ('the_content', 'fbcommentbox', 100);



function fbcommentshortcode($fbatts) {
    extract(shortcode_atts(array(
		"width" => get_option('fbcomments_width'),
		"count" => get_option('fbcomments_count'),
		"countmsg" => get_option('fbcomments_countmsg'),
		"num" => get_option('fbcomments_num'),
		"title" => get_option('fbcomments_title'),
		"migrated" => get_option('fbcomments_migrated'),
		"url" => get_permalink(),
		"linklove" => get_option('fbcomments_linkove'),
		"scheme" => get_option('fbcomments_scheme'),
    ), $fbatts));


	if ($migrated == 'on') { $migrate = "migrated=\"1\"";}
	if ($count == 'on') { $commentcount = "<p><fb:comments-count href=".$url."></fb:comments-count> ".$countmsg."</p>";}
    $fbcommentbox = "<div class=\"fbcomments\">".
	      "<h3>".$title."</h3>".$commentcount."<div class=\"fbcommentbox\"><fb:comments href=\"".$url."\" num_posts=\"".$num."\" width=\"".$width."\" colorscheme=\"".$scheme."\" ".$migrate."></fb:comments></div>";
    if ($linklove != '') {
      $fbcommentbox .= '<p>Powered by <a href="http://pleer.co.uk/wordpress/plugins/facebook-comments/">Facebook Comments</a></p>';
    }
    $fbcommentbox .= "</div>";
  return $fbcommentbox;
}

add_filter('widget_text', 'do_shortcode');
add_shortcode('fbcomments', 'fbcommentshortcode');
?>