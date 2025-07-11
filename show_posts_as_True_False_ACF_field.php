<?php 

// show posts as per propers query id 
add_filter( 'elementor/query/propers', function($query) {
    $meta_query = [
        [
            // ACF true False field 
            'key'     => 'propers',
            'value'   => '1',
            'compare' => '='
        ]
    ];

    $query->set('post_type', 'botiga');
    $query->set('meta_query', $meta_query);
});