<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package portknow
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

		// query_posts('posts_per_page=12'); // batas tampilan per-page 
		if ( have_posts() ) : ?>

			<header class="cat-header">

				
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );

					$cat = get_category( get_query_var( 'cat' ) );
					$category = $cat->slug;
				?>				
				
			</header><!-- .page-header -->
			<div class="title-bg" >
				<img src="<?php bloginfo('template_url');?>/img/<?php echo $category;?>.jpg" >
			</div>
		<div class="cat-su-container">
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

<?php endwhile; ?>

<?php   
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
	