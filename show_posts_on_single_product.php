<?php 

// Custom Elementor query filter to display related event speakers on single product pages
// This filter modifies the Elementor loop with a tax_query to match the product's speaker categories

add_filter( 'elementor/query/event_speakers_se', function( $query ) {
    // Check if we're on a single product page
    if ( is_singular( 'product' ) ) {
        $product_id = get_the_ID(); // Get the current product ID

        // Retrieve terms from the 'event-speaker-category' taxonomy
        $terms = get_the_terms( $product_id, 'event-speaker-category' );

        $slugs = []; // Initialize an array to store term slugs

        // If terms exist and no error occurred, extract slugs
        if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $slugs[] = $term->slug;
            }
        }

        // Set tax_query on the Elementor query to filter speakers by matching slugs
        $query->set( 'tax_query', [
            [
                'taxonomy' => 'event-speaker-category', // Target taxonomy
                'field'    => 'slug',                   // Match by slug
                'terms'    => $slugs,                   // Use extracted slugs
            ],
        ] );
    }
});