<?php
//Template Name:Custom_Template
?>
<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'paged' => $paged );
			$wp_query = new WP_Query($args);
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/post/content', get_post_format() );
				endwhile;
			endif;
			?>
			<?php next_posts_link( '&larr; Older posts', $wp_query ->max_num_pages); ?>
			<?php previous_posts_link( 'Newer posts &rarr;' ); ?>
	   </main>
</div>

