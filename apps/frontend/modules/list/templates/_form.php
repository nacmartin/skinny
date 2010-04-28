<div class="fiftypercent">
  <form action="<?php echo url_for('list/new') ?>" method="post">
      <fieldset>
        <legend>New list</legend>
        <?php echo $form->renderGlobalErrors() ?>
        <?php echo $form['name']->renderRow() ?>
        <?php //echo $form['private']->renderRow() ?>
        <?php echo $form['description']->renderRow() ?>
      </fieldset>
      <p style="text-align:center">
        <?php echo $form['_csrf_token'] ?>
        <input type="submit" value="<?php echo 'Create the list' ?>" />
      </p>
  </form>
</div>
