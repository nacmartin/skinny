<div class="fiftypercent">
  <form action="<?php echo url_for('@rememberPassword') ?>" method="post">
    <fieldset>
      <legend><?php echo 'Password forgotten?' ?></legend>
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form['email']->renderRow() ?>
    </fieldset>
    <p style="text-align:center">
      <?php echo $form['_csrf_token'] ?>
      <input type="submit" value="<?php echo 'Next' ?>" />
    </p>
  </form>
</div>
