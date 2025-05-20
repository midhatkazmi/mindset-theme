<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<address <?php echo get_block_wrapper_attributes(); ?>>
	<?php if ( $attributes[ 'svgIcon' ] ) : ?>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Email Icon">
			<path d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z"/>
		</svg>
	<?php endif; ?>
	<p><?php echo wp_kses_post( get_post_meta( 15, 'company_email', true ) ); ?></p>
</address>