<?php 


// Skip the first 3 posts

add_filter( 'elementor/query/common_query_2', function( $query ) {

    $query->set('offset', 3);
        
});