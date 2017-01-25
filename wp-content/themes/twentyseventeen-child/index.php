<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<h1>Custom Post</h1>
<?php
$query_args = array(
 'post_type' => 'post',
 'posts_per_page' => 5,
 'paged' => $paged
);
$the_query = new WP_Query( $query_args );
if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
?>
   <h1><?php echo the_title(); ?></h1>
     <?php the_excerpt(); ?>
<?php endwhile; ?>
<div class="wrap">

	<?php if ( is_home() && ! is_front_page() ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		</header>
	<?php else : ?>
	<header class="page-header">
		<h2 class="page-title"><?php _e( 'Posts', 'twentyseventeen' ); ?></h2>
	</header>
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile;

				the_posts_pagination( array(
					'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
				) );

			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
<h1>Start</h1>
<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$query_args = array(
 'post_type' => 'post',
 'posts_per_page' => 2,
 'paged' => $paged
);
$the_query = new WP_Query( $query_args );
if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop ?>
   <h1><?php echo the_title(); ?></h1>
     <?php the_excerpt(); ?>
<?php endwhile; ?>

<?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
     <?php echo get_next_posts_link( 'Older Entries', $the_query->max_num_pages ); // display older posts link ?>
     <?php echo get_previous_posts_link( 'Newer Entries' , $the_query->max_num_pages); // display newer posts link
     wp_reset_postdata();?>
<?php } ?>

<?php else: ?>
   <h1>Sorry...</h1>
   <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif;?>
<h1>End</h1>

	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
