<?php
/**
 * Rinhae functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Rinhae
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rinhae_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Rinhae, use a find and replace
		* to change 'rinhae' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'rinhae', get_template_directory() . '/languages' );

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

	// Custom Image Crops
	// Portrait Blog Size - 200px width, 300px height, hard crop
	add_image_size( 'rinhae-small-portrait', 200, 300, false );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'rinhae' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'rinhae_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add theme support for wide-alignment option in block editor
	add_theme_support( 'align-wide' );


}
add_action( 'after_setup_theme', 'rinhae_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rinhae_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rinhae_content_width', 640 );
}
add_action( 'after_setup_theme', 'rinhae_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rinhae_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'rinhae' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'rinhae' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'rinhae_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rinhae_scripts() {
	wp_enqueue_style( 
		'fwd-googlefonts', 
		'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap',
		array(),
		null // Set null if loading multiple Google Fonts from their CDN
	);
	wp_enqueue_style( 'rinhae-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'rinhae-style', 'rtl', 'replace' );

	wp_enqueue_script( 'rinhae-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rinhae_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
* Custom Post Types & Taxonomies
*/
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Set a Block Templates
function rinhae_block_editor_templates() {
    if ( isset( $_GET['post'] ) && '63' == $_GET['post'] ) {
        $post_type_object = get_post_type_object( 'page' );
        $post_type_object->template = array(
			array (
				'core/paragraph',
				array(
					'placeholder' => 'Add your biography here...'
				)
			),
			array (
				'core/button',
			),
		);
	}
}
add_action( 'init', 'rinhae_block_editor_templates' );

// Change excerpt length to 25 words
// Filters always need to be passed in a value, you can it whatever.
// This is required because the function is dealing with some initial data.

function rinhae_excerpt_length( $length ) {
	if (is_post_type_archive('rinhae-students')) {
    return 25;
	} else {
	return 55;
	}
}

add_filter( 'excerpt_length', 'rinhae_excerpt_length', 999 );


function rinhae_excerpt_more( $more ) {
	if (is_post_type_archive('rinhae-students')) {

	// You don't need a parameter for get_permalink b/c if excerpt is running, it should already be inside a loop.
	$more = '... <a class="read-more" href="'. esc_url( get_permalink() ) .'">Read more about the student... </a>';
	return $more;
	}
}

add_filter ( 'excerpt_more', 'rinhae_excerpt_more');