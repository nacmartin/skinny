<div id="title"><h1>My lists</h1></div>

<?php if (count($lists) > 1):?>
  <div class="right"><?php echo link_to('Create a new list', 'list/new', array('class'=>'pinkrounded'))?></div>
  <ul class="listoflists">
    <?php foreach ($lists as $list):?>
    <li><?php echo link_to($list->name, 'list/show?slug='.$list->slug)?></li>
    <?php endforeach ?>
  </ul>
<?php else:?>
  <div class="msgcenter">
    <h2 style="margin-bottom:50px;">You haven't created any list yet</h2>
    <h3><?php echo link_to('Create a new list', 'list/new', array('class'=>'pinkrounded'))?></h3>
  </div>
<?php endif?>

