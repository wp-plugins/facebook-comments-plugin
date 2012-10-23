<?php

//ADD XFBML
add_filter('language_attributes', 'schema');
function fbschema($attr) {
	$options = get_option('fbcomments');
	if ($options['opengraph'] == '1') {$attr .= "\n xmlns:og=\"http://ogp.me/ns#\"";}
	if ($options['fbns'] == '1') {$attr .= "\n xmlns:fb=\"http://ogp.me/ns/fb#\"";}
	return $attr;
}

//ADD OPEN GRAPH META
function fbgraphinfo() {
	$options = get_option('fbcomments'); ?>
<meta property="fb:app_id" content="<?php echo $options['appID']; ?>"/>
<meta property="fb:admins" content="<?php echo $options['mods']; ?>"/>
<?php
}
add_action('wp_head', 'fbgraphinfo');

//ADD JQUERY
function fb_loadjquery() {
$options = get_option('fbcomments');
if ($options['jquery'] == '1') {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}
}    
add_action('wp_enqueue_scripts', 'fb_loadjquery');


function fbmlsetup() {
$options = get_option('fbcomments');
if ($options['fbml'] == '1') {
?>
<!-- Facebook Comments for WordPress: http://3doordigital.com/wordpress/plugins/facebook-comments/ -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $options['language']; ?>/all.js#xfbml=1&appId=<?php echo $options['appID']; ?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php }}
add_action('wp_footer', 'fbmlsetup', 100);



//COMMENT BOX
function fbcommentbox($content) {
	$options = get_option('fbcomments');
	if (
	   (is_single() && $options['posts'] == '1') ||
       (is_page() && $options['pages'] == '1') ||
       ((is_home() || is_front_page()) && $options['homepage'] == '1')) {

		if ($options['count'] == '1') {
			if ($options['countstyle'] == '') {
				$commentcount = "<p>";
			} else {
				$commentcount = "<p class=\"".$options['countstyle']."\">";
			}
			$commentcount .= "<fb:comments-count href=".get_permalink()."></fb:comments-count> ".$options['countmsg']."</p>";
		}
		if ($options['title'] != '') {
			if ($options['titleclass'] == '') {
				$commenttitle = "<h3>";
			} else {
				$commenttitle = "<h3 class=\"".$options['titleclass']."\">";
			}
			$commenttitle .= $options['title']."</h3>";
		}
		$content .= "<!-- Facebook Comments for WordPress: http://pleer.co.uk/wordpress/plugins/facebook-comments/ -->".$commenttitle.$commentcount;

      	if ($options['html5'] == '1') {
			$content .=	"<div class=\"fb-comments\" data-href=\"".get_permalink()."\" data-num-posts=\"".$options['num']."\" data-width=\"".$options['width']."\" data-colorscheme=\"".$options['scheme']."\"></div>";

    } else {
    $content .= "<fb:comments href=\"".get_permalink()."\" num_posts=\"".$options['num']."\" width=\"".$options['width']."\" colorscheme=\"".$options['scheme']."\"></fb:comments>";
     }

    if ($options['linklove'] != '') {
      $content .= '<p>Powered by <a href="http://3doordigital.com/wordpress/plugins/facebook-comments/">Facebook Comments</a></p>';
    }
  }
return $content;
}
add_filter ('the_content', 'fbcommentbox', 100);


function fbcommentshortcode($fbatts) {
    extract(shortcode_atts(array(
		"fbcomments" => get_option('fbcomments'),
		"url" => get_permalink(),
    ), $fbatts));
    if (!empty($fbatts)) {
        foreach ($fbatts as $key => $option)
            $fbcomments[$key] = $option;
	}
		if ($fbcomments[count] == '1') {
			if ($fbcomments[countstyle] == '') {
				$commentcount = "<p>";
			} else {
				$commentcount = "<p class=\"".$fbcomments[countstyle]."\">";
			}
			$commentcount .= "<fb:comments-count href=".$url."></fb:comments-count> ".$fbcomments[countmsg]."</p>";
		}
		if ($fbcomments[title] != '') {
			if ($fbcomments[titleclass] == '') {
				$commenttitle = "<h3>";
			} else {
				$commenttitle = "<h3 class=\"".$fbcomments[titleclass]."\">";
			}
			$commenttitle .= $fbcomments[title]."</h3>";
		}
		$fbcommentbox = "<!-- Facebook Comments for WordPress: http://3doordigital.com/wordpress/plugins/facebook-comments/ -->".$commenttitle.$commentcount;

      	if ($fbcomments[html5] == '1') {
			$fbcommentbox .=	"<div class=\"fb-comments\" data-href=\"".$url."\" data-num-posts=\"".$fbcomments[num]."\" data-width=\"".$fbcomments[width]."\" data-colorscheme=\"".$fbcomments[scheme]."\"></div>";

    } else {
    $fbcommentbox .= "<fb:comments href=\"".$url."\" num_posts=\"".$fbcomments[num]."\" width=\"".$fbcomments[width]."\" colorscheme=\"".$fbcomments[scheme]."\"></fb:comments>";
     }

    if ($fbcomments[linklove] != '') {
      $fbcommentbox .= '<p>Powered by <a href="http://3doordigital.com/wordpress/plugins/facebook-comments/">Facebook Comments</a></p>';
    }
  return $fbcommentbox;
}
add_filter('widget_text', 'do_shortcode');
add_shortcode('fbcomments', 'fbcommentshortcode');


?>