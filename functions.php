<?php
/**
 * portknow functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package portknow
 */

if ( ! function_exists( 'portknow_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function portknow_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on portknow, use a find and replace
	 * to change 'portknow' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'portknow', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'portknow' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'portknow_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'portknow_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function portknow_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'portknow_content_width', 640 );
}
add_action( 'after_setup_theme', 'portknow_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function portknow_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'portknow' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'portknow' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'portknow_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function portknow_scripts() {
	wp_enqueue_style( 'portknow-style', get_stylesheet_uri() );

	wp_enqueue_script( 'portknow-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'portknow-js', get_template_directory_uri() . '/js/portknow.js', array('jquery'));

	wp_enqueue_script( 'portknow-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'portknow_scripts' );


// ---------------- TAMBAHAN ------------------
//Register New Menu Navigation
add_action( 'init', 'my_custom_menus' );
function my_custom_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Menu' ),
            'secondary-menu' => __( 'Secondary Menu' )
        )
    );
}

// menghilkangkan  nama category pada page category
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;

});

// login redirect
/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

// Custom css login 
function my_custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';
}

add_action('login_head', 'my_custom_login');


// ganti logo 

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(https://bacapikiran.com/wp-content/uploads/2016/12/bacaico.png);
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Bacapikiran, Merekah kedalam pikiran';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function annointed_admin_bar_remove() {
        global $wp_admin_bar;

        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

add_filter('wpseo_enable_xml_sitemap_transient_caching', '__return_false');

//tambah metabox post

add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add() {
    // add_meta_box( 'price', 'Price', 'price_cb', 'leadership', 'normal', 'high' );
    $screens = array( 'post' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'post',            // Unique ID
            'Pengaturan Tambahan',      // Box title
            'metabox_post',  // Content callback
             $screen                      // post type
        );
    }
}

function metabox_post() {
	$cpimgpost = get_post_meta( get_the_ID(), '_meta_cpimgpost', true );
	$customboxpost = get_post_meta( get_the_ID(), '_meta_customboxpost', true );
	?>
	<ul>
	<li>
		<h4><label for="cp_img_post">Copyright Gambar</label></h4>
		<input type="text" name="cp_img_post" id="cp_img_post" value="<?php echo $cpimgpost;?>" >
	</li>
	<li>
		<h4><label for="custom_box_post">Custom Sidebar</label></h4>
		<textarea style="min-height: 100px; width: 100%;" type="text" name="custom_box_post" id="custom_box_post" style="width: 100%;"><?php echo $customboxpost;?></textarea>
	</li>
	<br />
		<div>
			<p><b>Keterangan:</b> Untuk mengisi form <b>custom sidebar</b>, gunakan kode-kode di bawah ini sesuai kebutuhan. Ganti teks warna <font color="red">merah</font> sesuai dengan kebutuhan. </p>
			<pre style="overflow: auto; background-color: #d4d4d4; padding: 5px 10px;">

<font color="blue">// Copy kode di bawah ini jika ingin menambahkan PENULIS</font>

&ltdiv class="penulis-container"&gt
&lth4 class="penulis"&gtDITULIS OLEH&lt/h4&gt
&ltdiv class="penulis"&gt
 &lta href="<font color="red">http://website-anda.com</font>"&gt<font color="red">Nama-anda</font>&lt/a&gt
&lt/div&gt
&lt/div&gt

			</pre>
		</div>
	</ul>
	<?php
}

add_action('save_post','cp_post_img_save');
function cp_post_img_save($post_id) {
	update_post_meta( $post_id, '_meta_cpimgpost', $_POST['cp_img_post']);
	update_post_meta( $post_id, '_meta_customboxpost', $_POST['custom_box_post']);

}


// mnonaktifkan pingback
add_filter( 'xmlrpc_methods', function( $methods ) {
   unset( $methods['pingback.ping'] );
   return $methods;
} );


// ---------------- END TAMBAHAN------------------

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

