<?php

namespace Halloween\Site\Table;

use Halloween\Site\Table\Table as Table;

trait TableJs
{
  /**
   * Undocumented function
   *
   * @return void
   */
  protected static function echoTableJs()
  {
?>
    <script type="application/javascript" title="<?= Table::COMPONENT_CLASS_SEL ?>">
    </script>
<?php
  }
}
