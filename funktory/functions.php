<?php
/**
 * funktory functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package funktory
 */

 if ( isset( $_GET['action'] ) && $_GET['action'] == 'hbs_logout' ) {
	update_user_meta(  get_current_user_id(), 'hide_after_register_notif', true );
	wp_logout();
	wp_redirect( home_url('/login') );
	exit;
 }

// function ut_session_init() {

// 	if ( ! session_id() ) {
// 		session_start();
// 	}
// }
// add_action( 'init', 'ut_session_init' );


// function ut_session_destroy() {
// 	session_destroy();
// }
// add_action( 'wp_logout', 'ut_session_destroy' );


if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'funktory_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function funktory_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on funktory, use a find and replace
		 * to change 'funktory' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'funktory', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'funktory' ),
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
				'funktory_custom_background_args',
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

		// Create a new role and grant it the rights "of the Author"
        $author = get_role( 'author' );
        $result = add_role( 'midwive', 'Midwive', $author->capabilities );
        $user_id = get_current_user_id();

        if ( is_user_logged_in() && ! get_user_meta( $user_id, 'user_yoshteq_token', true ) ) {
			$user_pass = get_user_meta( $user_id, 'user_yoshteq_pass', true );
			$user = get_userdata( $user_id );
			$token = get_yoshteq_token( $user->user_login, $user_pass );

			update_user_meta( $user_id, 'user_yoshteq_token', $token );
			// $_SESSION['yoshteq_token'] = $token; 
        }
	}
endif;
add_action( 'after_setup_theme', 'funktory_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function funktory_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'funktory_content_width', 640 );
}
add_action( 'after_setup_theme', 'funktory_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function funktory_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'funktory' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'funktory' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'funktory_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function funktory_scripts() {
	// wp_enqueue_style( 'funktory-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'funktory-style', 'rtl', 'replace' );
	
	wp_enqueue_style( 'funktory-awesome', get_template_directory_uri() . '/css/awesome.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'funktory-dataTables', 'https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'funktory-rowReorder', 'https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'funktory-responsive', 'https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'funktory-style', get_template_directory_uri() . '/css/style.css', array(), _S_VERSION );
	wp_enqueue_style( 'funktory-dataTables-css', 'https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'funktory-datetime-css', 'https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css', array(), _S_VERSION );

	wp_enqueue_script( 'funktory-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	//////////////////////////////////////
  	wp_deregister_script('jquery-core');
  	wp_register_script('jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', false, null, true);
  	wp_deregister_script('jquery');
  	wp_register_script('jquery', false, array('jquery-core'), null, true);
  	//////////////////////////////////////

	wp_enqueue_script( 'funktory-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'funktory-dataTables-js', 'https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'funktory-rowReorder-js', 'https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'funktory-responsive-js', 'https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js', array('jquery'), _S_VERSION, true );
	// wp_enqueue_script( 'funktory-jquery.tablesorter', get_template_directory_uri() . '/js/jquery.tablesorter.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'funktory-moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'funktory-datetime', 'https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js', array('jquery'), _S_VERSION, true );

	if ( is_page_template('template-statistics.php') ) {
		$data_private = array();
		$data_statutory = array();
		$selected_year = $_GET['_year'] ?? null;
		$token = get_user_meta( get_current_user_id(), 'user_yoshteq_token', true );
		$statistics = ut_statistics( $token, $selected_year );
		wp_enqueue_script( 'funktory-core-js', 'https://cdn.amcharts.com/lib/4/core.js', array(), date("Ymd"), false );
		wp_enqueue_script( 'funktory-charts-js', 'https://cdn.amcharts.com/lib/4/charts.js', array(), date("Ymd"), false );
		wp_enqueue_script( 'funktory-spiritedaway-js', 'https://cdn.amcharts.com/lib/4/themes/spiritedaway.js', array(), date("Ymd"), false );
		wp_enqueue_script( 'funktory-animated-js', 'https://cdn.amcharts.com/lib/4/themes/animated.js', array(), date("Ymd"), false );
		wp_enqueue_script( 'funktory-chart', get_template_directory_uri() . '/js/chart.js', array('jquery'), _S_VERSION, true );
		foreach ( (array)$statistics as $key => $statistic ) : 
			$year = date( 'Y', strtotime( $statistic['description'] ) );
        	$month = date( 'm', strtotime( $statistic['description'] ) );
	        foreach ( (array)$statistic['privateServices'] as $private_service ) : 
	        	// remove duplicate
	        	foreach ( (array)$data_private as $item ) {
	        	    if ( /*$item['year'] == $year &&*/ $item['month'] == $month && $item['service'] == $private_service["description"] ) {
	        	    	continue 2;
	        	    }
	        	}
				$data_private[] = [
					'year' => $year,
					'month' => $month,
					'service' => $private_service["description"],
					'amount' => (int)$private_service['amount'],
				];
	        endforeach; 

	        foreach ( (array)$statistic['statutoryServices'] as $statutory_service ) : 
	        	// remove duplicate
	        	foreach ( (array)$data_statutory as $item ) {
	        	    if ( /*$item['year'] == $year &&*/ $item['month'] == $month && $item['service'] == $statutory_service["description"] ) {
	        	    	continue 2;
	        	    }
	        	}
				$data_statutory[] = [
					'year' => $year,
					'month' => $month,
					'service' => $statutory_service["description"],
					'amount' => (int)$statutory_service['amount'],
				];
	        endforeach; 

	    endforeach; 
		wp_localize_script( 'funktory-chart', 'chart_params', array(
			'data_private' => $data_private,
			'data_statutory' => $data_statutory,
			'_ytd' => __ ('ytd', 'betheme'),
			'_1_day' => __ ('1 day', 'betheme'),
			'_1_week' => __ ('1 week', 'betheme'),
			'_10_days' => __ ('10 days', 'betheme'),
			'_1_mounth' => __ ('1 month', 'betheme'),
			'_1_year' => __ ('1 year', 'betheme'),
			'_max' => __ ('Max', 'betheme'),
			'_price' => __ ('Price', 'betheme'),
			'_buy' => __ ('Buy', 'betheme'),
			'_sell' => __ ('Sale', 'betheme'),
			'_period' => __ ('Period:', 'betheme'),
			'_range' => __ ('Range:', 'betheme'),
			'_curency' => __ (' uah', 'betheme')
		) );
	}

	wp_enqueue_script( 'funktory-script', get_template_directory_uri() . '/js/script.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'funktory-main', get_template_directory_uri() . '/js/main.js', array('jquery'), _S_VERSION, true );
	wp_localize_script( 'funktory-main', 'main_params', [
      'ajaxurl'    => admin_url( 'admin-ajax.php' ),
      'ajax_nonce' => wp_create_nonce('ut_check'),
      'assets'     => get_template_directory_uri(),
    ] );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'funktory_scripts' );

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'lib/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

function ut_attach_theme_options() {
    require get_template_directory() . '/inc/custom-fields/options.php';
    require get_template_directory() . '/inc/custom-fields/page.php';
}
add_action( 'carbon_fields_register_fields', 'ut_attach_theme_options' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* string übersetzungen */
add_filter('gettext', 'translate_text');
add_filter('ngettext', 'translate_text');
 
function translate_text($translated) {
 
$translated = str_ireplace('Selected', 'Auswahl', $translated);
$translated = str_ireplace('items', 'Dokumente', $translated);
$translated = str_ireplace('Open', 'Download', $translated);
 
return $translated;
}