  <ul class="listoflists">
    <?php foreach ($lists as $list):?>
    <li><?php echo link_to($list->name, 'list/show?slug='.$list->slug)?>&nbsp;
    <span class="shortdesc"><?php echo link_to($list->getShortDescription(50).'....','list/show?slug='.$list->slug )?></span>
    </li>
    <?php endforeach ?>
  </ul>

