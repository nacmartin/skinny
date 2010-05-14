<div id="unregistered" style="display:none" class="flash_notice">Unregistered users cannot save their progress. <?php echo link_to('Register, it\'s free!', '@sf_guard_signin')?></div>
<div class="title_head">
<h1><?php echo $list->name?></h1></div>
<div id="description"><?php echo $list->get('descriptionHtml', ESC_RAW)?></div>
<ul id="todo" class="ui-widget ui-helper-reset">
  <?php foreach ($rows as $row): ?>
    <?php include_partial('list/item',array('item' => $row['item'], 'include_dashboard_links' => true, 'owner' => $owner, 'form' => $row['form']))?>
  <?php endforeach; ?>
</ul>

<?php if ($owner): ?>
    <div class="newitem ui-widget" id="form-new">
    <?php include_partial('list/newItem',array('form' => $newItemForm))?>
    </div>
<?php endif?>

<div id="foot-show">
<?php echo link_to('Print', "list/print?id=$list->id")?>
<?php if($owner):?>
  <?php echo link_to('Edit', 'list/update?id='.$list->id)?>
  <?php echo link_to('Delete', 'list/delete?id='.$list->id, 'confirm=Are you sure?')?>
<?php endif?>

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

  $.ajaxSetup({cache: false});

  function submitForm(form){
    id = form.attr('id');
    item_id = id.substring(11);
    if (item_id == 'new'){
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?php echo url_for('list/addSkinnyItem')?>",
        data: form.serialize()+'&id=<?php echo $list->id?>',
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          alert('There is a problem with the connection. Please, retry in some time.');
        },
        success: function(data, textStatus, XMLHttpRequest){
          newit = $("#todo").append(data);
          newit.find('textarea:last-child').markedit();
          $('#form-new input:first').val("");
          $('#form-new textarea').val("");
        }
      });
    }else{
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?php echo url_for('list/updateSkinnyItem')?>",
        data: form.serialize()+'&id=<?php echo $list->id?>'+
              '&item_id='+item_id,
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          alert('There is a problem with the connection. Please, retry in some time.');
        },
        success: function(data, textStatus, XMLHttpRequest){
          $('#todo-'+item_id).replaceWith(data);
          $('#todo-'+item_id).children('.formitem').find('textarea:last-child').markedit();
          $('#todo-'+item_id).children('.formitem').hide();
          $('#todo-'+item_id).children('.todo-show').show();
        }
      });
    }
    return false;

  }

  $('form').live('submit', function() {
    submitForm($(this));
    return false;
  });

  $('.icon-edit').live('click',function(){
    showEdit($(this).parent().parent());
  });

  $('.icon-delete').live('click',function(){
    var agree=confirm("Are you sure you want to delete this item?");
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
  $('#todo .formitem').each(function(){ $(this).hide()});

  $('.formitem form > input').live('click',function() {
    submitForm($(this).parent());
    return false;
  });

});


function showEdit(item){
  item.children('.formitem').show();
  item.children('.todo-show').hide();
  item.find('.formitem #skinny_item_name').focus();
}

</script>
<?php endif?>

<script type="text/javascript">
<?php if ($sf_user->isAuthenticated()): ?>
  function check(id){
    var r = $.ajax({
      type: 'GET',
        url: '<?php echo url_for('list/checkItem')?>'+"?id="+id,
        async: false
    }).responseText;
    return r;
  }
  
  function uncheck(id){
    var r = $.ajax({
      type: 'GET',
        url: '<?php echo url_for('list/uncheckItem')?>'+"?id="+id,
        async: false
    }).responseText;
    return r;
  }
<?php else:?>
  function check(id){
    $('#unregistered').show();
  }

  function uncheck(id){
    $('#unregistered').show();
  }
<?php endif?>
</script>
