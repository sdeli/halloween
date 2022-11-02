<?php

namespace Halloween\Site\Table;

use \Halloween\Settings as Settings;

class VoteSection
{
  /**
   * Undocumented function
   *
   * @param string $name
   * @return void
   */
  public static function echoSection($name)
  {
    $display_name = str_replace("_", " ", $name)
?>
    <div class="halloween-game__adding_points" data-name="<?= $name ?>">
      <div class="halloween-game__title">
        <h2><?= $display_name ?></h2>
      </div>
      <div class="halloween-game__dropdown">
        <?php SelectBox::echoBox($name . Settings::MAX_POINTS_META[0]); ?>
      </div>
      <div class="halloween-game__dropdown">
        <?php SelectBox::echoBox($name . Settings::MAX_POINTS_META[1]); ?>
      </div>
      <div class="halloween-game__dropdown">
        <?php SelectBox::echoBox($name . Settings::MAX_POINTS_META[2]); ?>
      </div>
    </div>
<?php
  }
}
