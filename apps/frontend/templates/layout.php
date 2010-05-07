<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
    try {
      var pageTracker = _gat._getTracker("UA-16121511-1");
      pageTracker._setDomainName(".listandcheck.com");
      pageTracker._trackPageview();
    } catch(err) {}</script>
    <meta name="google-site-verification" content="Ycw-C-E1v2HSmQT84unM5QtNXoO3eQ0hkUFrUaAvyfM" />
  </head>
  <body>
    <div class="topline">
      <ul>
      <?php if ($sf_user->isAuthenticated()): ?>
        <li><?php echo $sf_user->getGuardUser()->getUsername()?></li>
        <li><?php echo link_to('my lists', '@my_lists')?></li> 
        <li><?php echo link_to('sign out', '@sf_guard_signout')?></li> 
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
      </div>
      <div class="content">
        <?php echo $sf_content ?>
      </div>
    </div>
    <div id="footer">
      <div id="opensource">
        <img src="/images/opensource.png"/>list&check is licensed under <a href="http://creativecommons.org/licenses/by-sa/3.0/" rel="nofollow">cc-by-sa-3.0</a> Check <a href="http://github.com/nacmartin/skinny">the repository on github</a>. Created by <a href="http://nacho-martin.com">Nacho Martín</a>. Design obviously inspired on <a href="http://symfony-check.org">symfony-check</a>. <a href="http://github.com/nacmartin/skinny/blob/master/README.markdown">Credits</a>.

      </div>
    </div>
  </body>
</html>
