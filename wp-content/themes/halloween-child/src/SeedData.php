<?php

namespace Halloween;

class SeedData
{
  /**
   * @var string[][] $users 
   */
  const users = [
    ['user_login' => 'Andris', 'user_pass' => 'AndirsHalloween', "user_email" => 'sandor.deli.dev@gmail.com'],
    ['user_login' => 'Hilda', 'user_pass' => 'HildaHalloween', "user_email" => 'sandor.deli.dev2@gmail.com'],
    ['user_login' => 'Peti', 'user_pass' => 'Peti Halloween', "user_email" => 'sandor.deli.dev3@gmail.com'],
    ['user_login' => 'Kriszti', 'user_pass' => 'Kriszti Halloween', "user_email" => 'sandor.deli.dev4@gmail.com'],
    ['user_login' => 'Kristof', 'user_pass' => 'Kristof Halloween', "user_email" => 'sandor.deli.dev5@gmail.com'],
    ['user_login' => 'Orsi', 'user_pass' => 'Orsi Halloween', "user_email" => 'sandor.deli.dev6@gmail.com'],
    ['user_login' => 'Zoli', 'user_pass' => 'Zoli Halloween', "user_email" => 'sandor.deli.dev7@gmail.com'],
    ['user_login' => 'Domi', 'user_pass' => 'Domi Halloween', "user_email" => 'sandor.deli.dev8@gmail.com'],
    ['user_login' => 'Dori', 'user_pass' => 'Dori Halloween', "user_email" => 'sandor.deli.dev9@gmail.com'],
    ['user_login' => 'Balint', 'user_pass' => 'Balint Halloween', "user_email" => 'sandor.deli.dev10@gmail.com'],
    ['user_login' => 'Sannya', 'user_pass' => 'Sannya Halloween', "user_email" => 'sandor.deli.dev11@gmail.com'],
  ];

  /**
   * @var string[][] $couples 
   */
  const couples = [
    ['post_title' => 'Handris', "post_status" => "publish", "post_type" => "couples"],
    ['post_title' => 'Korsi', "post_status" => "publish", "post_type" => "couples"],
    ['post_title' => 'Prisztina', "post_status" => "publish", "post_type" => "couples"],
    ['post_title' => 'Zomi', "post_status" => "publish", "post_type" => "couples"],
    ['post_title' => 'Báttya', "post_status" => "publish", "post_type" => "couples"],
    ['post_title' => 'Kapitány Sanyi', "post_status" => "publish", "post_type" => "couples"],
  ];
  /**
   * Undocumented function
   *
   * @return void
   */
  public static function init()
  {
    self::seedUsers();
    self::registerCouplesPostType();
    self::seedCouples();
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public static function seedUsers()
  {
    foreach (self::users as $user_data) {
      $user = get_user_by('login', $user_data['user_login']);
      if (!$user) {
        wp_insert_user($user_data);
      }
    }
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public static function registerCouplesPostType()
  {
    $supports = array(
      'title', // post title
      'author', // post author
      'thumbnail', // featured images
      'custom-fields', // custom fields
      'revisions', // post revisions
    );

    $labels = array(
      'name' => _x('couples', 'plural'),
      'singular_name' => _x('couple', 'singular'),
      'menu_name' => _x('couples', 'admin menu'),
      'name_admin_bar' => _x('couples', 'admin bar'),
      'add_new' => _x('Add couple', 'add couple'),
      'add_new_item' => __('Add New couple'),
      'new_item' => __('New couple'),
      'edit_item' => __('Edit couple'),
      'view_item' => __('View couple'),
      'all_items' => __('All couple'),
      'search_items' => __('Search couples'),
      'not_found' => __('No couples found.'),
    );

    $args = array(
      'supports' => $supports,
      'labels' => $labels,
      'public' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'couples'),
      'has_archive' => true,
      'hierarchical' => false,
      'taxonomies' => array('couple_category'),
      'show_in_rest' => true
    );

    register_post_type('couples', $args);
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public static function seedCouples()
  {
    global $wpdb;
    foreach (self::couples as $couple) {
      $couple_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $couple['post_title'] . "'");
      if (!$couple_id) {
        wp_insert_post($couple);
      }
    }
  }
}
