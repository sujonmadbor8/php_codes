<?php 

// -----------------------------
// ✅ Custom Pagination Function
// -----------------------------
function wc_custom_pagination( $query, $device = 'desktop' ) {
    if ( ! $query || ! $query->max_num_pages ) {
        return;
    }

    $total_pages  = $query->max_num_pages;
    $current_page = max( 1, get_query_var('paged') );

    // Set different limits for desktop vs mobile
    $max_display = ( $device === 'mobile' ) ? 4 : 10;

    $start = $current_page;
    $end   = min( $current_page + $max_display - 1, $total_pages - 1 );

    echo '<div class="product-search-pagination custom-pagination ' . esc_attr( $device . '_custom' ) . '">';
    echo '<ul class="page-numbers">';

    // Previous link
    if ( $current_page > 1 ) {
        echo '<li><a class="prev page-numbers" href="' . get_pagenum_link( $current_page - 1 ) . '">«</a></li>';
    }

    // Page numbers
    for ( $i = $start; $i <= $end; $i++ ) {
        if ( $i == $current_page ) {
            echo '<li><span class="page-numbers current">' . $i . '</span></li>';
        } else {
            echo '<li><a class="page-numbers" href="' . get_pagenum_link( $i ) . '">' . $i . '</a></li>';
        }
    }

    // Add dots + last page if needed
    if ( $end < $total_pages - 1 ) {
        echo '<li><span class="page-numbers dots">…</span></li>';
        echo '<li><a class="page-numbers" href="' . get_pagenum_link( $total_pages ) . '">' . $total_pages . '</a></li>';
    } elseif ( $end == $total_pages - 1 ) {
        echo '<li><a class="page-numbers" href="' . get_pagenum_link( $total_pages ) . '">' . $total_pages . '</a></li>';
    }

    // Next link
    if ( $current_page < $total_pages ) {
        echo '<li><a class="next page-numbers" href="' . get_pagenum_link( $current_page + 1 ) . '">»</a></li>';
    }

    echo '</ul>';
    echo '</div>';
}