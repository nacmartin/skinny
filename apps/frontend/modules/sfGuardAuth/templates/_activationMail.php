Dear <?php echo $username?>, 

To continue the registration, please use the following link:

<?php echo url_for('@activate?token='.$token, true)?>

Welcome to List&Check!
