<li class="todo" id="todo<?php echo $item->id?>">
  <?php if ($owner):?>
    <div class="ui-icon ui-icon-arrowthick-2-n-s icon-drag"></div>
  <?php endif?>
  <div class="ui-widget-header ui-helper-reset ui-corner-all ui-state-default">
    <span class="title"><?php echo $item ?></span>
    <?php if (isset($include_dashboard_links) && true === $include_dashboard_links): ?>
      <span class="check"></span>
    <?php endif ?>
    <span class="ui-widget-header-end"/> 
  </div>
  <div class="ui-widget-content ui-helper-reset ui-corner-bottom">
    <?php if (isset($include_dashboard_links) && true === $include_dashboard_links): ?>
      <p class="permalink">
        <?php /*echo link_to(
          'permalink',
          'todo_permalink',
          $todo,
          array(
            'title' => url_for(array('sf_route' => 'todo_permalink', 'sf_subject' => $todo), true)
          )
        )*/?>
      </p>
    <?php endif ?>
    <?php echo $item->get('content_html', ESC_RAW)?> 
    <?php if (isset($include_dashboard_links) && true === $include_dashboard_links): ?>
      <p class = "top"><a href="#todoAnchors"><span class="ui-icon ui-icon-carat-1-n"></span><span class="txt">top</span></a></p>
    <?php endif?>
  </div>
</li>
