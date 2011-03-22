<?php
/*
Plugin Name:  Facebook Comments
Plugin URI:   http://pleer.co.uk/wordpress/plugins/facebook-comments/
Description:  Add the Facebook Comments facitility to your WordPress site quickly and easily.
Version:      1.0
Author:       Alex Moss
Author URI:   http://alex-moss.co.uk/

Copyright (C) 2010-2010, Alex Moss
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
Neither the name of Alex Moss or pleer nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/


//ADD FB OPENGRAPH INFO
function fbgraphinfo() { ?>
<meta property="fb:app_id" content="<?php echo get_option('fbcomments_appID'); ?>"/>
<meta property="fb:admins" content="<?php echo get_option('fbcomments_admins'); ?>">

<?php if (get_option('fbcomments_bg') != '') { ?>
<style type="text/css">
.fb_ltr { background: <?php echo get_option('fbcomments_bg'); ?>; }
</style>}

<?php }}
add_action('wp_head', 'fbgraphinfo');

//ADD FBML
function fbmlsetup() {
if (get_option('fbcomments_fbml') == 'on') {
?>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js#appId=<?php echo get_option('fbcomments_appID'); ?>&amp;xfbml=1"></script>
<?php }}
add_action('wp_footer', 'fbmlsetup');


//COMMENT BOX
function fbcommentbox($content) {
$content.="<div id=\"fb-comments\">";
if (get_option('fbcomments_posts') == 'on') {
	if(is_single()) {
		$content.= "<h3>".get_option('fbcomments_title')."</h3><fb:comments href=\"".get_permalink()."\" num_posts=\"".get_option('fbcomments_count')."\" width=\"".get_option('fbcomments_width')."\"></fb:comments>";
		if ($linklove != "no"){ $content.= '<br />Powered by <a href="http://pleer.co.uk/wordpress/plugins/facebook-comments/">Facebook Comments</a>'; }
	}
}
if (get_option('fbcomments_pages') == 'on') {
	if(is_page()) {
		$content.= "<h3>".get_option('fbcomments_title')."</h3><fb:comments href=\"".get_permalink()."\" num_posts=\"".get_option('fbcomments_count')."\" width=\"".get_option('fbcomments_width')."\" height=\"50\"></fb:comments>";
		if ($linklove != "no"){ $content.= '<br />Powered by <a href="http://pleer.co.uk/wordpress/plugins/facebook-comments/">Facebook Comments</a>'; }
	}
}
if (get_option('fbcomments_homepage') == 'on') {
	if(is_home() || is_front_page()) {
		$content.= "<h3>".get_option('fbcomments_title')."</h3><fb:comments href=\"".get_permalink()."\" num_posts=\"".get_option('fbcomments_count')."\" width=\"".get_option('fbcomments_width')."\"></fb:comments>";
		if ($linklove != "no"){ $content.= '<br />Powered by <a href="http://pleer.co.uk/wordpress/plugins/facebook-comments/">Facebook Comments</a>'; }
	}
}
$content.="</div>";
return $content;
}
add_filter ('the_content', 'fbcommentbox', 100);




//
// Admin panel options.... //
//

add_action('admin_menu', 'show_fbcomments_options');

function show_fbcomments_options() {
    // Add a new submenu
    add_options_page('Facebook Comments Options', 'Facebook Comments', 8, 'fbcomments', 'fbcomments_options');


	//Add options
	add_option('fbcomments_fbml', 'on');
	add_option('fbcomments_posts', 'on');
	add_option('fbcomments_pages', 'off');
	add_option('fbcomments_homepage', 'off');
	add_option('fbcomments_appID', '');
	add_option('fbcomments_admins', '');
	add_option('fbcomments_count', '10');
	add_option('fbcomments_title', 'Comments');
	add_option('fbcomments_width', '450');
	add_option('fbcomments_bg', '#F2F2F2');
	add_option('fbcomments_linklove', 'yes');

}
//
// Admin page HTML //
//
function fbcomments_options() { ?>
<style type="text/css">
div.headerWrap { background-color:#e4f2fds; width:200px}
#options h3 { padding:7px; padding-top:10px; margin:0px; cursor:auto }
#options label { width: 300px; float: left; margin-left: 10px; }
#options input { float: left; margin-left:10px}
#options p { clear: both; padding-bottom:10px; }
#options .postbox { margin:0px 0px 10px 0px; padding:0px; }
</style>
<div class="wrap">
<form method="post" action="options.php" id="options">
<?php wp_nonce_field('update-options') ?>
<h2>Facebook Comments Options</h2>

<div class="postbox">
<h3 class="hndle">Resources</h3>
	<div style="text-decoration:none; padding:10px">
		<div style="width:180px; text-align:center; float:right; font-size:10px; font-weight:bold">
			<a href="http://pleer.co.uk/go/twitter-paypal/">
			<img src="https://www.paypal.com/en_GB/i/btn/btn_donateCC_LG.gif" border="0" style="padding-bottom:10px" /></a>
		</div>

	<a href="http://developers.facebook.com/docs/reference/plugins/comments/" style="text-decoration:none" target="_blank">Facebook Comments Developer Homepage</a><br /><br />

	<a href="http://pleer.co.uk/wordpress/plugins/facebook-comments/" style="text-decoration:none" target="_blank">Plugin Homepage</a> <small>- More information on this plugin</small><br /><br />

	<a href="http://pleer.co.uk/wordpress/plugins/" style="text-decoration:none" target="_blank">WordPress Plugins</a> <small>- I have developed other plugins including a <a href="http://pleer.co.uk/wordpress/plugins/wp-twitter-feed/" style="text-decoration:none" target="_blank">Twitter Feed</a> and <a href="http://pleer.co.uk/wordpress/plugins/rss-feed-reader/" style="text-decoration:none" target="_blank">RSS Feed Reader</a>!</small><br /><br />


</div>
</div>


<div class="postbox">
<h3 class="hndle">Initial Setup via Facebook</h3>
	<div style="text-decoration:none; padding:10px">

	<a href="http://www.facebook.com/developers/createapp.php" style="text-decoration:none" target="_blank">Create an App to handle your comments</a><small>- call it anything e.g. "Comments". Once you have your App ID, enter it into the space below</small><br /><br />

	<a href="http://www.facebook.com/developers/apps.php" style="text-decoration:none" target="_blank">App Setup</a> <small>- to set up, choose your App and click <strong>Edit Settings</strong>. Click on the <strong>Web Site</strong> tab on the left. Ensure you enter the <strong>Site URL</strong> (e.g. http://pleer.co.uk/) and <strong>Site domain</strong> (e.g. pleer.co.uk) and hit <strong>Save Changes</strong></small><br /><br />


</div>
</div>

<div class="postbox">
<h3 class="hndle">Moderation and Testing</h3>
	<div style="text-decoration:none; padding:10px">

	<a href="http://developers.facebook.com/tools/comments" style="text-decoration:none" target="_blank">Comment Moderation Area</a><small>- here you can view and moderate all comments. This area also has a <strong>Settings</strong> area where you can control how comments are published<br /><em>Note that this can also be controlled by moderators within the posts or pages directly</em></small><br /><br />

	<a href="http://developers.facebook.com/tools/lint" style="text-decoration:none" target="_blank">Facebook URL Linter</a> <small>- enter a URL where the comment box appears and it will validate the page for you, providing any errors you may have.</small><br /><br />

</div>
</div>


<div class="postbox">
<h3 class="hndle">Settings</h3>
<div style="text-decoration:none; padding:10px">
<p>To turn off WordPress comments, click <a href="<?php bloginfo('url'); ?>/wp-admin/options-discussion.php" target="_blank">here</a> to go to your discussion settings. <strong>Untick</strong> the option saying <em>"Allow people to post comments on new articles"</em><br /><small>You may also have to disable comments within your own theme's settings</small></p>

		<p>
			<?php
				if (get_option('fbcomments_fbml') == 'on') {echo '<input type="checkbox" name="fbcomments_fbml" checked="yes" />';}
				else {echo '<input type="checkbox" name="fbcomments_fbml" />';}
			?>
			<label>Enable FBML <small>- only disable this if you already have FBML enabled elsewhere</small></label>
		</p>

		<p>
			<?php
				if (get_option('fbcomments_posts') == 'on') {echo '<input type="checkbox" name="fbcomments_posts" checked="yes" />';}
				else {echo '<input type="checkbox" name="fbcomments_posts" />';}
			?>
			<label>Show comment box in posts</label>
		</p>

		<p>
			<?php
				if (get_option('fbcomments_pages') == 'on') {echo '<input type="checkbox" name="fbcomments_pages" checked="yes" />';}
				else {echo '<input type="checkbox" name="fbcomments_pages" />';}
			?>
			<label>Show comment box in pages</label>
		</p>

		<p>
			<?php
				if (get_option('fbcomments_homepage') == 'on') {echo '<input type="checkbox" name="fbcomments_homepage" checked="yes" />';}
				else {echo '<input type="checkbox" name="fbcomments_homepage" />';}
			?>
			<label>Show comment box on the homepage</label>
		</p>
<br />
<br />
	<p><label>App ID</label> <input type="text" name="fbcomments_appID" value="<?php echo get_option('fbcomments_appID'); ?>" /></p>
	<p><label>Admins</label> <input type="text" name="fbcomments_admins" value="<?php echo get_option('fbcomments_admins'); ?>" /> To add multiple moderators, separate the uids by comma without spaces. To find your uid, go to any photo album your have created and take note of the number after <strong>id=</strong></p>
	<p><label>Number of Comments</label> <input type="text" name="fbcomments_count" value="<?php echo get_option('fbcomments_count'); ?>" /> Default is <strong>10</strong></p>
	<p><label>Width (px)</label> <input type="text" name="fbcomments_width" value="<?php echo get_option('fbcomments_width'); ?>" /> Default is <strong>450</strong>, minimum must be <strong>350</strong></p>
	<p><label>Title</label> <input type="text" name="fbcomments_title" value="<?php echo get_option('fbcomments_title'); ?>" /> Default is <strong>Comments</strong>. This will be nested within a &#60;H3&#62; tag</p>
	<p><label>Background Colour</label> <input type="text" name="fbcomments_bg" value="<?php echo get_option('fbcomments_bg'); ?>" /> Facebook's default is <strong>#F2F2F2</strong>. This may affect the appearance of other Facebook usage in your site. To disable, leave blank and style <strong>.fb_ltr</strong> within your own CSS.</p>
<br style="clear:both"/>
</div>
</div>

</div>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="fbcomments_fbml,fbcomments_posts,fbcomments_pages,fbcomments_homepage,fbcomments_appID,fbcomments_admins,fbcomments_count,fbcomments_width,fbcomments_bg,fbcomments_title" />
		<div style="clear:both;padding-top:0px;"></div>
		<p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options') ?>" /></p>
		<div style="clear:both;padding-top:20px;"></div>
		</form>

</div>

<?php }

// Add settings link on plugin page
function fb_link($links) {
  $settings_link = '<a href="options-general.php?page=fbcomments">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'fb_link' );

?>