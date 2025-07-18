<?php 



// custom slider
function custom_testimonial_slider_shortcode() {
    // Fetch posts from the 'testimonial' post type
    $args = array(
        'post_type' => 'testimonial',
        'posts_per_page' => -1, // Fetch all testimonials
        'post_status' => 'publish',
    );
    $query = new WP_Query($args);



    // Start output buffering
    ob_start();



    if ($query->have_posts()) {
        ?>
       <div class="testimonial-slider">
              
    <!-- Profile Images -->
               <div class="profile-row">
                       <?php while ($query->have_posts()) : $query->the_post(); ?>
                           <div class="profile-item">
                                   <?php if (has_post_thumbnail()) : ?>
                                       <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" class="profile-picture"
                alt="<?php the_title(); ?>">
                                   <?php endif; ?>
                               </div>
                       <?php endwhile; ?>
                   </div>



              
    <!-- Testimonial Content -->
               <div class="testimonial-content-row">
                       <?php while ($query->have_posts()) : $query->the_post(); ?>
                           <div class="testimonial-item">
                                   <p><?php the_content(); ?></p>
                               </div>
                       <?php endwhile; ?>
                   </div>



               
    <!-- Ratings -->
                <div class="testimonial-ratings-row">
                       <?php while ($query->have_posts()) : $query->the_post(); ?>
                           <div class="rating-item">
                                   <?php
                        $rating = get_post_meta(get_the_ID(), 'ratings', true);
                        echo str_repeat('⭐', intval($rating));
                        ?>
                               </div>
                       <?php endwhile; ?>
                   </div>



              
    <hr style="color:#0C59DB; width:32px; height:2px text-align:center; border: 1px solid #0C59DB; margin:20px auto;">



              
    <!-- Name and Designation -->
               <div class="testimonial-details-row">
                       <?php while ($query->have_posts()) : $query->the_post(); ?>
                           <div class="details-item">
                                   <strong><?php the_title(); ?></strong><br>
                                   <span><?php echo get_post_meta(get_the_ID(), 'designation', true); ?></span>
                               </div>
                       <?php endwhile; ?>
                   </div>



             



              
    <!-- Navigation Arrows -->
               <button class="prev">&lt;</button>
               <button class="next">&gt;</button>
          
</div>
       <?php
    } else {
        echo '<p>No testimonials found.</p>';
    }



    // Reset post data
    wp_reset_postdata();



    // Return buffered output
    return ob_get_clean();
}
add_shortcode('custom_testimonial_slider', 'custom_testimonial_slider_shortcode');