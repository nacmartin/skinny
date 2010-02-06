<h1>Skinny lists List</h1>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>View</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($skinny_lists as $skinny_list): ?>
    <tr>
      <td><?php echo $skinny_list->getName() ?></td>
      <td><?php echo $skinny_list->getCreatedAt() ?></td>
      <td><?php echo $skinny_list->getUpdatedAt() ?></td>
      <td><?php echo link_to("View", 'list_permalink', $skinny_list, 
                            array(
                              'name' => url_for(
                                array(
                                  'sf_route'   => 'list_permalink', 
                                  'sf_subject' => $skinny_list), 
                                true
                              ))) ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('list/new') ?>">New</a>
