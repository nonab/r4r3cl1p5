<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Theme custom function file
#	Theme		:	iForum
#	File		:	custom functions
#	Author		:	Simple:Press
#
#	The 'functions' file can be used for custom functions & is loaded with each template
#
# --------------------------------------------------------------------------------------

# A small javascript routine has been used to replace standard browser tooltips with
# more appealing graphics. You can turn this off by setting SP_TOOLTIPS to false.

if (!defined('SP_TOOLTIPS')) define('SP_TOOLTIPS', true);

# ------------------------------------------------------------------------------------------

add_action('init',                  'iForum_textdomain');
add_filter('sph_editor_check',      'iForum_page_check');
add_filter('sph_plupload_check',    'iForum_page_check');
add_filter('sph_captcha_check',     'iForum_page_check');
add_filter('sph_postpreview_check', 'iForum_page_check');
add_filter('sph_syntax_check',      'iForum_page_check');
add_filter('sph_post_as_js_check',  'iForum_page_check');

# load the theme textdomain for tranlations
function iForum_textdomain() {
	sp_theme_localisation('spIforum');
}

function iForum_page_check($pageview) {
	$pageview.= ' group';
    return $pageview;
}

?>