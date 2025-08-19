// Hide project gallery or testimonial section if ACF true/false field is checked
add_action( 'wp_head', function() {
if ( is_singular('project') ) {

// Check ACF field for gallery
$hide_gallery = get_field('hide_gallery_section');
if ( $hide_gallery ) {
echo '<style>
.project_single_gallery_section {
    display: none !important;
}
</style>';
}

// Check ACF field for testimonial
$hide_testimonial = get_field('hide_testimonial_section');
if ( $hide_testimonial ) {
echo '<style>
.single_project_testimonial {
    display: none !important;
}
</style>';
}
}
});