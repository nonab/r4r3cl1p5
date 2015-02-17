<?php
global $tooltips;

$tooltips = array();
$t = 'Users in a User Group joined with this Permission Set and assigned to a Forum... - ';

$tooltips['view_forum'] = $t.'Can view all aspects of the forum - topics and posts';
$tooltips['view_forum_lists'] = $t.'Can only view the group and forum listing';
$tooltips['view_forum_topic_lists'] = $t.'Can only view the group, forum lsting and topic listing';
$tooltips['view_admin_posts'] = $t.'Can view posts made by a forum Admin in the forum';
$tooltips['view_lown_admin_posts'] = $t.'Can view only own posts and admin/mod posts';
$tooltips['start_topics'] = $t.'Can Create new topics in the forum';
$tooltips['reply_topics'] = $t.'Can reply to all topics in the forum';
$tooltips['reply_own_topics'] = $t.'Can only reply to own topics';
$tooltips['bypass_flood_control'] = $t.'Can bypass wait time between posts';
$tooltips['edit_own_topic_titles'] = $t.'Cn edit the titles of topics they have created in the forum';
$tooltips['edit_any_topic_titles'] = $t.'Can edit the title of any topic in the forum';
$tooltips['pin_topics'] = $t.'Can pin topics to the top of the topic listing in the forum';
$tooltips['move_topics'] = $t.'Can move topics from the forum into another';
$tooltips['move_posts'] = $t.'Can move posts in a forum topic to a new topic';
$tooltips['lock_topics'] = $t.'Can lock topics in the forum and stop any new posts being made';
$tooltips['delete_topics'] = $t.'Can delete topics from the forum';
$tooltips['edit_own_posts_forever'] = $t.'Can edit posts they have made in te forum at any time';
$tooltips['edit_own_posts_reply'] = $t.'Can edit posts they have made in the forum until a new post is made';
$tooltips['edit_any_post'] = $t.'Can edit any posts in any topic in the forum';
$tooltips['delete_own_posts'] = $t.'Can delete posts they have made in any topic in the forum';
$tooltips['delete_any_post'] = $t.'Can delete any post in any topic in the forum';
$tooltips['pin_posts'] = $t.'Can pin a post to the top of the post list in any topic in the forum';
$tooltips['reassign_posts'] = $t.'Can reassign posts in any topic in the forum to a different user';
$tooltips['view_email'] = $t.'Can view the email address of any user who has posted in any topic in the forum';
$tooltips['view_profiles'] = $t.'Can view the profile of any user who has posted in any topic in the forum';
$tooltips['view_members_list'] = $t.'Can view the members listing. This may or may not be limted to other members who share user groups and permissions.';
$tooltips['report_posts'] = $t.'Can report any post as being suspect in any topic in the forum to the forum Admin';
$tooltips['bypass_math_question'] = $t."Can make a post in any topic in the forum without having to complete the 'spam' math question";
$tooltips['bypass_moderation'] = $t.'Can make all posts in any topic in the forum without requiring Admin approval';
$tooltips['bypass_moderation_once'] = $t.'Can make posts in any topic in the forum after having their first post approved by a user capable of moderating posts';
$tooltips['moderate_posts'] = $t.'Can approve posts made by other users in any topic in the forum';
$tooltips['use_signatures'] = $t.'Can create and use a signature in their posts made in the forum';
$tooltips['upload_avatars'] = $t.'Can upload an avatar to be used in the forums subject to the forum wide avatar preferences';
$tooltips['view_links'] = $t.'Can view links within post content';
$tooltips['use_spoilers'] = $t.'Can use spoilers in posts to hide content requiring action to view';
$tooltips['can_use_smileys'] = $t.'Can use smileys in posts';
$tooltips['can_use_iframes'] = $t.'Can use iframes in posts';
$tooltips['view_own_admin_posts'] = $t.'Can view only own posts and admin/mod posts';
$tooltips['create_links'] = $t.'Can create links in posts';
$tooltips = apply_filters('sph_perms_tooltips', $tooltips, $t);
?>