<?php

require_once( TEMPLATEPATH.'/player.php' );

function rcnmundo_setup() {
	// Agregar al tema la funcionalidad del menu
	register_nav_menu( 'mainmenu', 'Menú principal' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'rcnmundo_setup' );

function rcnmundo_scripts_styles() {
	global $wp_styles;
	//cargar las librerias del tema

	//cargar la hoja de estilo principal
	//wp_enqueue_style( 'boostrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	//wp_enqueue_style( 'rcnmundo-style', get_template_directory_uri() . '/style.css' );

}

add_action( 'wp_enqueue_scripts', 'rcnmundo_scripts_styles' );

function rcnmundo_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}

add_filter( 'wp_title', 'rcnmundo_title', 10, 2 );

function rcnmundo_widgets_init() {
	register_sidebar( array(
		'name' => __( 'SIDEBAR', 'rcnmundo' ),
		'id' => 'sidebar',
		'description' => __( 'permanent sidebar', 'rcnmundo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="tt_box_sidebar">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'TOPBAR', 'rcnmundo' ),
		'id' => 'topbar',
		'description' => __( 'Only on the topbar', 'rcnmundo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
	register_sidebar( array(
		'name' => __( 'FOOTERBAR', 'rcnmundo' ),
		'id' => 'footerbar',
		'description' => __( 'Widget area for suscribe form', 'rcnmundo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'rcnmundo_widgets_init' );

function comscore_inline_tag() {
  if (is_front_page()) {
    $comscore_name = 'rcnmundo.portada';
  } elseif (is_category()) {
    $category = get_the_category();

    $comscore_name = $category[0]->slug . '.portada';
  } else {
    $post = get_post();

    if ($post) {
      $category_name = $post->post_type;
      $categories = get_the_category($post->ID);

      if (count($categories) > 0) {
        $category_name = $categories[0]->slug;
      }

      $comscore_name = $category_name . '.' . sanitize_title($post->post_title);
    } else {
      $current_path = add_query_arg(NULL, NULL);
      $current_alias_url = str_replace('/', '.', trim($current_path, '/'));

      $comscore_name = $current_alias_url;

      $dot = strrpos($current_alias_url, '.');

      if ($dot === false) {
        $comscore_name = "$current_alias_url.portada";
      }
    }
  }

  $template_uri = get_template_directory_uri();

  print '<script src="'. $template_uri .'/comscore/comscore-inline-tag.min.js"></script>';
  print '<script src="'. $template_uri .'/comscore/streamsense.4.1505.18.min.js"></script>';
  print "<script type='text/javascript'>udm_('http'+(document.location.href.charAt(4)=='s'?'s://sb':'://b')+'.scorecardresearch.com/b?c1=2&c2=14444496&site=rcn-mundo&name=". $comscore_name ."')</script>";
  print '<noscript><img src="http://b.scorecardresearch.com/p?c1=2&amp;c2=14444496&amp;site=rcn-mundo&name='. $comscore_name .'" height="1" width="1" alt="*"></noscript>';
}

add_action('wp_head', 'comscore_inline_tag');

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(),$limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
function add_twitter_cards() {
	if(is_single()) {
	 	$cc_id = get_the_ID();
        $tc_url    = get_permalink();
	    $tc_title  = get_the_title();
	    $tc_image = wp_get_attachment_image_src( get_post_thumbnail_id($cc_id), full );
	    $tc_image_thumb  = $tc_image[0];
	?>
	<meta property="og:site_name" content="RCN MUNDO" />
	<meta property="og:url" content="<?php echo $tc_url; ?>" />
	<meta property="og:title" content="ESCUCHANDO <?php echo $tc_title; ?>" />
	<meta property="og:description" content="Emisoras de RCN Radio" />
	<meta property="og:image" content="<?php echo $tc_image_thumb; ?>" />
	<meta property="fb:app_id" content="437128813159994" />
	<?php }
}
add_action('wp_head', 'add_twitter_cards');


// FUNCIONES PARA JSON


// The object type. For custom post types, this is 'post';
// for custom comment types, this is 'comment'. For user meta,
// this is 'user'.
$object_type = 'post';
$args1 = array( // Validate and sanitize the meta value.
    // Note: currently (4.7) one of 'string', 'boolean', 'integer',
    // 'number' must be used as 'type'. The default is 'string'.
    'type'         => 'string',
    // Shown in the schema for the meta key.
    'description'  => 'A meta key associated with a string meta value.',
    // Return a single value of the type.
    'single'       => true,
    // Show in the WP REST API response. Default: false.
    'show_in_rest' => true,
);
register_meta( $object_type, 'url_stream', $args1 );
register_meta( $object_type, 'site', $args1 );
register_meta( $object_type, 'station', $args1 );

?>

