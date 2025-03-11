<?php

if (!defined('ABSPATH')) {
    exit;
}

class Simple_Two_Factor_Auth {

    public function __construct() {
        // Hook into the login form and authentication
        add_action('login_form', [$this, 'add_2fa_field']);
        add_action('wp_authenticate_user', [$this, 'validate_2fa_code'], 10, 2);
        add_action('wp_login', [$this, 'send_2fa_code'], 10, 2);
    }

    // Step 1: Generate and send the 2FA code
    public function send_2fa_code($user_login, $user) {
        if (!is_wp_error($user)) {
            $code = wp_generate_password(6, false);
            update_user_meta($user->ID, '_2fa_code', $code);
            update_user_meta($user->ID, '_2fa_code_time', time());

            // Send the code via email
            $subject = 'Your 2FA Code';
            $message = 'Your 2FA code is: ' . $code;
            wp_mail($user->user_email, $subject, $message);

            // Redirect to the 2FA verification page
            wp_redirect(home_url('/2fa-verification/'));
            exit;
        }
    }

    // Step 2: Add 2FA field to the login form
    public function add_2fa_field() {
        if (isset($_GET['2fa']) && $_GET['2fa'] === 'true') {
            ?>
            <p>
                <label for="2fa_code">2FA Code<br />
                <input type="text" name="2fa_code" id="2fa_code" class="input" value="" size="20" /></label>
            </p>
            <?php
        }
    }

    // Step 3: Validate the 2FA code
    public function validate_2fa_code($user, $password) {
        if (isset($_POST['2fa_code']) && !empty($_POST['2fa_code'])) {
            $saved_code = get_user_meta($user->ID, '_2fa_code', true);
            $code_time = get_user_meta($user->ID, '_2fa_code_time', true);

            // Code valid for 5 minutes (300 seconds)
            if ($saved_code && $code_time && time() - $code_time <= 300) {
                if ($saved_code === $_POST['2fa_code']) {
                    // Success - clear the code
                    delete_user_meta($user->ID, '_2fa_code');
                    delete_user_meta($user->ID, '_2fa_code_time');
                    return $user;
                } else {
                    return new WP_Error('invalid_2fa_code', __('Invalid 2FA code.'));
                }
            } else {
                return new WP_Error('expired_2fa_code', __('2FA code expired.'));
            }
        } else {
            return new WP_Error('missing_2fa_code', __('Please enter your 2FA code.'));
        }

        return $user;
    }
}
