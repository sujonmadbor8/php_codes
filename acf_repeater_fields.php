<?php 


// Shortcode to output ACF repeater with multiple subfields
// Usage: [acf_repeater_ul post_type="receptes" field="ingredients" subfields="ingredient,quantity,unit"]
function acf_repeater_ul_multi_shortcode($atts) {
    ob_start();

    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'post_type' => '',
        'field'     => '',
        'subfields' => '', // comma-separated subfield names
    ), $atts);

    global $post;
    if (!$post || get_post_type($post) !== $atts['post_type']) return '';

    $subfields = array_map('trim', explode(',', $atts['subfields']));

    if (have_rows($atts['field'], $post->ID)) {
        echo '<ul>';
        while (have_rows($atts['field'], $post->ID)) {
            the_row();
            $line = [];

            foreach ($subfields as $subfield) {
                $value = get_sub_field($subfield);
                if ($value) {
                    $line[] = esc_html($value);
                }
            }

            if (!empty($line)) {
                echo '<li>' . implode(' ', $line) . '</li>';
            }
        }
        echo '</ul>';
    }

    return ob_get_clean();
}
add_shortcode('acf_repeater_ul', 'acf_repeater_ul_multi_shortcode');
// [acf_repeater_ul post_type="receptes" field="ingredients" subfields="ingredient,quantity,unit"]