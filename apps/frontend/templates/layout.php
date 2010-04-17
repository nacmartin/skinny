<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div class="topline">
      <ul>
      <?php if ($sf_user->isAuthenticated()): ?>
        <li><?php echo $sf_user->getGuardUser()->getUsername()?></li>
        <li><?php echo link_to('logoout', '@sf_guard_signout')?></li> 
        <li><?php echo link_to('change password', '@changePassword')?></li> 
      <?php else: ?>
        <li><?php echo link_to('sign up', '@register')?></li> 
        <li><?php echo link_to('sign in', '@sf_guard_signin')?></li> 
      <?php endif ?>
      </ul>
    </div>

    <div class="wrapAll">
      <?php echo link_to(image_tag('listandcheck.png'), '@homepage')?>
      <div id="flashes">
        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
        <?php endif; ?>

        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
        <?php endif; ?>
      <div class="content">
        <?php echo $sf_content ?>
      </div>
    </div>
  </body>
</html>
