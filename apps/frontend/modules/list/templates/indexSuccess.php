<div class="fiftypercent">
<center>
<div class="title_head_center"><h1>Create Lists<h1>
<h2>In a supple way<h2></div>
<p class="bigtext">Make lists easily.<br/> Detail your items as much as you need.</p>
<div class="register bigtext">
<?php echo link_to('Sign up for free', '@register',array('class'=>'pinkrounded'))?>
</div>
</center>
</div>
<div class="fiftypercent">
  <?php echo image_tag('screenshot.jpg')?>
</div>

<div class="title_head"><h2>Last updated lists</h2></div>

<?php if($sf_user->isAuthenticated()):?>
  <div class="right"><?php echo link_to('Create a new list', 'list/new')?></div>
<?php endif?>
<?php include_partial('listoflists', array('lists' => $lists)) ?>
