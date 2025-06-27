<?php 


// Custom Elementor query for area category taxonomy archive pages
// This ensures only 'project' post types are shown when viewing a taxonomy archive for 'area'
add_action( 'elementor/query/area_category', function( $query ) {
    if ( is_tax( 'area' ) ) {
        $query->set( 'post_type', 'project' );
    }
});


// start 
// Custom Elementor query for displaying related projects on single developer pages
// This fetches 'project' posts linked to the current developer via the 'developer' taxonomy
add_action( 'elementor/query/developer_projects', function( $query ) {

    if ( is_singular( 'developer' ) ) { // Check if on a single developer post
        global $post;
        $post_slug = $post->post_name; // Get current developer's slug
        $query->set( 'tax_query', array(
            array(
                'taxonomy' => 'developer', // Target 'developer' taxonomy
                'field'    => 'slug',      // Match using slug
                'terms'    => $post_slug,  // Slug of current developer
            ),
        ));
    }
});

// Placeholder for future logic in wp_footer hook on single developer pages
// Currently retrieves the post slug of the developer but doesn't use it yet
add_action('wp_footer', function(){
    
    if ( is_singular( 'developer' ) ) {
        global $post;
        $post_slug = $post->post_name; // Retrieve slug of current developer
    }
});

// end 