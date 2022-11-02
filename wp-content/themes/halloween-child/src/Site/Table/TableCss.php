<?php

namespace Halloween\Site\Table;

trait TableCss
{
  /**
   * Undocumented function
   *
   * @return void
   */
  protected static function echoTableCss()
  {
?>
    <style title="sannya2222">
      .entry-title {
        text-align: center;
      }

      #container {
        background: url(/wp-content/uploads/2022/10/witch.png);
        background-repeat: no-repeat;
        background-size: contain;
        justify-content: center;
      }

      .halloween-game {
        width: 100%;
        display: flex;
        flex-direction: column;
        /* gap: 50px; */
        /* justify-content: inherit; */
        align-items: center;
      }

.halloween-game__title {
    text-align: center;
}

      .halloween-game__adding_points {
        display: flex;
        flex-direction: column;
        gap: 20px;
        align-items: center;
      }
    </style>
<?php
  }
}
