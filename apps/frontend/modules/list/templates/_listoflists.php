  <ul class="listoflists">
    <?php foreach ($lists as $list):?>
    <li><?php echo link_to($list->name, 'list/show?slug='.$list->slug)?>&nbsp;
    <span class="shortdesc"><?php echo link_to($list->getShortDescription(50).'....','list/show?slug='.$list->slug )?></span><?php echo $list->private ? image_tag('lock.png', array('alt' => 'list is private', 'title' => 'private')) : ''?>
    </li>
    <?php endforeach ?>
  </ul>

