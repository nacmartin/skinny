<div class="fiftypercent">
  <form action="<?php echo url_for('@changePassword') ?>" method="post">
    <fieldset>
      <legend><?php echo 'Change password' ?></legend>
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form['currentpassword']->renderRow() ?>
      <?php echo $form['password']->renderRow() ?>
      <?php echo $form['password2']->renderRow() ?>
    </fieldset>
    <p style="text-align:center">
      <?php echo $form['_csrf_token'] ?>
      <input type="submit" value="<?php echo 'Save changes' ?>" />
    </p>
  </form>
</div>
