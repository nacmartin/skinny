<?php $hascontent = (!$item->text || $item->text == "") ? false : true;?>

<li class="todo" id="todo-<?php echo $item->id?>">
  <div class = "todo-show">
    <?php if ($owner):?>
      <div class="ui-icon ui-icon-closethick icon-delete"></div>
      <div class="ui-icon ui-icon-arrowthick-2-n-s icon-drag"></div>
      <div class="ui-icon ui-icon-pencil icon-edit"></div>
    <?php endif?>
    <div class="ui-widget-header item-header ui-helper-reset ui-corner-all ui-state-default <?php echo $hascontent ? 'hascontent' : '' ?><?php if(count($item->getSkinnyChecks())){echo 'ui-state-disabled';}?>">
      <span class="title"><?php echo $item->name ?></span>
      <?php if ($hascontent):?>
        <div class="ui-icon ui-icon-triangle-1-e icon-show"></div>
      <?php endif?>
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
    </div>
  </div>
  <?php if ($owner):?>
  <div class="formitem" id="form-<?php echo $item->id?>" style="display:none;">
  <form id="actualform-<?php echo $item->id?>">
      <div class="ui-widget-header ui-helper-reset ui-corner-all ui-state-default">
      <?php echo $form['name']->render()?><?php echo $form['id']->render()?></div>
      <div><?php echo $form['text']->render()?></div>
      <input type="submit" value="Submit" />
    </form>

  </div>
  <?php endif?>
</li>
