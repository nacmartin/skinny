<div class="fiftypercent">
  <form action="<?php echo url_for('@register') ?>" method="post">
    <fieldset>
      <legend><?php echo 'Register' ?></legend>
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form['username']->renderRow() ?>
      <?php echo $form['email']->renderRow() ?>
      <?php echo $form['password']->renderRow() ?>
      <?php echo $form['password2']->renderRow() ?>
    </fieldset>
    <p style="text-align:center">
      <?php echo $form['_csrf_token'] ?>
      <input type="submit" value="<?php echo 'Click here to register your account' ?>" />
    </p>
  </form>
</div>
<div class="fiftypercent">
  <h2>Why register?</h2>   
  <p>By registering an account, you will be able to create and save your own lists.</p>
  <h2>Privacy</h2>   
  <p>We won't share your email with strangers.</p>
  <h2>Already registered</h2>   
  <p>Do you have an account?</p>
  <?php echo button_to('Sign in!', '@sf_guard_signin') ?>
</div>
