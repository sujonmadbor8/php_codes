<?php 

// Shortcode to display loop index number (e.g., 01, 02, 03...) in Elementor Loop Grid
// This keeps consistent numbering even if the same post appears multiple times

function elementor_loop_index_shortcode() {
    // Global variable to keep track of index count across loop
    global $loop_index_count;

    // Initialize the counter if not already set
    if (!isset($loop_index_count)) {
        $loop_index_count = 0;
    }

    // Access the current post object
    global $post;

    // Static array to ensure each post is only counted once
    static $post_ids = [];

    // If this post has not been indexed yet
    if (!in_array($post->ID, $post_ids)) {
        $loop_index_count++; // Increment the loop index
        $post_ids[] = $post->ID; // Mark this post as counted

        // Format the index with leading zero and assign to post object
        $post->loop_index_number = str_pad($loop_index_count, 2, '0', STR_PAD_LEFT);
    }

    // Return the stored index number for this post
    return isset($post->loop_index_number) ? $post->loop_index_number : '';
}

// Register the shortcode [loop_index] for use in Elementor or other content areas
add_shortcode('loop_index', 'elementor_loop_index_shortcode');