<?php

function evolution_recent_comments($no_comments = 5, $comment_len = 50) {
    global $wpdb;
    $request = "SELECT * FROM $wpdb->comments";
    $request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
    $request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password =''";
    $request .= " ORDER BY comment_date DESC LIMIT $no_comments";
    $comments = $wpdb->get_results($request);
    if ($comments) {
        foreach ($comments as $comment) {
            ob_start();
            ?>
                <li><?php echo get_avatar( $comment, 40 ); ?>
                    <a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><cite><?php echo evolution_get_author($comment); ?></cite></a>
                    <span><?php echo human_time_diff(get_comment_date('U',$comment->comment_ID), current_time('timestamp')), __(' ago', 'evolution'); ?>:</span>
                    <span class="which-post"><a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>">(<?php echo get_the_title($comment->comment_post_ID); ?>)</a></span>
                    <p><?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?>...</p>
                </li>
            <?php
            ob_end_flush();
        }
    } else {
        echo '<li>'.__('No comments yet', 'evolution').'';
    }
}

// Get author for comment
function evolution_get_author($comment) {
    $author = "";
    if ( empty($comment->comment_author) )
        $author = __('Anonymous', 'evolution');
    else
        $author = $comment->comment_author;
    return $author;
}