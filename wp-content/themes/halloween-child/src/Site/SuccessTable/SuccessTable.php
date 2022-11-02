<?php

namespace Halloween\Site\SuccessTable;

use \Halloween\Settings as Settings;

class SuccessTable
{
  const COMPONENT_CLASS_SEL = 'success-table';

  /**
   * Undocumented function
   *
   * @return void
   */
  public static function init()
  {
    add_action('wp_head', function () {
      self::echoTableCss();
    });
    add_action('the_post', function () {
      if (is_single()) {
        add_action('wp_head', function () {
          self::echoTableCss();
        });

        add_action('wp_footer', function () {
          self::echoTableJs();
        });
        add_filter('the_content', function () {
          self::echoTable();
        }, 1);
      }
    });
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public static function echoTable()
  {
?>
    <div class="success-game">
      <div class="success-game__adding_points">
        <div class="success-game__title">
          <h2><?= self::getDisplayName(Settings::SECTION_METAS[0]) ?></h2>
        </div>
        <?php
        self::resultsOfSection(Settings::SECTION_METAS[0]);
        ?>
      </div>

      <div class="success-game__adding_points">
        <div class="success-game__title">
          <h2><?= self::getDisplayName(Settings::SECTION_METAS[1]) ?></h2>
        </div>
        <?php
        self::resultsOfSection(Settings::SECTION_METAS[1]);
        ?>
      </div>

      <div class="success-game__adding_points">
        <div class="success-game__title">
          <h2><?= self::getDisplayName(Settings::SECTION_METAS[2]) ?></h2>
        </div>
        <?php
        self::resultsOfSection(Settings::SECTION_METAS[2]);
        ?>
      </div>

      <div class="success-game__adding_points">
        <div class="success-game__title">
          <h2><?= self::getDisplayName(Settings::SECTION_METAS[3]) ?></h2>
        </div>
        <?php
        self::resultsOfSection(Settings::SECTION_METAS[3]);
        ?>
      </div>

      <div class="success-game__adding_points">
        <div class="success-game__title">
          <h2><?= self::getDisplayName(Settings::SECTION_METAS[4]) ?></h2>
        </div>
        <?php
        self::resultsOfSection(Settings::SECTION_METAS[4]);
        ?>
      </div>

      <div class="success-game__adding_points">
        <div class="success-game__title">
          <h2>Az idei HALLOWEEN Abszolút Bajnoka</h2>
        </div>
        <?php
        self::resultsOfSection('Az idei HALLOWEEN Abszolút Bajnoka');
        ?>
      </div>

      <div class="success-game__adding_points">
        <div class="ending-message">
          <h2>Báttya TEAM és Sannya KAPTIÁNY gratulaál a résztvevőknek :)</h2>
          <h2>Pusszcsi</h2>
        </div>
      </div>
    </div>
    <?php
  }

  /**
   * Undocumented function
   *
   * @param string $name
   * @return void
   */
  public static function resultsOfSection($section_name)
  {
    global $wpdb;
    if ($section_name !== 'Az idei HALLOWEEN Abszolút Bajnoka') {
      $sql = "SELECT * FROM $wpdb->postmeta WHERE meta_key like '%$section_name%'";
    } else {
      $sql = "SELECT * FROM $wpdb->postmeta WHERE meta_key like '%hn-points%'";
    }
    $results = $wpdb->get_results($sql);
    $couples_with_points = self::aggregateMetaResults($results);
var_dump($couples_with_points);
    $display_couples_count = 3;
    foreach ($couples_with_points as $couple_name => $points) {
      $display_couples_count--;
      if ($display_couples_count < 0) continue;
      $couple_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $couple_name . "'");
      $thmb = get_the_post_thumbnail($couple_id);
    ?>
      <div class="runner-upps">
        <span><?= $couple_name ?></span><span><?= $points ?></span>
      </div>
      <div class="runner-upp-thumb">
        <?= $thmb ?>
      </div>
    <?php } ?>


  <?php
  }

  /**
   * $meta_results
   *
   * @param mixed[] $meta_results
   * @return mixed[]
   */
  private static function aggregateMetaResults($meta_results)
  {
    $aggr = [];
    foreach ($meta_results as $meta_result) {
      /** @phpstan-ignore-next-line */
      $couple = get_post($meta_result->post_id);
      /** @phpstan-ignore-next-line */
      if (isset($aggr[$couple->post_title])) {
        /** @phpstan-ignore-next-line */
        $aggr[$couple->post_title] += intval($meta_result->meta_value);
      } else {
        /** @phpstan-ignore-next-line */
        $aggr[$couple->post_title] = intval($meta_result->meta_value);
      }
    }
    arsort($aggr);
    return $aggr;
  }

  /**
   * Undocumented function
   *
   * @param string $name
   * @return void
   */
  public static function getDisplayName($name)
  {
    $display_name = str_replace("_", " ", $name);
    return $display_name;
  }


  function echoTableCss()
  {
  ?>
    <style title="sannya23">
      .entry-title {
        text-align: center;
        font-size: 50px !important;
      }

      h2 {
        font-size: 50px !important;
      }

      #container {
        background: url(/wp-content/uploads/2022/10/witch.png);
        background-repeat: no-repeat;
        background-size: contain;
        justify-content: center;
      }

      .success-game {
        width: 100%;
        display: flex;
        flex-direction: column;
        /* gap: 50px; */
        /* justify-content: inherit; */
        align-items: center;
        opacity: 0;
        transition: all 3s ease-in-out;
      }

      .success-game__adding_points {
        display: flex;
        flex-direction: column;
        gap: 20px;
        align-items: center;
      }

      .runner-upps {
        width: 400px;
        font-weight: bold;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        font-size: 41px;
      }

      .runner-upp-thumb {
        width: 500px;
      }

      .ending-message {
        text-align: center;
      }
    </style>
  <?php
  }

  function echoTableJs()
  {
  ?>
    <script type="application/javascript" title="<?= self::COMPONENT_CLASS_SEL ?>">
      window.addEventListener('load', (event) => {
        console.log('page is fully loaded');
        document.querySelector('body').addEventListener('click', () => {
          document.querySelector('.success-game').style.opacity = 1;
        })
      });
    </script>
<?php
  }
}
