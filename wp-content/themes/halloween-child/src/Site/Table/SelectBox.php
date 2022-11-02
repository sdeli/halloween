<?php

namespace Halloween\Site\Table;

class SelectBox
{
  const COMPONENT_CLASS_SEL = 'post';

  /**
   * Undocumented function
   *
   * @return void
   */
  public static function init()
  {
    add_action('wp_head', function () {
      self::echoCss();
    });
  }

  /**
   * Undocumented function
   *
   * @param string $db_meta_value
   * @return void
   */
  public static function echoBox($db_meta_value)
  {
    $couples = self::get_couples();
    if (strpos($db_meta_value, "three")) {
      $default_message = 'válassz 3 pontért';
    }
    if (strpos($db_meta_value, "two")) {
      $default_message = 'válassz 2 pontért';
    }
    if (strpos($db_meta_value, "one")) {
      $default_message = 'válassz 1 pontért';
    }
?>
    <label class="custom-select">
      <select name="<?= $db_meta_value ?>">
        <option value="0"><?= $default_message ?></option>
        <?php foreach ($couples as $couple) { ?>
          <option value="<?= $couple->ID ?>"><?= $couple->post_title ?></option>
        <?php } ?>
      </select>
    </label>
  <?php
  }

  /**
   * Undocumented function
   *
   * @return \WP_Post[]
   */
  private static function get_couples()
  {
    /**
     * @var \WP_Post[]
     */
    $couples = get_posts(["post_type" => 'couples', 'numberposts' => -1]);
    $current_user = wp_get_current_user();
    /**
     * @var \WP_Post[]
     */
    $allowed_Couples = [];
    foreach ($couples as $couple) {
      $user_name = $current_user->user_login;

      $is_him = $user_name === 'Andris';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Hilda és Andris';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
      $is_him = $user_name === 'Hilda';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Hilda és Andris';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
      $is_him = $user_name === 'Peti';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Kriszti és Peti';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
      $is_him = $user_name === 'Kriszti';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Kriszti és Peti';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
      $is_him = $user_name === 'Kristof';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Orsi és Kristóf';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
      $is_him = $user_name === 'Orsi';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Orsi és Kristóf';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
      $is_him = $user_name === 'Zoli';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Domi és Zoli';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
      $is_him = $user_name === 'Domi';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Domi és Zoli';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
      $is_him = $user_name === 'Dori';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Dóri és Bálint';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
      $is_him = $user_name === 'Balint';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Dóri és Bálint';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
      $is_him = $user_name === 'Sannya';
      if ($is_him) {
        $not_belonging_to_couple = $couple->post_title !== 'Kapitány Sanyi';
        if ($not_belonging_to_couple) {
          array_push($allowed_Couples, $couple);
        }

        continue;
      }
    }

    return $couples;
  }


  /**
   * Undocumented function
   *
   * @return void
   */
  public static function echoCss()
  {
  ?>
    <style>
      .custom-select {
        display: inline-block;
        position: relative;
        top: 16px;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        border-radius: 5px;
        box-shadow: 0 0 1em rgba(255, 255, 255, 0.2), inset 0 0 1px rgba(255, 255, 255, 0.8);
        /* Styling the select background */
        background-color: #d47df5;
      }

      .custom-select select {
        width: auto;
        margin: 0;
        padding: 0.75em 1.5em;
        outline: none;
        cursor: pointer;
        border: none;
        border-radius: 0;
        background-color: transparent;
        /* Styling the select text color */
        color: #074153;
        /* removes the fucking native down arrow */
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 0.01px;
        text-overflow: "";
      }

      .custom-select select::-ms-expand {
        display: none;
      }

      .custom-select:after {
        position: absolute;
        top: 16px;
        right: 12px;
        /* Styling the down arrow */
        width: 0;
        height: 0;
        padding: 0;
        content: "";
        border-left: 0.25em solid transparent;
        border-right: 0.25em solid transparent;
        border-top: 0.375em solid #0a6682;
        pointer-events: none;
      }

      @-moz-document url-prefix() {
        .custom-select select {
          padding-right: 1.75em;
        }
      }

      @media screen and (-webkit-min-device-pixel-ratio: 0) {
        .custom-select select {
          padding-right: 2em;
        }
      }
    </style>
<?php
  }
}
