<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package portknow
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main main1" role="main">
			<div id="well">Welcome, Inside...</div>
			<div class="well-box"> 	
				<img src="<?php bloginfo('template_url'); ?>/img/brain.svg">
				<div class=" br2">Pikiran</div>
				<div class=" br1">Manusia</div>
			</div>



			<?php
			while ( have_posts() ) : the_post();


				echo '<div class="front-quote">';
				the_content();
				echo '</div>';


			endwhile; 
			?>


			<?php

			function dispcat($jenis,$desc,$child) {

				$jenis_cat = $jenis;
				$args = array(
				    'category_name'  => $jenis_cat,
				    'orderby' => 'rand',
				    'showposts' => 4	
				);
				query_posts($args);


				$cat_id = get_category_by_slug( $jenis );
				$cat_link= get_category_link($cat_id);
				$cat_lk = $cat_link;
				echo '<a href="'. $cat_link.'"> ';
				echo '<div class="front-cat-title">';
				echo strtoupper($jenis_cat);
				echo '</div>';
				echo '</a>';

				echo '<div class="front-cat-desc"><p>';
					echo $desc;
				echo '</p></div>';



				echo '<div class="front-cat-child">';
				foreach ($child as  $value) {
					$cat_id = get_category_by_slug( $value );
					$cat_link= get_category_link($cat_id);
					$cat_name= get_cat_name( $cat_id );
					echo '<a href="'. $cat_link.'"> ';
					echo $value;
					
					echo '</a>';
				}
				echo '</div>';


				echo '<div class="main-carousel">';
				while ( have_posts() ) : the_post();
				?>
					<?php 
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
					?>
					<div class="carousel-cell">
							<a href="<?php the_permalink(); ?>"> 

						

						<?php if (has_post_thumbnail()) { ?>
							<div class="img"><?php the_post_thumbnail(); ?></div>

						<?php } ?>

							<div class="car-title">

								<?php foreach((get_the_category()) as $category) { ?>
								<div class="cat-cat <?php echo $category->cat_name; ?>">
									 <?php
									    echo strtoupper($category->cat_name) . ' '; 
									} ?>
								</div>
								<?php the_title(); ?> 
							</div>
						</a>
					</div>

				<?php 
				endwhile; ?>
				</div>
				<div class="clear"></div>
				<div class="front-cat-bt"> <a href="<?php echo $cat_lk;?>" >Baca artikel <span><?php echo $jenis_cat;?></span> lainya ...</a></div>
			<?php } ?>
			<div id="sains-box" class="front-cat">
				<svg class="aa" xmlns="https://www.w3.org/2000/svg" xmlns:svg="https://www.w3.org/2000/svg">
				 <g>
	 				 <path stroke="#0a0101" opacity="0.95" id="svg_1" d="m-0.03321,118.75c3.79675,0 1999.91939,-117.99948 1999.91888,-117.99923c-0.0005,0.00025 0.33505,117.85219 0.37161,117.85797c0.03656,0.00578 -2000.2905,0.14126 -2000.2905,0.14126z" stroke-width="0" fill="#000000"/>
				 </g>
				</svg>

				<?php
					$desc = 'Segala keterhubungan sains dalam dunia pikiran manusia di bahas disini, dan di pecah-pecah dalam beberapa kategori berikut :';
					$child = array ("psikologi","pseudo-sains","neurosains","hypnosis");
					dispcat('sains',$desc,$child); 

				?>
			</div>	

			<div id="misteri-box" class="front-cat">
				<svg class="aa" xmlns="https://www.w3.org/2000/svg" xmlns:svg="https://www.w3.org/2000/svg">
				 <g>
					<path stroke="#0a0101" opacity="0.95" id="svg_1" d="m1999.96868,118.75c-3.79655,0 -1999.81158,-117.99948 -1999.81108,-117.99923c0.0005,0.00025 -0.33503,117.85219 -0.37159,117.85797c-0.03656,0.00578 2000.18267,0.14126 2000.18267,0.14126z" stroke-width="0" fill="#000000"/>
				 </g>
				</svg>
				<?php 
				$desc = 'Pikiran manusia tidak pernah lepas dari misteri, misteri terjadinya fenomena-fenomena aneh hanyalah tentang penafsiran pikiran kita tentangnya. Topik misteri akan di bagi sebagai berikut :';
				$child = array ("detektif","spiritual","mitos","pemberdayaan");
				dispcat('misteri',$desc,$child); 
				?>
			</div>	

			<div id="unik-box" class="front-cat">
				<svg class="aa" xmlns="https://www.w3.org/2000/svg" xmlns:svg="https://www.w3.org/2000/svg">
				 <g>
	 				 <path stroke="#0a0101" opacity="0.95" id="svg_1" d="m-0.03321,118.75c3.79675,0 1999.91939,-117.99948 1999.91888,-117.99923c-0.0005,0.00025 0.33505,117.85219 0.37161,117.85797c0.03656,0.00578 -2000.2905,0.14126 -2000.2905,0.14126z" stroke-width="0" fill="#000000"/>
				 </g>
				</svg>
				<?php 
				$desc = 'Dalam dunia pikiran terkadang muncul sebuah kejadian-kejadian unik yang tidak pernah kita sangka sebelumnya. Hal tersebut di rangkum dalam beberapa topik sebagai berikut :';
				$child = array ("extraordinary","fenomena","tips");
				dispcat('unik',$desc,$child); 
				?>
			</div>	

			<div id="trick-box" class="front-cat">
				<svg class="aa" xmlns="https://www.w3.org/2000/svg" xmlns:svg="https://www.w3.org/2000/svg">
				 <g>
					<path stroke="#0a0101" opacity="0.95" id="svg_1" d="m1999.96868,118.75c-3.79655,0 -1999.81158,-117.99948 -1999.81108,-117.99923c0.0005,0.00025 -0.33503,117.85219 -0.37159,117.85797c-0.03656,0.00578 2000.18267,0.14126 2000.18267,0.14126z" stroke-width="0" fill="#000000"/>
				 </g>
				</svg>
				<?php 
				$desc = 'Bagaimana cara mendemonstrasikan kekuatan indera keenam. Seperti membaca pikiran, memprediksi masa depan dan lain sebagainya. Jawabannya ada dalam beberapa topik di bawah ini :';
				$child = array ("ESP","telepathy","remote-viewing","ramalan");
				dispcat('trick-of-mind',$desc,$child); 
				?>
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
