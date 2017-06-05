<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package portknow
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="mainsg" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post(); ?>


	 <div class="cat-su">
<?php 
	
	foreach((get_the_category()) as $category) { 
		$cat_name = $category->cat_name;
		$cat_link = get_category_link( $category->cat_ID );

	?>
		<a href="<?php echo esc_url($cat_link); ?>">
		<span class="cat-cat <?php echo $cat_name;?>">
			<?php
			echo strtoupper($cat_name) . ' '; //tampilan cateory ke huruf kapital
			} ?> 
		</span>
		</a>
	</div>

	<div class="title-bg" <?php echo (is_user_logged_in()? 'style="top: 32px;"' : '' );?>>
		<?php the_post_thumbnail();?>
	</div>
	<?php 
		$cpimgpost = get_post_meta( get_the_ID(), '_meta_cpimgpost', true );
		if (!empty($cpimgpost)) {
	 ?>
			<div class="cpimgpost">
				<div class="img-cp">
					<em>
						<i class="fa fa-camera "></i> 
						<?php echo $cpimgpost; ?> 
					</em>
				</div>
			</div>
	<?php 
		}
	?>

<?php
			get_template_part( 'template-parts/content', get_post_format() );


			// the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>



		</main><!-- #main -->
				<!-- menampilkan post update terakhir tetapi dalam urutan random  -->
			<aside id="customwidget" class="widget-area" role="complementary">
			<?php 
				$customboxpost = get_post_meta( get_the_ID(), '_meta_customboxpost', true );
				if (!empty($customboxpost)) {
					echo '<section id="customboxpost" class="widget">';
					echo $customboxpost;
					echo '</section>';
				}
			?>

				<section id="newer-post" class="widget image-frame">		
					<h2 class="widget-title">Update Baru</h2>
					<?php
						$args = array( 
							'posts_per_page' => 6, 
							'order'=> 'DESC', 
							'orderby' => 'rand',
							'date_query' => array(
								array(
									'after' => '6 month ago'
									)
								)
							);
						$postslist = get_posts( $args );
						?> 
						<ul>
						<?php
						foreach ( $postslist as $post ) :
						  setup_postdata( $post ); ?> 
							<li> <a href="<?php echo post_permalink( $ID ); ?> ">
								<span><?php the_title();?> </span> 
								<?php the_post_thumbnail();?> 
								<!-- <?php the_excerpt(); ?> -->
							</a></li>
						<?php
						endforeach; 
						wp_reset_postdata();
					?>	</ul>
				</section>
			</aside>
			<?php get_sidebar(); ?>

	</div><!-- #primary -->

	<div class="message-fix">
		<p>Jika bermanfaat, mengapa tidak Anda bagikan saja?</p>
	</div>
<?php 
get_sidebar();
get_footer();
