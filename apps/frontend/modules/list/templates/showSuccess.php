<?php if ($owner):?>
<script type="text/javascript">
$(function() {
    $("#todo").sortable({ opacity: 0.6, handle: '.icon-drag', placeholder: 'ui-state-highlight' });
  $("#todo").disableSelection();
  $('#todo').bind('sortupdate', function(event, ui) {
    var result = $('#todo').sortable('toArray');
    $.ajax({
      type: "POST",
      url: "<?php echo url_for('list/sort')?>",
      data: { 'sortarr' : $.toJSON(result) },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert('There is a problem with the connection. Please, retry in some time.');
      }
    });
  });
});
</script>
<?php endif?>


<div class="tagList">
</div>

<h2><?php echo $list->name?></h2>
<ul id="todo" class="ui-widget ui-helper-reset">
  <?php foreach ($items as $item): ?>
    <?php include_partial('list/item',array('item' => $item, 'include_dashboard_links' => true, 'owner' => $owner))?>
  <?php endforeach; ?>
</ul>
<div id="foot-show">
<?php if ($owner): ?>
  <?php echo link_to('Edit', 'list/edit?id='.$list->id, array('class'=>"crud"))?>
<?php endif?>
