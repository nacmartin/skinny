<center>
<h1>Login required.</h1>
<p>This page is not public</p>
<p>You must proceed to the login page and enter your username and password.</p>

<ul>
      <li><?php echo link_to('Proceed to login', sfConfig::get('sf_login_module').'/'.sfConfig::get('sf_login_action')) ?></li>
      <li><a href="javascript:history.go(-1)">Back to previous page</a></li>
</ul>
