<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package portknow
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php 
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Hasil Pencarian dari: %s', 'portknow' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */?>

				<div class="cat-container">
					<a href="<?php echo post_permalink($ID); ?>">
					<div class="cat-img">	
						<?php the_post_thumbnail(); ?>
					</div>
					<div class="cat-caption"> 
						<?php the_title(); ?> 
					</div>
					</a>
				<?php
						foreach((get_the_category()) as $category) { ?>

					<div class="cat-cat <?php echo $category->cat_name; ?>">
						 <?php
						    echo strtoupper($category->cat_name) . ' '; 
						} 
						?>
					</div>

				</div>

<?php endwhile; 


			

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
