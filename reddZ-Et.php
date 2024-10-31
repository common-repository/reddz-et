<?php
/*
Plugin Name: reddZ-Et
Plugin URI: http://blog.rswr.net/2008/07/29/reddz-et-wordpress-plugin/
Description: Automatically displays a "reddit" button for each post. Full <a href="options-general.php?page=reddZ-Et.php">admin options</a> available.
Version: 1.0.4
Author: Ryan Christenson (The RSWR Network)
Author URI: http://www.rswr.net/
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists("reddZEt")) {
	class reddZEt {
		var $adminOptionsName = "reddZEtAdminOptions";
		function reddZEt() { //constructor
		}

		//Returns an array of admin options
		function getAdminOptions() {
			$rZEtAdminOptions = array('home' => 'true', 'post' => 'true', 'page' => 'true', 'tag' => 'true', 'arch' => 'true', 'srch' => 'true','promote' => 'true', 'display1' => 'true', 'style' => 'true');
			$rZEtOptions = get_option($this->adminOptionsName);
			if (!empty($rZEtOptions)) {
				foreach ($rZEtOptions as $key => $option)
				$rZEtAdminOptions[$key] = $option;
			}
			update_option($this->adminOptionsName, $rZEtAdminOptions);
			return $rZEtAdminOptions;
		}
		function init() {
			$this->getAdminOptions();
		}

		//Prints out the admin page
		function printAdminPage() {
			$rZEtOptions = $this->getAdminOptions();
			if (isset($_POST['update_reddZEtSettings'])) {
			
				// Save Settings
				if($_POST['home'] == "on") update_option('rZEt_home', "checked=on");
  				else update_option('rZEt_home', "");
  				if($_POST['post'] == "on") update_option('rZEt_post', "checked=on");
  				else update_option('rZEt_post', "");
  				if($_POST['page'] == "on") update_option('rZEt_page', "checked=on");
  				else update_option('rZEt_page', "");
  				if($_POST['tag'] == "on") update_option('rZEt_tag', "checked=on");
  				else update_option('rZEt_tag', "");
  				if($_POST['arch'] == "on") update_option('rZEt_arch', "checked=on");
  				else update_option('rZEt_arch', "");
  				if($_POST['srch'] == "on") update_option('rZEt_srch', "checked=on");
  				else update_option('rZEt_srch', "");
  				if($_POST['promote'] == "on") update_option('rZEt_promote', "checked=on");
  				else update_option('rZEt_promote', "");
  				$rz_display1 = $_POST['display1'];
  				$rz_style = $_POST['style'];

				// Update Settings
				update_option('rZEt_display1', $rz_display1);
				update_option('rZEt_style', $rz_style);

				// Update Admin
				update_option($this->adminOptionsName, $rZEtOptions);
?>
<div class="updated"><p><span class="tblBold"><?php _e("Options Updated!", "reddZEt");?></span></p></div>
<?php
			} else {
				// Retrieve Options
				$rz_display1 = get_option('rZEt_display1');
				$rz_style = get_option('rZEt_style');
			}
?>
<div class="wrap">
<h2><?php _e('reddZ-Et 1.0.4','diggZEt'); ?></h2>
<style type="text/css">
<!--
.tblPad td{padding:10px;text-align:left;}
.tblPad th{text-align:left;vertical-align:top;}
.tblRed{color:red;font-weight:700;}
.tblBold{font-weight:700;}
-->
</style>
<form class="form-table" method="post" action="<?php _e($_SERVER["REQUEST_URI"]); ?>">
<div class="updated"><p><span class="tblBold"><?php _e('This plugin is soon to be discontinued. Check out <a href="http://blog.rswr.net/2009/02/14/social-media-wordpress-plugin/" target="_blank">S-ButtonZ</a> the new combined version of all four of our social media button plugins.<br /><br /><a href="http://wordpress.org/extend/plugins/s-buttonz/" target="_blank">Download S-ButtonZ Here</a>', "buzzZEt");?></span></p></div>
<?php //Display Settings ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Display Settings','reddZEt'); ?></span></h3>
      <div class="inside">
<table width="100%">
<tr>
<th scope="row">
Hide Buttons On...
</td><td>
<span class="tblBold">
<input type="checkbox" name="home" <?php _e(get_option('rZEt_home')); ?> /> Home Page (Recommended to speed up your Home Page's load time.)<br />
<input type="checkbox" name="post" <?php _e(get_option('rZEt_post')); ?> /> Posts<br />
<input type="checkbox" name="page" <?php _e(get_option('rZEt_page')); ?> /> Pages<br />
<input type="checkbox" name="tag" <?php _e(get_option('rZEt_tag')); ?> /> Tag Pages<br />
<input type="checkbox" name="arch" <?php _e(get_option('rZEt_arch')); ?> /> Archives (This is all Category, Author and Date based pages)<br />
<input type="checkbox" name="srch" <?php _e(get_option('rZEt_srch')); ?> /> Search Page Results<br />
<span class="tblRed">Single Page or Post</span>
<br />Note: Add the following html snippet to any page or post you would like to the hide the reddit button on.
<br />&lt;!--reddZ=none--&gt;
</span>
</td></tr>
<tr>
<th scope="row">
Button Position
</td><td>
<select id="display1" name="display1">
	<option value="" <?php _e($rz_display1=="" ? "selected" : ""); ?>>Top Right</option>
	<option value="left" <?php _e($rz_display1=="left" ? "selected" : ""); ?>>Top Left</option>
	<option value="bottomL" <?php _e($rz_display1=="bottomL" ? "selected" : ""); ?>>Bottom Left</option>
	<option value="bottomR" <?php _e($rz_display1=="bottomR" ? "selected" : ""); ?>>Bottom Right</option>
</select>
</td></tr>
</table>
      </div>
    </div>
  </div>
<?php //Button Settings ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Button Settings','reddZEt'); ?></span></h3>
      <div class="inside">
<table width="100%">
<tr>
<th scope="row">
Choose Style
</td><td style="vertical-align:top;">
<select id="style" name="style">
	<option value="" <?php _e($rz_style=="" ? "selected" : ""); ?>>Style 1</option>
	<option value="2" <?php _e($rz_style=="2" ? "selected" : ""); ?>>Style 2</option>
	<option value="3" <?php _e($rz_style=="3" ? "selected" : ""); ?>>Style 3</option>
</select>
</td>
<td>
<img src="<?php _e(reddZEt_Url()); ?>reddit-examples.png" width="280px" height="100px" />
</td></tr>
</table>
      </div>
    </div>
  </div>
<?php //Other Settings ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Other Settings','reddZEt'); ?></span></h3>
      <div class="inside">
<table width="100%">
<tr>
<th scope="row">
Help promote reddZ-Et?
</td><td>
<input type="checkbox" name="promote" <?php _e(get_option('rZEt_promote')); ?> />  <span class="tblBold">Place a support link at the bottom of each post/page that uses a reddit button. Thanks for your support!</span>
</td></tr>
</table>
      </div>
    </div>
  </div>
<?php //More Plugins ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Like this plugin?','reddZEt'); ?> Try another Social Bookmarking Plugin by <a href="http://www.rswr.net/">The RSWR Network</a></span></h3>
      <div class="inside">
      <ul>
<li><a href="http://blog.rswr.net/2008/11/13/yahoo-buzz-wordpress-plugin/" target="blank">buzzZ-Et (Yahoo! Buzz Buttons)</a></li>
<li><a href="http://blog.rswr.net/2008/05/23/wordpress-plugin-diggz-et/" target="blank">diggZ-Et (Digg Buttons)</a></li>
<li><a href="http://blog.rswr.net/2008/07/28/dzonez-et-wordpress-plugin/" target="blank">dzoneZ-Et (dZone Buttons)</a></li>
      </ul>
      </div>
    </div>
  </div>
	<input type="submit" name="update_reddZEtSettings" value="<?php _e('Update Settings', 'reddZEt') ?>" class="button-primary action" /><br /><br />
</form>
</div>
<?php
		}
	}
}

// Get Plugin URL
function reddZEt_Url() {
	$path = dirname(__FILE__);
	$path = str_replace("\\","/",$path);
	$path = trailingslashit(get_bloginfo('wpurl')) . trailingslashit(substr($path,strpos($path,"wp-content/")));
	return $path;
}

// Initialize the admin panel
if (!function_exists("reddZEt_ap")) {
	function reddZEt_ap() {
		global $rZEt_init;
		if (!isset($rZEt_init)) {
			return;
		}
		if (function_exists('add_options_page')) {
			add_options_page('reddZ-Et', 'reddZ-Et', 9, basename(__FILE__), array(&$rZEt_init, 'printAdminPage'));
		}
	}
}

// Create Button
if (!function_exists("reddZEt_But")) {
	function reddZEt_But($content) {
		// Retrieve Options
		$rz_display1 = get_option('rZEt_display1');
		$rz_style = get_option('rZEt_style');
?>
<?php 
// Display Top Right
if($rz_display1 == "") {
	if($rz_style == "") {
_e('<div style="float: right; width: 42px; padding-right: 90px; margin: 0 0 0 10px;">','reddZEt');
	}
	elseif($rz_style == "2") {
_e('<div style="float: right; width: 42px; padding-right: 10px; margin: 0 0 0 10px;">','reddZEt');
	}
	elseif($rz_style == "3") {
_e('<div style="float: right; width: 42px; padding-right: 30px; margin: 0 0 0 10px;">','reddZEt');
	}
}

// Display Top Left
elseif($rz_display1 == "left") {
	if($rz_style == "") {
_e('<div style="float: left; width: 42px; padding-right: 90px; margin: 0 10px 0 0;">','reddZEt');
	}
	elseif($rz_style == "2") {
_e('<div style="float: left; width: 42px; padding-right: 10px; margin: 0 10px 0 0;">','reddZEt');
	}
	elseif($rz_style == "3") {
_e('<div style="float: left; width: 42px; padding-right: 30px; margin: 0 10px 0 0;">','reddZEt');
	}
}

// Display Bottom Left
elseif($rz_display1 == "bottomL") {
	if($rz_style == "") {
_e('<div style="position:relative; width: 100%; padding: 0 0 40px 0;">','reddZEt');
_e('<div style="position:absolute; bottom: 10px; width: 42px;">','reddZEt');
	}
	elseif($rz_style == "2") {
_e('<div style="position:relative; width: 100%; padding: 0 0 100px 0;">','reddZEt');
_e('<div style="position:absolute; bottom: 10px; width: 42px;">','reddZEt');
	}
	elseif($rz_style == "3") {
_e('<div style="position:relative; width: 100%; padding: 0 0 80px 0;">','reddZEt');
_e('<div style="position:absolute; bottom: 10px; width: 42px;">','reddZEt');
	}
}

// Display Bottom Right
elseif($rz_display1 == "bottomR") {
	if($rz_style == "") {
_e('<div style="position:relative; width: 100%; padding: 0 0 40px 0;">','reddZEt');
_e('<div style="position:absolute; bottom: 10px; right:90px; width: 42px;">','reddZEt');
	}
	elseif($rz_style == "2") {
_e('<div style="position:relative; width: 100%; padding: 0 0 100px 0;">','reddZEt');
_e('<div style="position:absolute; bottom: 10px; right:10px; width: 42px;">','reddZEt');
	}
	elseif($rz_style == "3") {
_e('<div style="position:relative; width: 100%; padding: 0 0 80px 0;">','reddZEt');
_e('<div style="position:absolute; bottom: 10px; right:30px; width: 42px;">','reddZEt');
	}
}
?>
<script>
<!--
reddit_url='<?php the_permalink(); ?>';
reddit_title='<?php the_title(); ?>';
//-->
</script>
<script type="text/javascript" src="http://www.reddit.com/button.js?t=<?php if ($rz_style == '') _e('1','reddZEt'); else _e($rz_style,'reddZEt'); ?>"></script>
</div>
<?php
	}
}

// Add Button
if (!function_exists("reddZEt_AddBut")) {
	function reddZEt_AddBut($content) {
		$rz_display1 = get_option('rZEt_display1');
		//error_reporting(E_ALL);
		if(is_home() && get_option('rZEt_home') == "checked=on") return $content;
		if(is_single() && get_option('rZEt_post') == "checked=on") return $content;
		if(is_page() && get_option('rZEt_page') == "checked=on") return $content;
		if(is_tag() && get_option('rZEt_tag') == "checked=on") return $content;
		if(is_archive() && get_option('rZEt_arch') == "checked=on") return $content;
		if(is_search() && get_option('rZEt_srch') == "checked=on") return $content;
		if (strpos($content, "reddZ=none") == TRUE) return $content;
		if($rz_display1 == "bottomL" || $rz_display1 == "bottomR") {
			$content = reddZEt_But($content).$content;
			if(is_page() || is_single()) {
				if (get_option('rZEt_promote') == "checked=on") {
					$content .= "<p>Reddit buttons brought to you by <a href='http://blog.rswr.net/2008/07/29/reddz-et-wordpress-plugin/'>reddZ-ET (WordPress Plugin)</a></p></div>";
				} else {
					$content .= '</div>';
				}
			} else {
				$content .= '</div>';
			}
			return $content;
		}
		else {
			$content = reddZEt_But($content).$content;
			if(is_page() || is_single()) {
				if (get_option('rZEt_promote') == "checked=on") {
					$content .= "<p>Reddit buttons brought to you by <a href='http://blog.rswr.net/2008/07/29/reddz-et-wordpress-plugin/'>reddZ-ET (WordPress Plugin)</a></p>";
				}
			}
			return $content;
		}
	}
}

// Initialize Class
if (class_exists("reddZEt")) {
	$rZEt_init = new reddZEt();
}

//Actions and Filters
if (isset($rZEt_init)) {
	//Actions
	add_action('reddZ-Et/reddZ-Et.php', array(&$rZEt_init, 'init'));
	add_action('admin_menu', 'reddZEt_ap');
	//Filters
	add_filter('the_content', 'reddZEt_AddBut');
}

?>
