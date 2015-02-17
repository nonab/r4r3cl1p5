<?php

/**
 * Gets the first image of a post or the featured image (post thumbnail)
 * 
 * @uses evolution_post_thumbURL() and evolution_get_first_image()
 * @since 1.0.6
 * 
 */
function evolution_box_thumbnails() { 

if(has_post_thumbnail()) {
                $thumb = evolution_post_thumbURL();
				echo '<img src="';
				echo plugins_url( 'evolution-sidebar-box/' ) . '/timthumb.php?src=' . $thumb . '&amp;h=60&amp;w=60" alt="';
                the_title();
				echo '" />';

			} else {

                $image = evolution_get_first_image();
				if($image) :
					echo '<img src="';
					echo plugins_url( 'evolution-sidebar-box/' ) . '/timthumb.php?src=' . $image . '&amp;h=60&amp;w=60" alt="';
					the_title();
					echo '" />';
				endif;
			}
}

/**
 * 
 * Gets the post thumbnail
 *
 * @since 1.0.6 
 */
function evolution_post_thumbURL() {
		global $post, $posts;
		$thumbnail = '';
		ob_start();the_post_thumbnail(180,180,true);$toparse=ob_get_contents();ob_end_clean();
		preg_match_all('/src=("[^"]*")/i', $toparse, $img_src); $thumbnail = str_replace("\"", "", $img_src[1][0]);
		return $thumbnail;
}

/**
 * 
 * Gets the first image of a post
 * 
 * @since 1.0.6
 * 
 */
function evolution_get_first_image() {
 		global $post, $posts;
 		$first_img = '';
 		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
 		if(isset($matches[1][0])){
 		$first_img = $matches [1][0];
 		return $first_img;
 		}
}