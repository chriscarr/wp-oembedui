<?php
/*
Plugin Name: oEmbed UI
Plugin URI: http://chriscarr.me
Description: A simple UI for native WordPress oEmbed functionality.
Version: 0.1
Author: Chris Carr - C2 IT, LLC
Author URI: http://chriscarr.me
License: GPLv2 or later

------------------------------------------------------------------------

Copyright 2009-2013 C2 IT, LLC

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

*/

add_action('media_buttons', 'oc_embedvideo_addbutton', 25);

function oc_embedvideo_addbutton() {
	if (!in_array(basename($_SERVER['PHP_SELF']), array('post.php', 'page.php', 'page-new.php', 'post-new.php'))) {
		return;
	}

	echo '<a href="#TB_inline?width=480&inlineId=add_embedvideo_options" class="thickbox button add_embedvideo" id="add_embedvideo" title="' . __("Embed Video", 'carrot') . '"><span class="dashicons-video-alt3"></span> ' . __("Embed Video", "carrot") . '</a>';
	?>
	<style>
		.dashicons-video-alt3:before {
			content: "\f236";
			font: 400 18px/17px 'dashicons';
			speak: none;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			color: #888;
			vertical-align: middle;
		}
	</style>
	<div id="add_embedvideo_options" style="display:none;">
		<div class="wrap">
			<h3>Embed a Video</h2>
			<p>Copy and paste in the URL of the YouTube or Vimeo page with the video you want to embed (not an "embed" code).<br />
			<small>e.g. http://www.youtube.com/watch?v=xxxxxxxxxxx</small></p>
			<p><input type="text" placeholder="paste video URL..." class="oc_video_url" style="width: 300px;" /></p>
			<p><input type="button" class="button-primary oc_video_url" value="Insert Video" onclick="OCInsertVideo();"/></p>
		</div>
	</div>
<?php 
}

if (in_array(basename($_SERVER['PHP_SELF']), array('post.php', 'page.php', 'page-new.php', 'post-new.php'))) {
	add_action('admin_footer', 'oc_embedvideo_addscripts');
}

function oc_embedvideo_addscripts() {
	?>
	<script>
		function OCInsertVideo() {
			var htmlcode;
			htmlcode = '[embed type="oEmbed"]' + jQuery('#TB_ajaxContent .oc_video_url').val() + '[/embed]';
			console.log(htmlcode);
			console.log(jQuery('#TB_ajaxContent .oc_video_url').val());
			window.send_to_editor(htmlcode);
			return false;
		}
	</script>
	<?php
}