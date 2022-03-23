<?php
   /*
   Plugin Name: Danke! polls plugin
   Plugin URI: https://github.com/nicolasard/wp-polls-plugin
   description: A plugin to create polls
   Version: 1.2
   Author: Nicolas Ard.
   Author URI: https://nicolasard.github.io
   License: GPL2
   */

add_action('wp_footer', 'danke_footer');
function danke_footer() {
  echo '<div>Hello plugin</div>';
}


/**
 * Adding Submenu under Settings Tab
 *
 * @since 1.0
 */
function crunchify_add_menu() {
	add_submenu_page ( "options-general.php", "Crunchify Plugin", "Crunchify Plugin", "manage_options", "crunchify-hello-world", "crunchify_hello_world_page" );
}
add_action ( "admin_menu", "crunchify_add_menu" );
 
/**
 * Setting Page Options
 * - add setting page
 * - save setting page
 *
 * @since 1.0
 */
function crunchify_hello_world_page() {
	?>
<div class="wrap">
	<h1>
		Danke! polls config
	</h1>
 
	<form method="post" action="options.php">
            <?php
	settings_fields ( "crunchify_hello_world_config" );
	do_settings_sections ( "crunchify-hello-world" );
	submit_button ();
	?>
         </form>
</div>
 
<?php
}
 
/**
 * Init setting section, Init setting field and register settings page
 *
 * @since 1.0
 */
function crunchify_hello_world_settings() {
	add_settings_section ( "crunchify_hello_world_config", "", null, "crunchify-hello-world" );
	add_settings_field ( "crunchify-hello-world-text", "This is sample Textbox", "crunchify_hello_world_options", "crunchify-hello-world", "crunchify_hello_world_config" );
	register_setting ( "crunchify_hello_world_config", "crunchify-hello-world-text" );
}
add_action ( "admin_init", "crunchify_hello_world_settings" );
 
/**
 * Add simple textfield value to setting page
 *
 * @since 1.0
 */
function crunchify_hello_world_options() {
	?>
<div class="postbox" style="width: 65%; padding: 30px;">
	<input type="text" name="crunchify-hello-world-text"
		value="<?php
	echo stripslashes_deep ( esc_attr ( get_option ( 'crunchify-hello-world-text' ) ) );
	?>" /> Provide any text value here for testing<br />
</div>
<?php
}
 
/**
 * Append saved textfield value to each post
 *
 * @since 1.0
 */
add_filter ( 'the_content', 'crunchify_com_content' );
function crunchify_com_content($content) {
	return $content . stripslashes_deep ( esc_attr ( get_option ( 'crunchify-hello-world-text' ) ) );
}

?>
