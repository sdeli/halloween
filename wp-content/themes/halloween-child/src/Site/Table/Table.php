<?php

namespace Halloween\Site\Table;

use \Halloween\Site\Table\TableCss as TableCss;
use \Halloween\Site\Table\TableJs as TableJs;
use \Halloween\Site\Table\SelectBox as SelectBox;
use \Halloween\Site\Table\VoteSection as VoteSection;
use \Halloween\Settings as Settings;
// use \Inc\Settings as Settings;

class Table
{
  const COMPONENT_CLASS_SEL = 'post';

  use TableCss;
  use TableJs;

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
        add_action('wp_footer', function () {
          self::echoTableJs();
        });
        add_filter('the_content', function () {
          self::echoTable();
        }, 1);
      }
    });

    SelectBox::init();
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public static function echoTable()
  {
?>
    <div class="halloween-game">
      <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
        <div class="halloween-game__adding_points">
          <?php
          VoteSection::echoSection(Settings::SECTION_METAS[0]);
          ?>
        </div>

        <div class="halloween-game__adding_points">
          <?php
          VoteSection::echoSection(Settings::SECTION_METAS[1]);
          ?>
        </div>

        <div class="halloween-game__adding_points">
          <?php
          VoteSection::echoSection(Settings::SECTION_METAS[2]);
          ?>
        </div>

        <div class="halloween-game__adding_points">
          <?php
          VoteSection::echoSection(Settings::SECTION_METAS[3]);
          ?>
        </div>

        <div class="halloween-game__adding_points">
          <?php
          VoteSection::echoSection(Settings::SECTION_METAS[4]);
          ?>
        </div>

        <div class="halloween-game__adding_points" style="margin-top: 50px;">
          <input name="submit" type="submit">
        </div>
      </form>
    </div>
<?php
  }
}
