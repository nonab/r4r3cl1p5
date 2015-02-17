<?php
/*
Simple:Press
Ahah call for acknowledgements
$LastChangedDate: 2014-06-03 18:16:31 -0700 (Tue, 03 Jun 2014) $
$Rev: 11507 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

sp_forum_api_support();

$forumid = sp_esc_int($_GET['forum']);
if (empty($forumid)) die();

$userid = sp_esc_int($_GET['userid']);
if (empty($forumid)) die();

$sql = "SELECT auth_id, auth_name, auth_cat, authcat_name FROM ".SFAUTHS."
		JOIN ".SFAUTHCATS." ON ".SFAUTHS.".auth_cat = ".SFAUTHCATS.".authcat_id
		WHERE active = 1
		ORDER BY auth_cat, auth_id";
$authlist = spdb_select('set', $sql);

global $spGlobals;
$curcol = 1;
$category = '';

foreach ($authlist as $a) {
	$auth_id = $a->auth_id;
	$auth_name = $a->auth_name;

	if ($category != $a->authcat_name) {
		$category = $a->authcat_name;
		$curcol = 1;
		echo '<div class="spAuthCat">'.spa_text($category).'</div>';
	}

	echo '<div class="spColumnSection">';
	if (sp_get_auth($auth_name, $forumid, $userid)) {
		echo '<img src="'.sp_find_icon(SPTHEMEICONSURL, 'sp_PermissionYes.png').'" />&nbsp;&nbsp;'.spa_text($spGlobals['auths'][$auth_id]->auth_desc);
	} else {
		echo '<img src="'.sp_find_icon(SPTHEMEICONSURL, 'sp_PermissionNo.png').'" />&nbsp;&nbsp;'.spa_text($spGlobals['auths'][$auth_id]->auth_desc);
	}
	echo '</div>';

	$curcol++;
	if ($curcol > 2) $curcol = 1;
}

echo '<p><a href="javascript:void(null)" onclick="spjClearIt(\'perm'.$forumid.'\'); spjSetProfileDataHeight();">';
echo '<input type="button" id="spClosePerms" class="spSubmit" value="'.sp_text('Close').'" />';
echo '</a></p>';
?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		baseHeight = Math.max(jQuery("#spProfileData").outerHeight(true) + 10, jQuery("#spProfileMenu").outerHeight(true));
       	jQuery("#spProfileContent").height(baseHeight + jQuery("#spProfileHeader").outerHeight(true));
	})
	</script>
<?php

die();
?>