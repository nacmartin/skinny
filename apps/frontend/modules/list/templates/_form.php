<script type="text/javascript">

var items = <?php print_r($form['items']->count())?>;

function addItem(num) {
  var r = $.ajax({
    type: 'GET',
      url: '<?php echo url_for('list/addSkinnyItemForm')?>'+'<?php echo   ($form->getObject()->isNew()?'':'?id='.$form->getObject()->getId()).($form->getObject()->isNew()?'?num=':'&num=')?>'+num,
      async: false
  }).responseText;
  return r;
}
$().ready(function() {
  $('button#add_item').click(function() {
      $("#extraitems").append(addItem(items)).find('textarea:last-child').markedit();
    items = items + 1;
  });

  $('textarea').each(function(){
    $(this).markedit();
  });

});
</script>



<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('list/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php if (!$form->getObject()->isNew()): ?>
  <input type="hidden" name="sf_method" value="put" />
  <?php endif; ?>
  <?php echo $form->renderGlobalErrors();?>
  <div><?php echo $form['_csrf_token']->render();?><?php echo $form['id']->render();?></div>
  <fieldset>
    <legend>General</legend>
    <div><?php echo $form['name']->renderRow()?></div>
    <div><?php echo $form['private']->renderRow()?></div>
  </fieldset>
  <fieldset>
    <legend>Items</legend>
    <?php for($i = 0; $i < $form['items']->count() ; $i++):?>
      <?php include_partial('addItem', array('form' => $form, 'num' => $i))?>
    <?php endfor ?>
    <div id="extraitems"/>
  </fieldset>
<button id="add_item" type="button"><?php echo "Add item"?></button>

<input type="submit" value="Save" />
</form>

<?php if (!$form->getObject()->isNew()): ?>
  <?php echo link_to('Delete', 'list/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
<?php endif; ?>

