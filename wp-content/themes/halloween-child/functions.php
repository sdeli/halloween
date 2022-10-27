<?php
function hl_the_content()
{
  // Do stuff. Say we will echo "Fired on the WordPress initialization".
  $content = 'Fired on the WordPress initialization';
  return $content;
}
add_filter('the_content', 'hl_the_content', 1);

function is_suer()
{
  // Do stuff. Say we will echo "Fired on the WordPress initialization".
  $user = wp_get_current_user();
  $is_admin = in_array('administrator', (array) $user->roles);
  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $is_on_login_page = $actual_link === wp_login_url();
  if (!$is_admin && !$is_on_login_page) {
    wp_redirect(wp_login_url());
    exit;
  }
}
add_filter('init', 'is_suer', 1);
