<?php 

function acf_group_fields_shortcode($atts) {
    ob_start();

    $atts = shortcode_atts(array(
        'post_type'  => '',
        'group'      => '', // group field name
        'subfields'  => '', // comma-separated subfield names
    ), $atts);

    global $post;
    if (!$post || get_post_type($post) !== $atts['post_type']) return '';

    $group_data = get_field($atts['group'], $post->ID);

    if (!is_array($group_data)) return '';

    $subfields = array_map('trim', explode(',', $atts['subfields']));

    echo '<ul>';
    foreach ($subfields as $field_name) {
        if (!empty($group_data[$field_name])) {
            $value = $group_data[$field_name];

            // Optional: handle image field
            if (is_array($value) && isset($value['url'])) {
                echo '<li><strong>' . esc_html(ucwords(str_replace('_', ' ', $field_name))) . ':</strong> <img src="' . esc_url($value['url']) . '" alt="" style="max-width:150px;" /></li>';
            } else {
                echo '<li><strong>' . esc_html(ucwords(str_replace('_', ' ', $field_name))) . ':</strong> ' . esc_html($value) . '</li>';
            }
        }
    }
    echo '</ul>';

    return ob_get_clean();
}
add_shortcode('acf_group_fields', 'acf_group_fields_shortcode');

// [acf_group_fields post_type="property" group="floor_plan" subfields="description_about_floor,bedrooms,bathrooms,living_area_in_sq_ft,floor_plan_image"]