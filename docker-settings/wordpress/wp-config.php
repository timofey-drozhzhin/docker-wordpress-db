<?php
$table_prefix  = getenv('DB_PREFIX') ?: 'wp_';
define('WP_CONTENT_DIR', '/var/www/html/wp-content');

// Get Variables from docker-compose.yml
foreach ($_ENV as $key => $value) {
    $capitalized = strtoupper($key);
    if (!defined($capitalized)) {
        define($capitalized, $value);
    }
}

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

require_once(ABSPATH . 'wp-settings.php');