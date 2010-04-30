<h1><?php echo $list->name?></h1>
<ul>
  <?php foreach ($items as $item):?>
    <div class="print-title">
      <h2><?php echo count($item->getSkinnyChecks()) ? image_tag("checkbox-checked.png") : image_tag("checkbox.png")?>
      <?php echo $item->name ?></h2></div>
    <?php $content = $item->text?>
    <?php if ($content) :?>
      <div class="print-content">
        <?php echo $item->get('content_html', ESC_RAW) ?>
      </div>
    <?php endif?>
  <?php endforeach?>
</ul>


