<?php
/*
 * Author: K.A.V. Alcuinus
 * URL: alcuinus.de
 * Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
Theme Support
\*------------------------------------*/

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    add_theme_support('custom-background', array(
        'default-color' => 'F6F6F6'
        ));

    add_theme_support('custom-header', array(
        'default-image'			=> get_template_directory_uri() . '/img/headerbwenkel.png',
        'header-text'			=> false,
        'default-text-color'		=> '#414141',
        'width'				=> 768,
        'height'			=> 188,
        'random-default'		=> false,
        'wp-head-callback'		=> $wphead_cb,
        'admin-head-callback'		=> $adminhead_cb,
        'admin-preview-callback'	=> $adminpreview_cb
        ));

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('alcuinus', get_template_directory() . '/languages');
}

/*------------------------------------*\
Functions
\*------------------------------------*/

// alcuinus Blank navigation
function alcuinus_nav()
{
   wp_nav_menu(
    array(
        'theme_location'  => 'header-menu',
        'container'       => false,
        'echo'            => true,
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 2
        ));
}


function alcuinus_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        //Wij gebruiken een nieuwere versie dan de ingebouwde van wp
        wp_deregister_script('jquery');
        wp_register_script('jquery', ("https://code.jquery.com/jquery-2.1.3.min.js"), array(), '', true);
        wp_enqueue_script('jquery');

        wp_register_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), '', true);
        wp_enqueue_script('modernizr');

        wp_register_script('bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js", array(), '', true);
        wp_enqueue_script('bootstrap');

        wp_register_script('headroom', 'https://cdnjs.cloudflare.com/ajax/libs/headroom/0.7.0/headroom.min.js', array(), '', true);
        wp_enqueue_script('headroom');

        wp_register_script('alcuinus', get_template_directory_uri() . '/js/main.js', array(), '', true);
        wp_enqueue_script('alcuinus');
    }
}
// Load alcuinus Blank styles
function alcuinus_styles()
{
    //Google fonts
    wp_register_style('lora', 'http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&subset=latin,latin-ext', array(), '', 'all');
    wp_enqueue_style('lora');
    wp_register_style('inconsolata', 'http://fonts.googleapis.com/css?family=Inconsolata:400,700&subset=latin,latin-ext', array(), '', 'all');
    wp_enqueue_style('inconsolata');
    wp_register_style('cabin', 'http://fonts.googleapis.com/css?family=Cabin:400,700', array(), '', 'all');
    wp_enqueue_style('cabin');

    wp_register_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css', array(), '', 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('bootstrap-theme', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css', array(), '', 'all');
    //wp_enqueue_style('bootstrap-theme');

    wp_register_style('alcuinus', get_template_directory_uri() . '/style.css', array(), '1', 'all');
    wp_enqueue_style('alcuinus');
}

function register_alcuinus_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'alcuinus'), // Main Navigation
        ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

if (function_exists('register_sidebar'))
{
    register_sidebar(array(
        'name' => __('footerleft', 'alcuinus'),
        'description' => __('Footer left', 'alcuinus'),
        'id' => 'footerleft',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
        ));
    register_sidebar(array(
        'name' => __('footermid', 'alcuinus'),
        'description' => __('Footer mid', 'alcuinus'),
        'id' => 'footermid',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
        ));
    register_sidebar(array(
        'name' => __('footerright', 'alcuinus'),
        'description' => __('Footer right', 'alcuinus'),
        'id' => 'footerright',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
        ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
        ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function alcuinus_wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    $pagination = preg_replace('/page-numbers/', 'pagination', paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '/page/%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text'    => __('«'),
        'next_text'    => __('»'),
        'type'         => 'list'
        )), 1);

    echo str_replace('<li><span class=\'page-numbers current', '<li class="active"><span class=\'current', $pagination);
}

// Custom Excerpts
function alcuinus_wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using alcuinus_wp_excerpt('alcuinus_wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using alcuinus_wp_excerpt('alcuinus_wp_custom_post');
function alcuinus_wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function alcuinus_wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function alcuinus_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'alcuinus') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function alcuinus_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Custom Comments Callback, currently not used.
function alcuinuscomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
    ?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
       <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
       <?php endif; ?>
       <div class="comment-author vcard">
           <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
           <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
       </div>
       <?php if ($comment->comment_approved == '0') : ?>
           <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
           <br />
       <?php endif; ?>

       <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
          <?php
          printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
          ?>
      </div>

      <?php comment_text() ?>

      <div class="reply">
       <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
   </div>
   <?php if ( 'div' != $args['style'] ) : ?>
   </div>
<?php endif; ?>
<?php }

/*------------------------------------*\
Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'alcuinus_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'alcuinus_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'alcuinus_styles'); // Add Theme Stylesheet
add_action('init', 'register_alcuinus_menu'); // Add alcuinus Blank Menu
//add_action('init', 'create_post_type_alcuinus'); // Add our alcuinus Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'alcuinus_wp_pagination'); // Add our alcuinus Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'alcuinus_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'alcuinus_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes


/*------------------------------------*\
	Custom Post Types
    \*------------------------------------*/

// Soon to be Alcuinus blogpost
    function create_post_type_alcuinus()
    {
    register_taxonomy_for_object_type('category', 'alcuinus-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'alcuinus-blank');
    register_post_type('alcuinus-blank', // Register Custom Post Type
        array(
            'labels' => array(
            'name' => __('alcuinus Blank Custom Post', 'alcuinus'), // Rename these to suit
            'singular_name' => __('alcuinus Blank Custom Post', 'alcuinus'),
            'add_new' => __('Add New', 'alcuinus'),
            'add_new_item' => __('Add New alcuinus Blank Custom Post', 'alcuinus'),
            'edit' => __('Edit', 'alcuinus'),
            'edit_item' => __('Edit alcuinus Blank Custom Post', 'alcuinus'),
            'new_item' => __('New alcuinus Blank Custom Post', 'alcuinus'),
            'view' => __('View alcuinus Blank Custom Post', 'alcuinus'),
            'view_item' => __('View alcuinus Blank Custom Post', 'alcuinus'),
            'search_items' => __('Search alcuinus Blank Custom Post', 'alcuinus'),
            'not_found' => __('No alcuinus Blank Custom Posts found', 'alcuinus'),
            'not_found_in_trash' => __('No alcuinus Blank Custom Posts found in Trash', 'alcuinus')
            ),
            'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom alcuinus Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
        ));
}

/*------------------------------------*\
	ShortCode Functions
    \*------------------------------------*/
    function hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

    //Return default if no color provided
        if(empty($color))
          return $default;

    //Sanitize $color if "#" is provided
      if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

        //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

        //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

        //Return rgb(a) color string
    return $output;
}

function getHeadingList($string, $minlevel = 2, $maxlevel = 4){
    $HTML = new DOMDocument();
    $HTML->loadHTML($string);

    $xpath = new DOMXpath($HTML);

    $headerquery = '';
    for($i=$minlevel; $i<=$maxlevel; $i++){
        $headerquery .= '//h'. $i;
        if($i!==$maxlevel){
            $headerquery .= ' | ';
        }
    }

    return $xpath->query($headerquery);
    $length = $elements->length;
}

?>
