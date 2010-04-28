<div id="title"><h1>Last updated lists</h1></div>

<?php if($sf_user->isAuthenticated()):?>
  <div class="right"><?php echo link_to('Create a new list', 'list/new', array('class'=>'pinkrounded'))?></div>
<?php endif?>
<ul class="listoflists">
  <?php foreach ($lists as $list):?>
  <li><?php echo link_to($list->name, 'list/show?slug='.$list->slug)?></li>
  <?php endforeach ?>
</ul>
