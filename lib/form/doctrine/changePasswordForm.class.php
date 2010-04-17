<?php

class ChangePasswordForm extends BasesfGuardUserForm
{
  /**
   * Form configuration
   */
  public function configure()
  {
    // widgets
    $this->setWidgets(array(
      'currentpassword'   => new sfWidgetFormInputPassword(),
      'password'          => new sfWidgetFormInputPassword(),
      'password2'         => new sfWidgetFormInputPassword(),
    ));

    // helps
    $this->widgetSchema->setHelps(array(
      'currentpassword'     => 'Enter your current password to confirm that you own this account.',
      'password'  => 'Your password must be 6 characters length minimum.',
      'password2' => 'Please confirm your password for avoiding typos.',
    ));

    // validators
    $this->setValidators(array(
      'currentpassword'  => new sfValidatorString(array('min_length' => 6, 'max_length' => 128)),
      'password'  => new sfValidatorString(array('min_length' => 6, 'max_length' => 128)),
      'password2' => new sfValidatorString(array('min_length' => 6, 'max_length' => 128)),
    ));

    // post validator
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
      new sfValidatorSchemaCompare('password', '==', 'password2'),
      new sfValidatorDoctrineUnique(array('model'  => 'sfGuardUser', 'column' => 'username')),
      new sfValidatorDoctrineUnique(array('model'  => 'sfGuardUser', 'column' => 'email'))
    )));

    $this->validatorSchema->setPostValidator(new sfGuardUserChangePasswordValidator(array('user_id' =>$this->getOption('user_id'))));
    $this->mergePostValidator(new sfValidatorSchemaCompare('new_password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));

    $this->widgetSchema->setNameFormat('user[%s]');

    $oDecorator = new sfWidgetFormSchemaFormatterDiv($this->getWidgetSchema());
    $this->getWidgetSchema()->addFormFormatter('div', $oDecorator);
    $this->getWidgetSchema()->setFormFormatterName('div'); 
  }

}
