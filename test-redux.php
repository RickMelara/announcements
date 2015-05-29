<?php
/*
Plugin Name: UAM Site Announcements 
*/
define( PLUGIN_PATH, plugin_dir_path( __FILE__ ) );

require_once( PLUGIN_PATH . 'config.php' );

function uam_announcements_add_theme_styles () {
	wp_enqueue_style( 'main', '/wp-content/mu-plugins/plugin-test-redux/css/uamAnnouncements.css');
}

add_action( 'wp_enqueue_scripts', 'uam_announcements_add_theme_styles' );

function uam_announcements_add_bar () {
	global $opt_name;
	$option = get_site_option( $opt_name );
	$id = get_blog_details()->blog_id;
	$blogName = get_blog_details()->blogname;
	if ($option["uam_announcements_state"] && $option["uam_announcements_bar_site_state_$id"] && is_user_logged_in()) :
		
		add_action('wp_head', 'uam_announcements_custom_styles');
		?>
		<div id="uamAnnouncementsBar_<?php echo $id; ?>" class="uamAnnouncementsBar">
			<?php if ( $option["uam_announcement_text_$id"] === 'Default' || $option["uam_announcement_text_$id"] === '') : ?>
				<h1><?php echo "You Are In " . $blogName; ?></h1>
			<?php else: ?>
				<h1> <?php echo $option["uam_announcement_text_$id"]; ?> </h1>
			<?php endif; ?>
			
		</div>
		<?php
	
	endif;
}

add_action( 'get_footer', 'uam_announcements_add_bar' );
?>