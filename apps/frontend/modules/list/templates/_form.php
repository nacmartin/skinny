<div class="fiftypercent">
  <form action="<?php echo url_for('list/'.($form->getObject()->isNew() ? 'new':'update?id='.$form->getObject()->id)) ?>" method="post">
      <fieldset>
        <legend>New list</legend>
        <?php echo $form->renderGlobalErrors() ?>
        <?php echo $form['id']->render() ?>
        <?php echo $form['name']->renderRow() ?>
        <?php echo $form['description']->renderRow() ?>
        <?php echo $form['private']->renderRow() ?>
      </fieldset>
      <p style="text-align:center">
        <?php echo $form['_csrf_token'] ?>
        <input type="submit" value="<?php echo $form->getObject()->isNew() ? 'Create the list' : 'Save' ?>" />
      </p>
  </form>
</div>
