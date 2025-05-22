<?php
/**
 * Registers the block using a `blocks-manifest.php` file, which improves the performance of block type registration.
 * Behind the scenes, it also registers all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function mindset_blocks_mindset_blocks_block_init() {
	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
	 * based on the registered block metadata.
	 * Added in WordPress 6.8 to simplify the block metadata registration process added in WordPress 6.7.
	 *
	 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
	 */
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
		return;
	}

	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` file.
	 * Added to WordPress 6.7 to improve the performance of block type registration.
	 *
	 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
	 */
	if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
		wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
	}
	/**
	 * Registers the block type(s) in the `blocks-manifest.php` file.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
	foreach ( array_keys( $manifest_data ) as $block_type ) {
		register_block_type( __DIR__ . "/build/{$block_type}" );
	}
}
add_action( 'init', 'mindset_blocks_mindset_blocks_block_init' );

/**
* Registers the custom fields for some blocks.
*
* @see https://developer.wordpress.org/reference/functions/register_post_meta/
*/
function mindset_register_custom_fields() {
	register_post_meta(
		'page',
		'company_email',
		array(
			'type'         => 'string',
			'show_in_rest' => true,
			'single'       => true
		)
	);
	register_post_meta(
		'page',
		'company_address',
		array(
			'type'         => 'string',
			'show_in_rest' => true,
			'single'       => true
		)
	);
}
add_action( 'init', 'mindset_register_custom_fields' );

function mindset_blocks_render_callbacks( $args, $name ) {
	if ( 'mindset-blocks/service-posts' === $name ) {
		$args['render_callback'] = 'fwd_render_service_posts';
	}
	if ( 'mindset-blocks/testimonial-slider' === $name ) {
		$args['render_callback'] = 'fwd_render_testimonial_slider';
	}
	return $args;
}
add_filter( 'register_block_type_args', 'mindset_blocks_render_callbacks', 10, 2 );

// Callback function for the Service Posts block
function fwd_render_service_posts( $attributes ) {
	ob_start();
	?>
	<div <?php echo get_block_wrapper_attributes(); ?>>
		<?php
		// Output the Service navigation
		$args = array(
			'post_type'      => 'fwd-service',
			'posts_per_page' => -1,
			'order'          => 'ASC',
			'orderby'        => 'title'
		);
	
		$query = new WP_Query( $args );
	
		if ( $query -> have_posts() ) {
			echo '<nav class="services-nav">';
			
			while ( $query -> have_posts() ) {
				$query -> the_post();
				
				echo '<a href="#'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() ) .'</a>';
	
			}
			wp_reset_postdata();
	
			echo '</nav>';
		}

		// Output the Service posts
		// $taxonomy = 'fwd-service-type';
		$terms = get_terms(
			array(
				// 'taxonomy' => $taxonomy
				'taxonomy' => 'fwd-service-category',
			)
		);
		if ( $terms && ! is_wp_error($terms) ) {
			foreach ( $terms as $term ) {
				// Add your WP_Query() code here
				// Use $term->slug in your tax_query
				// Use $term->name to organize the posts
				$args = array(
					'post_type'      => 'fwd-service',
					'posts_per_page' => -1,
					'order'          => 'ASC',
					'orderby'        => 'title',
					'tax_query'		 => array(
						array(
							'taxonomy' => 'fwd-service-category',
							'field'    => 'slug',
							'terms'    => $term->slug
						)
					)
				);
						
				$query = new WP_Query( $args );
						
				if ( $query -> have_posts() ) {
					echo '<section>';
					// echo '<h2>' . esc_html( $term->name ) . '</h2>
					echo '<h2>' . $term->name . '</h2>';
			
					while ( $query -> have_posts() ) {
						$query -> the_post();
			
						echo '<article id="'. esc_attr( get_the_ID() ) .'">';	
							echo '<h3>' . esc_html( get_the_title() ) . '</h3>';
							the_content();
						echo '</article>';
						
					}
					wp_reset_postdata();
			
					echo '</section>';
				}
			}
		}
		?>
	</div>
	<?php
	return ob_get_clean();
}

// Callback function for the Testimonial Slider
function fwd_render_testimonial_slider( $attributes, $content ) {
    ob_start();
    $swiper_settings = array(
        'pagination' => $attributes['pagination'],
        'navigation' => $attributes['navigation']
    );
    ?>
	<?php
		$styles = "--arrow-color: " . $attributes[ "arrowColor" ] . ";";
	?>
    <div <?php echo get_block_wrapper_attributes( array( "style" => $styles ) ); ?>>
        <script>
            const swiper_settings = <?php echo json_encode( $swiper_settings ); ?>;
        </script>
        <?php
        $args = array(
            'post_type'      => 'fwd-testimonial',
            'posts_per_page' => -1
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : ?>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <div class="swiper-slide">
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php if ( $attributes['pagination'] ) : ?>
                <div class="swiper-pagination"></div>
            <?php endif; ?>
            <?php if ( $attributes['navigation'] ) : ?>
                <button class="swiper-button-prev"></button>
                <button class="swiper-button-next"></button>
            <?php endif; ?>
            <?php
            wp_reset_postdata();
        endif;
        ?>
    </div>
    <?php
    return ob_get_clean();
}