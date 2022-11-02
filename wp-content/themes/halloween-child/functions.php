<?php

use \Halloween\Settings as Settings;
use \Halloween\Site\SuccessTable\SuccessTable as SuccessTable;

function hn_display_thank_you_message()
{
  // Do stuff. Say we will echo "Fired on the WordPress initialization".
  $content = 'Thank you for voting:)';
  return $content;
}

/**
 * Undocumented function
 *
 * @return void
 */
function hn_access_management()
{
  // Do stuff. Say we will echo "Fired on the WordPress initialization".
  if (defined('DOING_AJAX')) {
    return;
  }
  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $is_on_login_page = $actual_link === wp_login_url();
  if (!is_user_logged_in() && !$is_on_login_page) {
    wp_redirect(wp_login_url());
    exit;
  }
}
add_filter('init', 'hn_access_management', 1);

/**
 * Undocumented function
 *
 * @param string $class
 * @return void
 */
function hn_autoloader($class)
{
  // project-specific namespace prefix
  $prefix = 'Halloween';

  // base directory for the namespace prefix
  $base_dir = __DIR__ . '/src';

  // does the class use the namespace prefix?
  $len = strlen($prefix);
  if (strncmp($prefix, $class, $len) !== 0) {
    // no, move to the next registered autoloader
    return;
  }

  // get the relative class name
  $relative_class = substr($class, $len);

  // replace the namespace prefix with the base directory, replace namespace
  // separators with directory separators in the relative class name, append
  // with .php
  $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
  // if the file exists, require it
  if (file_exists($file)) {
    require_once $file;
  }
}

spl_autoload_register('hn_autoloader');

add_filter('init', function () {
  \Halloween\SeedData::init();
  if (is_admin()) {
    return;
  }

  if (defined('DOING_AJAX')) {
    return;
  }
  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $is_on_success_page = strpos($actual_link, 'halloween-success');
  if ($is_on_success_page) {
    SuccessTable::init();
    return;
  }


  $current_user = wp_get_current_user();
  /**
   * @var bool has_submitted_form 
   */
  $has_submitted_form = get_user_meta($current_user->ID, 'hn-has-voted', true);
  if ($has_submitted_form) {
    add_filter('the_content', 'hn_display_thank_you_message', 1);
    return;
  }

  $is_submitting_form = isset($_POST['submit']);
  if ($is_submitting_form) {
    update_user_meta($current_user->ID, 'hn-has-voted', true);
    add_filter('the_content', 'hn_display_thank_you_message', 1);
    hn_storing_points();
  } else {
    \Halloween\Site\Table\Table::init();
  }
}, 1);

/**
 * Undocumented function
 *
 * @return void
 */
function hn_storing_points()
{
  foreach (Settings::SECTION_METAS as $point_type) {
    $query_param_three_points = $point_type . Settings::MAX_POINTS_META[0];
    $three_points_user_id = intval($_POST[$query_param_three_points]);
    add_post_meta($three_points_user_id, 'hn-points' . '-' . $point_type, 3);

    $query_param_three_points = $point_type . Settings::MAX_POINTS_META[1];
    $two_points_user_id = intval($_POST[$query_param_three_points]);
    add_post_meta($two_points_user_id, 'hn-points' . '-' . $point_type, 2);

    $query_param_three_points = $point_type . Settings::MAX_POINTS_META[2];
    $one_point_user_id = intval($_POST[$query_param_three_points]);
    add_post_meta($one_point_user_id, 'hn-points' . '-' . $point_type, 1);
  }
}
