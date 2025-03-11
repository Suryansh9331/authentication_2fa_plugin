<?php
/*
Plugin Name: Simple 2FA
Description: A simple plugin that adds email-based two-factor authentication to WordPress login.
Version: 1.0
Author: Suryansh
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Include the main class file
require_once plugin_dir_path(__FILE__) . 'includes/2FA-handler.php';

// Initialize the plugin
function simple_2fa_init() {
    $two_factor_auth = new Simple_Two_Factor_Auth();
}
add_action('plugins_loaded', 'simple_2fa_init');

// Register shortcode to display 2FA form
add_shortcode('2fa_verification', function() {
    if (is_user_logged_in()) { 
        ?>
        <form method="post" action="<?php echo wp_login_url(); ?>">
            <p>
                <label for="2fa_code">Enter your 2FA Code:</label>
                <input type="text" name="2fa_code" required />
            </p>
            <p>
                <input type="submit" value="Verify" />
            </p>
        </form>
        <?php
    } else {
        echo '<p>You must be logged in to verify your code.</p>';
    }
});

// Enqueue styles for the form
function simple_2fa_enqueue_styles() {
    wp_enqueue_style('simple-2fa', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'simple_2fa_enqueue_styles');

// Activation Hook
register_activation_hook(__FILE__, 'simple_2fa_activate');
function simple_2fa_activate() {
    // Code to run on activation (e.g., setup database tables, options)
}

// Deactivation Hook
register_deactivation_hook(__FILE__, 'simple_2fa_deactivate');
function simple_2fa_deactivate() {
    // Cleanup code on deactivation (e.g., remove options)
}
