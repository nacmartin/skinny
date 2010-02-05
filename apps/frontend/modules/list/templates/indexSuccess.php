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
      <td><?php echo link_to("View","list/show?id=".$skinny_list->getid()) ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('list/new') ?>">New</a>
