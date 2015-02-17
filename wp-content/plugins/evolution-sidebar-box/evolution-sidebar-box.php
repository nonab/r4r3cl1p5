<?php
/*
Plugin Name: Evolution Sidebar Box
Plugin URI: http://hechtmediaarts.com/evolution-sidebar-box/
Description: Creates a new and simple to use widget that adds a sidebar box with recent posts, last comments, categories, popular posts, a tag cloud and the archives to the sidebar.
Version: 1.0.9
Author: Hecht MediaArts
Author URI: http://hechtmediaarts.com
License: http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
*/

/**
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

add_action('widgets_init', 'evolution_sidebar_box_init');

function evolution_sidebar_box_init() {

	register_widget('evolution_sidebar_box');

		// Include the required files
		require_once dirname( __FILE__ ) . '/recent-comments.php';
		require_once dirname( __FILE__ ) . '/get-first-image.php';

	load_plugin_textdomain( 

		'evolution', 
		false, 
		dirname( 
		plugin_basename( __FILE__ ) ) . '/languages/' );

}

	class Evolution_Sidebar_Box extends WP_Widget {

/**
 * Register widget with WordPress.
 */
	public function __construct() {
		parent::__construct(
	 		'evolution_sidebar_box', // Base ID
			'Evolution Sidebar Box', // Name
			array( 'description' => __( 'Adds a Sidebar Box with recent posts, last comments, categories, popular posts, a tag cloud and the archives to the sidebar. No Options.', 'evolution' ), ) // Args
		);

		function evolution_register_script_style() {

			wp_register_script( 'evolution_sidebar_box', plugins_url( '/js/aside-script.js', __FILE__ ), array( 'jquery' ) );
			wp_register_style( 'evolution_sidebar_box', plugins_url('/css/aside-style.css', __FILE__) );
			wp_enqueue_script('evolution_sidebar_box');
			wp_enqueue_style('evolution_sidebar_box');
		}

		// Adding the javascript and css only if widget in use
			if ( is_active_widget( false, false, $this->id_base, true ) ) {

				add_action( 'wp_enqueue_scripts', 'evolution_register_script_style' );	
			}

	}


    /**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

?>
<div id="sidebarbox">
		<ul id="tabMenu">
			<li class="famous selected" title="<?php  _e(' Famous Posts', 'revothemes');?>">
			</li>
			<li class="commentz" title="<?php  _e(' Last Comments', 'revothemes');?>">
			</li>
			<li class="posts" title="<?php  _e(' Recent Posts', 'revothemes');?>">
			</li>
			<li class="category" title="<?php  _e(' Categories', 'revothemes');?>">
			</li>
			<li class="random" title="<?php  _e(' Tag Cloud', 'revothemes');?>">
			</li>
            <li class="archiveslist" title="<?php  _e(' Archives', 'revothemes');?>">
            </li>
		</ul>
		<div class="boxBody">
	  	<div id="famous" class="show">
				<h5 class="tabmenu_header">
				<?php  _e(' Famous Posts', 'revothemes');?>
				</h5>
				<ul id="popular-comments">
					<?php
							$the_query = new WP_Query('showposts=5&ignore_sticky_posts=1&orderby=comment_count');	
							while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<li>
						<a href="<?php the_permalink();?>" title="<?php the_title();?>">
							<?php evolution_box_thumbnails(); ?>
						</a>
						<span>
							<a href="<?php the_permalink();?>" title="<?php the_title();?>">
							<?php the_title();?>
							</a>
						</span>
						<p>
							Posted by
							<strong>
							<?php the_author() ?>
							</strong> on the
							<?php the_time('F jS, Y') ?> with
							<?php comments_popup_link('No Comments;', '1 Comment', '% Comments');?>
						</p>
					</li>
					<?php endwhile;?>
					<?php wp_reset_query(); ?>
				</ul>
			</div>		
			<div id="commentzz">
				<h5 class="tabmenu_header">
				<?php  _e(' Last Comments', 'revothemes');?>
				</h5>
				<ul class="wet_recent_comments">
					<?php evolution_recent_comments();?>
				</ul>
			</div>
			<div id="posts">
				<h5 class="tabmenu_header">
				<?php  _e(' Recent Posts', 'revothemes');?>
				</h5>
				<ul class="recent_articles">
					<?php
							$the_query = new WP_Query('showposts=5&ignore_sticky_posts=1');	
							while ($the_query->have_posts()) : $the_query->the_post(); ?>
						<li class="clearfix">
						<a href="<?php the_permalink();?>" title="<?php the_title();?>">
							<?php evolution_box_thumbnails(); ?>
						</a>
						<span class="title-link">
							<a href="<?php the_permalink();?>" title="<?php the_title();?>">
							<?php the_title();?>
							</a>
						</span>
						<p><?php echo substr(get_the_excerpt(), 0,65); ?></p>
							<?php endwhile;?>
					<?php wp_reset_query(); ?>	
				</li>
				</ul>
			</div>
			<div id="category">
				<h5 class="tabmenu_header">
				<?php  _e(' Categories', 'revothemes');?>
				</h5>
				<ul class="category_list">
					<?php wp_list_categories('show_count=1&title_li=');?>
				</ul>
			</div>
			<div id="random">
				<h5 class="tabmenu_header">
				<?php  _e(' Tag Cloud', 'revothemes');?>
				</h5>
				<?php if (function_exists('wp_tag_cloud')) { ?>
				<span id="sidebar-tagcloud">
					<?php wp_tag_cloud('smallest=10&largest=18');?>
				</span>
				<?php }?>
			</div>
            <div id="archiveslist">
				<h5 class="tabmenu_header">
				<?php  _e(' Monthly Archives', 'revothemes');?>
				</h5>
            <ul>
            <?php wp_get_archives('monthly&show_post_count=1', '', 'html', '', '', TRUE); ?>
            </ul>
			</div>
		</div><!-- end div.boxBody -->
		<div class="boxBottom">
		</div>
	</div><!-- end div.box -->
<?php
		echo $after_widget;
	}

   /**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}


    /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}