<?php

add_action('admin_menu', 'show_fbcomments_options');

function show_fbcomments_options() {
    // Add a new submenu
    add_options_page('Facebook Comments Options', 'Facebook Comments', 8, 'fbcomments', 'fbcomments_options');


	//Add options
	add_option('fbcomments_fbml', 'on');
	add_option('fbcomments_opengraph', 'off');
	add_option('fbcomments_fbns', 'off');
	add_option('fbcomments_posts', 'on');
	add_option('fbcomments_pages', 'off');
	add_option('fbcomments_homepage', 'off');
	add_option('fbcomments_appID', '');
	add_option('fbcomments_migrated', 'off');
	add_option('fbcomments_num', '10');
	add_option('fbcomments_count', 'yes');
	add_option('fbcomments_countmsg', 'comments');
	add_option('fbcomments_title', 'Comments');
	add_option('fbcomments_width', '450');
	add_option('fbcomments_bg', '');
	add_option('fbcomments_boxstyle', '');
	add_option('fbcomments_h3style', '');
	add_option('fbcomments_countstyle', '');
	add_option('fbcomments_commentstyle', '');
	add_option('fbcomments_linklove', 'on');
	add_option('fbcomments_scheme', 'light');
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

<div class="postbox-container" style="width:100%;">
	<div class="metabox-holder">
	<div class="postbox">
		<h3 class="hndle"><span>Resources</span></h3>
		<div style="margin:20px;">
			<div style="width:180px; text-align:center; float:right; font-size:10px; font-weight:bold">
				<a href="http://pleer.co.uk/go/twitter-paypal/">
				<img src="https://www.paypal.com/en_GB/i/btn/btn_donateCC_LG.gif" border="0" style="padding-bottom:10px" /></a>
			</div>
	<a href="http://developers.facebook.com/docs/reference/plugins/comments/" style="text-decoration:none" target="_blank">Facebook Comments Developer Homepage</a><br /><br />
	<a href="http://pleer.co.uk/wordpress/plugins/facebook-comments/" style="text-decoration:none" target="_blank">Plugin Homepage</a> <small>- More information on this plugin</small><br /><br />
	<a href="http://pleer.co.uk/wordpress/plugins/" style="text-decoration:none" target="_blank">WordPress Plugins</a> <small>- I have developed other plugins including a <a href="http://pleer.co.uk/wordpress/plugins/wp-twitter-feed/" style="text-decoration:none" target="_blank">Twitter Feed</a> and <a href="http://pleer.co.uk/wordpress/plugins/rss-feed-reader/" style="text-decoration:none" target="_blank">RSS Feed Reader</a>!</small><br /><br />

		</div>
	</div>
	</div>

	<div class="metabox-holder">
	<div class="postbox">
		<h3 class="hndle"><span>Initial Setup via Facebook</span></h3>
		<div style="margin:20px;">
	<a href="http://www.facebook.com/developers/createapp.php" style="text-decoration:none" target="_blank">Create an App to handle your comments</a><small>- call it anything e.g. "Comments". Once you have your App ID, enter it into the space below</small><br /><br />
	<a href="http://www.facebook.com/developers/apps.php" style="text-decoration:none" target="_blank">App Setup</a> <small>- to set up, choose your App and click <strong>Edit Settings</strong>. Click on the <strong>Web Site</strong> tab on the left. Ensure you enter the <strong>Site URL</strong> (e.g. http://pleer.co.uk/) and <strong>Site domain <em>WITHOUT THE WWW.</em></strong> (e.g. pleer.co.uk) and hit <strong>Save Changes</strong></small><br /><br />
</div>
</div>
</div>


	<div class="metabox-holder">
	<div class="postbox">
		<h3 class="hndle"><span>Moderation and Testing</span></h3>
		<div style="margin:20px;">
	<a href="http://developers.facebook.com/tools/comments" style="text-decoration:none" target="_blank">Comment Moderation Area</a><small>- here you can view and moderate all comments. This area also has a <strong>Settings</strong> area where you can control how comments are published<br /><em>Note that this can also be controlled by moderators within the posts or pages directly</em></small><br /><br />
	<a href="http://developers.facebook.com/tools/lint" style="text-decoration:none" target="_blank">Facebook URL Linter</a> <small>- enter a URL where the comment box appears and it will validate the page for you, providing any errors you may have.</small><br /><br />
</div>
</div>
</div>


	<div class="metabox-holder">
	<div class="postbox">
		<h3 class="hndle"><span>Settings</span></h3>
		<div style="margin:20px;">
<p>To turn off WordPress comments, click <a href="<?php bloginfo('url'); ?>/wp-admin/options-discussion.php" target="_blank">here</a> to go to your discussion settings. <strong>Untick</strong> the option saying <em>"Allow people to post comments on new articles"</em><br /><small>You may also have to disable comments within your own theme's settings</small></p>
		<p>
			<?php
				if (get_option('fbcomments_fbml') == 'on') {echo '<input type="checkbox" name="fbcomments_fbml" checked="yes" />';}
				else {echo '<input type="checkbox" name="fbcomments_fbml" />';}
			?>
			<label>Enable XFBML</label><small>only disable this if you already have XFBML enabled elsewhere</small>
		</p>
		<p>
			<?php
				if (get_option('fbcomments_fbns') == 'on') {echo '<input type="checkbox" name="fbcomments_fbns" checked="yes" />';}
				else {echo '<input type="checkbox" name="fbcomments_fbns" />';}
			?>
			<label>Enable FB Namespace</label><small>only enable this if Facebook comments are not appearing</small>
		</p>
		<p>
			<?php
				if (get_option('fbcomments_opengraph') == 'on') {echo '<input type="checkbox" name="fbcomments_opengraph" checked="yes" />';}
				else {echo '<input type="checkbox" name="fbcomments_opengraph" />';}
			?>
			<label>Enable Open Graph</label><small>only enable this if Facebook comments are not appearing, not all information is being passed to Facebook or if you have not enabled Open Graph elsewhere within WordPress</small>
		</p>
		<p>
			<?php
				if (get_option('fbcomments_migrated') == 'on') {echo '<input type="checkbox" name="fbcomments_migrated" checked="yes" />';}
				else {echo '<input type="checkbox" name="fbcomments_migrated" />';}
			?>
			<label>Enable Migration Option</label><small>only enable this if you have received an email from Facebook mentioning an option called <strong>migrated="1"</strong> although this should never be needed</small>
		</p>
		<p>
			<?php
				if (get_option('fbcomments_linklove') != '') {echo '<input type="checkbox" name="fbcomments_linklove" checked="yes" />';}
				else {echo '<input type="checkbox" name="fbcomments_linklove" />';}
			?>
			<label>Credit</label><small>untick this box to remove the link to the plugin homepage. If you do, please think of <strong><a href="http://pleer.co.uk/go/twitter-paypal/">donating</a></strong>!</small>
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
	<p><label>Number of Comments</label> <input type="text" name="fbcomments_num" value="<?php echo get_option('fbcomments_num'); ?>" /> Default is <strong>10</strong></p>
	<p><label>Width (px)</label> <input type="text" name="fbcomments_width" value="<?php echo get_option('fbcomments_width'); ?>" /> Default is <strong>450</strong>, minimum must be <strong>350</strong></p>
	<p><label>Title</label> <input type="text" name="fbcomments_title" value="<?php echo get_option('fbcomments_title'); ?>" /> Default is <strong>Comments</strong>. This will be nested within a &#60;H3&#62; tag</p>
		<p>
			<?php
				if (get_option('fbcomments_count') == 'on') {echo '<input type="checkbox" name="fbcomments_count" checked="yes" />';}
				else {echo '<input type="checkbox" name="fbcomments_count" />';}
			?>
			<label>Show comment count</label>
		</p>
			<p><label>Comment text</label> <input type="text" name="fbcomments_countmsg" value="<?php echo get_option('fbcomments_countmsg'); ?>" />text to go after comment count. Default is <strong>comments</strong>. This will be nested within a &#60;p&#62; tag</p>
</div>
</div>
</div>

	<div class="metabox-holder">
	<div class="postbox">
		<h3 class="hndle"><span>Customisation and Styling</span></h3>
		<div style="margin:20px;">
<p>This may affect the appearance of other Facebook usage in your site. To disable anything specific, or use your own CSS file to style everything, simply leave the field blank and use the CSS style reference!</p>
		<p>



			<label>Colour Scheme</label>
			<div style="margin-left: 45%; margin-top: -20px;"><input type="radio" name="fbcomments_scheme" value="light" <?php if (get_option('fbcomments_scheme') == 'light') {echo 'checked';} ?> /><label>light</label>
			<br /><br /><input type="radio" name="fbcomments_scheme" value="dark" <?php if (get_option('fbcomments_scheme') == 'dark') {echo 'checked';} ?> /> <label>dark</label>
		</div></p>
	<p><label>Whole Comment Box style</label> <input type="text" name="fbcomments_boxstyle" value="<?php echo get_option('fbcomments_boxstyle'); ?>" /> CSS style: <strong>.fbcomments</strong></p>
	<p><label>Title Style</label> <input type="text" name="fbcomments_h3style" value="<?php echo get_option('fbcomments_h3style'); ?>" /> CSS style: <strong>.fbcomments h3</strong></p>
	<p><label>Comment Count Style</label> <input type="text" name="fbcomments_countstyle" value="<?php echo get_option('fbcomments_countstyle'); ?>" /> CSS style: <strong>.fbcomments p</strong></p>
	<p><label>Comment Box Style</label> <input type="text" name="fbcomments_commentstyle" value="<?php echo get_option('fbcomments_commentstyle'); ?>" /> CSS style: <strong>.fbcommentbox</strong></p>
	<p><label>Facebook Comment Box background</label> <input type="text" name="fbcomments_bg" value="<?php echo get_option('fbcomments_bg'); ?>" /> CSS style: <strong>#content .fb_ltr { background: YOUR_COLOUR; }</strong> // Facebook's default: <strong>background: #F2F2F2;</strong></p>


</div></div>
</div>

	<div class="metabox-holder">
<div class="postbox">
<h3 class="hndle">Insert Manually via Shortcode</h3>
<div style="text-decoration:none; padding:10px">
<p>The settings above are for automatic insertion of the Facebook Comment box.</p>
<p>You can insert the comment box manually in any page or post or template by simply using the shortcode <strong>[fbcomments]</strong>. To enter the shortcode directly into templates using PHP, enter <strong>echo do_shortcode('[fbcomments]');</strong></p>
<p>You can also use the options below to override the the settings above.</p>
<ul>
<li><strong>url</strong> - leave blank for current URL</li>
<li><strong>width</strong> -  minimum must be <strong>350</strong></li>
<li><strong>title</strong></li>
<li><strong>num</strong> - enter a number</li>
<li><strong>count</strong> - on/off</li>
<li><strong>countmsg</strong></li>
<li><strong>scheme</strong> - colour scheme: light/dark</li>
<li><strong>linklove</strong> - on/off</li>
</ul>
<p>An example using these options is <strong>[fbcomments url="http://pleer.co.uk/wordpress/plugins/facebook-comments/" width="375" count="off" num="3" countmsg="wonderful comments!"]</strong>
</p>

</div></div></div>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="fbcomments_fbml,fbcomments_fbns,fbcomments_opengraph,fbcomments_posts,fbcomments_pages,fbcomments_homepage,fbcomments_num,fbcomments_appID,fbcomments_count,fbcomments_width,fbcomments_bg,fbcomments_boxstyle,fbcomments_h3style,fbcomments_countstyle,fbcomments_commentstyle,fbcomments_title,fbcomments_migrated,fbcomments_countmsg,fbcomments_linklove,fbcomments_scheme" />
<div class="submit"><input type="submit" class="button-primary" name="submit" value="Save Facebook Comments Settings"></div>

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