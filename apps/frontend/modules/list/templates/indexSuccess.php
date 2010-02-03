<h1>Skinny lists List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($skinny_lists as $skinny_list): ?>
    <tr>
      <td><a href="<?php echo url_for('list/show?id='.$skinny_list->getId()) ?>"><?php echo $skinny_list->getId() ?></a></td>
      <td><?php echo $skinny_list->getName() ?></td>
      <td><?php echo $skinny_list->getCreatedAt() ?></td>
      <td><?php echo $skinny_list->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('list/new') ?>">New</a>
