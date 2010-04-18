<?php
class sfGuardUserRememberPasswordValidator extends sfValidatorBase
{
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('email_field', 'email');
    $this->setMessage('invalid', 'There aren\'t accounts registered with this address.');
  }
  public function doClean($values)
  {
    $email = $values;

    if ($user = Doctrine::getTable('sfGuardUser')->findOneByEmail($email)){
      return $values;
    }

    throw new sfValidatorErrorSchema($this, array(
      'email' => new sfValidatorError($this, 'invalid'),
    ));

    // assume a required error has already been thrown, skip validation
    return $values;
  }
}
