<?php if ($owner):?>
<script type="text/javascript">
$(function() {
  $("#todo").sortable({ opacity: 0.6, handle: '.icon-drag', placeholder: 'ui-state-highlight' });
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

  $('form').live('submit', function() {
      id = $(this).parent().parent().attr('id');
      item_id = id.substring(5);
      $.ajax({
        type: "POST",
        url: "<?php echo url_for('list/updateSkinnyItem')?>",
        data: $(this).serialize()+'&id=<?php echo $list->id?>'+
              '&item_id='+item_id,
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          alert('There is a problem with the connection. Please, retry in some time.');
        },
        success: function(data){
          $('#'+id).replaceWith(data);
          $('#'+id).children('.formitem').find('textarea:last-child').markedit();
          $('#'+id).children('.formitem').hide();
          $('#'+id).children('.todo-show').show();
        }
      });
      return false;
  });

  $('button#add_item').click(function() {
    newit = $("#todo").append(addItem())
    newit.find('textarea:last-child').markedit();
    newit.find('.formitem:last').show();
    newit.find('.todo-show:last').hide();

  });

  $('.icon-edit').live('click',function(){
    showEdit($(this).parent().parent());
  });

  $('.icon-delete').live('click',function(){
    var agree=confirm("Are you sure you want to delete?");
    if (!agree) return;
    id = $(this).parent().parent().attr('id');
    item_id = id.substring(5);
    var r = $.ajax({
      type: 'GET',
      url: '<?php echo url_for('list/deleteSkinnyItem')."?id=$list->id"."&item_id="?>'+item_id,
      async: false,
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alert('There is a problem with the connection. Please, retry in some time.');
        },
      success: function(data){
        $('#'+id).remove();
      }
    }).responseText;
    return r;
  });

  $('textarea').each(function(){
    $(this).markedit();
  });

  $('.todo-show').each(function(){ $(this).show()});
  $('.formitem').each(function(){ $(this).hide()});

});
function addItem(num) {
  var r = $.ajax({
    type: 'GET',
      url: '<?php echo url_for('list/addSkinnyItem')."?id=$list->id"?>',
      async: false
  }).responseText;
  return r;
}
function showEdit(item){
  item.children('.formitem').show();
  item.children('.todo-show').hide();
}

</script>
<?php endif?>


<div id="title"><h1><?php echo $list->name?></h1></div>
<ul id="todo" class="ui-widget ui-helper-reset">
  <?php foreach ($rows as $row): ?>
    <?php include_partial('list/item',array('item' => $row['item'], 'include_dashboard_links' => true, 'owner' => $owner, 'form' => $row['form']))?>
  <?php endforeach; ?>
</ul>
<div id="foot-show">
<?php if ($owner): ?>
<button id="add_item" type="button"><?php echo "Add item"?></button>
<?php endif?>
<?php echo link_to('Print', "list/print?id=$list->id")?>
